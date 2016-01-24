@extends('layoutLogin')
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-lg-12">
          
    <div id="list" class="List-box">
        <div class="head text-center">
            <h3><span> </span>Hasil Pemilihan Air Conditioner</h3>
            <fieldset>
                {!! Form::open(array('url' => '/')) !!}
                    <input class="Back-btn" id="BackBtn" value="Back" type="submit"/>
                {!! Form::close() !!}
            </fieldset>

        <?php $i=0?>
        @foreach($HasilAC as $HasilAC)
            <?php $FotoAC = $HasilAC->ModelFoto;?>
            <div class="toggleDiv row-fluid single-project">
                <div class="span6">
                    <img src={{ asset($FotoAC) }} alt="project 9">
                </div>
                <div class="span6">
                    <div class="project-description">
                        <div class="project-title clearfix">
                            <span class="show_hide close">
                                <i class="icon-cancel"> <!-- {{ $HasilAC->Final_Bobot }} --> </i>
                            </span>
                            <h3>{{$HasilAC->Merek}}</h3>
                                     <p>{{$HasilAC->Model}}</p>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Capasitas</span>{{$HasilAC->Capasitas}}</div>
                                    <div>
                                        <span>Garansi</span>{{$HasilAC->Garansi}}</div>
                                    <div>
                                        <span>Ketahanan</span>{{$HasilAC->Ketahanan}}</div>
                                    <div>
                                        <span>Listrik</span>{{$HasilAC->Merek}}</div>
                                    <div>
                                        <span>Fitur</span>{{$HasilAC->Fitur}}</div>
                                    <div>
                                        <span><br/>Harga</span>{{$HasilAC->Harga}}</div>
                                </div>
                                <!-- <p>I learned that we can do anything, but we can't do everything... at least not at the same time. So think of your priorities not in terms of what activities you do, but when you do them. Timing is everything.</p> -->
                            </div>
                        </div>
                    </div>
        <?php $i=$i+1 ?>
        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop