<?php

require_once "./app/models/modelTeam.php";
require_once "./app/views/viewsTeam.php";

class team
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new TeamModel();
        $this->view = new TeamView();
    }

    // MOSTRAR TODOS LOS EQUIPOS (TABLA) //
    public function showTeams()
    {
        $listOfTeams = $this->model->getTeams();
        return $this->view->showListOfTeams($listOfTeams);
    }

    // MOSTRAR UN EQUIPO EN ESPECIFICO CON SUS JUGADORES RELACIONADOS
    public function showSpecificClub($id)
    {
        $getDatafromTeam = $this->model->getTeamData($id);
        $team = $this->model->Players_From_specificClub($id);

        $showPlayer = $this->view->showCategories($team, $getDatafromTeam);
    }

    // NUEVO EQUIPO
    public function addTeam()
    {
        $showForms = $this->view->newTeam();

        if (!isset($_POST['nameClub']) || empty($_POST['nameClub'])) {
            return $this->view->showError('No se puede registrar un equipo sin nombre');
        }

        if (!isset($_POST['foundation']) || empty($_POST['foundation'])) {
            return $this->view->showError('No se puede registrar un equipo sin fundacion');
        }

        if (!isset($_POST['stadium']) || empty($_POST['stadium'])) {
            return $this->view->showError('No se puede registrar un equipo sin estadio');
        }

        if (!isset($_POST['badge']) || empty($_POST['badge'])) {
            return $this->view->showError('No se puede registrar un equipo sin logo');
        }


        $clubName = $_POST['nameClub'];
        $foundation = $_POST['foundation'];
        $stadium = $_POST['stadium'];
        $badge = $_POST['badge'];

        $newPlayer = $this->model->insertNewClub($clubName, $foundation, $stadium, $badge);

        header('Location: ' . BASE_URL);
    }

    // ELIMINAR EQUIPO
    public function deleteTeam($id)
    {
        if (empty($id)) {
            $errorMessage = $this->view->showError404();
        } else {
            $query = $this->model->deleteClub($id);
            $del = $this->view->deleteTeam();
        }
    }

    // EDITAR EQUIPO
    public function updateTeam($id)
    {
        $showForms = $this->view->editTeam();

        if (!isset($_POST['nameClub']) || empty($_POST['nameClub'])) {
            return $this->view->showError('No se puede registrar un equipo sin nombre');
        }

        if (!isset($_POST['foundation']) || empty($_POST['foundation'])) {
            return $this->view->showError('No se puede registrar un equipo sin fundacion');
        }

        if (!isset($_POST['stadium']) || empty($_POST['stadium'])) {
            return $this->view->showError('No se puede registrar un equipo sin estadio');
        }

        if (!isset($_POST['badge']) || empty($_POST['badge'])) {
            return $this->view->showError('No se puede registrar un equipo sin logo');
        }


        $clubName = $_POST['nameClub'];
        $foundation = $_POST['foundation'];
        $stadium = $_POST['stadium'];
        $badge = $_POST['badge'];

        $newPlayer = $this->model->updateClub($clubName, $foundation, $stadium, $badge, $id);

        header('Location: ' . BASE_URL);
    }
}
