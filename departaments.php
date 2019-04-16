<?PHP

require 'lib.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$usuari="ruben";
$token="3cec3029b8bfdc04a3c03d41574a48d7f9206cabf545d21f27a5f74c222e9555";

if (valida_token($usuari, $token)) {
	$departaments = get_departaments();
	http_response_code(200);

	// TODO: generar respuesta
	echo json_encode(
		array("resultat" => true));
}
else {
	http_response_code(404);
	echo json_encode(
		array("resultat" => false,
		      "dades" => "",
		      "missatge" => "Token no valid"));
} 
