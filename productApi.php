<?php 
require "config.php";
require "product.php";

$productObj = new Product($conn);
$method = $_SERVER['REQUEST_METHOD'];
$endPoint = $_SERVER['PATH_INFO'];

header('Content-Type: application/json');

//execute 

switch ($method) {
    case 'GET':
        if($endPoint === "/getProduct"){
            if($_GET['id']){
                $id = $_GET['id'];
                $respone = $productObj->getProductById($id);
                echo json_encode(['data'=> $respone]);
            }else{
                $respone = $productObj->getAllProduct();
                echo json_encode(['data'=> $respone]);
            }
        }
        break;
    case "POST":
        if($endPoint === "/addProduct"){
            $data = json_decode(file_get_contents('php://input'), true);
            $respone = $productObj->addProduct($data);
            echo json_encode(["status"=>$respone]);
        }
        break;

    case "PUT":
        if($endPoint === "/updateProduct"){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $_GET['id'];
            $response = $productObj->UpdateProduct($data, $id);
            echo json_encode(["status"=> $response]);
        }
        
        break;
    case "DELETE":
        if($endPoint === "/deleteProduct"){
            $id = $_GET['id'];
            $response = $productObj->deleteProduct($id);
            echo json_encode(["status"=>$response]);
        }
        break;
    
    default:
        echo json_encode(["error"=>"Error"]);
        break;
}