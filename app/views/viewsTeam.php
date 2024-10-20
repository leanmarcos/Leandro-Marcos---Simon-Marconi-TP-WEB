<?php

class TeamView
{

    public function showListOfTeams($listOfTeams)
    {
        require 'templates/list_Categories.phtml';
    }

    public function showError() {}

    public function showError404(){
        require_once "templates/error404.phtml";
    }

    public function showCategories($players, $dataTeam)
    {
        require_once 'templates/specificTeam.phtml';
    }


    public function newTeam()
    {
        require_once "templates/newClub.phtml";
    }

    public function editTeam()
    {
        require_once 'templates/updateTeam.phtml';
    }

    public function deleteTeam()
    {
        require_once 'templates/elementDeleted.phtml';
    }
}
