<?php
namespace Models;

abstract class Model
{
    protected $_db = null;
    protected $_table;

    public function __construct(\PDO $db,$table)
    {
        $this->_db = $db;
        $this->_table = $table;
    }

    public function findAll(Array $input)
    {
        $statement = "
            SELECT 
                *
            FROM
                ".$this->_table.";
        ";

        try {
            $statement = $this->_db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find(Array $input)
    {
        $id = $input[0];
        $statement = "
            SELECT 
                *
            FROM
                ".$this->_table."
            WHERE id = ?;
        ";

        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
}