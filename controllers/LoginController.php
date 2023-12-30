<?php

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router; 

class LoginController {

    public static function login(Router $router) {

        $alertas = [];
 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //Comprobar que el usuario exista
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    //Comprobar la contraseña
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        // Autenticar al usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header("Location: /admin");
                        } else {
                            header("Location: /cita");
                        }

                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }

        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/login", [
            'alertas' => $alertas,
        ]);

    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();  

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario && $usuario->confirmado === "1"){
                    //Generar token para restablecer contraseña
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar el email para restablecer contraseña
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito", "Revisa tu correo");
                } else {
                    Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/olvide-password", [
            'alertas' => $alertas
        ]);

    }

    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        //Buscar usuario por token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Lee la nueva contraseña y la guarda
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if (empty($alertas)) {
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                
                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/recuperar-password", [
            'alertas' => $alertas,
            'error' => $error
        ]);

    }

    public static function crear(Router $router) {

        $usuario = new Usuario;
        
        //Alertas vacias
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacios. Es decir, no hay errores
            if(empty($alertas)){
                //Comprobar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hash a la contraseña
                    $usuario->hashPassword();

                    //Generar un token para confirmar cuenta
                    $usuario->crearToken();

                    //Enviar el email para confirmar cuenta
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
            
        }

        $router->render("auth/crear-cuenta", [
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);

    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {

        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        
        if (empty($usuario)) {
            Usuario::setAlerta('error','Token no Valido');
        } else {
            //Modificar al usuario confirmado - elimiando token - cambiando de 0 a 1 confirmando.
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta("exito","Cuenta Comprobada Correctamente");
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);

    }

}