<?PHP

require 'lib.php';

$usuari = '';
$token = '';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if (isset($_POST['usuari'])) {
        $usuari = $_POST['usuari'];
    }

    if (isset($_POST['token'])) {
        $token = $_POST['token'];
    }

    // para test
    // $usuari="ruben";
    // $token="3cec3029b8bfdc04a3c03d41574a48d7f9206cabf545d21f27a5f74c222e9555";

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    if (valida_token($usuari, $token)) {
    	http_response_code(200);
    
    	echo json_encode(get_departaments());
    }
    else {
    	http_response_code(404);
    	echo json_encode(
    		array("resultat" => false,
    		      "dades" => "",
    		      "missatge" => "Token no valid"));
    } 
}
else {
?>
<html>
   <head>
      <script src="jquery-3.4.1.min.js"></script>
      <script src="js.cookie.js"></script>
   </head>
   <body>
      <h1>Hola</h1>
      <form id="departamentos" action="departaments.php" method="POST">
          <button type="submit" form="departamentos" value="Submit">Obtener departamentos</button>
      </form>
      <div id="respuesta">
          <p id="codigo"></p>
      </div>

   </body>
   <script>
      $(function() {
          $('#departamentos').submit(function(event) {
              event.preventDefault(); // Prevent the form from submitting via the browser

              var form = $(this);
              $.ajax({
                  type: form.attr('method'),
                   url: form.attr('action'),
                   data: {
                       usuari: Cookies.get("usuari"),
                       password: Cookies.get("password")
	           },
		   dataType: "json"
	      }).done(function(data) {
                   $('#codigo').text("MENSAJE:" + data.responseJSON['missatge']);
              }).fail(function(data) {
		   // tenemos que autenticarnos de nuevo!
		   window.location.replace("valida.php");
	      });
         });

      });

   </script>

</html>
<?PHP
}
?>
