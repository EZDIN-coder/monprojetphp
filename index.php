<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Mon app web</title>
    <link rel="stylesheet" href=styles.css>
</head>

<body>
<header></header>
<h1> Les 4 fantastiques</h1>
<fieldset id="main">
    <legend>Notre formulaire :</legend>
    <form action="index.php" method="post">
        <label>Nom de l'employé</label>
        <input type="text" name="nom" value=""><br><br>
        <label>Produit:</label>
        <input type="text" name="produit" value=""><br><br>        
        <br>
        <label>Lieu</label>
        <input type="text" name="lieu" value=""><br><br>
        <br>

        <label>Commande :</label>
        <br>
        <label>Date de debut</label>
        <input type="date" name="dated"><br><br>
        <label>Date de fin</label>
        <input type="date" name="datef"><br><br>

        <input type="submit" name="valider" value=" Envoyer "> 
        <input type="reset" value="Annuler">
    </form>
</fieldset>
<br>



<?php
$idcom = mysqli_connect('127.0.0.1', 'root', 'root','wrpracti_northwind');
if (!$idcom) {
    echo "Connexion impossible";
    exit();
} 
if(!empty($_POST['nom']) 
         && empty($_POST['produit']) 
         && empty($_POST['lieu'])
         && empty($_POST['dated']) 
         && empty($_POST['datef']) 
         ){
        $nom = $idcom->escape_string($_POST['nom']);
     
        $requete = "SELECT orders.OrderID,employees.FirstName ,employees.LastName,customers.CompanyName 
        FROM orders ,customers,employees WHERE orders.EmployeeID= employees.EmployeeID 
        and orders.CustomerID=customers.CustomerID
        and employees.firstName='$nom'";
        
        $result = $idcom->query($requete);
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
         }
 
 // Recherche par nom du produit    
  if(empty($_POST['nom']) 
        && !empty($_POST['produit']) 
        && empty($_POST['lieu'])
        && empty($_POST['dated']) 
        && empty($_POST['datef']) 
        ){
            $produit = $idcom->escape_string($_POST['produit']);

            $requete = "SELECT ProductID,ProductName,UnitPrice
             FROM products 
             WHERE ProductName LIKE '$produit%' ORDER BY ProductID ";
           // echo "requete" .$requete ;
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
                   echo ('<td><a href="modifPrix.php?productId='.$donnees['ProductID'].'"  target="_blank">Modifier</a></td>');
                   echo('</tr>');
               }
                   echo('<tbody>');
                   echo('</table>');
                  } else {
                    echo "0 results";
                }
           
      
        }
       
        if(empty($_POST['nom']) 
         && empty($_POST['produit']) 
         && !empty($_POST['lieu'])
         && empty($_POST['dated']) 
         && empty($_POST['datef']) 
         ){
       // $nom = $idcom->escape_string($_POST['nom']);
       
        $lieu = $idcom->escape_string($_POST['lieu']);
  
       // $requete = "SELECT Orders.EmployeeID, Customers.CompanyName, Customers.ContactName
        //FROM Orders
        //INNER JOIN Customers
        //ON Orders.CustomerID = Customers.CustomerID
        //WHERE Orders.ShipCity = '$lieu' AND Orders.EmployeeID = '$nom' ORDER BY  Customers.CompanyName ASC";
        $requete ="SELECT orders.OrderID,employees.FirstName,employees.LastName,customers.CompanyName 
        FROM orders ,customers,employees 
        WHERE orders.EmployeeID= employees.EmployeeID 
        and   orders.CustomerID=customers.CustomerID 
        and   orders.ShipCity='$lieu' order by customers.CompanyName ASC ";
        //echo  "requete" .$requete ;
       $result = $idcom->query($requete);
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
        while( $reponse1 = $result->fetch_assoc()){       
            echo ('<tr>');
            echo ('<td>'.$reponse1 ['OrderID'].'</td>');
            echo ('<td>'.$reponse1 ['FirstName'].'</td>');
            echo ('<td>'.$reponse1 ['LastName'].'</td>');
            echo ('<td>'.$reponse1['CompanyName'].'</td>');
            echo('</tr>');
        //echo  $reponse1 [0]." ".$reponse1 [1]." ".$reponse1 [2]."".$reponse1[3] ;
        }
        echo('<tbody>');
                   echo('</table>');
         }

        if(empty($_POST['nom']) 
         && empty($_POST['produit']) 
         && empty($_POST['lieu'])
         && !empty($_POST['dated']) 
         && !empty($_POST['datef']) 
         ){
      
        $dated = ($_POST['dated']);
        $datef = ($_POST['datef']);



        $requete = "SELECT Orders.OrderID, Products.ProductID, Products.ProductName, Orders.OrderDate, Orders.ShipAddress 
        FROM Orders 
        INNER JOIN Products 
        WHERE Orders.OrderDate 
        BETWEEN '$dated' AND '$datef' ";
        //echo "requete" .$requete ;
        $result = $idcom->query($requete);
        while( $reponse1 = $result->fetch_row()){

       
     echo "<br/>";
     echo  $reponse1 [0]." ".$reponse1 [1]." ".$reponse1 [2] ;
}
         }

  
      

    
 
        $idcom->close();


?>

<footer> Formulaire fait par les 4 EZMIABAN </footer>
</body>
</html>