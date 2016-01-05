$(document).ready(function () {

	$('#EditBtn').click(function(){
		var tugel = document.getElementById('EditBtn').text;
		// alert(1);
		// alert(tugel);
		if(tugel == "Edit")
		{
			$(this).switchClass("up","down");
			document.getElementById('EditBtn').text = "Cancel";
			// alert(2);
			// $.post("{{ URL::to('kriteria') }}", function( data ) {
				  
			// });
			// document.getElementsByName("JumlahKriteria");
			alert(JumlahKriteria);
		}
		else
		{
			$(this).switchClass("down","up");
			document.getElementById('EditBtn').text = "Edit";
			// alert(3);
			// $(this).text("Edit");
		}
	});

	$('#sliderKapasitasGaransi').jqxSlider({
		height: 30,
		width: "90%",
		min: -9, 
		max: 9, 
		step: 1, 
		ticksFrequency: 2,  //keterangan
		values: [0], 
		// tooltip: true,
		ticksPosition: 'bottom',
		// showMinorTicks: true,
		// minorTicksFrequency: 2,
		// showTickLabels: true,
		showRange: false,
		rtl:true,
		mode: 'fixed'		
	});

	$('#sliderKapasitasGaransi').jqxSlider('focus');

	$('#sliderKapasitasGaransi').on('change', function (event) 
	{
    	
    	if(event.args.value>0)
    	{
    		document.getElementById('KapasitasGaransiMin').innerHTML = 'Kapasitas ' + event.args.value + ' kali lebih penting dari Garansi';
    		document.getElementById('KapasitasGaransiMax').innerHTML = ' ';
		}
		else if(event.args.value<0)
		{
			document.getElementById('KapasitasGaransiMin').innerHTML = '';
			document.getElementById('KapasitasGaransiMax').innerHTML = 'Garansi ' + (event.args.value*-1) + ' kali lebih penting dari Kapasitas';
		}
		else
		{
			document.getElementById('KapasitasGaransiMin').innerHTML = 'Kapasitas dan Garansi sama Pentingnya';
			document.getElementById('KapasitasGaransiMax').innerHTML = '';
		}
		// console.log(event.args.value);
	});

// --------------------------------------------------------------------------------------------------------------------

	$('#sliderKapasitasPerawatan').jqxSlider({
		height: 30,
		width: "90%",
		min: -9, 
		max: 9, 
		step: 1, 
		ticksFrequency: 2,  //keterangan
		values: [0], 
		// tooltip: true,
		ticksPosition: 'bottom',
		// showMinorTicks: true,
		// minorTicksFrequency: 2,
		// showTickLabels: true,
		showRange: false,
		rtl:true,
		mode: 'fixed'		
	});

	$('#sliderKapasitasPerawatan').jqxSlider('focus');

	$('#sliderKapasitasPerawatan').on('change', function (event) 
	{
    	// console.log(event.args.value);
    	if(event.args.value>0)
    	{
    		document.getElementById('KapasitasPerawatanMin').innerHTML = 'Kapasitas ' + event.args.value + ' kali lebih penting dari Perawatan';
    		document.getElementById('KapasitasPerawatanMax').innerHTML = ' ';
		}
		else if(event.args.value<0)
		{
			document.getElementById('KapasitasPerawatanMin').innerHTML = '';
			document.getElementById('KapasitasPerawatanMax').innerHTML = 'Perawatan ' + (event.args.value*-1) + ' kali lebih penting dari Kapasitas';
		}
		else
		{
			document.getElementById('KapasitasPerawatanMin').innerHTML = 'Kapasitas dan Perawatan sama Pentingnya';
			document.getElementById('KapasitasPerawatanMax').innerHTML = '';
		}
		// console.log(event.args.value);
	});


});