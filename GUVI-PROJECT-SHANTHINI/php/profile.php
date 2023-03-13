<?php
session_start();
$email= $_SESSION['email'];

require_once __DIR__ . '\assets\vendor\autoload.php';
require_once __DIR__ . 'C:\xampp2\htdocs\GUVI-PROJECT-SHANTHINI\assets\vendor\autoload.php';

$client = new MongoDB\Client(
   'mongodb+srv://shanthinisaro26:Shan@1826@cluster0.hq02xgx.mongodb.net/test?retryWrites=true&w=majority');
 
 $db = $client->guvi;
 
 
 $c = $db->guvi_db;

 $con = new MongoDB\Client("mongodb+srv://shanthinisaro26:Shan@1826@cluster0.hq02xgx.mongodb.net/test");

 $db = $con->guvi;
 $c = $db->collection;

 echo $email;

$cursor = $c->find();

// for selected user information getting
 foreach ($cursor as $document) {
    if($email == $document["email"])
    {

      echo '
      <tr><th>'. $document["Name"] .'</td><td>'.$document["email"].'</td><td>'.$document["Age"].'</td><td>'.$document["DOB"].'</td> <td>'.$document["Phone_number"].'</td></tr>
   ';
    }


 }
 ?>



 