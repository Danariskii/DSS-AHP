@extends('layoutLogin')
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-lg-12">
            <h3 class="panel-title">Hasil Pemilihan Air Conditioner</h3>        
        </div>
    </div>

    <!-- {{ $RankingAlternatif[2] }}; -->


        <?php $i=0?>
        @foreach($HasilAC as $HasilAC)
        <tr><br/>
            <td>{{ $HasilAC->id}}</td><br/>
            <td>{{ $HasilAC->Merek }}</td><br/>
            <td>{{ $HasilAC->Model }}</td><br/>
            <td>{{ $HasilAC->Harga }}</td><br/>
            <td>{{ $HasilAC->Capasitas }}</td><br/>
            <td>{{ $HasilAC->Garansi }}</td><br/>
            <td>{{ $HasilAC->Perawatan }}</td><br/>
            <td>{{ $HasilAC->Fitur }}</td><br/>
            <td>{{ $HasilAC->Listrik }}</td><br/>
            <td>{{ $HasilAC->Desain }}</td><br/>
            <td>{{ $HasilAC->Ketahanan }}</td><br/>
            <td>{{ $RankingAlternatif[$i]}}</td><br/><br/>
        </tr>
        <?php $i=$i+1 ?>
        @endforeach


    


</div>
@stop