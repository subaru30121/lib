jQuery(function(){

	(function(){
		var json = {}
		$('table tbody tr').each(function(){
			json[$(this).find('> td:eq(3)').text()-0] = '';
		});
		for(var i in json){
			$('<option/>').html(i).appendTo('#qty-filter')
		}
	})();
	
	$('table').simpleTableFilter({
		filters : {
			2 : 'input[name=class-filter]'
		}
	});

});
