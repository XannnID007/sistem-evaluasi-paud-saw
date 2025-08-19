<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';
    protected $primaryKey = 'alternatif_id';

    // REVISI: kode → kode_alternatif
    protected $fillable = [
        'kode_alternatif',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'nama_orangtua',
        'user_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'alternatif_id', 'alternatif_id');
    }

    public function hasilSaw()
    {
        return $this->hasOne(HasilSaw::class, 'alternatif_id', 'alternatif_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }

    //REVISI: Accessor untuk backward compatibility
    public function getKodeAttribute()
    {
        return $this->kode_alternatif;
    }
}
