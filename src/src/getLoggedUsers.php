<?php

function getLoggedUsers(): array
{
    $allSessions = [];
    $sessionNames = scandir('/tmp');

    foreach ($sessionNames as $sessionName) {
        $sessionName = str_replace("sess_", "", $sessionName);
        if (strpos($sessionName, ".") === false) { //This skips temp files that aren't sessions
            session_id($sessionName);
            session_start();
            $allSessions[] = $_SESSION['id'];
            session_abort();
        }
    }
    return $allSessions;
}
