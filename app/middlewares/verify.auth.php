<?php
function verifyAuthUser($response)
{
    if ($response->user) {
        return;
    } else {
        header('Location: ' . BASE_URL . 'notloged');
        die();
    }
}
