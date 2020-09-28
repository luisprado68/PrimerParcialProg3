<?php
    require_once('./fileManager.php');

    class Usuario extends FileManager{
        public $email;
        public $tipo;
        public $clave;

        public function __construct($email,$tipo,$clave)
        {
            $this->email = $email;
            $this->tipo = $tipo;
            $this->clave = $clave;
        }

        public function __toString()
        {
            return $this->email."*".$this->tipo."*".$this->clave;
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
                    
                    $nuevoObjeto = new Usuario($arrayDatos[0],trim($arrayDatos[1], "\x00..\x1F"),trim($arrayDatos[2], "\x00..\x1F"));
                    array_push($listaObjetos,$nuevoObjeto);
                }
            }
            return $listaObjetos;
        }

        
        public function validarUsuario($lista){
            $ok=false;
            foreach ($lista as $value) {
                
                if($value->email == $this->email){
                    if($value->tipo == $this->tipo){
                        if($value->clave == $this->clave){
                            $ok = true;
                            break;
                        }
                    }
                   
                    
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