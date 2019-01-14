<?php


$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "hackingchallenge";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
    echo "Connexion non établie.";
    exit;
}

    echo mysqli_query($mysqli,"CREATE TABLE IF NOT EXISTS `".$BDD['db']."`.`membres` ( `id` INT NOT NULL AUTO_INCREMENT , `pseudo` VARCHAR(25) NOT NULL , `mdp` CHAR(32) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;")?"Table membres créée avec succès, vous pouvez maintenant supprimer la ligne ". __LINE__ ." de votre fichier ". __FILE__ ."!":"Erreur création table membres: ".mysqli_error($mysqli);

$AfficherFormulaire=1;
if(isset($_POST['pseudo'],$_POST['mdp'])){
    if(empty($_POST['pseudo'] )){
        echo "Le champ Pseudo est vide.";
    } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['pseudo'])){
        echo "Le Pseudo doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    } elseif(strlen($_POST['pseudo'])>25){
        echo "Le pseudo est trop long, il dépasse 25 caractères.";
    } elseif(empty($_POST['mdp'])){
        echo "Le champ Mot de passe est vide.";
    } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM membres WHERE pseudo='".$_POST['pseudo']."'"))==1){
        echo "Ce pseudo est déjà utilisé.";
    } else {
       
        if(!mysqli_query($mysqli,"INSERT INTO membres (pseudo, mdp) VALUES ('".$_POST['pseudo']."','".$_POST['mdp']."')  pseudo='".$_POST['pseudo']."'")){
            echo "Une erreur s'est produite: ".mysqli_error($mysqli);
        } else {
            echo "Vous êtes inscrit avec succès!";
            $AfficherFormulaire=0;
        }
    }
}


?>