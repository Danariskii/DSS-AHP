<?
if(isset($_POST['npwp']) && isset($_POST['niklist'])){
	$NPWP_FINAL=$_POST['npwp'];
	$NIK=$_POST['niklist'];
	//DB::Update("UPDATE mathcing_ktp set 'NPWP_FINAL'=? where 'NIK' = ? ",[$NPWP_FINAL, $NIK]);
	$id= Session::get('username');
	dd($niklist);
}

?>
