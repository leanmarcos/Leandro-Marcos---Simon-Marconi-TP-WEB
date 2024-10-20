<?php
require_once "app/models/modelLogin.php";
require_once "app/views/viewLogin.php";

class userLogin
{

    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new userModel;
        $this->view = new userView;
    }

    function formLogin()
    {
        $this->view->showLoginPage();
    }

    function userVerify()
    {
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            return $this->view->showIncorrectLogIn('El nombre de usuario NO puede estar incompleto');
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showIncorrectLogIn('La contraseña NO puede estar incompleta');
        }

        $userName = $_POST['username'];
        $password = $_POST['password'];



        $userVerification = $this->model->getUserName($userName);

        if ($userVerification && password_verify($password, $userVerification->password)) {
            session_start();
            $_SESSION['id_user'] = $userVerification->id_user;
            $_SESSION['username'] = $userVerification->username;

            $this->view->showCorrectLogIn("Inicio de sesion exitoso");
        } else {
            return $this->view->showIncorrectLogIn("Usuario no encontrado, verifique su nombre o contraseña");
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }

    public function notLoged()
    {
        $this->view->not_loged();
    }
}
