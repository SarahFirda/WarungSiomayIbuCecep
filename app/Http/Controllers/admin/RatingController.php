<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function Index()
    {
        $data = Rating::select('id_menu', DB::raw('AVG(rating) as rata_rata'))
                                ->groupBy('id_menu')
                                ->get();
        return view('dashboard.rating.index', compact('data'));
    }

    public function Store($id_pesanan, Request $request)
    {
        $pesanan = Pesanan::query()->findOrFail($id_pesanan);
        
        foreach ($request->input('ratings') as $detail => $ratingValue) {
            $pesananDetail = PesananDetail::findOrFail($detail);
    
            Rating::create([
                'id_menu' => $pesananDetail->id_menu,
                'id_antrian' => $pesanan->id_antrian,
                'rating' => $ratingValue,
            ]);
        }
        
        return redirect('/pesanan/'. $id_pesanan)->withHeaders(['Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0']);
    }
}
