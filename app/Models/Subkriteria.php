<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriteria';
    protected $fillable = ['kriteria_id', 'nilai', 'skor'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
