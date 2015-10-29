function buscar_cidades(){
	      
	var estado = document.getElementById("estado").value;  //codigo do estado escolhido
	
	//se encontrou o estado
	if(estado){
	  var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
	  $.get(url, function(dataReturn) {
	    $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
	  });
	}
}
