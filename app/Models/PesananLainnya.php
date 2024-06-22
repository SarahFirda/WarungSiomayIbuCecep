<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananLainnya extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesanan_lainnya';
    protected $table = 'pesanan_lainnya';
    protected $guarded = ['id'];
}
