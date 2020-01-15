<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('display_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Africa/Johannesburg');

$G_TAKE = "";
foreach (getallheaders() as $name => $value) {
    if ($name == "Authorization") {
        $G_TOKEN = $value;
    }else{

    }
    
}

if (strlen($G_TOKEN) > 10)
{
    //Validate the Basic Authorization

    //Check if Basic Time has no expired
    
    //Testing
    //$details = json_decode(file_get_contents("php://input"));
    $fh = fopen('log.txt', 'w') or die("Can't open file.");
    // output the value as a variable by setting the 2nd parameter to true
    //$results = print_r($details, true);
    $results ="Tester";
    fwrite($fh, $results);
    fclose($fh);
    
}else{
    echo json_encode("Please provided Basic Authorization to proceed");
}



?>
