<?php
  require_once('./fileManager.php');
class Precio extends FileManager{
    public $precioHora;
    public $precioEstadia;
    public $pracioMensual;

    public function __construct($precioHora,$precioEstadia,$pracioMensual)
    {
        $this->precioHora = $precioHora;
        $this->precioEstadia = $precioEstadia;
        $this->pracioMensual = $pracioMensual;
    }

    public function __toString()
    {
        return $this->precioHora."*".$this->precioEstadia."*".$this->pracioMensual;
    }

    public function save(){
        $flag=false;
        if(FileManager::Escribir(FileManager:: $filename,$this)){
            $flag=true;
        }
        return $flag;
    }

   

    public static function read($nombre){
        $listaObjetos = array();
        $lista= FileManager ::Leer($nombre);

        foreach ($lista as  $value) {
            $arrayDatos = explode('*',$value);//separamos el string entre un caracter especifico a array asociativo

            if(count($arrayDatos)== 3){
                
                $nuevoObjeto = new Usuario((int)$arrayDatos[0],(int)trim($arrayDatos[1], "\x00..\x1F"),(int)trim($arrayDatos[2], "\x00..\x1F"));
                array_push($listaObjetos,$nuevoObjeto);
            }
        }
        return $listaObjetos;
    }

    
    public function validarTipo($lista){
        $ok=false;
        foreach ($lista as $value) {
            
           
                if($value->tipo == "admin"){
                   
                        $ok = true;
                        break;
                    }
                }
                return $ok;
                
            }
        

       
    

    public function validarMail($lista){
        $igual=false;
        foreach ($lista as $value) {
            if (strcmp($value->email, $this->email) === 0){
                $igual=true;
                 break;
            }
        }
        return $igual;
    }
}

?>