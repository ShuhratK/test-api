<?php

namespace Models;

include_once('Model.php');

class User extends Model
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'users');
    }

    public function logged(array $input)
    {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/src/getLoggedUsers.php');
        $loggedIds = getLoggedUsers();
        $statement = "SELECT * FROM `users` WHERE id IN (" . implode(",", $loggedIds) . ");";
        try {
            $statement = $this->_db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function notrophy(array $input)
    {   
        $callback = function ($el) {
            return reset($el);
        };
        $statement = "SELECT id FROM users;";
        try {
            $statement = $this->_db->query($statement);
            $userIds = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $userIds = array_map($callback, $userIds);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $statement = " SELECT user_id FROM trophies;";
        try {
            $statement = $this->_db->query($statement);
            $usersWithTrophies = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $usersWithTrophies = array_map($callback, $usersWithTrophies);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $diff = array_diff($userIds, $usersWithTrophies);

        $statement = "SELECT * FROM `users` WHERE id IN (" . implode(",", $diff) . ");";
        try {
            $statement = $this->_db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
