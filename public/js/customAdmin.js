$(function()
{
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
    		document.getElementById('KapasitasGaransiMin').innerHTML = 'Kapasitas = ' + event.args.value;
    		document.getElementById('KapasitasGaransiMax').innerHTML = ' ';
		}
		else if(event.args.value<0)
		{
			document.getElementById('KapasitasGaransiMin').innerHTML = ' ';
			document.getElementById('KapasitasGaransiMax').innerHTML = 'Garansi = ' + (event.args.value*-1);
		}
		else
		{
			document.getElementById('KapasitasGaransiMin').innerHTML = 'Kapasitas = ' + event.args.value;
			document.getElementById('KapasitasGaransiMax').innerHTML = 'Garansi = ' + event.args.value;
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
    		document.getElementById('KapasitasPerawatanMin').innerHTML = 'Kapasitas = ' + event.args.value;
    		document.getElementById('KapasitasPerawatanMax').innerHTML = ' ';
		}
		else if(event.args.value<0)
		{
			document.getElementById('KapasitasPerawatanMin').innerHTML = ' ';
			document.getElementById('KapasitasPerawatanMax').innerHTML = 'Perawatan = ' + (event.args.value*-1);
		}
		else
		{
			document.getElementById('KapasitasPerawatanMin').innerHTML = 'Kapasitas = ' + event.args.value;
			document.getElementById('KapasitasPerawatanMax').innerHTML = 'Perawatan = ' + event.args.value;
		}
		console.log(event.args.value);
	});


});