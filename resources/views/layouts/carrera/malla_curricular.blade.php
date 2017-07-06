<br>
<h2>Malla Curricular <span class="fa fa-angle-double-right"></span></h2>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		
		<div class="contenedor">
			@foreach($semestres as $semestre)
				<div class="semestre">
					<h1>Semestre {{$semestre->nivel}}</h1>

					@foreach($listar_materias as $lm)

						@if($lm->nivel == $semestre->nivel)
						<div class="materia CB" id="{{$lm->id_materia}}">
		      				<header>
		      					{{$lm->codigo}}
		      				</header>
		      				<section>
		        				{{$lm->materia}}
		      				</section>

		      				<div class="det-mat">
		      					<div>
		          					{{$lm->sigla}}
		      					</div>
		      					<div>
		      					</div>
		      				</div>
		    			</div>
		    			@endif
	    			@endforeach
				</div>
			@endforeach

		</div>
		<!-- <button type="button" id="toggleArrowBtn">Mostrar conectores</button> -->
	</div>
</div>

<script type="text/javascript">

var lista_materias=[];

var lista_dependencias=[];


//Booleano que indica si la flechas ya se añadieron
var flecha_inicializadas= false;

$(document).ready(function () {

	$.ajax({

    	type: 'post',
    	url: 'malla_listaDependencias',
    	data: {
      		'_token': $('input[name=_token]').val(),
      		'id_carrera': $('#id_carrera').val(),
    	},
    	success: function(data){

    		lista_materias= data.lista_materias;
    		lista_dependencias= data.lista_dependencias;
    	}
  	});
});


$(document).ready(function(){

	$('.materia').on('click',function(){
    	//alert('materia');
    	var idMat = $(this).attr('id');
    	$(this).addClass('selected');
    
		seleccionarAdelante( idMat );
    
    	seleccionaPrevios(idMat);
  	});

  	$('.materia').on('mouseout',function(){
  		//limpiar la seleccion despues que pase el mouse
		limpiarSeleccion();
  	});

  	//Botón que alterna las flechas
	$('#toggleArrowBtn').on('click',function(){
    	//Si ya se añadieron las flechas
    	if( flecha_inicializadas ){
      		//las oculta
      		$('svg').toggle();
    	}else{
      		//Las añade dinámicamente
       		conectarMaterias(); 
      		flecha_inicializadas = true;
		}
    
  	});
});

function getArregloAdelante( idMateria){

	var adelante=[];

	for(i=0; i < lista_dependencias.length; i++){

		if(lista_dependencias[i].id_materia == idMateria){
			adelante.push(lista_dependencias[i].id_continua);
		}
	}

	return adelante;
}




/*Función que selecciona las materias hacía adelante*/
function seleccionarAdelante( idMateria ){

	var corrAct= getArregloAdelante(idMateria);
    
    //Marca los correquisitos
  	
  	if( corrAct ){

  		for( var i = 0; i < corrAct.length; i++){    
        	var idCorrAct = corrAct[i];
        
	        $('#'+idCorrAct).addClass('prerequisito');
        
        
        	//Se invoca recursivamente si existen prerrequisitos del prerequisito
        	
        	if(getArregloAdelante(idCorrAct))
        		seleccionarAdelante(idCorrAct);
        	
      	}
    }
  	return;
}


function getArregloPrevio( idMateria){

	var previo=[];

	for(i=0; i < lista_dependencias.length; i++){

		if(lista_dependencias[i].id_continua == idMateria)
			previo.push(lista_dependencias[i].id_materia);
	}

	return previo;
}

/*Función que marca las materias hacia atrás*/
function seleccionaPrevios( idMateria ){
	//Itera sobre la lista de prerequisitos

  	var keyAct= getArregloPrevio(idMateria);
    
    //Marca los correquisitos
  	
  	if( keyAct ){

  		for( var i = 0; i < keyAct.length; i++){    
        	var idKeyAct = keyAct[i];
        
	        $('#'+idKeyAct).addClass('previo');
        
        
        	//Se invoca recursivamente si existen prerrequisitos del prerequisito
        	
        	if(getArregloPrevio(idKeyAct))
        		seleccionaPrevios(idKeyAct);
        	
      	}
    }
  	return;
}

/*Métdo que limpia las selecciones*/
function limpiarSeleccion(){
  	$('.contenedor .correquisito').removeClass('correquisito');
	$('.contenedor .prerequisito').removeClass('prerequisito');
	$('.contenedor .previo').removeClass('previo');
	$('.contenedor .selected').removeClass('selected');
}

//Métodos de jsPlumb
//jsPlumb.bind("ready", conectarMaterias);

function conectarMaterias() {
    
    var color_prueba = "#002846";
    var common = {
    	connector:"StateMachine",
    	anchors:["Center", "Center" ],
    	endpoints:["Dot", "Blank" ],
      	endpointStyle:{ radius:2 },
     	overlays:[ ["PlainArrow", {location:1, width:10, length:9} ]],
        paintStyle:{lineWidth:3,strokeStyle:color_prueba}
    };
    // your jsPlumb related init code goes here

    //Estilo de las flechas de correquisitos
    

    for(var i=0; i < lista_materias.length; i++){

    	var keyAct= lista_materias[i].id_materia;
    	
    	var rel= getArregloFlecha(lista_materias[i].id_materia);
    	
    	var valAct;
    	if( rel ){
	    	for( var j=0; j < rel.length; j++){
	    		valAct= rel[j];
	    		jsPlumb.connect({source:keyAct, target:valAct},common);  
	    	}
    	}

    }

}

/**
 * funcion para devolver un array de materias
 * @param  {[type]} idMateria [description]
 * @return {[type]}           [description]
 */
function getArregloFlecha( idMateria){


	var adelante=[];

	var contador=0;

	for(i=0; i < lista_dependencias.length; i++){

		if(lista_dependencias[i].id_materia == idMateria)
			contador= contador + 1;
	}

	if(contador != 0){
		for(i=0; i < lista_dependencias.length; i++){

			if(lista_dependencias[i].id_materia == idMateria){
				adelante.push(lista_dependencias[i].id_continua);
			}
		}
	}

	return adelante;
}
</script>