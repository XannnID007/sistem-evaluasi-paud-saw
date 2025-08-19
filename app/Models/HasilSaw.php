<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSaw extends Model
{
    use HasFactory;

    protected $table = 'hasil_saw';
    protected $primaryKey = 'hasil_saw_id'; //REVISI: Tetap menggunakan hasil_saw_id

    protected $fillable = [
        'alternatif_id',
        'skor_akhir',
        'ranking',
        'kategori'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id', 'alternatif_id');
    }
}
