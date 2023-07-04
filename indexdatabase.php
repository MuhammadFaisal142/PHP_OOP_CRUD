<?php
    include 'database.php';
    $obj=new Database();

    // $obj->insert('studenttable',['id'=>'9','name'=>'Ram Kumar','age'=>'20','email'=>'ramkumar34@gmail.com','phone'=>'947257929','subject'=>'bcomrece','marks'=>'78']);
    // echo "Insert Result is : ";
    // echo '<pre>';
    // print_r($obj->get_result());



    $obj->update('studenttable',['id'=>'6','name'=>'krishan Kumar','age'=>'22','email'=>'ramkumar34@gmail.com','phone'=>'9472534349','subject'=>'Cchanged','marks'=>'43'],'id="7"');
    echo "Update Result is : ";
    echo '<pre>';
    print_r($obj->get_result());


/*
    $obj->delete('studenttable','id="9"');
    echo "Delete Result is : ";
    echo '<pre>';
    print_r($obj->get_result());
*/

    // $obj->sql('SELECT * FROM studenttable');
    // echo "SQL  Result is : ";
    // echo '<pre>';
    // print_r($obj->get_result());


?>