<?php

namespace Models;
use PDO;

class Trophy extends Model
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db, 'trophies');
    }

    public function add(array $input)
    {
        $userId = $input[0];
        $trophiesCount = isset($input[1]) ? $input[1] : 1;

        $id = $input[0];
        $statement = "insert into trophies (`id`, `user_id`, `date_db`, `count`) 
        VALUES(NULL, '".$userId."', CURRENT_TIMESTAMP, '".$trophiesCount."');";
        
        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $insertId = $this->_db->lastinsertid();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    

       

        $statement = "select * from trophies where id = ".$insertId.";";

        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($insertId));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function del(array $input)
    {   
        $transactionId = $input[0];
        $statement = "select * from trophies where id = ".$transactionId.";";

        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($transactionId));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $statement = "delete from trophies where id = ".$transactionId.";";

        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($transactionId));
            $delete = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if(is_array($delete))
            {
                return $result[0];
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        
    }

    public function find(array $input)
    {
        $id = $input[0];
        $statement = "select sum(count) as count from trophies where user_id = ".$id.";";

        try {
            $statement = $this->_db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0];
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
