<?php

$db_host     = "localhost";
$db_username = "username";
$db_password = "password";

$conn = mysqli_connect("localhost", "root", "", "gre");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
}

$sql = "select * from gre_word";
$result = mysqli_query($conn,$sql);
$chk = [1,2,3,4,5,6,7,8,9];
while($r = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
    if(true)
    {
    $name[]=$r;
    }
}
shuffle($name);
// print_r($name);
echo json_encode($name);

