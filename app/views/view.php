<?php

class TaskView
{
    public function showItems($listOfItems)
    {
        require_once 'templates/list_Items.phtml';
    }

    public function showError($error) {}

    public function showError404(){
        require_once "templates/error404.phtml";
    }
    public function showPlayer($player, $playerClub, $club)
    {
        require_once 'templates/specificPlayer.phtml';
    }


    public function new_Player($clubOptions)
    {
        require_once "templates/newPlayer.phtml";
    }

    public function edit_Player($clubOptions)
    {
        require_once './templates/updatePlay.phtml';
    }

    public function delete_player()
    {
        require_once 'templates/elementDeleted.phtml';
    }
}
