<?php

require_once "./app/models/model.php";
require_once "./app/views/view.php";

class player
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new TaskModel();
        $this->view = new TaskView();
    }

    // MOSTRAR TABLA DE JUGADORES
    public function showPlayers()
    {
        $numberOfPlayers = $this->model->getPlayers();

        return $this->view->showItems($numberOfPlayers);
    }

    // MOSTRAR JUGADOR EN ESPECIFICO
    public function showSpecificPlayer($id)
    {
        $player = $this->model->specificPlayer($id);

        $playerClub = $this->model->getTeamData($player->club);

        $showPlayer = $this->view->showPlayer($player, $playerClub, $player->club);
    }

    // AÑADIR JUGADOR
    public function addPlayer()
    {
        $getClubOptions = $this->model->get_Club_Options();
        $showForms = $this->view->new_Player($getClubOptions);

        if (!isset($_POST['nameplayer']) || empty($_POST['nameplayer'])) {
            return $this->view->showError('No se puede registrar un jugador sin nombre');
        }

        if (!isset($_POST['playerAge']) || empty($_POST['playerAge'])) {
            return $this->view->showError('No se puede registrar un jugador sin edad');
        }

        if (!isset($_POST['playerClub']) || empty($_POST['playerClub'])) {
            return $this->view->showError('No se puede registrar un jugador sin club');
        }

        if (!isset($_POST['playerValue']) || empty($_POST['playerValue'])) {
            return $this->view->showError('No se puede registrar un jugador sin valor de mercado');
        }

        if (!isset($_POST['playerPosition']) || empty($_POST['playerPosition'])) {
            return $this->view->showError('No se puede registrar un jugador sin posicion');
        }

        $playerName = $_POST['nameplayer'];
        $playerAge = $_POST['playerAge'];
        $playerClub = $_POST['playerClub'];
        $playerValue = $_POST['playerValue'];
        $playerPosition = $_POST['playerPosition'];

        $newPlayer = $this->model->insertNewPlayer($playerName, $playerAge, $playerClub, $playerValue, $playerPosition);

        header('Location: ' . BASE_URL);
    }

    // ELIMINAR JUGADOR
    public function deletePlayer($id)
    {
        if (empty($id)) {
            $this->view->showError404();
        } else {
            $query = $this->model->deleteSpecificPlayer($id);
            $del = $this->view->delete_player();
        }
    }

    // EDITAR JUGADOR
    public function updatePlayer($id)
    {
        if (empty($id)) {
            $this->view->showError404();
        } else {
            $getClubOptions = $this->model->get_Club_Options();
            $showForms = $this->view->edit_Player($getClubOptions);

            if (!isset($_POST['nameplayer']) || empty($_POST['nameplayer'])) {
                return $this->view->showError('No se puede registrar un jugador sin nombre');
            }

            if (!isset($_POST['playerAge']) || empty($_POST['playerAge'])) {
                return $this->view->showError('No se puede registrar un jugador sin edad');
            }

            if (!isset($_POST['playerClub']) || empty($_POST['playerClub'])) {
                return $this->view->showError('No se puede registrar un jugador sin club');
            }

            if (!isset($_POST['playerValue']) || empty($_POST['playerValue'])) {
                return $this->view->showError('No se puede registrar un jugador sin valor de mercado');
            }

            if (!isset($_POST['playerPosition']) || empty($_POST['playerPosition'])) {
                return $this->view->showError('No se puede registrar un jugador sin posicion');
            }


            $playerName = $_POST['nameplayer'];
            $playerAge = $_POST['playerAge'];
            $playerClub = $_POST['playerClub'];
            $playerValue = $_POST['playerValue'];
            $playerPosition = $_POST['playerPosition'];

            $editPlayer = $this->model->updatePlayer($playerName, $playerAge, $playerClub, $playerValue, $playerPosition, $id);


            header('Location: ' . BASE_URL);
        }
        
    }
}
