<?php

require_once 'models/usuario.php';

class UsuarioController
{

    public function index()
    {
        echo 'Controlador Usuarios,Acción index';
    }

    public function registro()
    {
        require_once 'views/usuario/registro.php';
    }

    public function guardar()
    {
        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $admin = isset($_POST['admin']) ? $_POST['admin'] : "user";
            // var_dump($_POST);
            // die();
            if ($nombre & $apellidos & $email & $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $usuario->setRol($admin);
                $save = $usuario->save();
                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
            header("Location:" . base_url . 'usuario/registro');
        }
        header("Location:" . base_url . 'usuario/registro');
    }

    public function login()
    {
        if (isset($_POST) && !isset($_SESSION['identity'])) {
            //Identificar al usuario
            $usuario = new Usuario();
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            //Consulta a la base de datos
            $identity = $usuario->login($email, $password);
            //Crear sesión  
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                if ($identity->rol == "admin") {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = "Email o Contraseña Incorrectos";
            }
        }
        header("Location:" . base_url);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url);
    }
}
