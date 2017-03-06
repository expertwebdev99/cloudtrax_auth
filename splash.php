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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en"><head>
    <meta charset="utf-8">
    <title>FREE WIFI Arcador - Magwifico | Connect</title>
    <meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- styles -->
    <link href="css/custom.css" rel="stylesheet">
    </style>
    <script language="javascript" type="text/javascript">
      function toggle_visibility(id) {
        var e = document.getElementById(id);
        if (e.style.display == 'block') {
          e.style.display = 'none';
        } else {
          e.style.display = 'block';
        }
      }
    </script>
  </head>
  <!-- Change the background color and add an image here -->
  <body style="background-image : url('img/background.jpg');">
    <div class="container">
      <!-- Logo -->
      <div class="page-header" style="background-color:black">
        <img alt="CloudTrax Logo" src="img/logo.jpg">
      </div>
      <!-- Header Image * ID "rounded" automatically adds rounded corners -->
  
      <!-- Main Content -->
      <!-- Left Column -->
      <div class="row">
        <div class="span4">
          <h1>Welcome to FREE WIFI Arcador - Magwifico</h1>
          <div class="mobileonly">
            <a class="showLink" onclick="toggle_visibility('welcome');">
              <p>Show/Hide Welcome Message and Terms</p>
            </a>
          </div>
          <div id="welcome" class="welcome">
            <p><strong>By continuing, you agree to the terms and conditions.</strong></p>
            <div style="height:140px;width:97%;border:1px solid #ccc;overflow:auto;margin-bottom:15px;padding:5px;">
            <p><small><strong>Terms and Conditions</strong></small></p>
            <p><small>By using our internet service, you hereby expressly acknowledge and agree that there are significant security, privacy and confidentiality risks inherent in accessing or transmitting information through the internet, whether the connection is facilitated through wired or wireless technology. Security issues include, without limitation, interception of transmissions, loss of data, and the introduction of viruses and other programs that can corrupt or damage your computer.</small></p>
            <p><small>Accordingly, you agree that the owner and/or provider of this network is NOT liable for any interception or transmissions, computer worms or viruses, loss of data, file corruption, hacking or damage to your computer or other devices that result from the transmission or download of information or materials through the internet service provided.</small></p>
            <p><small>Use of the wireless network is subject to the general restrictions outlined below. If abnormal, illegal, or unauthorized behavior is detected, including heavy consumption of bandwidth, the network provider reserves the right to permanently disconnect the offending device from the wireless network.</small></p>
            <p><small><strong>Examples of Illegal Uses</strong></small></p>
            <p><small>The following are representative examples only and do not comprise a comprehensive list of illegal uses:</small></p>
            <ol>
              <li>Spamming and invasion of privacy - Sending of unsolicited bulk and/or commercial messages over the Internet using the Service or using the Service for activities that invade another's privacy.</li>
              <li>Intellectual property right violations - Engaging in any activity that infringes or misappropriates the intellectual property rights of others, including patents, copyrights, trademarks, service marks, trade secrets, or any other proprietary right of any third party.</li>
              <li>Accessing illegally or without authorization computers, accounts, equipment or networks belonging to another party, or attempting to penetrate/circumvent security measures of another system. This includes any activity that may be used as a precursor to an attempted system penetration, including, but not limited to, port scans, stealth scans, or other information gathering activity.</li>
              <li>The transfer of technology, software, or other materials in violation of applicable export laws and regulations.</li>
              <li>Export Control Violations</li>
              <li>Using the Service in violation of applicable law and regulation, including, but not limited to, advertising, transmitting, or otherwise making available ponzi schemes, pyramid schemes, fraudulently charging credit cards, pirating software, or making fraudulent offers to sell or buy products, items, or services.</li>
              <li>Uttering threats;</li>
              <li>Distribution of pornographic materials to minors;</li>
              <li>and Child pornography. </li>
            </ol>
            <p><small><strong>Examples of Unacceptable Uses</strong></small></p>
            <p><small>The following are representative examples only and do not comprise a comprehensive list of unacceptable uses:</small></p>
            <ol>
              <li>High bandwidth operations, such as large file transfers and media sharing with peer-to-peer programs (i.e.torrents)</li>
              <li>Obscene or indecent speech or materials</li>
              <li>Defamatory or abusive language</li>
              <li>Using the Service to transmit, post, upload, or otherwise making available defamatory, harassing, abusive, or threatening material or language that encourages bodily harm, destruction of property or harasses another.</li>
              <li>Forging or misrepresenting message headers, whether in whole or in part, to mask the originator of the message.</li>
              <li>Facilitating a Violation of these Terms of Use</li>
              <li>Hacking</li>
              <li>Distribution of Internet viruses, Trojan horses, or other destructive activities</li>
              <li>Distributing information regarding the creation of and sending Internet viruses, worms, Trojan horses, pinging, flooding, mail-bombing, or denial of service attacks. Also, activities that disrupt the use of or interfere with the ability of others to effectively use the node or any connected network, system, service, or equipment.</li>
              <li>Advertising, transmitting, or otherwise making available any software product, product, or service that is designed to violate these Terms of Use, which includes the facilitation of the means to spam, initiation of pinging, flooding, mail-bombing, denial of service attacks, and piracy of software.</li>
              <li>The sale, transfer, or rental of the Service to customers, clients or other third parties, either directly or as part of a service or product created for resale.</li>
              <li>Seeking information on passwords or data belonging to another user.</li>
              <li>Making unauthorized copies of proprietary software, or offering unauthorized copies of proprietary software to others.</li>
              <li>Intercepting or examining the content of messages, files or communications in transit on a data network. </li>
            </ol>
          </div>
        </div>
      </div>
      <!-- Right Column -->
      <div class="span8">
        <div class="row">
          <div class="box">
            <h3>Free Access:</h3>
            <!-- Username and Password to be submitted to RADIUS -->
            <form method="post">
              <table border="0" cellpadding="0" cellspacing="0">
                <tbody><tr>
                  <th>Name:</th>
                  <td><input class="inputbox" name="Name" type="text"></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td><input class="inputbox" name="Email" type="email"></td>
                </tr>
                <tr>
                  <th>Phone:</th>
                  <td><input class="inputbox" name="Phone" size="6" type="Integer "></td>
                </tr>

				<tr>
                  <th>User Name:</th>
                  <td><input class="inputbox" name="username"></td>
                </tr>

				<tr>
                  <th>Password:</th>
                  <td><input class="inputbox" name="password"></td>
                </tr>
				

                <tr>
                  <td colspan="2"><button class="button" type="SUBMIT">Free WIFI</button></td>
                </tr>
              </tbody></table>

			  <input type="hidden" name="challenge" value="<?php echo $_GET["challenge"] ?>">
			  <input type="hidden" name="uamip" value="<?php echo $_GET["uamip"] ?>">
			  <input type="hidden" name="uamport" value="<?php echo $_GET["uamport"] ?>">
			  <input type="hidden" name="userurl" value="<?php echo $_GET["userurl"] ?>">

            </form>
          </div>

      <div style="clear: both"></div>
      <!-- Footer
      ==================================================
      Customize this area however you wish -->
      <div>
        <p class="horizontalrule"><small>&copy; 2017 CloudTrax</small></p>
      </div>
      <!-- /container -->
    </div>
    <!-- /container -->


</div></body></html>





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
  $username = $_POST['username'];
  $password = $_POST['password'];
  $challenge = $_POST['challenge'];
  $encoded_password = encode_password($password, $challenge, $uam_secret);

  $redirect_url = "http://$uamip:$uamport/logon" .
    "?username=" . urlencode($username) .
    "&password=" . urlencode($encoded_password);

  // If you want to redirect the user to a specific location, you may set it here
  // $redirect_url .= "&redir=" . urlencode("http://myportal.example.com");

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

