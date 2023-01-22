<?php require_once('inc/connection.php'); ?>
<?php


/*INSERT INTO table_name (column1,column2,etc)
VALUES (value1,value2,etc) */





$query = "SELECT ID,first_name,last_name,email,gender FROM user";

$result = mysqli_query($connection, $query);

$table = "<table>";
$table .= "<tr>";
$table .= "<th>ID </th> <th>First Name </th> <th>Last Name </th> <th>Email </th><th>Gender </th></tr>";

if ($result) {
    echo mysqli_num_rows($result) . "Record <hr>";
    while ($record = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>" . $record['ID'] . "</td>";
        $table .= "<td>" . $record['first_name'] . "</td>";
        $table .= "<td>" . $record['last_name'] . "</td>";
        $table .= "<td>" . $record['email'] . "</td>";
        $table .= "<td>" . $record['gender'] . "</td>";
    }
}
$table .= "</tr>";
$table .= "</table>";


?>
<?php require_once('inc/connection.php'); ?>
<?php


/*INSERT INTO table_name (column1,column2,etc)
VALUES (value1,value2,etc) */





$query = "SELECT ID,fname,lname,email,gender FROM customers";

$result = mysqli_query($connection, $query);

$table = "<table>";
$table .= "<tr>";
$table .= "<th>ID </th> <th>First Name </th> <th>Last Name </th> <th>Email </th><th>Gender </th></tr>";

if ($result) {
    echo mysqli_num_rows($result) . "Record <hr>";
    while ($record = mysqli_fetch_assoc($result)) {
        $table .= "<tr>";
        $table .= "<td>" . $record['ID'] . "</td>";
        $table .= "<td>" . $record['fname'] . "</td>";
        $table .= "<td>" . $record['lname'] . "</td>";
        $table .= "<td>" . $record['email'] . "</td>";
        $table .= "<td>" . $record['gender'] . "</td>";
    }
}
$table .= "</tr>";
$table .= "</table>";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>output</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 2px solid black;
            padding: 10px;
            font-size: 2rem;
        }

        a {

            float: right;
        }

        .btn-danger {
            margin-left: 2rem;
        }

        .btn-primary {
            margin-left: 2rem;
        }
    </style>
</head>

<body style="background-color: lightblue;">
    <div class="container mt-5">
        <a href="http://localhost/myphp/Project%20New/form_user.php" target="_blank" class="btn btn-primary">Register</a>
        <a href="http://localhost/myphp/Project%20New/Test_Delete.php" target="_blank" class="btn btn-danger " data-bs-toggle="modal" data-bs-target=#remove>Delete</a>
        <a href="http://localhost/myphp/Project%20New/test_Update.php" target="_blank" class="btn btn-success ">Update</a>
        <?php echo $table; ?>
    </div>
    </div>

    <!-- REMOVE MODAL -->
    <div class="modal fade" id="remove">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete</h3>
                    <button class="btn-close" data-bs-dismiss='modal'></button>
                </div>
                <div class="modal-body">

                    <form action="delete.php" method="POST">

                        <label for="id_2">ID</label>
                        <input type="text" name="id_2" placeholder="Enter Id">
                        <button class="btn btn-primary mt-3" type="submit" name="submit_2">Submit</button>

                    </form>


                </div> <!-- modal-body-end -->
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
    <!--REMOVE MODAL END -->
</body>

</html>

<?php mysqli_close($connection); ?>