<?php

$db = new SQLite3('empresa.db');

// cambiar cuando sea web por esto
#$usuari = $_POST["usuari"];
#$password = $_POST["password"];
$usuari = 'ruben';
$password = 'hola';

$result = $db->query('SELECT * FROM usuari WHERE usuari = "' . $usuari . '" AND passwd = "' .$password . '"');

$row = $result->fetchArray();

// Devolvemos el resultado
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if ($row) {
   http_response_code(200);
   $token = bin2hex(random_bytes(32));
   $token_limit = date('now');
   $db->query('UPDATE usuari SET token = "' . $token . '", token_limit = "' . $token_limit . '" WHERE usuari = "' . $row['usuari'] . '"');
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
