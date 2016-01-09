<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Matrix_SubKriteria extends Model
{
    protected $table = 'table_matrix_subkriteria';

    protected $fillable = ['Nama_Matrix_SubKriteria', 'Nama_Matrix_Pasangan_SubKriteria', 'Nilai_Matrix_SubKriteria'];

    protected $hidden = ['password', 'remember_token'];
}
