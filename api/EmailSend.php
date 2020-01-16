<?php
/**
 * Created by PhpStorm.
 * User: Oarabile.Macdonald
 * Date: 2018/11/05
 * Time: 11:53 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('display_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Africa/Johannesburg');


$data = json_decode(file_get_contents("php://input"));
require 'sendemail.php';

$ToEmailList = $data->toAddress;
$Subject  = $data->toSubject;
$bodyContent = $data->toBody;

SendEmail($ToEmailList,$Subject,$bodyContent);