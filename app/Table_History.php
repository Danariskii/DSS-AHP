<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_History extends Model
{
    protected $table = 'table_history';

    protected $fillable = ['Hasil_Rekomendasi','Jumlah_Kriteria', 'Jumlah_Alternatif', 'Capasitas', 'Garansi', 'Perawatan', 'Fitur', 'Listrik', 'Desain', 'Ketahanan'];

    protected $hidden = ['password', 'remember_token'];
}
