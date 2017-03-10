<?php
$uam_secret = "J3ZYzRpqBC";

function encode_password($plain, $challenge, $secret) {
	if ((strlen($challenge) % 2) != 0 ||
	    strlen($challenge) == 0)
	    return FALSE;

	$hexchall = hex2bin($challenge);
	if ($hexchall === FALSE)
		return FALSE;

	if (strlen($secret) > 0) {
		$crypt_secret = md5($hexchall . $secret, TRUE);
		$len_secret = 16;
	} else {
		$crypt_secret = $hexchall;
		$len_secret = strlen($hexchall);
	}

	/* simulate C style \0 terminated string */
	$plain .= "\x00";
	$crypted = '';
	for ($i = 0; $i < strlen($plain); $i++)
		$crypted .= $plain[$i] ^ $crypt_secret[$i % $len_secret];

	$extra_bytes = 0;//rand(0, 16);
	for ($i = 0; $i < $extra_bytes; $i++)
		$crypted .= chr(rand(0, 255));

	return bin2hex($crypted);
}

function print_logon_form() {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="images/icons/favicon.ico" rel="icon" type="image/x-icon" />
  
  <title>Bienvenidos | MagWifiCo</title>
  <!-- bootstrap & normalize -->
  <link rel="stylesheet" href="css/libs/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">
  <link rel="stylesheet" href="css/magwifico.css" />
</head>
<body>
  <div class="page-wrap bg-full bg-full--shop">
    <div class="container">

      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="title-welcome">
            <p>Bienvenido a </p> <h1>SHOP</h1>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="form-save-data float-right">
            <p class="free-wifi">Free Wifi</p>
            <p>Ingresa tus datos para 'Continuar'.</p>
			<form method="post">
              <div class="form-group">
                <input type="text" class="form-control" name="fullName" id="nombreCompleto" placeholder="Nombre completo" required/>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="phoneNumber" id="numeroMovil" placeholder="Número móvil"/>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="emailAddr" id="email" placeholder="Correo Electrónico" required/>
              </div>
              <button type="submit" class="btn btn-default">Continuar</button>

			  <input type="hidden" name="challenge" value="<?php echo $_GET["challenge"] ?>">
			  <input type="hidden" name="uamip" value="<?php echo $_GET["uamip"] ?>">
			  <input type="hidden" name="uamport" value="<?php echo $_GET["uamport"] ?>">
			  <input type="hidden" name="userurl" value="<?php echo $_GET["userurl"] ?>">

            </form>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div> <!-- page-wrap -->

  <div class="site-footer bg_blue">
    <div class="container">
      <div class="row">
        <div class="col-xs-4 col-sm-5 col-md-4 col-lg-3">
          <img src="images/Magwifico-logo.png" class="logo" alt="MagWifiCo">
        </div>
        <div class="col-xs-8 col-sm-7 col-md-8 col-lg-9">
          <h4>Politica de Privacidad</h4>
          <p>Al dar click en '<b>continuar</b>'' aceptas explícitamente la <a href="javascript:;" data-toggle="modal" data-target="#myModal">Politica de Privacidad</a> de Magwifico.</p>
        </div>
      </div>
    </div>
  </div><!-- site-footer -->

  <!-- modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Politica de Privacidad y autorizacion de datos.</h4>
      </div>
      <div class="modal-body">
        Doy mi consentimiento previo, expreso e informado a Magwifico S.A.S.en adelante MW, para el tratamiento de mis datos personales, así: Derechos del titular de los datos personales (i) Acceder en forma gratuita a los datos proporcionados a MW que hayan sido objeto de tratamiento. (ii) Conocer, actualizar y rectificar mi información frente a datos parciales, inexactos, incompletos, fraccionados, que induzcan a error, o a aquellos cuyo tratamiento esté prohibido o no haya sido autorizado. (iii) Solicitar prueba de la autorización otorgada (iv) Presentar ante la Superintendencia de Industria y Comercio (SIC) quejas por infracciones a lo dispuesto en la normatividad vigente. (v) Revocar la autorización y/o solicitar la supresión del dato cuando en el tratamiento no se respeten los principios, derechos y garantías constitucionales y legales, el cual procederá cuando la autoridad haya determinado que MW en el tratamiento ha incurrido en conductas contrarias a la Constitución y la normatividad vigente. (vi) Abstenerse de responder las preguntas sobre datos sensibles. Tendrá carácter facultativo las respuestas que versen sobre datos sensibles o sobre datos de las niñas y niños y adolescentes. Finalidad: MW podrá utilizar, transferir a terceros, recolectar, almacenar, procesar, usar mi información personal con el objeto de entregarme, ofrecerme y/o venderme productos, servicios, soluciones y cualquier otro requerido para la prestación del servicio contratado, dentro de las cuales se encuentran: a) Telecomunicaciones; b) Servicios de asistencia c) Servicios Digitales d) Contenidos e) Aplicaciones f) Terminales. Entiendo, acepto y autorizo a MW que en territorio nacional y en el extranjero, se suministren mis datos personales a proveedores de productos y servicios, a sociedades del mismo grupo empresarial al que pertenezca, y a terceros que provean servicios o con quien tenga algún tipo de relación, ya sea para: i) Recaudo, ii) Pagos de Ventas, iii) Renovaciones, iv) Reposiciones, v) Soporte Técnico, vi) Servicio al Cliente, vii) Manejo y administración de bases de datos, viii) Solicitar, contratar, cambiar y cancelar servicios prestados por MW directamente o por conducto de terceros; ix) Dar respuestas a peticiones, quejas y recursos, x) Dar respuestas a organismos de control xi) Solicitar factura o información sobre ésta, xii) Solicitar la entrega, reparación o cumplimiento de garantía de productos o servicios, xiii) Recibir publicidad impresa o a través de medios electrónicos. xiv) Utilizar los distintos servicios de sus correspondientes Sitios Web, incluyendo la descarga de contenidos y formatos; xv) Enviar al Titular la notificación de ofertas, avisos y/o mensajes promocionales, xvi) Participar en concursos, rifas, juegos y sorteos; xvii) Procesar pagos, xviii) Recaudar cartera y realizar cobro administrativo prejudicial y judicial, xix) Uso de servicios de telecomunicaciones prestados por terceros, xx) Servicios de atención (Canales de atención al Usuario) xxi) Autenticación y Validación de correos electrónicos; xxii) Telemercadeo; xxiii) Productos de Mercadeo Masivo xxiv) Facturación Electrónica; xxv) Comercialización de diferentes tipos de productos xxvi) Cualquier otra actividad de naturaleza similar a las descritas en los incisos previamente citados. Magwifico S.A.S., tiene como domicilio principal la ciudad de Bogotá en la Cra 18 No. 120-17
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->
  
  <script src="js/libs/jquery.min.js"></script>
  <script src="js/libs/bootstrap.min.js"></script>
</body>
</html>



<?php
}

function print_success() {
  session_start();
?>
<!doctype html>
<html>
<head>
<title>FREE WIFI Arcador - Magwifico</title>
<?php
  if(isset($_SESSION["userurl"])) {
    echo '<meta http-equiv="refresh" content="3;URL=\'' . $_SESSION["userurl"] . '\'">';
  }
?>
</head>
<body>
<?php
  if(isset($_SESSION["userurl"])) {
    echo '<h1>Welcome! You will be redirected to your destination momentarily</h1>';
  } else {
    echo '<h1>Welcome!</h1>';
  }
?>
</body>
</html>
<?php
}

function print_failed() {
?>
<!doctype html>
<html>
<head><title>FREE WIFI Arcador - Magwifico</title></head>
<body><h1>Authentication Failed</h1></body>
</html>
<?php
}

function print_logoff() {
?>
<!doctype html>
<html>
<head><title>FREE WIFI Arcador - Magwifico</title></head>
<body><h1>GoodBye</h1></body>
</html>

<?php
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
  switch($_GET["res"]) {
  case "logoff":
    print_logoff();
    break;
  case "success":
    print_success();
    break;
  case "failed":
    print_failed();
    break;
  case "notyet":
    print_logon_form();
    break;
  default:
    http_response_code(400);
    exit();
  }
} else if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uamip = $_POST['uamip'];
  $uamport = $_POST['uamport'];
  $username = 'testuser';//$_POST['username'];
  $password = 'ThisIsThePassword';//$_POST['password'];
  $challenge = $_POST['challenge'];
  $encoded_password = encode_password($password, $challenge, $uam_secret);

  $redirect_url = "http://$uamip:$uamport/logon" .
    "?username=" . urlencode($username) .
    "&password=" . urlencode($encoded_password);

  // If you want to redirect the user to a specific location, you may set it here
  // $redirect_url .= "&redir=" . urlencode("http://myportal.example.com");

  //-------------------Send email-------------------//

	$adminEmailAddr = "radius.st76m@zapiermail.com";
	$emailAddr = $_POST['emailAddr'];
	$fullName = $_POST['fullName'];
	$phoneNumber = $_POST['phoneNumber'];
	$message = "Name : $fullName\r\nEmail : $emailAddr\r\nPhoneNumer : $phoneNumber";
	mail($adminEmailAddr, 'User Login - Magwifico', $message);

  //---------------------------------//

  session_start();
  if(isset($_POST["userurl"])) {
    $_SESSION["userurl"] = $_POST["userurl"];
  } else {
    unset($_SESSION["userurl"]);
  }
  session_write_close();
 
  header("Location: $redirect_url", TRUE, 302);
  exit();
} else {
  http_response_code(400);
  exit();
}

