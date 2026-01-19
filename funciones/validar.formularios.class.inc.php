<?php
class validar{
	
	/*validar solo numeros*/
	public static function onlyNumbers($num){
		return preg_replace("/[^0-9-.-]/","", $num);
		}
	
	/*validar solo letras*/
	public static function onlyLetters($string){
		return preg_replace("/[^A-Z]+/", "", $string);
		}
	
	/*validar que el campo no este vacio*/
	public static function notEmpty($valor){
		/*eliminar espacios al inicio y al final*/
		$valor = trim($valor);
		
		/*comprobar si esta vacio o no*/
		if(is_numeric($valor)){//si en numerico 
			if(strlen($valor) == 0){//comoprobar que no vaya vacio
				return true;//es etsa vacio regresamos true
				}else{
					return false;//si no esta vacio regresamos false
					}
			/*si es string*/
			}else if(empty($valor) and strlen($valor) == 0){//comprobar que este vacio
				return true;//esta vacio regresamos true
				}else{
					return false;//no esta vacio regresamos false
					}
		}
	}

?>