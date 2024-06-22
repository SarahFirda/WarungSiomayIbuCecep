<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-navbutton-color" content="#D9BD8E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#D9BD8E">
    <title>HomePage</title>
</head>

<body style="font-family: Arial, sans-serif;">

    <div style="max-width: 210mm; margin: 0 auto; padding: 16px; box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);">

        <div style="font-weight: bold; text-align: center; font-size: 1.5rem; padding-top: 1rem;">Laporan Keuangan</div>

        <div style="padding: 2rem 1rem 1rem 1rem;">
            <table style="width: 100%; border-collapse: collapse; border-radius: 0.5rem; border: 2px solid black;">
                <thead>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;" colspan="3">Data Pendapatan</th>
                    </tr>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">No Antri</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Total</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPendapatan = 0;
                    @endphp

                    @if (isset($pendapatan) && count($pendapatan) !== 0)
                        @foreach ($pendapatan as $item)
                            @php
                                $totalPendapatan += $item->grand_total;
                            @endphp
                            <tr style="color: black; text-align: center; border: 2px solid black;">
                                <td style="border: 2px solid black;">{{ $item->Antrian->nomor_antrian }}</td>
                                <td style="border: 2px solid black;">
                                    Rp.{{ number_format($item->grand_total, 0, ',', '.') }}
                                </td>
                                <td style="border: 2px solid black;">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="color: black; text-align: center; border: 2px solid black;">
                            <td style="border: 2px solid black; padding: 3rem 0;" colspan="3">Data Pendapatan Kosong
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div style="font-weight: bold; font-size: 1.125rem; padding-top: 1rem; padding-bottom: 0.5rem;">Total
                Pendapatan:
                Rp.{{ isset($pendapatan) && count($pendapatan) !== 0 ? number_format($totalPendapatan, 0, ',', '.') : 0 }}
            </div>
        </div>

        <div style="padding: 1rem 1rem 0;">
            <table style="width: 100%; border-collapse: collapse; border-radius: 0.5rem; border: 2px solid black;">
                <thead>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;" colspan="3">Data Pesanan Luar</th>
                    </tr>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Nominal</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Sumber</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPesananLuar = 0;
                    @endphp

                    @if (isset($pesananLuar) && count($pesananLuar) !== 0)
                        @foreach ($pesananLuar as $item)
                            @php
                                $totalPesananLuar += $item->nominal;
                            @endphp
                            <tr style="color: black; text-align: center; border: 2px solid black;">
                                <td style="border: 2px solid black;">Rp.{{ number_format($item->nominal, 0, ',', '.') }}
                                </td>
                                <td style="border: 2px solid black;">
                                    {{ $item->sumber }}
                                </td>
                                <td style="border: 2px solid black;">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="color: black; text-align: center; border: 2px solid black;">
                            <td style="border: 2px solid black; padding: 3rem 0;" colspan="3">Data Pesanan Luar
                                Kosong
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div style="font-weight: bold; font-size: 1.125rem; padding-top: 1rem; padding-bottom: 0.5rem;">Total
                Pesanan Luar:
                Rp.{{ isset($pesananLuar) && count($pesananLuar) !== 0 ? number_format($totalPesananLuar, 0, ',', '.') : 0 }}
            </div>
        </div>

        <div style="padding: 1rem 1rem 0;">
            <table style="width: 100%; border-collapse: collapse; border-radius: 0.5rem; border: 2px solid black;">
                <thead>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;" colspan="3">Data Pengeluaran</th>
                    </tr>
                    <tr style="color: black; text-align: center; border: 2px solid black;">
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Nominal</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Keperluan</th>
                        <th style="padding: 0.5rem 1rem; border: 2px solid black;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPengeluaran = 0;
                    @endphp

                    @if (isset($pengeluaran) && count($pengeluaran) !== 0)
                        @foreach ($pengeluaran as $item)
                            @php
                                $totalPengeluaran += $item->nominal;
                            @endphp
                            <tr style="color: black; text-align: center; border: 2px solid black;">
                                <td style="border: 2px solid black;">Rp.{{ number_format($item->nominal, 0, ',', '.') }}
                                </td>
                                <td style="border: 2px solid black;">
                                    {{ $item->keperluan }}
                                </td>
                                <td style="border: 2px solid black;">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr style="color: black; text-align: center; border: 2px solid black;">
                            <td style="border: 2px solid black; padding: 3rem 0;" colspan="3">Data Pengeluaran
                                Kosong
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div style="font-weight: bold; font-size: 1.125rem; padding-top: 1rem; padding-bottom: 0.5rem;">Total
                Pesanan Luar:
                Rp.{{ isset($pengeluaran) && count($pengeluaran) !== 0 ? number_format($totalPengeluaran, 0, ',', '.') : 0 }}
            </div>

            @php
                $grandTotal = $totalPendapatan + $totalPesananLuar - $totalPengeluaran;
            @endphp

            <div style="font-weight: bold; font-size: large; padding-top: 4px;">Grand Total:
                Rp.{{ number_format($grandTotal, 0, ',', '.') ?? 0 }}</div>

        </div>
    </div>
</body>
