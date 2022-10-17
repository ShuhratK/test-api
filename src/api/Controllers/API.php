<?php
require_once('APIController.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/src/dbconnection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/Models/UserModel.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/Models/TrophyModel.php');

class API extends APIController
{
    public function __construct($request, $origin)
    {
        parent::__construct($request);
    }


    /**
     * Example of an Endpoint
     */
    protected function users()
    {   
        $object = new Models\User(getDbConnection());
        if ($this->method == 'GET') {
            if ($this->verb) {
                return $object->{$this->verb}($this->args);
            } elseif(is_numeric($this->args[0])){
                return $object->find($this->args);
            }
            else
            {
                return $object->findAll($this->args);
            }
        } else {
            return "Only accepts GET requests";
        }
    }

    protected function trophies()
    {
        $object = new Models\Trophy(getDbConnection());
        if ($this->method == 'GET') {
            if($this->verb){
                return $object->{$this->verb}($this->args);
            }
            elseif(is_numeric($this->args[0])){
                return $object->find($this->args);
            }
            else
            {
                return $object->findAll($this->args);
            }
        } else {
            return "Only accepts GET requests";
        }
    }
}
