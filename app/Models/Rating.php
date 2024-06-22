<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_rating';
    protected $table = 'rating';
    protected $guarded = ['id'];

    public function Menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
    public function Antrian()
    {
        return $this->belongsTo(Antrian::class, 'id_antrian');
    }
}
