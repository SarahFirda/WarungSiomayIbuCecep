<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesanan';
    protected $table = 'pesanan';
    protected $guarded = ['id'];

    public function Details()
    {
        return $this->hasMany(PesananDetail::class, 'id_pesanan');
    }
    public function Antrian()
    {
        return $this->belongsTo(Antrian::class, 'id_antrian');
    }
}
