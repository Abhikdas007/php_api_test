<?php
class Product
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getAllProduct()
    {
        $sql = "SELECT * FROM product";
        $res = mysqli_query($this->conn, $sql);
        $product = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $product[] = $row;
            }
        }
        return $product;
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM product WHERE id=$id";
        $res = mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            return mysqli_fetch_assoc($res);
        }else{
            return array("No data Found");
        }
    }

    public function addProduct($data){
        $product_name = $data['product_name'];
        $product_price = $data['product_price'];
        $product_rating = $data['product_rating'];

        $sql = "INSERT INTO product (product_name,product_price,product_rating) VALUES ('$product_name', '$product_price', '$product_rating')";
        $res = mysqli_query($this->conn, $sql);
        if ($res) {
            return true;
        }else{
            return false;
        }

    }

    public function UpdateProduct($data, $id){
        $product_name = $data['product_name'];
        $product_price = $data['product_price'];
        $product_rating = $data['product_rating'];

        $sql = "UPDATE product SET product_name = '$product_name', product_price = '$product_price', product_rating = '$product_rating' WHERE id=$id";

        if (mysqli_query($this->conn, $sql)){
            return true;
        }else{
            return false;
        }
    }

    public function deleteProduct($id){
        $sql = "DELETE FROM product WHERE id=$id";
        if (mysqli_query($this->conn, $sql)){
            return true;
        }else{
            return false;
        }

    }
}
