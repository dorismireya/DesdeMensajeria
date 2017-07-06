
{{ csrf_field() }}

<div id="popup_Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          	<div class="modal-header">
              
                <h4 class="modal-title">Publicación</h4>
            </div>
            <div class="modal-body">

            <div class="publicaciones related_post" >
            	<h2></h2>

            	<div class="view_contenido">
            	</div>
            </div>
			         <input type="hidden" id="id_fpublicacion_view" value="0">
            
              <form id="form" class="form-horizontal" role="dialog">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


$(document).ready(function() {

	setTimeout(function()  {startPopup()}, 2000);
	
    		
});

function startPopup(){

	$.ajax({

    	type: 'post',
    	url: 'getCantidad_Publicaciones',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'tipo': "Informacion",
      		'importancia': "Especial",
    	},
    	success: function(data){

    		if(data[0].cantidad != 0)
    			loadPopup();

    	}
  	});
}

function loadPopup(){

	$.ajax({

    	type: 'post',
    	url: 'getLoad_Publicaciones',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'tipo': "Información",
      		'importancia': "Especial",
    	},
    	success: function(data){

    		concatenar="";

    		for(i=0; i < data.length; i++){
    			concatenar= concatenar + "<h2>"+data[i].titulo+"</h2>";
    			concatenar= concatenar + "<div class='view_contenido'>"+data[i].contenido+"</div>";
    			concatenar= concatenar + "<a class='blog_readmore' href='{{route('publicacion_completa',['id_fpublicacion'=> ''])}}"+"/"+data[i].id_fpublicacion+"'>Leer más</a>";

    		}


    		concatenar= "<div class='publicaciones related_post' >"+ concatenar+" </div>";


    		$('.publicaciones').replaceWith(concatenar);

    		$('#popup_Modal').modal('show');
    	}
  	});
	
}

</script>