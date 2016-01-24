<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_Questionnaire extends Model
{
    protected $table = 'table_questionnaire';

    protected $fillable = ['Pertanyaan', 'Jumlah_Sangat_Setuju', 'Jumlah_Setuju', 'Jumlah_Netral', 'Jumlah_Tidak_Setuju', 'Jumlah_Sangat_Tidak_Setuju', 'Jumlah_Koresponden'];

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = true;
}
