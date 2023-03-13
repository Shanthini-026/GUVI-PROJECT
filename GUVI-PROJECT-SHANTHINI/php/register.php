<?php

$name = $_POST['name'];
$email  = $_POST['email'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$phno = $_POST['phno'];
$password = $_POST['password'];
$confirm_password= $_POST['confirm_password'];



require_once __DIR__ . 'C:\xampp\htdocs\GUVI-Project\assets\vendor\autoload.php';

// $con = new MongoDB\Client("mongodb://localhost:27017");

// $db = $con->guvi;
// $c = $db->collection;


$client = new MongoDB\Client(
  'mongodb+srv://shanthinisaro26:Shan@1826@cluster0.hq02xgx.mongodb.net/test?retryWrites=true&w=majority');

$db = $client->guvi;

$c = $db->guvi_db;



if (!empty($email) || !empty($password)  )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "guvi_db";



// Create connection
$conn = mysqli_connect ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else if($password != $confirm_password)
{
  echo "Password and Confirm-password are dismatched..!";
}
else if($password == $confirm_password){

  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT INTO register ( email ,password )VALUES('$email','$password')";
  $stmt=$conn->prepare("INSERT INTO 'register'('name','email','age','dob','phno','password','confirm_password')VALUES('$name','$email','$age','$dob','$phno','$password','$confirm_password')");
//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ss",$email,$password);
      $stmt->execute();


// sending information in Mangodb database
      $c->insertOne(["name" => $name,
                     "email" => $email,
                     "password" => $password,
                     "age" => $age, 
                     "dob" => $dob, 
                     "phno" => $phno]
                  );

      echo "<script> New record inserted sucessfully </script>";

     }
    else 
    {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close(); 
    }
}
else 
{
 echo "All field are required";
 die();
}

?>