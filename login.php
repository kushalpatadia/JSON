<?php
$con = mysqli_connect("localhost", "id1140919_root", "roottoor");
mysqli_select_db($con,"id1140919_ecommerce");
$jsonInput = file_get_contents('php://input');

$jsonArray = json_decode($jsonInput,true);
$email=$_GET['email'];
$password = $_GET['password'];
$jsonArray["email"]= $email;
$jsonArray["password"]= $password;
$un= $jsonArray["email"];
$pwd = $jsonArray["password"];


$query="SELECT * FROM tbl_users WHERE email='$un' AND password='$pwd'";

$res = mysqli_query($con,$query);
$msg = "";
$var = "";
$status = false;
$check = mysqli_num_rows($res);
if ($check != 0) {
	while($row= mysqli_fetch_array($res))
	{
	    $var=$row['username'];
	    $msg='Success';
            $status= true;
	}
	$jsonOPArray=array('message'=>$msg,'status'=>$status);
}
else
{
	$msg ='Invalid Login';
        $status= false ;
	$jsonOPArray=array('message'=>$msg,'status'=>$status);
}


$jsonOutput = json_encode($jsonOPArray);
header('Content-Type: application/json');
echo $jsonOutput;