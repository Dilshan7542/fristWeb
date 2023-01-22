<?php 

//$connection = mysqli_connect(dbserver,dbuser,dbpwd,dbname);

$connection = mysqli_connect('localhost','root','','bus_emp');

//mysqli_conncet_errno(); mysqli_connect_error();

//cheacking the connection

if(mysqli_connect_errno()){
    die('Database connection failed' . mysqli_connect_error());

}
else{
    //echo"connection successful";
}


?>