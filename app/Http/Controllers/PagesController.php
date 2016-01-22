<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect;
use Session;
use DB;
use Hybrid_Auth;
use Hybrid_Endpoint;

use App\User;
use App\Table_Kriteria;
use App\Table_Matrix_Kriteria;
use App\Table_SubKriteria;
use App\Table_Matrix_SubKriteria;

use App\Table_AC;
use App\Table_Bobot_AC;

use App\Table_Questionnaire;

class PagesController extends Controller
{

    public function redirect()
    {        
        // return view('pages.home');
        return redirect('users');
    }

	public function index()
    {
         if(Session::has('privilege')=='Admin') return view('pages.home');

        // $users = DB::table('users')->get();
        // $id = Session::get('id');
        // $privilege = Session::get('privilege');
        
        return view('layout');//, compact('users','id','privilege'));
    }

    public function login()
    {
    	return view('pages.login');
    }

    public function submit(Request $request)
    {
        $username = $request->get('Username');
        $password = $request->get('password');
        // $password = md5($password);

        $row = DB::select('SELECT * FROM users WHERE name = ? AND password = ?', [$username, $password]);

        //dd($row);
        if(count($row) > 0) {
            if($row[0]->id)
            {
                if(!$row[0]->flag) return redirect()->back()->withErrors('ID anda sudah tidak aktif');

                $id = $row[0]->id;

                Session::put('privilege', $row[0]->privilege);
                Session::put('id', $row[0]->id);

                if($row[0]->privilege == 'Admin')
                {
                    Session::put('username', $row[0]->name);
                    // return view('pages.HomeAdmin');
                    return redirect('admin');
                    // return view('layoutAdmin');
                }
                else if($row[0]->privilege == 'user')
                {
                    Session::put('username', $row[0]->name);
                    return view('users');
                }
                else
                {
                    return redirect()->back()->withErrors('Invalid Privileges!');
                }
            }
        }
        else{
            return redirect()->back()->withErrors('Invalid Username or Password!');
        }



        //return view('check.login', compact('username'), compact('password'));
    }

    public function logout()
    {
    	Session::flush();
    	return redirect('users');
    }

    public function kriteria(Table_Kriteria $table_kriteria)
    {
        $table_kriteria = Table_Kriteria::count();
        $JumlahN = (($table_kriteria * $table_kriteria) - $table_kriteria)/2;
        $KombinasiKriteria;
        // $nama_kriteria = DB::select('SELECT Nama_Kriteria from table_kriteria');
        $nama_kriteria = Table_Kriteria::all();
        $SubKriteria;

        for ($i=0; $i<$table_kriteria; $i++) 
        {
            for ($m=1+$i; $m<$table_kriteria; $m++)
            { 
                $KombinasiKriteria[$i][$m] = $nama_kriteria[$i]['Nama_Kriteria']."".$nama_kriteria[$m]['Nama_Kriteria'];
                // $KombinasiKriteria[$i][$m] = "i = ".$i." dan m = ".$m;
            }
        }

        return view('layoutAdmin')->with('JumlahN', $JumlahN)->with('KombinasiKriteria', json_encode($KombinasiKriteria))->with('NamaKriteria', json_encode($nama_kriteria));
        /*return view('layoutAdmin', compact('JumlahN','nama_kriteria'));*/
        // return view('pages.HomeAdmin');
    }

    public function kriteriaUser(Table_Kriteria $table_kriteria, Table_AC $table_ac, Table_Questionnaire $table_questionnaire)
    {
        $JumlahKriteria = Table_Kriteria::count();
        $table_kriteria = Table_Kriteria::all();
        $table_ac = Table_AC::all();
        $tombolgallery = DB::select("SELECT DISTINCT Merek FROM table_ac");
        $table_questionnaire = Table_Questionnaire::all();

        // dd($tombolgallery);

        for ($j=0; $j<$JumlahKriteria; $j++)
        {
            $SubKriteria[$j] = DB::select("SELECT DISTINCT ".$table_kriteria[$j]['Nama_Kriteria']." FROM table_ac ");
        }
        // dd($SubKriteria);

        return view('layout')->with('JumlahKriteria', $JumlahKriteria)->with('Table_Kriteria', json_encode($table_kriteria))->with('SubKriteria', json_encode($SubKriteria))->with('Table_AC',($table_ac))->with('tombolgallery',$tombolgallery)->with('Questionnaire', $table_questionnaire);
    }

    public function questionnaire(Request $request)
    {
    //     $i=1
    //     for ($i=0; $i < ; $i++) 
    //     {
    //         $Pertanyaan = $request->get('Pertanyaan'.$i);
    //         $i=$i+1;
            $input = $request->input();       
            dd(count($input));

        // }

        // dd($username);
        // $password = $request->get('password');
    }

    public function postValue(Request $request, Table_Bobot_AC $table_bobot_ac, Table_AC $table_ac, Table_Kriteria $table_kriteria)
    {
        $input = $request->input();
        //dd($request);

        $JumlahKriteria = Table_Kriteria::count();

        // $bobot_kriteria = Table_Kriteria::get(array('Nama_Kriteria','Nilai_Bobot_Kriteria'));

        // $JumlahKriteria = 8;
        
        $value = $input['value'];
        $value = json_decode($value);
        // dd($value[0]->rangeStart);

        $matrix ;

        $Perawatan;
        if ($value[2]==1)
        {
            $Perawatan ='Praktis';
        }
        elseif ($value[2]==2)
        {
            $Perawatan ='Berkala';
        }
        elseif ($value[2]==3)
        {
            $Perawatan ='Intens';
        }

        $Fitur;
        if ($value[3]==1)
        {
            $Fitur ='Tidak Ada Fitur';
        }
        elseif ($value[3]==2)
        {
            $Fitur ='Simple';
        }
        elseif ($value[3]==3)
        {
            $Fitur ='Full Fitur';
        }

        $Desain;
        if ($value[5]==1)
        {
            $Desain ='Standard';
        }
        elseif ($value[5]==2)
        {
            $Desain ='Simple';
        }
        elseif ($value[5]==3)
        {
            $Desain ='Stylish';
        }

        $Ketahanan;
        if ($value[6]==1)
        {
            $Ketahanan ='Standard';
        }
        elseif ($value[6]==2)
        {
            $Ketahanan ='Menengah';
        }
        elseif ($value[6]==3)
        {
            $Ketahanan ='Kuat';
        }

        // if ($value[0]["rangeStart"]==$value[0]["rangeEnd"]) 
        // {
        //     dd($value);
            
        // }

        // $alternatif = DB::select("SELECT id FROM table_ac WHERE Capasitas>=".$value[0]["rangeStart"]." AND Capasitas<=".$value[0]["rangeEnd"]." AND Garansi>=".$value[1]["rangeStart"]." AND Garansi<=".$value[1]["rangeEnd"]." AND Perawatan='".$Perawatan."' AND Fitur='".$Fitur."' AND Listrik>=".$value[4]["rangeStart"]." AND Listrik<=".$value[4]["rangeEnd"]." AND Desain='".$Desain."' AND Ketahanan='".$Ketahanan."'");
        //SELECT * FROM `table_ac` WHERE `Capasitas`>=1/2 AND `Capasitas`<=2 AND `Garansi`>=2 AND `Garansi` <=3 AND `Perawatan`='Praktis' AND `Fitur`='Simple' AND `Listrik`>=320 AND `Listrik`<=528 AND `Desain`='Stylish' AND `Ketahanan`='Menengah'

        $table_ac = Table_AC::WHERE('Capasitas','>=',$value[0]->rangeStart)
                            // ->WHERE('Capasitas','<=',$value[0]["rangeEnd"])
                            ->WHERE('Garansi','>=',$value[1]->rangeStart)
                            // ->WHERE('Garansi','<=',$value[1]["rangeEnd"])
                            ->WHERE('Perawatan','=', $Perawatan)
                            ->WHERE('Fitur', '=', $Fitur)
                            ->WHERE('Listrik','>=',$value[4]->rangeStart)
                            // ->WHERE('Listrik','<=',$value[4]["rangeEnd"])
                            ->WHERE('Desain','=',$Desain)
                            ->WHERE('Ketahanan','=',$Ketahanan)->get(array('id'));

        dd($table_ac);

        $kriteria = Table_Kriteria::get(array('Nama_Kriteria','Nilai_Bobot_Kriteria'));

        $namaKrit;
        $bobotKrit;
        $matrixPure;
        $matrixBesar;
        $SumArray;
        $SumArraySemuaKriteria;
        $matrixNormalisasi;
        $matrixNormalisasiBesar;
        $SumArrayHorizontal;
        $SumArrayHorizontalBesar;
        $PowKedua;
        $PowKeduaBesar;
        $SumPowKedua;
        $SumPowKeduaBesar;
        $Wtemporary;
        $WtemporaryBesar;
        $CCI;
        $Wj;
        $Wjbesar;
        $Beta;
        $neW;
        $neWBesar;
        $NilaiDikaliBobot;
        $NilaiDikaliBobotBesar;
        $Ranking;
        $RankingBesar;

        for ($k=0; $k<$JumlahKriteria ; $k++) 
        { 
            $namaKrit[$k] = $kriteria[$k]["Nama_Kriteria"];
        }

        for ($BK=0; $BK <$JumlahKriteria ; $BK++) 
        { 
            $bobotKrit[$BK] = $kriteria[$BK]["Nilai_Bobot_Kriteria"];
        }

        $jumlahmatrix = count($table_ac);

        for ($o=0; $o<$jumlahmatrix ; $o++)
        {
            $kor[$o] = $table_ac[$o]["id"];
        }

        for ($al=0; $al < $jumlahmatrix ; $al++) 
        { 
            $RankingAlternatif[$al] = 0;
        }

        $table_bobot_ac = Table_Bobot_AC::find($kor);

        // $jumlahmatrix = 8;
        // $fak;

        // $table_bobot_ac = array(5,3,7,6,6,-3,-4,-3,5,3,3,-5,-7,6,3,4,6,-5,-3,-4,-7,-8,-2,-5,-6,-5,-6,-2);
        
        for ($L=0; $L < $JumlahKriteria; $L++)
        {
            $p=0;
            for ($i=0; $i < $jumlahmatrix; $i++) 
            {
                for ($j=0; $j < $jumlahmatrix; $j++)
                { 
                    if ($i==$j)
                    {
                        $matrixPure[$i][$j] = 1;
                        $matrix[$i][$j] = pow(1,2);
                    }
                    else if($i<$j)
                    {
                        // $matrix[$i][$j] = pow($table_bobot_ac[$p][$namaKrit[$L]],2);
                        // $matrix[$j][$i] = pow(1/($table_bobot_ac[$p][$namaKrit[$L]]),2);
                        // $check = explode("-",$table_bobot_ac[$p]);
                        $check = explode("-",$table_bobot_ac[$p]);
                        if ($check[0]=="")
                        {
                            $matrixPure[$i][$j] = 1/($table_bobot_ac[$p][$namaKrit[$L]]);
                            $matrixPure[$j][$i] = $table_bobot_ac[$p][$namaKrit[$L]]*1;

                            $matrix[$i][$j] = pow((1/$table_bobot_ac[$p][$namaKrit[$L]]),2);
                            $matrix[$j][$i] = pow(($table_bobot_ac[$p][$namaKrit[$L]]),2);
                        }
                        else
                        {
                            $matrixPure[$i][$j] = $table_bobot_ac[$p][$namaKrit[$L]];
                            $matrixPure[$j][$i] = 1/($table_bobot_ac[$p][$namaKrit[$L]]);

                            $matrix[$i][$j] = pow(($table_bobot_ac[$p][$namaKrit[$L]]),2);
                            $matrix[$j][$i] = pow(1/($table_bobot_ac[$p][$namaKrit[$L]]),2);
                        }
                        $p = $p + 1;
                    }
                }
            }



            for ($g=0; $g<$jumlahmatrix ; $g++)
            {
                $SumArray[$g] = 0;
                for ($f=0; $f<$jumlahmatrix ; $f++) 
                {
                    $SumArray[$g] = $SumArray[$g]+$matrix[$f][$g];
                }
            }

            for ($s=0; $s <$jumlahmatrix ; $s++) 
            { 
                $SumArray[$s] = sqrt($SumArray[$s]);
            }

            for ($t=0; $t<$jumlahmatrix ; $t++) 
            { 
                for ($r=0; $r<$jumlahmatrix ; $r++)
                { 
                    $matrixNormalisasi[$r][$t] = $matrixPure[$r][$t] / $SumArray[$t];
                }
            }

            for ($h=0; $h<$jumlahmatrix ; $h++)
            {
                $SumArrayHorizontal[$h] = 0;
                for ($b=0; $b<$jumlahmatrix ; $b++)
                {
                    $SumArrayHorizontal[$h] = $SumArrayHorizontal[$h]+$matrixNormalisasi[$h][$b];
                }
            }

            for ($q=0; $q<$jumlahmatrix ; $q++) 
            { 
                $PowKedua[$q] = pow($SumArrayHorizontal[$q],2);
            }

            $SumPowKedua = 0;
            for ($x=0; $x<$jumlahmatrix ; $x++) 
            { 
                $SumPowKedua = $SumPowKedua + $PowKedua[$x];
            }

            for ($z=0; $z<$jumlahmatrix ; $z++) 
            { 
                $Wtemporary[$z] = ($SumArrayHorizontal[$z])/(sqrt($SumPowKedua));
            }

            $Wj = 0;
            for ($v=0; $v<$jumlahmatrix ; $v++) 
            { 
                $Wj = $Wj + $Wtemporary[$v];
            }

            for ($BB=0; $BB<$jumlahmatrix ; $BB++) 
            { 
                $neW[$BB] = $Wtemporary[$BB]/$Wj;
            }

            for ($ak=0; $ak<$jumlahmatrix; $ak++) 
            { 
                $NilaiDikaliBobot[$ak] = $neW[$ak] * ($bobotKrit[$L]);
                $RankingAlternatif[$ak] = $RankingAlternatif[$ak] + $NilaiDikaliBobot[$ak];
            }

            // $RankingAlternatifBesar[$L] = $RankingAlternatif;

            for($rak=0; $rak<$jumlahmatrix; $rak++)
            {
                $urutan[$rak] = $RankingAlternatif[$rak]." ".$kor[$rak];
            }

            $urutanBesar[$L] = $urutan;
            dd($urutanBesar);

            $matrixBesar[$L] = $matrix;

            $SumArraySemuaKriteria[$L] = $SumArray;
            
            $matrixNormalisasiBesar[$L] = $matrixNormalisasi;
            
            $SumArrayHorizontalBesar[$L] = $SumArrayHorizontal;

            $PowKeduaBesar[$L] = $PowKedua;
            
            $SumPowKeduaBesar[$L] = sqrt($SumPowKedua);

            $WtemporaryBesar[$L] = $Wtemporary;

            $CCI[$L] = (sqrt($SumPowKedua))/$jumlahmatrix;

            $Wjbesar[$L] = $Wj;

            $Beta[$L] = 1/$Wj;

            $neWBesar[$L] = $neW;
            
            $NilaiDikaliBobotBesar[$L] = $NilaiDikaliBobot;
        }
        
        // dd($NilaiDikaliBobotBesar[1][0]);
        // dd($NilaiDikaliBobotBesar);
        // dd($NilaiDikaliBobot);
        // dd($RankingBesar);
        // dd($RankingAlternatif);
        // dd($NilaiDikaliBobotBesar);
        // dd($table_ac);

        $RankingSort = array_reverse(array_sort($RankingAlternatif, function($value)
        {
                    return sprintf('%s', $value[0]);
        }));
        // dd($RankingSort);

        $HasilAC = Table_AC::WHERE('Capasitas','>=',$value[0]->rangeStart)
                            // ->WHERE('Capasitas','<=',$value[0]["rangeEnd"])
                            ->WHERE('Garansi','>=',$value[1]->rangeStart)
                            // ->WHERE('Garansi','<=',$value[1]["rangeEnd"])
                            ->WHERE('Perawatan','=', $Perawatan)
                            ->WHERE('Fitur', '=', $Fitur)
                            ->WHERE('Listrik','>=',$value[4]->rangeStart)
                            // ->WHERE('Listrik','<=',$value[4]["rangeEnd"])
                            ->WHERE('Desain','=',$Desain)
                            ->WHERE('Ketahanan','=',$Ketahanan)->get();
        // dd($HasilAC);

        // dd($RankingSort);
        return view('pages.Hasil')->with('HasilAC', ($HasilAC))->with('RankingAlternatif', ($RankingAlternatif))->with('RankingSort', json_encode($RankingSort));
        // return view('pages.login');
    }

    // public function goHasil()
    // {
    //     return view('pages.Hasil');
    // }
}
?>