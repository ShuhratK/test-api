<?php
function getDbConnection():\Pdo
{
    return new PDO("mysql:host=db;port=3306;dbname=trophies", "root", "password");
}
