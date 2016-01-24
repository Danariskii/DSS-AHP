<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_AC extends Model
{
    protected $table = 'Table_AC';

    protected $fillable = array('Merek', 'Model', 'Harga', 'Capasitas', 'Garansi', 'Perawatan', 'Fitur', 'Listrik', 'Desain', 'Ketahanan');

    protected $hidden = ['password', 'remember_token'];
}
