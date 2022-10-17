<?php
// $apiArgArray = explode("/", substr($_SERVER['REQUEST_URI'], 1));
// echo var_dump($apiArgArray);
// echo '<br>';
// echo var_dump($_GET);
// echo '<br>';
// echo var_dump($_REQUEST);
// echo '<br>';
// echo var_dump($_POST);
// echo '<br>';
// echo var_dump(json_decode(file_get_contents("php://input"),true)['apiKey']);
// echo '<br>';
// echo var_dump($_SERVER);
// echo '<br>';

include("Controllers/API.php");

if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new API($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
