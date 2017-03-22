<?php
$jsonInput = file_get_contents('php://input');

$jsonArray = json_decode($jsonInput,true);
$username=$_GET['username'];
$email = $_GET['email'];
$password=$_GET['password'];
$mobileno = $_GET['mobileno'];
$jsonArray["username"]= $username;
$jsonArray["password"]= $password;
$jsonArray["email"]= $email;
$jsonArray["mobileno"]= $mobileno;
$fn = $jsonArray["username"];
$em= $jsonArray["email"];
$pwd = $jsonArray["password"];
$mob= $jsonArray["mobileno"];

$conn=mysqli_connect("localhost", "id1140919_root", "roottoor","id1140919_ecommerce");
$select = mysqli_query($conn, "SELECT email FROM tbl_users WHERE email='$em'");
$check = mysqli_num_rows($select);

$msg = "Something Wrong Happend";
$status=false;

if($check == 1){
  $msg = 'Already Registered Email Address';
  $status=false;
}
else{
$query ="INSERT INTO `tbl_users`(`username`,`email`, `password`, `mobileno`) VALUES ('$fn','$em','$pwd','$mob')";


if(!empty($fn) && !empty($em) && !empty($pwd) && !empty($mob)){ 
$res = mysqli_query($conn,$query);
if($res > 0)
{
    $msg = 'Register Successfully';
    $status=true;
}
else
{
    $msg = 'Not Register';
    $status=false;
}
}
else
{
    $msg = 'All fields are required';
    $status=false;
}
}
$jsonOPArray = array('message'=>$msg,'status'=>$status);

$jsonOutput = json_encode($jsonOPArray);
header('Content-Type: application/json');
echo $jsonOutput;