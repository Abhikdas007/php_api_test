<?php
require "config.php";
require "student.php";

$studentObj = new student($conn);

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['PATH_INFO'];

// echo $endpoint; die();

header('Content-Type: application/json');

// execution 

switch ($method) {
    case 'GET':
        if ($endpoint === "/showstudent") {
            if (isset($_GET['id'])) {
                $employ_id = $_GET['id'];
                $response = $studentObj->getStudentwithId($employ_id);
                echo json_encode($response);
            } else {
                $response = $studentObj->getAllStudentData();
                echo json_encode($response);
            }
        }
        break;
    case 'POST': 
        if ($endpoint === "/addstudent") {
            $data = json_decode(file_get_contents('php://input'), true);
            $response = $studentObj -> insert_student_data($data);
            echo json_encode($response);
        }
        break;
    case 'PUT':
        if ($endpoint === "/updatestudent") {
            if(isset($_GET['id'])){
                $employ_id = $_GET['id'];
                $data = json_decode(file_get_contents('php://input'), true);
                $response = $studentObj -> update_student_data($data, $employ_id);
                echo json_encode($response);
            }
        }
        break;

    case 'DELETE': 
        if ($endpoint === "/deletestudent") {
            // echo "hi"; die();
            if (isset($_GET['id'])){
                $employ_id = $_GET['id'];
                $response = $studentObj->delete_student($employ_id);
                echo json_encode(['result'=>$response]);
            }
        }
        break;
}
