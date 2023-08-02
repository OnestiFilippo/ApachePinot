<?php

$request = $_GET['req'];

if($request == "LAST")
{
    $last = file_get_contents('last.json');

    $json_data = json_decode($last, true);

    $myObj = new stdClass();

    $epoch = intval($json_data[0]);
    $datetime = new DateTime("@$epoch");
    $timestamp = $datetime->format('d/m/Y - H:i:s');

    $myObj->{"powerValue"} = $json_data[1];
    $myObj->{"sensor"} = $json_data[2];
    $myObj->{"timestamp"} = $timestamp;
    
    $myJSON = json_encode($myObj);
    echo $myJSON;
}
