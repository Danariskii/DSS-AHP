<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Bobot_AC extends Model
{
    protected $table = 'Table_Bobot_AC';

    protected $fillable = ['id_AC', 'ModelFoto', 'Capasitas', 'Garansi', 'Perawatan', 'Fitur', 'Listrik', 'Desain', 'Ketahanan', 'Final_Bobot'];

    protected $hidden = ['password', 'remember_token'];
}
