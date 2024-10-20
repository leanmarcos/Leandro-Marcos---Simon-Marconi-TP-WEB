<?php

class UserView{

    function showLoginPage(){
        require_once "templates/loginForm.phtml";
    }

    function showCorrectLogIn($exito){
      echo "<p class= 'text-success'>$exito</p>";
   }

    function showIncorrectLogIn($error){
        echo "<p class='text-danger'>$error</p>";
    }
   
    function not_loged(){
        require_once "templates/notLoged.phtml";
    }
}
