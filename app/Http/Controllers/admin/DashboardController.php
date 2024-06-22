<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Pesanan;
use App\Models\PesananLainnya;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{
    public function Index()
    {
        $pesananBaru = Pesanan::where('status_pesanan', 'Belum Selesai')->get();
        $pesananBelumBayar = Pesanan::where('status_pembayaran', 'Belum Dibayar')->get();

        $tanggalAwal = null;
        $tanggalAkhir = null;
        $periode = 'Bulanan';
        $pesanan = Pesanan::selectRaw('MONTH(created_at) as month, SUM(total_harga) as total_amount')
                            ->where('status_pesanan', 'Selesai')
                            ->where('status_pembayaran', 'Sudah Dibayar')
                            ->whereYear('created_at',date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

        $labels = [];
        $data = [];
        $colors = ['#8BC34A'];

        $periodeData= ['Harian', 'Mingguan', 'Bulanan', 'Tahunan'];
    
        for ($i=1; $i <= 12; $i++) { 
            $month = date('F',mktime(0,0,0,$i,1));
            $total_amount = 0;
    
            foreach ($pesanan as $key => $item) {
                if ($item->month == $i) {
                    $total_amount = $item->total_amount;
                    break;
                }
            }
            array_push($labels,$month);
            array_push($data,$total_amount);
        }
    
        $datasets = [
            [
                'label' => 'Total Pesanan',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];


        return view('dashboard.index',compact('pesananBaru','pesananBelumBayar','datasets','labels','tanggalAwal','tanggalAkhir','periode','periodeData'));
    }
    
    
    public function PesananDashboard($jenis_pesanan)
    {
        if($jenis_pesanan == 'baru'){
            $pesananBaru = Pesanan::where('status_pesanan', 'Belum Selesai')->get();

            return view('dashboard.pesananbaru.index',compact('pesananBaru',));

        } elseif($jenis_pesanan == 'belumbayar'){
            $pesananBelumBayar = Pesanan::whereIn('status_pesanan', ['Belum Selesai', 'Selesai'])
            ->where('status_pembayaran', 'Belum Dibayar')
            ->get();

            return view('dashboard.pesananbelumbayar.index', compact('pesananBelumBayar'));

        } else{
            $pesananSelesai = Pesanan::where('status_pesanan', 'Selesai')
            ->where('status_pembayaran', 'Sudah Dibayar')
            ->get();

            return view('dashboard.pesananselesai.index',compact('pesananSelesai',));
        }

    }

    public function PesananDetail($id_pesanan)
    {
        $pesanan = Pesanan::query()->findOrFail($id_pesanan);

        return view('dashboard.pesanandetail',compact('pesanan',));
    }

    public function Laporan()
    {
        $pendapatan = Pesanan::all();
        $pesananLainnya = PesananLainnya::all();
        $pengeluaran = Pengeluaran::all();
        
        return view('dashboard.laporan.index', compact('pendapatan', 'pesananLainnya', 'pengeluaran'));
    }

    public function FilterData(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');

        $pendapatan = Pesanan::whereDate('created_at', '>=', $tanggalAwal)
                                ->whereDate('created_at', '<=', $tanggalAkhir)
                                ->get();
        $pesananLainnya = PesananLainnya::whereDate('created_at', '>=', $tanggalAwal)
                                ->whereDate('created_at', '<=', $tanggalAkhir)
                                ->get();
        $pengeluaran = Pengeluaran::whereDate('created_at', '>=', $tanggalAwal)
                                ->whereDate('created_at', '<=', $tanggalAkhir)
                                ->get();
                                
        return view('dashboard.laporan.index', compact('pendapatan', 'pesananLainnya', 'pengeluaran', 'tanggalAwal', 'tanggalAkhir'));
    }

    public function CetakLaporan(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwalCetak');
        $tanggalAkhir = $request->input('tanggalAkhirCetak');

        if($tanggalAwal != null && $tanggalAkhir != null){
            $pendapatan = Pesanan::whereDate('created_at', '>=', $tanggalAwal)
                        ->whereDate('created_at', '<=', $tanggalAkhir)
                        ->get();
            $pesananLainnya = PesananLainnya::whereDate('created_at', '>=', $tanggalAwal)
                        ->whereDate('created_at', '<=', $tanggalAkhir)
                        ->get();
            $pengeluaran = Pengeluaran::whereDate('created_at', '>=', $tanggalAwal)
                        ->whereDate('created_at', '<=', $tanggalAkhir)
                        ->get();

            $pdf = Pdf::loadView('dashboard.laporan.cetak', ['pendapatan'=>$pendapatan, 'pesananLainnya'=>$pesananLainnya, 'pengeluaran'=>$pengeluaran]);
            $filename = 'Laporan-Keuangan(' . $tanggalAwal . '-' . $tanggalAkhir . ').pdf';
            return $pdf->download($filename);
        } else {
            $pendapatan = Pesanan::all();
            $pesananLainnya = PesananLainnya::all();
            $pengeluaran = Pengeluaran::all();
            
            $pdf = Pdf::loadView('dashboard.laporan.cetak', ['pendapatan'=>$pendapatan, 'pesananLainnya'=>$pesananLainnya, 'pengeluaran'=>$pengeluaran]);
            return $pdf->download('Laporan-Keuangan.pdf');
        }
    }

    public function FilterChart(Request $request)
    {
        $tanggalAwal = $request->input('tanggalAwal');
        $tanggalAkhir = $request->input('tanggalAkhir');
        $periode = $request->input('periode');

        $pesananBaru = Pesanan::where('status_pesanan', 'Belum Selesai')->get();
        $pesananBelumBayar = Pesanan::where('status_pembayaran', 'Belum Dibayar')->get();

        $labels = [];
        $data = [];
        $colors = ['#8BC34A'];

        $periodeData = ['Harian', 'Mingguan', 'Bulanan', 'Tahunan'];

        switch ($periode) {
            case 'Harian':
                $pesanan = Pesanan::selectRaw('DATE(created_at) as date, SUM(total_harga) as total_amount')
                                    ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                                    ->where('status_pesanan', 'Selesai')
                                    ->where('status_pembayaran', 'Sudah Dibayar')
                                    ->groupBy('date')
                                    ->orderBy('date')
                                    ->get();
            
                $tanggal = $tanggalAwal;
                while ($tanggal <= $tanggalAkhir) { 
                    $dailyTotal = 0; 
            
                    foreach ($pesanan as $item) {
                        if ($item->date == $tanggal) {
                            $dailyTotal = $item->total_amount;
                            break;
                        }
                    }
                    
                    array_push($labels, $tanggal);
                    array_push($data, $dailyTotal);
                    
                    $tanggal = date('Y-m-d', strtotime($tanggal . ' +1 day'));
                }
                break;
        
            case 'Mingguan':
                $pesanan = Pesanan::selectRaw('YEAR(created_at) as year, WEEK(created_at) as week, SUM(total_harga) as total_amount')
                                    ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                                    ->where('status_pesanan', 'Selesai')
                                    ->where('status_pembayaran', 'Sudah Dibayar')
                                    ->groupBy('year', 'week')
                                    ->orderBy('year')
                                    ->orderBy('week')
                                    ->get();
            
                $startWeek = intval(date('W', strtotime($tanggalAwal)));
                $endWeek = intval(date('W', strtotime($tanggalAkhir)));
            
                for ($week = $startWeek; $week <= $endWeek; $week++) {
                    $total_amount = 0;
                    
                    foreach ($pesanan as $item) {
                        if ($item->week == $week) {
                            $total_amount += $item->total_amount;
                        }
                    }
                    
                    $year = date('Y', strtotime($tanggalAwal));
                    $labels[] = "Week $week/$year";
                    $data[] = $total_amount;
                }
                break;

            case 'Bulanan':
                $pesanan = Pesanan::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_harga) as total_amount')
                                    ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                                    ->where('status_pesanan', 'Selesai')
                                    ->where('status_pembayaran', 'Sudah Dibayar')
                                    ->groupBy('year', 'month')
                                    ->orderBy('year')
                                    ->orderBy('month')
                                    ->get();
            
                $startMonth = intval(date('m', strtotime($tanggalAwal)));
                $endMonth = intval(date('m', strtotime($tanggalAkhir)));
                $startYear = intval(date('Y', strtotime($tanggalAwal)));
                $endYear = intval(date('Y', strtotime($tanggalAkhir)));
            
                for ($year = $startYear; $year <= $endYear; $year++) {
                    $start = ($year == $startYear) ? $startMonth : 1;
                    $end = ($year == $endYear) ? $endMonth : 12;
                    
                    for ($month = $start; $month <= $end; $month++) {
                        $total_amount = 0;
                        foreach ($pesanan as $item) {
                            if ($item->year == $year && $item->month == $month) {
                                $total_amount += $item->total_amount;
                            }
                        }
                        
                        $labels[] = date('m-Y', mktime(0, 0, 0, $month, 1, $year));
                        $data[] = $total_amount;
                    }
                }
                break;
                
            case 'Tahunan':
                $pesanan = Pesanan::selectRaw('YEAR(created_at) as year, SUM(total_harga) as total_amount')
                                    ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
                                    ->where('status_pesanan', 'Selesai')
                                    ->where('status_pembayaran', 'Sudah Dibayar')
                                    ->groupBy('year')
                                    ->orderBy('year')
                                    ->get();
            
                $startYear = intval(date('Y', strtotime($tanggalAwal)));
                $endYear = intval(date('Y', strtotime($tanggalAkhir)));
            
                for ($year = $startYear; $year <= $endYear; $year++) {
                    $total_amount = 0;
                    
                    foreach ($pesanan as $item) {
                        if ($item->year == $year) {
                            $total_amount += $item->total_amount;
                        }
                    }
                    
                    $labels[] = $year;
                    $data[] = $total_amount;
                }
                break;
        }

        $datasets = [
            [
                'label' => 'Total Pesanan',
                'data' => $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('dashboard.index',compact('pesananBaru','pesananBelumBayar','datasets','labels','tanggalAwal','tanggalAkhir', 'periode', 'periodeData'));
    }
}
