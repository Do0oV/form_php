<!DOCTYPE html>
<html>
<head>
	<title>Show DB</title>
	<style>
		td, th{
			border:1px solid black;
		}
		
	</style>
</head>
<body>
	<?php include 'conndb.php'; 

	$reponse = $db->query('SELECT * FROM messages');
	echo '<table>
	<tr>
	<th>Nom</th>
	<th>Email</th>
	<th>Contact</th>
	<th>Checkbox</th>
	<th>Select</th>
	<th>Message</th>
	<th>Delete</th>

	</tr>
	';
	while ($donnees = $reponse->fetch())
	{
		echo '<tr>
		<td>'.$donnees['nom'].'</td>
		<td>'.$donnees['email'].'</td>
		<td>'.$donnees['radio'].'</td>
		<td>'.$donnees['interet'].'</td>
		<td>'.$donnees['list'].'</td>
		<td>'.$donnees['message'].'</td>
		<td><button id="submit" type="submit" name="delete">Delete</button></td>
		</tr>
		';
	}
	$reponse->closeCursor();
	echo "  
	</table>";
	?>


<button id="submit" type="submit" name="delete">Delete</button>




</body>
</html>