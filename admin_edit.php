<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>


<?php


if (!isset($_SESSION['fname_5'])) {

    header('location:administrator.php?notmach=yes');
}






$query = "SELECT route_no,City,city_to FROM routes";

$result = mysqli_query($connection, $query);

$table = "<table class='table table-hover  bg-light table-sm'>";
$table .= "<tr class='table-primary  h5' >";
$table .= "<th>City No </th>  <th>City</th> <th>Arrivel </th> <th>Remove </th></tr>";

if ($result) {
    mysqli_num_rows($result);
    while ($record = mysqli_fetch_assoc($result)) {
        $table .= "<form action='delete.php' method='POST'>";
        $table .= "<tr class='h6'>";
        $table .= "<td style='font-family:Cursive;width:150px;'>" . $record['route_no'] . "</td>";
        $table .= "<td style='display:none;'>" . "<input type='text' value='{$record['route_no']}' name='d_id'>" . "</td>";
        $table .= "<td style='font-family:Cursive'>" . $record['City'] . "</td>";
        $table .= "<td style='font-family:Cursive'>" . $record['city_to'] . "</td>";
        $table .= "<td style='font-family:Cursive' >" . "<input type='submit' class='btn btn-outline-danger' name='submit' value='remove' >" . "</td>" ;
        $table .= "</tr>";
        $table .=  "</form>";
    }
}

$table .= "<tr title='add new routes'><th style='float=left;'> <button class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#insert' title='add new routes'> + </button> </th> <th></th> <th></th> <th></th>      </tr>";
$table .= "</table>";






?>

<?php if (isset($_POST['submit'])) {

    $id = "";
    $city = "";
    $arrivel = "";
    $id = $_POST['id'];
    $city = $_POST['city'];
    $arrivel = $_POST['city_to'];
    $update = "UPDATED
                    <hr>";


    $query_update = "UPDATE routes SET city='{$city}',city_to='{$arrivel}' WHERE route_no='{$id}' LIMIT 1 ";
    "INSERT INTO routes(city_no,city,city_to) VALUES ('{$id}','{$city}','{$arrivel}')";


    $result_update = mysqli_query($connection, $query_update);

    if ($result_update) {
        if (mysqli_affected_rows($connection)) {
            header('location:admin_edit.php');
        }
    } else {
        echo "UPDATE faild";
    }
}

?>

<!-- DELETE -->

<?php

/* ORDERS */
$query_order = "SELECT customers.email,customers.fname,customers.lname,schedul.city,schedul.city_to,customers.phone,schedul.Date
FROM customers 
INNER JOIN schedul
ON customers.email=schedul.email";


$result_order = mysqli_query($connection, $query_order);



$table_3 = "<table class='table table-hover  bg-light'>";
$table_3 .= "<tr class='table-primary h4'>";
$table_3 .= " <th>Email </th> <th>Name </th><th>Last Name </th><th>City No </th>  <th>City</th><th>Phone</th> <th>Date</th></tr>";

if ($result_order) {
    mysqli_num_rows($result_order);
    while ($record = mysqli_fetch_assoc($result_order)) {
        $table_3 .= "<tr claass='h5'>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['email'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['fname'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['lname'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['city'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['city_to'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['phone'] . "</td>";
        $table_3 .= "<td style='font-family:Cursive'>" . $record['Date'] . "</td>";
    }
}










$table_3 .= "</tr>";
$table_3 .= "</table>";



?>

<?php

$query_list = "SELECT City,city_to FROM routes";
$result_list = mysqli_query($connection, $query_list);
$select_list = '<select name="city" class="city" required>';
$city_to_list = '<select name="city_to" class="city_to" required>';



if ($result_list) {
    mysqli_num_rows($result_list);
    while ($record_list = mysqli_fetch_assoc($result_list)) {



        $select_list .=       "<option name='city'  id='city' class='city1'>" . $record_list['City'] . '</option>';
        $city_to_list .=       "<option name='city_to'  id='city_to'>" . $record_list['city_to'] . '</option>';
    }
}
$select_list .= '</select>';
$city_to_list .= '</select>';




?>

<?php

if (isset($_POST['insert'])) {
    $city = "";
    $city_to = "";

    $city = input_verify($_POST['city']);
    $city_to = input_verify($_POST['city_to']);

    $query_insert = "INSERT INTO routes(city,city_to) VALUES ('{$city}','{$city_to}')";

    $result_insert = mysqli_query($connection, $query_insert);
    if ($result_insert) {
        header('location:admin_edit.php?insert_done=yes');
    }
}

function input_verify($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }








        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;
        }

        nav a.navbar-brand {
            margin-left: 2em;
        }

        ul li a.nav-link {
            color: #FFF8DC;
        }

        span#greeting {
            color: #FF7F50;
            margin-top: 30px;
        }

        a.nav-link:hover {
            color: #FF1493;
        }

        option {
            width: 300px;
        }
    </style>
</head>

<body style="background-image:url(img/6.jpg);background-size: 100% ;">
    <div class="container">
        <!-- navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="border-bottom: solid #FFFAF0;">
            <a href="" class="navbar-brand"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /><a href="" class="nav-link h3" data-bs-toggle='modal' data-bs-target='#profile_2'> <?php echo $_SESSION['fname_5']; ?></a><span id="greeting"></span></a>
            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">

                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle="modal" data-bs-target="#insert">Insert</a>
                    </li>

                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-target="#remove" data-bs-toggle="modal">Remove</a>
                    </li>

                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-target="#edit" data-bs-toggle="modal">Edit</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle="modal" data-bs-target="#order">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle='offcanvas' data-bs-target='#to_do_list'>Booking</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link h5">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="admin_logout.php" class="nav-link h5">Log out</a>
                    </li>


                </ul>


            </div>


        </nav> <!-- navbar-end -->
        <?php if (isset($_GET['booking_ready'])) {

            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6' style='text-align:center'> Booking Send >> >></p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>

        <?php if (isset($_GET['all_clear'])) {

            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6' style='text-align:center'> All clear >> >></p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>

        <?php if (isset($_GET['insert_done'])) {

            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6' style='text-align:center'> Insert done >> >></p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>
        <div class="container mt-5">
            <h2 style="color:#FFFAF0 ;">City List</h2>
            <?php echo $table; ?>
            <div class='d-flex justify-content-center'>

                <!-- <button class="btn btn-success " data-bs-toggle="modal" data-bs-target='#remove'>Remove</button>
                <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target='#edit'>Edit</button> -->
                <br> <br>

            </div class='d-flex justify-content-center'>

            <div>
                <h2 style="color:#FFFAF0 ;">Order List</h2>
                <?php echo $table_3 ?>

            </div>


        </div>



        <!-- profile MODAL -->
        <div class="modal fade" id="profile_2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Your Profile</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">

                        <div class="h4"> <strong>First Name:</strong> <?php echo $_SESSION['fname_5'];  ?></div>
                        <div class="h4"><strong>Last Name:</strong> <?php echo $_SESSION['lname_5'];  ?></div>
                        <div class="h4"><strong>Email:</strong> <?php echo $_SESSION['email_5'];  ?></div>
                        <div class="h4"><strong>Gender:</strong> <?php echo $_SESSION['gender_5'];  ?></div>
                        <div class="h4"><strong>NIC No:</strong> <?php echo $_SESSION['NIC_5'];  ?></div>
                        <div class="h4"><strong>Phone:</strong> <?php echo $_SESSION['phone_5'];  ?></div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--profile MODAL END -->

        <!-- UPDATE MODAL -->
        <div class="modal fade" id="edit">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Update</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="admin_edit.php" method="POST">
                                <label for="id" class="h5">ID:</label>
                                <input type="text" name="id" value="" id="pwd" class="form-control w-25" placeholder="ID" required>

                                <label for="fname" class="from-label h5">City</label>
                                <input type="text" name="city" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>

                                <label for="lname" class="from-label h5">city_to</label>
                                <input type="text" name="city_to" value="" class="form-control w-25" placeholder="Last Name" id="lname" required>
                                <br>





                                <button class="d-flex justify-content-start btn btn-success mt-3 " type="submit" name="submit">Update</button>
                            </form>


                        </div>

                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- UPDATE MODAL END -->

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

                            <label for="d_id" class="h4">ID:</label>
                            <input type="text" name="d_id" placeholder="Enter Id" style="height: 35px;">
                            <button class="btn btn-danger mb-1" type="submit" name="submit">remove</button>

                        </form>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--REMOVE MODAL END -->


        <!-- INSERT MODAL -->
        <div class="modal fade" id="insert">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add New Routes</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="admin_edit.php" method="POST">


                                <label for="fname" class="from-label h4">City</label>
                                <input type="fname" name="city" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>

                                <label for="lname" class="from-label h4">city_to</label>
                                <input type="lname" name="city_to" value="" class="form-control w-25" placeholder="Last Name" id="lname" required>



                                <button class="btn btn-primary mt-3" type="submit" name="insert">Insert</button>

                            </form>
                        </div>

                    </div> <!-- modal-body-end -->
                    <div class=" modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- INSERT MODAL END -->

        <!-- ORDER MODAL -->
        <div class="modal fade" id="order">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Orders</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">

                        <?php echo $table_3 ?>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <form action="delete.php" method="POST">

                            <button type="submit" name="submit_1" class="btn btn-success" style="margin-left: 20rem;">Clear All</button>
                        </form>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--ORDER MODAL END -->


        <!-- OFFCANVAS TO DO -->


        <div class="offcanvas offcanvas-start" id="to_do_list">
            <div class="offcanvas-header " style="border-bottom:1px solid #A9A9A9;opacity:0.6;">
                <h1 class=" offcanvas-title">Booking </h1>

                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="row">
                    <div class="col-sm-12">

                        <button class="btn btn-success" data-bs-target="#output" data-bs-toggle="modal">Viwe Order</button>
                        <form action="booking.php" method="POST" class="form">
                            <label for="city" class="h4"> Departure</label>
                            <div>
                                <?php echo $select_list;     ?>
                            </div> <br> <br>

                            <div>
                                <label for="city_to" class="h4"> Arrival</label> <br>
                                <?php echo $city_to_list;     ?>
                            </div>
                            <br> <br>
                            <label for="pax" class="h4">Pax</label>
                            <input type="text" style="width: 50px;height: 25px;" name="pax">
                            <label for="text" class="h4">Price</label>
                            <input type="text" style="width: 70px;height: 25px;" name="price">

                            <br> <br>

                            <label for="date" class="h4">Date</label> <br>
                            <input type="date" id="date" name="date">

                            <br> <br>

                            <Button name="submit" class='btn btn-primary' type="submit">Book now</Button>

                        </form>
                    </div>

                </div>


            </div>
        </div> <!-- OFFCANVA END -->

        <!--Booking ORders -->
        <div class="modal fade" id="output">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Orders</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">

                        <div class="container">


                            <?php


                            $table_query = "SELECT id,city,city_to,pax,price,date FROM booking";
                            $table_result = mysqli_query($connection, $table_query);
                            ?>

                            <table class='table table-hover  bg-light'>
                                <tr class="table-primary">
                                    <th>ID</th>

                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Pax</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Cancel</th>
                                </tr>

                                <?php


                                if (mysqli_num_rows($table_result)) {
                                    while ($record = mysqli_fetch_assoc($table_result)) {

                                ?>

                                        <form action="delete.php" method="POST">




                                            <tr>

                                                <td>
                                                    <?php echo $record['id']; ?>
                                                    <input type="text" value="<?php echo $record['id']; ?>" name="id" size="5" readonly style="display: none;">
                                                </td>
                                                <td>
                                                    <?php echo $record['city']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $record['city_to']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $record['pax']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $record['date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $record['price']; ?>
                                                </td>
                                                <td>

                                                    <input type="submit" name="close" value="cancel" class="btn btn-danger">
                                                </td>

                                            </tr>





                                        </form>


                                <?php

                                    }
                                }

                                ?>
                            </table>

                        </div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--Order booking MODAL END -->










    </div>


    <div class="container mt-5">




    </div>
    </div>






















    <script>
        var y = new Date().getHours();
        var x = "";
        if (y < 12) {
            x += "Good morning!!";
        } else if (y < 16) {
            x += "Good Afternoon!!";

        } else {
            x += "Good Evening!!";
        }

        document.getElementById('greeting').innerHTML = x;
    </script>
</body>

</html>

<?php mysqli_close($connection); ?>