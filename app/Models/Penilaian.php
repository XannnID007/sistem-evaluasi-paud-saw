<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian'; // Perubahan dari 'id' ke 'id_penilaian'

    protected $fillable = ['alternatif_id', 'kriteria_id', 'nilai'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id', 'alternatif_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'kriteria_id');
    }
}
