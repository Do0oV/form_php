
<?php
try{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$db = new PDO('mysql:host=localhost;dbname=form_db;charset=utf8', 'user', 'mdp',$pdo_options);
}
catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}
?>