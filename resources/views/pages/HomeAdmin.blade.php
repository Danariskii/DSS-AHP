@extends('layoutAdmin')
@section('content')

<script type="text/javascript">
	$(document).ready(function () {
		var JumlahKriteria = '{!! $table_kriteria !!}'
		dd(JumlahKriteria);
	}
</script>

@stop