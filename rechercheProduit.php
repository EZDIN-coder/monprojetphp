<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Résultat recherche Produit</title>
  </head>
  
  <body>

  <header></header>
  <h1>La liste des produits</h1>
  <hr>
  <form method = "post" action="rechercheProduit.php">
   <fieldset>
       <legend>Liste des produits</legend>
       <label>Saisissez un nom du produit</label>
       <input type="text" name="Product">

       <input type="submit" value="Rechercher">

   </fieldset>
</form>

  <?php
//Inclusion des paramètres de connexion
$idcom = mysqli_connect('127.0.0.1', 'root', 'root','wrpracti_northwind'); 
if (!$idcom) 
{
echo "Connexion impossible à la base";
exit(); 
}
?>

<?php

   if(!empty($_POST['Product'])) {
   
      $produit = $idcom->escape_string($_POST['Product']);

$requete = "SELECT ProductID,ProductName,UnitPrice
 FROM products 
 WHERE ProductName LIKE '$produit%' ORDER BY ProductID ";
echo "requete" .$requete ;
$result = $idcom->query($requete);
$res=$result->num_rows;
echo "res" .$res;
if ($result->num_rows > 0) {


   echo('<table border="1">
    <colgroup width =150 span=12></colgroup>
	<thead> <!-- En-tête du tableau -->
   <tr>
       <th>ProductID</th>
       <th>nom Produit</th>
       <th>Prix unitaire</th>
       <th>Actions</th>
       </tr>
    </thead>
    <tbody> <!-- Corps du tableau --> ');
    //print_r($result->fetch_array());
    while($donnees = $result->fetch_assoc()) {
        echo ('<tr>');
       echo ('<td>'.$donnees['ProductID'].'</td>');
       echo ('<td>'.$donnees['ProductName'].'</td>');
       echo ('<td>'.$donnees['UnitPrice'].'</td>');
       echo ('<td><a href="modifPrix.php" target="_blank">Modifier</a></td>');
       echo('</tr>');
   }
       echo('<tbody>');
       echo('</table>');
      } else {
        echo "0 results";
    }
$idcom->close(); 
}
else {
    //echo "Veuillez remplir la formulaire";
    echo "<script language=\"javascript\">";
    echo "alert('Veuillez remplir la formulaire')";
    echo"</script>";
}
  ?>
  
  </body>
</html>