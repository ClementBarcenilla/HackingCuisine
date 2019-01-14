<?php

$mysqli = new mysqli("localhost","root","","hackingchallenge");

if ($mysqli ->connect_errno) {
    echo "Echec lors de la connexion à MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->query("

    CREATE TABLE IF NOT EXISTS user (
    id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(15) NOT NULL,
    password VARCHAR(15) NOT NULL);

        ");
    if(isset($_POST['identifiant']) && isset($_POST['password']) && $_POST['password'] != ''){

        $identifiant = $_POST['identifiant'];
        $mdp = $_POST['password'];

			//	var_dump($_POST);
        $res = $mysqli->query("SELECT password from user where pseudo = '".$identifiant."' ");


    if($res != false ){
		//		var_dump($res);

        $res = $res->fetch_assoc();
        if($res['password'] == $mdp){
            require('connection.html');
        }
		elseif ($mdp == ''){
			echo "<h2 style='color:red; '>Mot de passe vide</h2>";
			require('index.html');

		}

    else{
        echo "<h2 style='color:red; '>Couple pseudo/mdp incorrect</h2>";
        require('index.html');
        }

    }

    else{
        echo "<h2 style='color: red';>Ce pseudo n'existe pas</h2>";
        require('index.html');
    }

}
else{
	echo 'petit fou tu essais de m injecter hehehe';
}
?>
