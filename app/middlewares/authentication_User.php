<?php
function loginAuthentication($response)
{
    session_start();
    if (isset($_SESSION['id_user'])) {
        $response->user = new stdClass();
        $response->user->user_id = $_SESSION['id_user'];
        $response->user->username = $_SESSION['username'];
        return;
    }
}
