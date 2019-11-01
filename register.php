<?PHP
include "config.php";
if(isset($_POST["submit"])) {
	if (isset($_POST["login"]) && !empty($_POST["login"]) && isset($_POST["mdp"]) && !empty($_POST["mdp"])) {
		$login = trim($_POST["login"]);
		$mdp = trim($_POST["mdp"]);
		$uuid = GenUUID();
    	$exec = $_PDO->prepare('SELECT * FROM users WHERE username = :username');
    	$exec->execute(array( 'username' => $login) );
    	$data = $exec->fetchAll(PDO::FETCH_ASSOC);
		if ($exec == false) {
			die("Une erreur est survenue. Veuillez réssayer.");
		} elseif (count($data) > 0) {
			die("Ce pseudo est déjà utilisé !");
		}
		$usernameCorrect = preg_match("/^([A-Za-z0-9_]+)$/", $login);
		if ($usernameCorrect == 0) {
			die("Ce pseudo est incorrect");
		}
			$result = $_PDO->prepare( "INSERT INTO users (uuid, username, password) VALUES (:uuid, :username, :password)");
			$result->execute( array( 'uuid' => $uuid,'username' => $login,'password' => HashPassword($mdp)) );
		if ($result == false) {
			die("Une erreur est survenue.");
		}
		die("Votre compte a été crée avec succès !");
	} else {
		die("Une erreur est survenue. Veuillez réssayer.");
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>S'inscrire</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="res/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="res/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="res/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="res/css/util.css">
	<link rel="stylesheet" type="text/css" href="res/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('res/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="register.php" method="post">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Création d'un compte :
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Entrez un nom d'utilisateur">
						<input class="input100" type="text" name="login" placeholder="Pseudo" maxlength="40">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Entrez un mot de passe">
						<input class="input100" type="password" name="mdp" placeholder="Mot de passe" maxlength="40">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<input type="submit" name="submit" value="Envoyer" class="login100-form-btn"/>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="res/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="res/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="res/vendor/bootstrap/js/popper.js"></script>
	<script src="res/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="res/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="res/vendor/daterangepicker/moment.min.js"></script>
	<script src="res/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="res/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="res/js/main.js"></script>

</body>
</html>
