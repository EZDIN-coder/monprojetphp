<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Rechercher et modifier</title>
    <link rel="stylesheet" href=styles.css>
</head>

<body>
<header></header>

<?php


echo "productId" .$_GET['productId'];
//Créer la base de données
$idcom = mysqli_connect('127.0.0.1', 'root', 'root','wrpracti_northwind');
if (!$idcom) 
{
echo "Connexion impossible à la base";
exit(); 
}

if(!empty($_GET['productId'])){
    
    $product = $idcom->escape_string($_GET['productId']);

    $requete = "SELECT ProductID,ProductName,UnitPrice FROM products WHERE productID = $product ";

    $result = $idcom->query($requete);
     
    $coord = $result->fetch_row(); //fetch_row - Récupère une ligne de résultat sous forme de tableau indexé

    echo "<h1> Modification du prix</h1>";
    echo "<fieldset id=\"main\">";
    echo " <legend>Modification du formulaire :</legend>";
    echo "<form action=\"traitementUpdate.php\" method=\"post\">";
    ?>
       <label>productID:</label>
    <?php
    echo "<input type=\"numeric\" name=\"productID\" readonly =\"true\" value=\"$coord[0]\">";
    ?>
    <br><br>
    <label>Name</label>
        <?php
         echo "<input type=\"text\" name=\"ProductName\" value=\"$coord[1]\">";
         ?>
    <br><br>
    <label>Prix</label>
        <?php
         echo "<input type=\"text\" name=\"UnitPrice\" value=\"$coord[2]\">";
         ?>     
    <br><br>
        <input type="submit" name="valider" value=" Modifier "> &nbsp&nbsp&nbsp
        <input type="reset" value="Annuler">
      
      </fieldset>
    </form>
    
    <?php 
}
else {echo "Veuillez saisir l'identifiant du produit ";}
?>

</body>
</html>