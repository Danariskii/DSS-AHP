<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Matrix_Kriteria extends Model
{
    protected $table = 'table_matrix_kriteria';

    protected $fillable = ['Nama_Matrix_Kriteria', 'Nama_Matrix_Pasangan_Kriteria', 'Nilai_Matrix_Kriteria'];

    protected $hidden = ['password', 'remember_token'];
}
