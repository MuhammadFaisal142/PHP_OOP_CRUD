<?php
$servername="localhost";
$username="root";
$password="";
$dbname="students";

$conn=new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection Failed: " . $conn->connect_error);
    }
    $sql="SELECT * FROM studenttable";
    $result=$conn->query($sql);
    if($result->num_rows > 0){
        while($row= $result->fetch_assoc()){
             echo "ID : {$row['id']} - NAME : {$row['name']} - AGE : {$row['age']} - Email : {$row['email']} - Phone : {$row['phone']} - courseName : {$row['subject']} - Marks : {$row['marks']} <br>    ";
        }

    }else{
        echo "No result Founds";
    }
    $conn->close();
?>