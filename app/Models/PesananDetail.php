<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesanan_detail';
    protected $table = 'pesanan_detail';
    protected $guarded = ['id'];

    public function Pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
    public function Menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
