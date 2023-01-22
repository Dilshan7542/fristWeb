<?php include_once('inc/connection.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $id = "";
    $fname = "";
    $lname = "";
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $update = "UPDATED <hr>";

    $query = "UPDATE user SET first_name='{$fname}',last_name='{$lname}'  WHERE ID='{$id}' LIMIT 1 ";
    "INSERT INTO user(ID,first_name,last_name)  VALUES ('{$id}','{$fname}','{$lname}')";


    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_affected_rows($connection)){
            header('location:test_update.php');
        }
    } else {
        echo "UPDATE faild";
    }
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        ul li a.nav-link:hover {
            color: pink;
        }
    </style>
</head>

<body class="container">
    <div class="container">
        <a href="http://localhost/myphp/ums/index.php" class="btn btn-success">Back</a>
        <form action="test_Update.php" method="POST">

            <label for="fname" class="from-label">Frist Name:</label>
            <input type="fname" name="fname" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>

            <label for="lname" class="from-label">Last Name:</label>
            <input type="lname" name="lname" value="" class="form-control w-25" placeholder="Last Name" id="lname" required>

            <label for="password">ID:</label>
            <input type="fname" name="id" value="" id="pwd" class="form-control w-25" placeholder="Password " required>

            <input type="submit" name="submit" class="btn btn-primary mt-3">
            <input type="reset" class="btn btn-primary mt-3">

    </div>



    </form>

</body>

</html>