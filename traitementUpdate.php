<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Modification du Prix</title>
    <link rel="stylesheet" href=styles.css>
</head>

<body>
<h1>Modification du prix</h1>
<br>
<?php
//Créer la base de données
$idcom = mysqli_connect('127.0.0.1', 'root', 'root','wrpracti_northwind');


//Test si la connexion est valide
if (!$idcom) {
    echo "Connexion impossible";
    exit();
} 

 //echo 'UnitPrice' .$_POST['UnitPrice'];

if(!empty($_POST['UnitPrice'])) {

    $identifiant = $_POST['productID'];
    $prix = $idcom->escape_string($_POST['UnitPrice']);

    //Ecrire la requete pour modifier les données d'un utilisateur
    $requete = "UPDATE products SET
    UnitPrice = '$prix' 
     WHERE ProductID = '$identifiant'";

    //Envoyer la requete
    $result = $idcom->query($requete);

    //Vérifier que la requete est bien éxécutée
    if ($result) {
      echo "Les données ont bien été modifiées";
    } else {
        echo "Erreur " . $idcom->error;
    }

    //Fermer la connexion au serveur
    $idcom->close();

}
else {echo "Veuillez remplir correctement le formulaire ";}

?>

</body>
</html>