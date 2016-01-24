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
use App\Table_Saran;
use App\Table_History;

class PagesController extends Controller
{

    public function redirect()
    {        
        // return view('pages.home');
        return redirect('users');
    }

	public function index()
    {
        if(Session::has('privilege')=='Admin') return redirect('admin');;

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
        $password = md5($password);

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

    public function questionnaire(Request $request, Table_Questionnaire $questionnaire, Table_Saran $table_saran)
    {
            $input = $request->input();       

            // dd(($input['KritikOrSaran'])); tinggal bikin table untuk saran
            // dd(($input["2"]));
            $Saran = new Table_Saran;

            for ($Q=1; $Q<((count($input))-2) ; $Q++) 
            {
                $jawabannya = $input[$Q];
                $checkJawaban = explode("_",$jawabannya);

                $Quest = Table_Questionnaire::find($checkJawaban[1]);

                if ($checkJawaban[0] == 'SangatSetuju')
                {
                    $temp = $Quest->Jumlah_Sangat_Setuju;
                    $Quest->Jumlah_Sangat_Setuju =$temp+1;
                    $Quest->save();
                    $temp = 0;
                }
                elseif ($checkJawaban[0] == 'Setuju')
                {
                    $temp = $Quest->Jumlah_Setuju;
                    $Quest->Jumlah_Setuju =$temp+1;
                    $Quest->save();
                    $temp = 0;
                }
                elseif ($checkJawaban[0] == 'Netral')
                {
                    $temp = $Quest->Jumlah_Netral;
                    $Quest->Jumlah_Netral =$temp+1;
                    $Quest->save();
                    $temp = 0;
                }
                elseif ($checkJawaban[0] == 'TidakSetuju')
                {
                    $temp = $Quest->Jumlah_Tidak_Setuju;
                    $Quest->Jumlah_Tidak_Setuju =$temp+1;
                    $Quest->save();
                    $temp = 0;
                }
                elseif ($checkJawaban[0] == 'SangatTidakSetuju')
                {
                    $temp = $Quest->Jumlah_Sangat_Tidak_Setuju;
                    $Quest->Jumlah_Sangat_Tidak_Setuju =$temp+1;
                    $Quest->save();
                    $temp = 0;
                }
                $ALL='JwbPertanyaan'.$Q;
                $Saran->$ALL = $checkJawaban[0];
                $Saran->save();
            };

            $Saran->Saran = $input['KritikOrSaran'];
            $Saran->save();

            $temp = $Quest->Jumlah_Koresponden;
            $Quest->Jumlah_Koresponden=$temp+1;
            $Quest->save();
            $temp = 0;

            return redirect('users');
    }

    public function postValue(Request $request, Table_Bobot_AC $table_bobot_ac, Table_AC $table_ac, Table_Kriteria $table_kriteria, Table_History $table_history)
    {
        $input = $request->input();
        //dd($request);

        $JumlahKriteria = Table_Kriteria::count();

        $table_ac = Table_AC::get();

        // $bobot_kriteria = Table_Kriteria::get(array('Nama_Kriteria','Nilai_Bobot_Kriteria'));

        // $JumlahKriteria = 8;
        
        $value = $input['value'];
        $value = json_decode($value);
        // dd($value[0]->rangeStart);
        // dd($value);

        $matrix ;
        
        $array_bobot_suspect;

        $StartRangeCapasitasInputUser = $value[0]->rangeStart;
        $EndRangeCapasitasInputUser = $value[0]->rangeEnd;

        $StartRangeGaransiInputUser = $value[1]->rangeStart;
        $EndRangeGaransiInputUser = $value[1]->rangeEnd;

        $StartRangeListrikInputUser = $value[4]->rangeStart;
        $EndRangeListrikInputUser = $value[4]->rangeEnd;


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


        $count = count($table_ac);
        $idFilter;
        $idFilterCheck;
        $RankingAlternatifBesar;
        // $idFilterListrik;

        $ItunganArr = 0;
        for ($Cap=0; $Cap<$count; $Cap++)
        {
            if (($table_ac[$Cap]['Capasitas']) >= $StartRangeCapasitasInputUser AND $table_ac[$Cap]['Capasitas'] <= ($EndRangeCapasitasInputUser)) 
            {
                preg_match_all('!\d+!', $table_ac[$Cap]['Garansi'], $ThnGaransi);

                if ($ThnGaransi[0][0] >= $StartRangeGaransiInputUser AND $ThnGaransi[0][0] <= ($EndRangeGaransiInputUser))
                {
                    preg_match_all('!\d+!', $table_ac[$Cap]['Listrik'], $BesarListrik);

                    if ($BesarListrik[0][0] >= $StartRangeListrikInputUser AND $BesarListrik[0][0] <= $EndRangeListrikInputUser)
                    {
                        $checkPerawatan = explode(".",$table_ac[$Cap]['Perawatan']);
                        $checkFitur = explode(".",$table_ac[$Cap]['Fitur']);
                        if ($Perawatan==$checkPerawatan[0])
                        {
                            $idFilter[$ItunganArr] = $table_ac[$Cap]['id'];
                            $ItunganArr = $ItunganArr + 1;
                        }    
                        elseif ($Fitur==$checkFitur[0])
                        {
                            $idFilter[$ItunganArr] = $table_ac[$Cap]['id'];
                            $ItunganArr = $ItunganArr + 1;
                        }
                        elseif ($Desain==$table_ac[$Cap]['Desain'])
                        {
                            $idFilter[$ItunganArr] = $table_ac[$Cap]['id'];
                            $ItunganArr = $ItunganArr + 1;
                        }
                        elseif ($Ketahanan==$table_ac[$Cap]['Ketahanan']) 
                        {
                            $idFilter[$ItunganArr] = $table_ac[$Cap]['id'];
                            $ItunganArr = $ItunganArr + 1;
                        }
                    }
                }
            }
        }
        // dd($ItunganArr);

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

        $jumlahmatrix = count($idFilter);
        $RankingAlternatif = array();
        // dd($idFilter);
        
        for ($k=0; $k<$JumlahKriteria ; $k++) 
        { 
            $namaKrit[$k] = $kriteria[$k]["Nama_Kriteria"];
            $bobotKrit[$k] = $kriteria[$k]["Nilai_Bobot_Kriteria"];
        }

        $table_ac_Eksekusi = Table_AC::find($idFilter);

        for ($BSK=0; $BSK<$jumlahmatrix ; $BSK++) 
        {
            $PembobotanKriDB = Table_Bobot_AC::firstOrCreate(['id_AC'=>$idFilter[$BSK]]);
            
            $fnr = str_replace(" ","",$table_ac_Eksekusi[$BSK]['Model']);
            $namafotoT = 'images/'.$fnr.'.png';

            $PembobotanKriDB->id_AC = $idFilter[$BSK];
            $PembobotanKriDB->ModelFoto = $namafotoT;
            
            $bobotCapasitas = $table_ac_Eksekusi[$BSK]['Capasitas'];

            preg_match_all('!\d+!', $table_ac_Eksekusi[$BSK]['Garansi'], $ThnG);
            $bobotGaransi = $ThnG[0][0];

            preg_match_all('!\d+!', $table_ac_Eksekusi[$BSK]['Listrik'], $BListrik);
            $bobotListrik = $BListrik[0][0];

            $checkPerawatani = explode(".",$table_ac_Eksekusi[$BSK]['Perawatan']);
            $bobotPerawatan = $checkPerawatani[0];

            $checkFituri = explode(".",$table_ac_Eksekusi[$BSK]['Fitur']);
            $bobotFitur = $checkFituri[0];

            $bobotDesain = $table_ac_Eksekusi[$BSK]['Desain'];
            $bobotKetahanan = $table_ac_Eksekusi[$BSK]['Ketahanan'];

            if (round($bobotCapasitas, 2) < round(1.0, 2))
            {
                $PembobotanKriDB->Capasitas = 3;
            }
            elseif (round($bobotCapasitas, 2) >= round(1.0, 2) AND round($bobotCapasitas, 2) <= round(2.0, 2))
            {
                $PembobotanKriDB->Capasitas = 5;
            }
            elseif (round($bobotCapasitas, 2)> round(2.0, 2))
            {
                $PembobotanKriDB->Capasitas = 7;
            }
            // ---------------------------------------------------------------------------

            if ($bobotGaransi <= 1)
            {
                $PembobotanKriDB->Garansi = 2;
            }
            elseif ($bobotGaransi >= 1 AND $bobotGaransi <= 2) 
            {
                $PembobotanKriDB->Garansi = 3;
            }
            elseif ($bobotGaransi > 2) 
            {
                $PembobotanKriDB->Garansi = 5;
            }
            // ---------------------------------------------------------------------------
            if ($bobotListrik <= 900)
            {
                $PembobotanKriDB->Listrik = 2;
            }
            elseif ($bobotListrik >= 900 AND $bobotListrik <= 1500) 
            {
                $PembobotanKriDB->Listrik = 3;
            }
            elseif ($bobotListrik >= 1500 AND $bobotListrik <= 2000) 
            {
                $PembobotanKriDB->Listrik = 5;
            }
            elseif ($bobotListrik > 2000) 
            {
                $PembobotanKriDB->Listrik = 7;
            }
            // ---------------------------------------------------------------------------
            if ($bobotPerawatan =='Praktis')
            {
                $PembobotanKriDB->Perawatan = 1;
            }
            elseif ($bobotPerawatan =='Berkala')
            {
                $PembobotanKriDB->Perawatan = 3;
            }
            elseif ($bobotPerawatan =='Intens')
            {
                $PembobotanKriDB->Perawatan = 5;
            }
            // ---------------------------------------------------------------------------
            if ($bobotFitur =='No Fitur')
            {
                $PembobotanKriDB->Fitur = 1;
            }
            elseif ($bobotFitur =='Simple')
            {
                $PembobotanKriDB->Fitur = 3;
            }
            elseif ($bobotFitur =='Full Fitur')
            {
                $PembobotanKriDB->Fitur = 5;
            }
            //----------------------------------------------------------------------------
            if ($bobotDesain =='Standard')
            {
                $PembobotanKriDB->Desain = 1;
            }
            elseif ($bobotDesain =='Simple')
            {
                $PembobotanKriDB->Desain = 3;
            }
            elseif ($bobotDesain =='Stylish')
            {
                $PembobotanKriDB->Desain = 5;
            }
            // ---------------------------------------------------------------------------
            if ($bobotKetahanan =='Standard')
            {
                $PembobotanKriDB->Ketahanan = 1;
            }
            elseif ($bobotKetahanan =='Menengah')
            {
                $PembobotanKriDB->Ketahanan = 3;
            }
            elseif ($bobotKetahanan =='Kuat')
            {
                $PembobotanKriDB->Ketahanan = 5;
            }
            // ---------------------------------------------------------------------------
            $PembobotanKriDB->save();
        }


                //sampe sini pikirin cara setelah dibobotin masuk ke function dibawah ini 
                //dan cari cara biar bisa diurutin
                //dan save history
                // dd('wait');

        for ($ah=0; $ah < $jumlahmatrix ; $ah++) 
        {   
            $tempid = $idFilter[$ah];
            // $table_bobot_ac[$ah] = DB::select('SELECT * FROM table_bobot_ac WHERE id_AC = ?', [$tempid] );
            $table_bobot_ac[$ah] = Table_Bobot_AC::WHERE('id_AC', '=', $tempid)->get();
        }

        // $bismillah = 'Capasitas';
        // dd($table_bobot_ac[1][0]->$bismillah);
        // dd($table_bobot_ac);
        // dd($table_bobot_ac[1][0]->Capasitas);
        // $table_bobot_ac = Table_Bobot_AC::find($idFilter);

        // $jumlahmatrix = 8;
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
                        $matrixChecking[$i][$j] = '1';
                    }
                    else if($i<$j)
                    {
                        $bis = $namaKrit[$L];
                        // $pls = $table_bobot_ac[$p][0]->$fak;
                        // $check = explode("-", $table_bobot_ac[$p][0]->$fak);
                        if($table_bobot_ac[$i][0]->$bis > $table_bobot_ac[$j][0]->$bis)
                        {
                            $matrixPure[$i][$j] = ($table_bobot_ac[$i][0]->$bis) - ($table_bobot_ac[$j][0]->$bis);
                            $matrix[$i][$j] = pow(($matrixPure[$i][$j]),2);
                        }
                        elseif($table_bobot_ac[$i][0]->$bis == $table_bobot_ac[$j][0]->$bis) 
                        {
                            $matrixPure[$i][$j] = 1;
                            $matrix[$i][$j] = pow(1,2);
                        }
                        elseif($table_bobot_ac[$i][0]->$bis < $table_bobot_ac[$j][0]->$bis)
                        {
                            $matrixPure[$i][$j] = ($table_bobot_ac[$j][0]->$bis) - ($table_bobot_ac[$i][0]->$bis);
                            $matrixPure[$i][$j] = 1/$matrixPure[$i][$j];
                            $matrix[$i][$j] = pow(($matrixPure[$i][$j]),2);
                        }

                        if ($matrixPure[$i][$j] > 1)
                        {
                            $matrixPure[$j][$i] = 1/$matrixPure[$i][$j];
                            $matrix[$j][$i] = pow(($matrixPure[$j][$i]), 2);
                        }
                        elseif ($matrixPure[$i][$j] == 1)
                        {
                            $matrixPure[$j][$i] = 1;
                            $matrix[$j][$i] = pow(1,2);
                        }
                        elseif ($matrixPure[$i][$j] < 1)
                        {
                            $matrixPure[$j][$i] = ($table_bobot_ac[$j][0]->$bis) - ($table_bobot_ac[$i][0]->$bis);
                            $matrix[$j][$i] = pow(($matrixPure[$j][$i]), 2);
                        }

                    }
                }
            }//end matrix



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
                $RankingAlternatif[$ak] = 0;
                $NilaiDikaliBobot[$ak] = $neW[$ak] * ($bobotKrit[$L]);
                $RankingAlternatif[$ak] = $RankingAlternatif[$ak] + $NilaiDikaliBobot[$ak];
            }
            
            $RankingAlternatifBesar[$L] = $RankingAlternatif;
            
            for ($masukDB=0; $masukDB<$jumlahmatrix; $masukDB++) 
            {
                $pushValue = Table_Bobot_AC::firstOrCreate(['id_AC'=>$idFilter[$masukDB]]);

                $nilaiawal = round( ($pushValue->Final_Bobot),10 );
                // dd($RankingAlternatifBesar[$L][$masukDB]);
                $pushValue->Final_Bobot = $nilaiawal + $RankingAlternatifBesar[$L][$masukDB];
                $pushValue->save();
            }

        }

        $yeay = implode(",", $idFilter);

        $history = new Table_History;
        $history->Hasil_Rekomendasi = $yeay;

        $history->Jumlah_Kriteria = $JumlahKriteria;
        $history->Jumlah_Alternatif = $jumlahmatrix;

        $history->Capasitas = $StartRangeCapasitasInputUser.'-'.$EndRangeCapasitasInputUser;
        $history->Garansi = $StartRangeGaransiInputUser.'-'.$EndRangeGaransiInputUser;
        $history->Listrik = $StartRangeListrikInputUser.'-'.$EndRangeListrikInputUser;
        $history->Perawatan = $Perawatan;
        $history->Fitur = $Fitur;
        $history->Desain = $Desain;
        $history->Ketahanan = $Ketahanan;

        $history->save();

        $HasilAC = DB::select('SELECT * FROM table_ac RIGHT JOIN table_bobot_ac ON (table_ac.id = table_bobot_ac.id_AC) WHERE table_ac.id IN ('.$yeay.') GROUP BY table_ac.id ORDER BY table_bobot_ac.Final_Bobot DESC;');

        $status = DB::Update("UPDATE `table_bobot_ac` SET Final_Bobot = 0 WHERE 1");

        return view('pages.Hasil')->with('HasilAC', $HasilAC);
    }
}
?>