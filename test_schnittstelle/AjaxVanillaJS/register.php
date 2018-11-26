<?php

header('Content-Type: application/json');

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

// Data has been sent and should be processed
if(isset($obj['username'])){
    $username = $obj['username'];

    // TODO "write $username into the Database";
$jsonresponse = <<<jsonresponse
{ "status": "200", "infotext": "You have been registered successfully" }
jsonresponse;

echo $jsonresponse;

}
else{

$jsonresponse = <<<jsonresponse
{ "status": "50X", "infotext": "There has been an error with your credentials" }
jsonresponse;

echo $jsonresponse;
}