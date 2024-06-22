<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_antrian';
    protected $table = 'antrian';
    protected $guarded = ['id'];
}
