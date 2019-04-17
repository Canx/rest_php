<?php

require 'lib.php';

$usuari = $_POST["usuari"];
$password = $_POST["password"];

// PARA TEST
$usuari = 'ruben';
$password = 'hola';

// Devolvemos el resultado
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$token = valida($usuari, $password);
if ($token) {
   http_response_code(200);
   echo json_encode(
	   array("resultat" => true,
	         "dades" => array("token" => $token),
		 "missatge" => "Validació correcta"));
}
else {
   http_response_code(404);
   echo json_encode(
	   array("resultat" => false,
	         "dades" => "",
		 "missatge" => "Usuari o password incorrectes"));
}
