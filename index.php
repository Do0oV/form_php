<?php

include 'conndb.php';

if (isset($_POST['valider'])) {
	if(!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['message']) && !empty($_POST['radio'])&& !empty($_POST['select']) ){

		$to         = 'your@email.whatever';
		$headers    = 'From: "contact" <name@yourdomain.info>' . "\r\n";
		$headers    .= "Mime-Version: 1.0\n";
		$headers    .= "Content-Transfer-Encoding: 8bit\n";
		$headers    .= "Content-type: text/html; charset= utf-8\n";
		$subject = 'Nouveau message formulaire contact PHP';

		$nom = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['mail']);
		$db_msg = htmlspecialchars($_POST['message']);

		$message = '
		<html>
		<body>
		<div align="center">
		Nom de l\'expéditeur : '.$nom.'<br>
		Mail de l\'expéditeur : '.$email.'<br>
		'.nl2br($db_msg).'<br>
		</div>
		</body>
		</html>
		';
		//uncomment to send by email
		//mail($to, $subject, $message, $headers);
		$msg = 'Message envoyé';

		$radio = htmlspecialchars($_POST['radio']);
		$list = htmlspecialchars($_POST['select']);
		$interet = $_POST['interet'];
		$impint = implode(",", $interet);

		$reponse = $db->prepare("INSERT INTO messages (nom, email, radio, interet, list, message) 
			VALUES (:nom, :email,:radio, :impint,:list, :db_msg)");
		$reponse->execute(array(
			'nom' => $nom,
			'email' => $email,
			'radio' => $radio,
			'impint' => $impint,
			'list' => $list,
			'db_msg' => $db_msg
		));

	}else if (empty($_POST['name'])) {
		$msgnom = 'Merci de remplir votre nom!';
	}else if (empty($_POST['mail'])) {
		$msgmail = 'Merci de remplir votre email!';
	}else if (empty($_POST['message'])) {
		$msgmessage = 'Merci de remplir votre message!';
	}else if (empty($_POST['radio'])) {
		$msgradio = 'Merci de cocher une case!';
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>FormPHP</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
</head>
<body>
	<div class="container">
		<h1>Contactez-nous</h1>

		<form action="index.php" method="POST" name="formulaire">
			<span id="ok"><?php if (isset($msg)) echo $msg; else ""; ?></span>

			<label for="name">Nom :
				<span class="echo"><?php if (isset($msgnom)) echo $msgnom; else ""; ?></span>
			</label>
			<input type="text" id="name" name="name" >

			<label for="mail">E-mail :
				<span class="echo"><?php if (isset($msgmail)) echo $msgmail; else ""; ?></span>
			</label>
			<input type="email" id="mail" name="mail" >

			<div class="radio">
				<label for="professionnel">professionnel
					<input type="radio" id="professionnel" name="radio" value="professionnel">
				</label>

				<label for="particulier">particulier
					<input type="radio" id="particulier" name="radio" value="particulier">
				</label>
				<span class="echo"><?php if (isset($msgradio)) echo $msgradio; else ""; ?></span>
			</div>

			<fieldset>
				<legend>Centre d'intérêts</legend>

				<label for="pro">Musique
					<input type="checkbox" id="musique" name="interet[]" value="musique">
				</label>
				<label for="perso">Cinéma
					<input type="checkbox" id="cinema" name="interet[]" value="cinema">
				</label>
				<label for="perso">Jeux Vidéo
					<input type="checkbox" id="jeux" name="interet[]" value="jeux">
				</label>
				<label for="perso">Sport
					<input type="checkbox" id="sport" name="interet[]" value="sport">
				</label>
				<label for="perso">Voyage
					<input type="checkbox" id="voyage" name="interet[]" value="voyage">
				</label>
			</fieldset>

			<div class="select">
				<select name="select">
					<option disabled selected>Votre demande concerne:</option>
					<option value="info">informations</option>
					<option value="sav">SAV</option>
				</select> 
			</div>

			<label for="msg">Message :
				<span class="echo"><?php if (isset($msgmessage)) echo $msgmessage; else ""; ?></span>
			</label>
			<textarea id="msg" name="message" ></textarea>

			<button id="submit" type="submit" name="valider">Envoyer</button>

		</form>
	</div>
</body>
</html>