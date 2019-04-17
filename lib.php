<?PHP


// devuelve un token si se ha podido validar y en caso contrario
// devuelve NULL

function valida($usuari, $password) {
    $db = new SQLite3('empresa.db');
    $result = $db->query('SELECT * FROM usuari WHERE usuari = "' . $usuari . '" AND passwd = "' .$password . '"');
    $row = $result->fetchArray();
    
    $token = null;
    if ($row) {
        $token = bin2hex(random_bytes(32));
        $token_limit = date('now');
        $db->query('UPDATE usuari SET token = "' . $token . '", token_limit = "' . $token_limit . '" WHERE usuari = "' . $row['usuari'] . '"');
    }

    return $token;
}

function valida_token($usuari, $token) {
    $db = new SQLite3('empresa.db');
    $result = $db->query('SELECT * FROM usuari WHERE usuari = "' . $usuari . '"');
    $row = $result->fetchArray();
    if (!$row) {
	return false;
    } else {
        return ($row['token'] == $token);
    }
} 

function get_departaments() {
    $db = new SQLite3('empresa.db');
    $result = $db->query('SELECT iddep, nomdep, fk_cap, nomempl AS nomcap FROM departament NATURAL JOIN empleat');

    $departaments = [];

    while($row = $result->fetchArray()) {
       $departaments[] = array("iddep" => $row["iddep"],
		               "nomdep" => $row["nomdep"],
			       "fk_cap" => $row["fk_cap"],
			       "nomcap" => $row["nomcap"]);
    }
    return array("resultat" => true, $departaments);
}
