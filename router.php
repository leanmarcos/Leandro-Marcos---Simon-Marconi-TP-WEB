<?php

// REQUIRES //
require_once "./app/controllers/controller.php";
require_once "./app/controllers/controllerTeam.php";
require_once "./app/controllers/controllerLogin.php";
require_once "./app/middlewares/authentication_User.php";
require_once "./libs/response.php";
require_once "./app/middlewares/verify.auth.php";


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// DEFINIENDO ACTION //
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "home";
}

$params = explode("/", $action);

// RESPONSE //
$response = new Response();


// ROUTER //
switch ($params[0]) {

        // INICIO //
    case "home":
        $controller = new player();
        $controller_teams = new team();
        $controller->showPlayers();
        $controller_teams->showTeams();
        break;

        // FORM PARA INICIAR SESION //
    case "showSignin":
        $controller = new userLogin();
        $controller->formLogin();

        // INICIO DE SESION //
    case "signin":
        $controller = new userLogin();
        $controller->userVerify();
        break;

        // CERRAR SESION //
    case "signout":
        $controller = new userLogin();
        $controller->logout();
        break;

        // JUGADOR ESPECIFICO //
    case "player":
        $controller = new player();
        $controller->showSpecificPlayer($params[1]);
        break;

        // EQUIPO ESPECIFICO //
    case "team":
        $controller = new team();
        $controller->showSpecificClub($params[1]);
        break;

        // AGREGAR EQUIPO //
    case "newteam":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controller = new team();
        $controller->addTeam();
        break;

        // AGREGAR JUGADOR //
    case "newplayer":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controllerObject = new player;
        $controllerObject->addPlayer();
        break;

        // EDITAR JUGADOR //
    case "editplayer":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controllerObject = new player;
        $controllerObject->updatePlayer($params[1]);
        break;

        // ELIMINAR JUGADOR //
    case "deleteplayer":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controller = new Player();
        $controller->deletePlayer($params[1]);
        break;

        // EDITAR CLUB //
    case "editclub":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controllerObject = new team();
        $controllerObject->updateTeam($params[1]);
        break;

        // ELIMINAR CLUB //
    case "deleteclub":
        loginAuthentication($response);
        verifyAuthUser($response);
        $controller = new team();
        $controller->deleteTeam($params[1]);
        break;

        // EL USUARIO NO TIENE PERMISOS (SIN INICIO DESESION) //
    case "notloged":
        $controller = new userLogin();
        $controller->notLoged();
        break;

        // DEFAULT (URL NO ENCONTRADA) //
    default:
        require_once "./templates/error404.phtml";
        break;
}
