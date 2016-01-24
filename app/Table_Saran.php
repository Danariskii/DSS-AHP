<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Saran extends Model
{
    protected $table = 'table_saran';

    protected $fillable = ['Saran','JwbPertanyaan1', 'JwbPertanyaan2', 'JwbPertanyaan3', 'JwbPertanyaan4', 'JwbPertanyaan5', 'JwbPertanyaan6'];

    protected $hidden = ['password', 'remember_token'];
}
