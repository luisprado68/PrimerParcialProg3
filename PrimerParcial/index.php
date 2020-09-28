<?php

    include_once('./usuario.php');
    include_once('./precio.php');
    include_once('./ingreso.php');
    
    require __DIR__ . '/vendor/autoload.php';
   use \Firebase\JWT\JWT;

    $token = $_SERVER['HTTP_TOKEN'] ?? '';
    $key = "primerparcial";

    try {
        //recibo y paso token clave y el algoritmo para decodificar
        $decoded = JWT::decode($token, $key, array('HS256'));
        $logueado = true;
        //print_r($decoded);//devuelve un standar class

    } catch (Throwable $th) {

    echo "</br>No se encuentra logueado.</br>";
    $logueado=false;
    }


    //por que se pone falso el metodo cuando era distinto de post y los demas???
        $method = $_SERVER['REQUEST_METHOD'] ?? "sin metodo";
        

        if($method == "POST" || $method == "GET" || $method == "PUT" ){
            

            $path = $_SERVER['PATH_INFO'] ?? "Sin entidad";

            switch ($path) {
        
                case '/registro':
                    if ($method == 'POST') {
                        
                        $email = $_POST['email'] ?? '';
                        $tipo = $_POST['tipo'] ?? '';
                        $clave = $_POST['password'] ?? '';
                        
                       
                        $usuario = new Usuario($email,$tipo,$clave);
                        $usuario->setFilename($usuario,".txt");
                        $lista=Usuario::read("Usuario.txt");

                        if($usuario->validarMail($lista) == false){
                            if($usuario->save()){
                                echo "</br>Usuario guardado</br>";
                            }
                        }
                        
                        
                    }  
                    
                break;
                case '/login':

                    if ($method == 'POST') {
                        
                        $email = $_POST['email'] ?? '';
                        $tipo = $_POST['tipo'] ?? '';
                        $clave = $_POST['password'] ?? '';
                        
                        $lista = Usuario::read("Usuario.txt");
                        //funcion validar mail y nombre y contraseña
                        $usuario = new Usuario($email,$tipo,$clave);
                       if($usuario->validarUsuario($lista)){
                           
                        $payload = array(

                            "email" => $email,
                            "tipo" => $tipo,
                        );
                        $jwt = JWT::encode($payload, $key);
                        print_r($jwt);
                        $logueado=true;
                        echo "</br>Precio logueado</br>";
                       }
                    }  
                break;

                case '/precio':
                    $ok=false;
                    if ($method == 'POST' && $logueado== true ) {
                        //print_r($decoded);
                        // foreach ($decoded as  $value) {
                        //     if($value->tipo == "admin"){
                        //         $ok=true;
                        //         break;
                        //     }
                        // }
                        if($ok){
                            $hora = $_POST['precio_hora'] ?? '';
                            $estadia = $_POST['precio_estadia'] ?? '';
                            $mensual = $_POST['precio_mensual'] ?? '';
                            
                        
                            $precio = new Precio($hora,$estadia,$mensual);
                        
                            $precio->setFilename($precio,".txt");
                            $lista=Precio::read("Usuario.txt");

                            
                            if($precio->save()){
                                echo "</br>Precio guardado</br>";
                            }
                        
                        }
                        
                        
                        
                    }  
                    
                break;
                

                default:
                break;
                    echo '</br>Path erroneo</br>';
              }
            
            }
    
        
    else{
        echo "</br>No se encontro metodo de envio de información.</br>";
    }
   
       

    //   $listaObjetos = array();
    //  $listaObjetos =$auto->read("practica.txt");

    //  var_dump($listaObjetos);
?>




?>