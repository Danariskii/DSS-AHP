<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_SubKriteria extends Model
{
    protected $table = 'table_subkriteria';

    protected $fillable = ['Nama_SubKriteria', 'Nilai_Bobot_SubKriteria'];

    protected $hidden = ['password', 'remember_token'];
}
