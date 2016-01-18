<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Bobot_AC extends Model
{
    protected $table = 'Table_Bobot_AC';

    protected $fillable = ['id_AC', 'Model', 'Capasitas', 'Garansi', 'Perawatan', 'Fitur', 'Listrik', 'Desain', 'Ketahanan'];

    protected $hidden = ['password', 'remember_token'];
}
