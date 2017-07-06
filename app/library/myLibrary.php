<?php namespace App\library {
    class myLibrary {

    	public function getTabla_Color($tabla){

    		switch ($tabla) {
    			case 'facultad':
    				return "bg-aqua";
    				break;
    			case 'carrera':
    				return "bg-green";
    				break;
    			default:
    				return "bg-orange";
    				break;
    		}
    	}


    	public function getPublicacionEstado_Color($estado){

    		switch ($estado) {
    			case 'publicado':
    				return "bg-white";
    				break;
    			default:
    				return "bg-gray";
    				break;
    		}
    	}	
    }   
}
?>