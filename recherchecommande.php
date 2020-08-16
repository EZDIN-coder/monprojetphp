<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>LISTE DES COMMANDES</title>
  </head>
  
  <body>

  <header></header>
  <h1>La liste des commandes</h1>
  <hr>
  <form method ="post" action="recherchecommande.php">
   <fieldset>
       <legend>LISTE DES COMMANDES</legend>
       <label>Saisissez le numero de la commande</label>
       <input type="text" name="commande">
       
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

   if(!empty($_POST['commande'])) {
   
$OrderID = $_POST['commande'];

$requete = "SELECT orders.OrderID,employees.FirstName ,employees.LastName,customers.CompanyName FROM orders ,customers,employees WHERE orders.EmployeeID= employees.EmployeeID and orders.CustomerID=customers.CustomerID and orders.OrderID=$OrderID ";
 echo "requete" .$requete ; 
$result = $idcom->query($requete);
$res=$result->num_rows;
echo "res" .$res;
if ($result->num_rows > 0) {

   echo('<table border="1">
    <colgroup width =150 span=12></colgroup>
	<thead> <!-- En-tête du tableau -->
    <tr>
       <th>OrderID</th>
       <th>FirstName</th>
       <th>LastName</th>
       <th>CompanyName</th>
       </tr>
     </thead>
    <tbody> <!-- Corps du tableau --> ');
    //print_r($result->fetch_array());
    while($donnees = $result->fetch_assoc()) {
       //$donnees = $result->fetch_assoc();
       echo ('<tr>');
       echo ('<td>'.$donnees['OrderID'].'</td>');
       echo ('<td>'.$donnees['FirstName'].'</td>');
       echo ('<td>'.$donnees['LastName'].'</td>');
       echo ('<td>'.$donnees['CompanyName'].'</td>');
       //echo ('<td><a href="modifPrix.php" target="_blank">Modifier</a></td>');
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