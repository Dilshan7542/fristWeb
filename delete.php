<?php session_start();?>


<?php include_once('inc/connection.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $id = "";
    $id = $_POST['d_id'];

    $query = "DELETE FROM routes WHERE route_no='{$id}' LIMIT 1 ";
    "INSERT INTO routes(route_no)  VALUES ('{$id}')";


    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_affected_rows($connection)) {
            header('location:admin_edit.php');
        }
    } else {
        echo "DELETE faild";
    }
}

/* Delete all Order list */
if (isset($_POST['submit_1'])) {

    $id_1 = "";


    $query_1 = "DELETE FROM schedul ";



    $result_1 = mysqli_query($connection, $query_1);

    if ($result_1) {
        if (mysqli_affected_rows($connection)) {
            header('location:admin_edit.php?all_clear=yes');
        }
    } else {
        echo "DELETE faild";
    }
}

if (isset($_POST['submit_2'])) {

    $id_2 = "";
    $id_2 = $_POST['id_2'];

    $query_2 = "DELETE FROM customers WHERE id='{$id_2}' LIMIT 1 ";
    "INSERT INTO customers(id)  VALUES ('{$id_2}')";


    $result_2 = mysqli_query($connection, $query_2);

    if ($result_2) {
        if (mysqli_affected_rows($connection)) {
            header('location:customers.php');
        }
    } else {
        echo "DELETE faild";
    }
}



if (isset($_POST['close'])) {

    $id_7 = "";
    $id_7 = $_POST['id'];

    $query_7 = "DELETE FROM booking WHERE id='{$id_7}' LIMIT 1 ";
    "INSERT INTO booking(id)  VALUES ('{$id_7}')";


    $_result_7 = mysqli_query($connection, $query_7);

    if ($_result_7) {
        if (mysqli_affected_rows($connection)) {
            header('location:admin_edit.php');
        }
    } else {
        echo "DELETE faild";
    }
}

?>
