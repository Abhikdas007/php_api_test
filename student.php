<?php 
class student{
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getAllStudentData(){
        $sql_get_student = "SELECT * FROM students";
        $result = mysqli_query($this->conn, $sql_get_student); 
        if(!$result){
            return false;
        }
        $students = [];
        while ($row = mysqli_fetch_assoc($result)){
            $students [] = $row;
        }

        return $students;
    }

    public function getStudentwithId($id){
        $sql_get_student_with_id = "SELECT * FROM students WHERE id = $id";
        $result = mysqli_query($this->conn, $sql_get_student_with_id);
        $res_arry = mysqli_fetch_assoc($result);
        return $res_arry;
    }

    public function insert_student_data($data){
        $name  = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $sql = "INSERT INTO students (name, email, phone) VALUES('$name', '$email', '$phone')";
        $res = mysqli_query($this->conn, $sql);
        if($res){
            return true;
        }else{
            return false;
        }

    }


    public function update_student_data($data, $id){
        $name  = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $sql = "UPDATE students SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";

        // return $sql;
        $res = mysqli_query($this->conn, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function delete_student($id){
        $sql = "DELETE FROM students WHERE id = $id";
        // return $sql;
        $res = mysqli_query($this->conn, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}

?>