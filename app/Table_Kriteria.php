<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Kriteria extends Model
{
    protected $table = 'table_kriteria';

    protected $fillable = ['Nama_Kriteria', 'Nilai_Bobot_Kriteria', 'Jumlah_SubKriteria'];

    protected $hidden = ['password', 'remember_token'];
}
