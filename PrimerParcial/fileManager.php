<?php

    class FileManager{

        public static $filename;
        //la funcion puede poner la extension tambien;
        public function setFilename($filename,$extension)
        {
            FileManager::$filename = get_class($filename).$extension;

                
        }
        
        public static function Leer($nombreArchivo){
            $datosLeidos = false;
            $arrayDatosLeidos= array();
          
            $archivo = fopen($nombreArchivo,'a+');
        
            while(!feof($archivo)){
                
                $datosLeidos = fgets($archivo);

                if($datosLeidos != false){
                    
                    array_push($arrayDatosLeidos,$datosLeidos);
                }
                
            }
            fclose($archivo);

           return $arrayDatosLeidos;

        }

        public static function Escribir($nombreArchivo,$texto){
            $ok=false;
            $archivo = fopen($nombreArchivo,'a+');
            
            $escribir = fwrite($archivo,$texto.PHP_EOL);
            if($escribir >0){
                if(fclose($archivo)){
                     $ok=true;
                }
            }
            return $ok;
        }

       public static function leerJson($filename){
        $arrayJason = array();
        if(file_exists($filename)){

            $archivo = fopen($filename,'r');
            $sizeFile = filesize($filename);
            
            //***frear lee todo el archvio completo****
            //lemos lo que viene en foermato jason
            $completo=fread($archivo,$sizeFile);
            //lemos lo que viene en foermato jason y lo pasamos array con objeto standar
            $arrayJason = json_decode($completo);

            //trasnformar de stand onjeto a objeto
            
            $close = fclose($archivo);
            if($close){
                return $arrayJason;
            }
        }
        else{
            return $array = array();
         }
        
       }

       public static function leerDes($filename){

        if(file_exists($filename)){

            $archivo = fopen($filename,'r');
            $sizeFile = filesize($filename);
            
            //***frear lee todo el archvio completo****
            $completo=fread($archivo,$sizeFile);
            //lemos lo que viene en foermato jason y lo pasamos a string
            $array = unserialize($completo);

            $close = fclose($archivo);
            if($close){
                return $array;
            }
        }
        else{
           return $array = array();
        }
        
       }

       public static function escribirJson($filename,$arrayJason){
            $ok=false;
            $archivo = fopen($filename,'w');//lo queuqueremos es sobreescribir el archivo
        //vamos a escribir el array completo en formato json
   
            $escribir = fwrite($archivo,json_encode($arrayJason));
            
            if($escribir >0){
                if(fclose($archivo)){
                     $ok = true;
                }
            }
            return $ok;
       }
       
       public static function escribirSerializar($filename,$lista){
        $ok=false;
        $archivo = fopen($filename,'w');//lo queuqueremos es sobreescribir el archivo
       //vamos a escribir el array completo en formato json
       $escribir = fwrite($archivo,serialize($lista));
     
       if($escribir >0){
        if(fclose($archivo)){
             $ok = true;
        }
    }
    return $ok;
     
       }
        
    }


?>