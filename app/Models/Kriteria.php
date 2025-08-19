<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $primaryKey = 'kriteria_id';

    // REVISI: kode → kode_kriteria
    protected $fillable = ['kode_kriteria', 'nama', 'bobot', 'keterangan'];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id', 'kriteria_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'kriteria_id', 'kriteria_id');
    }
}
