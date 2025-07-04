<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $fillable = [
        'kode',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nama_orangtua'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilSaw()
    {
        return $this->hasOne(HasilSaw::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}
