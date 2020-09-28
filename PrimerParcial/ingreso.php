<?php
  require_once('./fileManager.php');
class Ingreso extends FileManager{
    public $patente;
    public $fecha_ingreso;
    public $tipo;
    public $email;

    public function __construct($patente,$fecha_ingreso,$tipo,$email)
    {
        $this->patente = $patente;
        $this->fecha_ingreso = $fecha_ingreso;
        $this->tipo = $tipo;
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->patente."*".$this->fecha_ingreso."*".$this->tipo."*".$this->email;
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
                
                $nuevoObjeto = new Ingreso($arrayDatos[0],trim($arrayDatos[1], "\x00..\x1F"),trim($arrayDatos[2], "\x00..\x1F"),trim($arrayDatos[3], "\x00..\x1F"));
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