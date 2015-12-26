$(function()
{

	$('#sliderKapasitas').jqxSlider({
		height: 30,
		width: "90%",
		min: 1, 
		max: 7, 
		step: 1, 
		ticksFrequency: 1,  //keterangan
		values: [1, 7], 
		// tooltip: true,
		ticksPosition: 'bottom',
		rangeSlider: true, 
		mode: 'fixed'		
	});

	$('#sliderKapasitas').on('change', function (event) 
	{
                    // var filter = $(this).attr('filter');
                    // handleSlide(event.args.value);
    	// console.log(event.args.value['rangeStart']);
    	if(event.args.value['rangeStart']=='0.5')
    	{
    		document.getElementById('KapasitasMin').innerHTML = '6 Bulan';
		}
		else
		{
			document.getElementById('KapasitasMin').innerHTML = event.args.value['rangeStart'] + ' ' + 'PK';
		}
    	
    	document.getElementById('KapasitasMax').innerHTML = event.args.value['rangeEnd'] + ' ' + 'PK';
	});

	$('#sliderGaransi').jqxSlider({
		height: 30,
		width: "90%",
		min: 1/2, 
		max: 3, 
		step: 0.5, 
		ticksFrequency: 0.5, 
		values: [1/2, 3], 
		// tooltip: true,
		ticksPosition: 'bottom',
		rangeSlider: true, 
		mode: 'fixed'
	});	

	$('#sliderGaransi').on('change', function (event) 
	{
                    // var filter = $(this).attr('filter');
                    // handleSlide(event.args.value);
    	// console.log(event.args.value['rangeStart']);
    	if(event.args.value['rangeStart']=='0.5')
    	{
    		document.getElementById('GaransiMin').innerHTML = '6 Bulan';
		}
		else
		{
			document.getElementById('GaransiMin').innerHTML = event.args.value['rangeStart'] + ' ' + 'Tahun';
		}
    	
    	document.getElementById('GaransiMax').innerHTML = event.args.value['rangeEnd'] + ' ' + 'Tahun';
	});

	$('#sliderPerawatan').jqxSlider({
		height: 30,
		width: "90%",
		min: 1/2, 
		max: 3, 
		step: 0.5, 
		ticksFrequency: 0.5, 
		values: [1/2, 3], 
		// tooltip: true,
		ticksPosition: 'bottom',
		rangeSlider: true, 
		mode: 'fixed'
	});	

	$('#sliderPerawatan').on('change', function (event) 
	{
                    // var filter = $(this).attr('filter');
                    // handleSlide(event.args.value);
    	// console.log(event.args.value['rangeStart']);
    	if(event.args.value['rangeStart']=='0.5')
    	{
    		document.getElementById('PerawatanMin').innerHTML = '6 Bulan';
		}
		else
		{
			document.getElementById('PerawatanMin').innerHTML = event.args.value['rangeStart'] + ' ' + 'Tahun';
		}
    	
    	document.getElementById('PerawatanMax').innerHTML = event.args.value['rangeEnd'] + ' ' + 'Tahun';
	});
});