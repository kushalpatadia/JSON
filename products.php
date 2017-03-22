<?php
$jsonInput = file_get_contents('php://input');

$conn = mysqli_connect("localhost", "root", "","ecommerce");

$outArr = array();

$query="SELECT * FROM tbl_products WHERE isActive='y'";

$result = mysqli_query($conn,$query);

$response["infos"] = array(); 
while($row = mysqli_fetch_array ($result))
{
     $info = array();

        $info["img"] = $row["imageName"];
        $info["title"] = $row["title"];
        $info["category"] = $row["category"];
        $info["subcategory"] = $row["subcategory"];
        $info["brand"] = $row["brand"];
        $info["price"] = $row["price"];
        $info["size"] = $row["size"];
        $info["color"] = $row["color"];
        $info["description"] = $row["shortDescription"];
        $info["specification"] = $row["specification"];
        $info["additionalinfo"] = $row["additionalinfo"];
    
    

//        $arr = array("e_img"=>$img ,"e_name"=>$name , "from_date"=>$fromdate , "to_date"=>$todate , "from_time"=>$fromtime , "to_time"=>$totime , "e_desc"=>$desc);
//        
        $outArr[] = $info;
 
}
$res=array("results"=>$outArr);
$json = json_encode($res);
header('Content-Type: application/json');
echo $json;
