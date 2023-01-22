<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php

if (!isset($_SESSION['fname'])) {

    header('location:index.php?notmach=yes');
}






if (isset($_POST['submit'])) {

    $city_1 = "";
    $city_2i = "";
    $pax = "";
    $date = "";
    $msg = "";
    $email = "";
    $msg_4 = "";
    $price = "";



    $city_1 = ($_POST['city_1']);
    $city_2i = ($_POST['city_to']);
    $pax = ($_POST['pax']);
    $date = ($_POST['date']);
    $email = ($_SESSION['email']);
    $price = ($_POST['price']);



    $query_ch = "SELECT * FROM schedul WHERE email='{$_SESSION['email']}' LIMIT 1";
    $result_ch = mysqli_query($connection, $query_ch);

    if ($result_ch) {
        if (mysqli_num_rows($result_ch) == 1) {
            $msg_4 = "Exists";
        } else {

            $query_insert = "INSERT INTO schedul(city,city_to,pax,Date,email,price)
                 VALUES ('{$city_1}}','{$city_2i}','{$pax}','{$date}','{$email}','{$price}')";

            $result_insert = mysqli_query($connection, $query_insert);

            if ($result_insert) {
                header('location:index_test.php?done=yes');
            } else {
                echo "error....";
            }
        }
    }
} /* isset end-- -------*/










?>




<?php


$query_fetch = "SELECT City,city_to FROM routes";
$result_fetch = mysqli_query($connection, $query_fetch);
$select = '<select name="city_1" class="city" required>';
$city_to = '<select name="city_to" class="city_to" required>';



if ($result_fetch) {
    mysqli_num_rows($result_fetch);
    while ($record = mysqli_fetch_assoc($result_fetch)) {



        $select .=       "<option name='city_1'  id='city' required >" . $record['City'] . '</option>';
        $city_to .=       "<option name='city_to'  id='city_to' required>" . $record['city_to'] . '</option>';
    }
}
$select .= '</select>';
$city_to .= '</select>';




?>

<?php









?>
<?php


/* $msg2="";

$query_5 = "SELECT * "
$result_5 = mysqli_query($connection, $query_5);




if ($result_5) {
    mysqli_num_rows($result_5);
   
        
       
    }
}

 */




?>


<?php

/* ORDER */
$cancel = "";
$tr = "";
$jp = "";
$mail = $_SESSION['email'];
$email_v = mysqli_real_escape_string($connection, $_SESSION['email']);

$query_v = "SELECT * FROM schedul WHERE email='{$email_v}' LIMIT 1";
$result_v = mysqli_query($connection, $query_v);
$tr .=
    "<table style='text-align: center;' class='colp'>";

$tr .= "<tr style='text-align:center;' class='colp'>";


if ($result_v) {
    if (mysqli_num_rows($result_v) == 1) {
        $tr .= " <th> #Ref </th> <th> Depature </th><th> Arrival </th> <th > Pax </th> <th> Date</th> <th> Cancel  </th>  </tr>   ";
        $query_vi = "SELECT * FROM schedul WHERE email='{$email_v}'";
        $result_vi = mysqli_query($connection, $query_vi);
        if ($result_vi) {
            mysqli_num_rows($result_vi);


            while ($record_v = mysqli_fetch_assoc($result_vi)) {
                $tr .= "<form action='index_test.php' method='POST'>";
                $tr .= "<tr>";
                $tr .= "<td>" . $_SESSION['ref'] = $record_v['id'] . "</td>";
                $tr .= "<input type='text' value='{$_SESSION['ref']}' name='can' id='non'>";
                $tr .= "<td>" . $record_v['city'] . "</td>";
                $tr .= "<td>" . $record_v['city_to'] . "</td>";
                $tr .= "<td>" . $record_v['pax'] . "</td>";
                $tr .= "<td>" . $record_v['Date'] . "</td>";
                $tr .= "<td>" . "<input type='submit' name='cancel' value='Cancel Order' class='btn btn-outline-danger'>" . "</td>" . "</form>";
            }
        }
    } else {
        $jp = "no data";
    }
}

$tr .= "</tr>";
$tr .= "</table>";

if (isset($_POST['cancel'])) {

    $can = $_POST['can'];


    $query = "DELETE FROM schedul WHERE id='{$can}' LIMIT 1 ";
    "INSERT INTO schedul(id)  VALUES ('{$can}')";


    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_affected_rows($connection)) {
            header('location:index_test.php?cancel_or=yes');
        }
    } else {
        echo "DELETE faild";
    }
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
        table.tb {
            border-collapse: collapse;
            text-align: center;
            opacity: 0.9;

        }

        th,
        td {
            border: 4px solid black;
            padding: 10px;
            font-size: 25px;

        }


        th.thh,
        td.tdd {
            border: 4px solid #FF00FF;
            padding: 10px;
            font-size: 25px;
            background-color: black;
            opacity: 0.8;
            color: #FFF8DC;

        }

        th.thh {
            color: #FFF8DC;
            font-family: Verdana, sans-serif;
        }

        tr.trd:hover {
            background-color: #87CEEB;

        }



        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;
        }

        ul li a.nav-link {
            color: #FFF8DC;
        }

        #non {
            display: none;
        }

        p.h6 {
            text-align: center;
        }

        span#greeting {
            color: #FF7F50;

            margin-top: 30px;
        }

        a.nav-link {
            color: #FF1493;
        }

        a.hh:visited {
            color: #FF1493;
        }

        a.nav-link:hover {
            color: #FFFAF0;
        }
    </style>
</head>

<body style="background-image:url(img/4.jpg);background-size: 100% ;">

    <div class="container">
        <!-- navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="border-bottom: solid #FFFAF0;">
            <a href="" class="navbar-brand" style="margin-left: 2em;"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /> <a href="" class="nav-link h3 hh" data-bs-toggle='modal' data-bs-target='#profile'> <?php echo $_SESSION['fname']; ?></a><span id="greeting"></span></a>


            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle='modal' data-bs-target='#order1'>My Order</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle='modal' data-bs-target='#schedule'>Schedule </a>
                    </li>
                    <li class="nav-item">
                        <a href="index_test.php" class="nav-link h5">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link h5">Log out</a>
                    </li>
                </ul>


            </div>


        </nav> <!-- navbar-end -->

        <?php if (isset($_GET['done'])) {

            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Your Order Send >> >></p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>
        <?php if (isset($_GET['cancel_or'])) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                 <p class='h6'>Your Order Cancelled</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>

        <?php if (!empty($msg_4)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'> Sory.. Your Order Already Exists</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }   ?>






        <div class="modal fade" id="order1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">My Orders</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">


                        <div> <?php echo $tr;
                                if (!empty($jp)) {
                                    echo  "<div class='bg-info'>No Order </div>";
                                }

                                ?>

                        </div>

                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--ORDER MODAL END -->



        <!-- modal -->
        <div class="modal fade" id="schedule">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Schedul</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">

                        <form action="index_test.php" method="POST">



                            <br>


                            <label for="city" class="h5"> Departure</label>
                            <?php echo $select;     ?>


                            <label for="city_to" class="arrivel h5" style="margin-left: 20px;"> Arrivel</label>
                            <?php echo $city_to;     ?>
                            <br> <br>
                            <label for="pax" class="h5">Pax</label>
                            <select name="pax" class="paxx" required>

                                <option value="45" name='pax'>45</option>
                                <option value="40" name='pax'>40</option>
                                <option value="30" name='pax'>30</option>
                            </select>


                            <br> <br>

                            <label for="date" class='date h5'>Date</label>
                            <br>

                            <input type="date" id="date" name="date">

                            <br>
                            <input type="price" id="date" name="price" value="Shedul Order" style="display: none;">
                            <br>

                            <Button type="submit" name="submit" class='btn btn-primary'>Book now</Button>
                        </form>
                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- modal-end -->



        <div class="container mt-5 row">
            <div class="col-sm-12">

                <?php


                $table_query = "SELECT id,city,city_to,pax,price,date FROM booking";
                $table_result = mysqli_query($connection, $table_query);
                ?>

                <table class=" d-flex justify-content-center " style="margin-top: 70px;">
                    <tr class="trr">

                        <th class="thh">Departure</th>
                        <th class="thh">Arrival</th>
                        <th class="thh">Pax</th>
                        <th class="thh">Date</th>
                        <th class="thh">Price</th>
                        <th class="thh">Order</th>
                    </tr>

                    <?php


                    if (mysqli_num_rows($table_result)) {
                        while ($record = mysqli_fetch_assoc($table_result)) {

                    ?>


                            <form action="index_test.php" method="POST">




                                <tr class="trd">


                                    <td class="tdd">


                                        <input type="text" value="<?php echo $record['city']; ?>" name="city_1" readonly>
                                    </td>
                                    <td class="tdd">
                                        <input type="text" value="<?php echo $record['city_to']; ?>" name="city_to" readonly>
                                    </td>
                                    <td class="tdd">
                                        <input type="text" value="<?php echo $record['pax']; ?>" name="pax" size="5" readonly>
                                    </td>
                                    <td class="tdd">
                                        <input type="text" value="<?php echo $record['date']; ?>" name="date" readonly>
                                    </td>
                                    <td class="tdd">
                                        <input type="text" value="<?php echo $record['price']; ?>" name="price" readonly>
                                    </td>
                                    <td class="tdd">

                                        <input type="submit" name="submit" class="btn btn-outline-primary" value="Order">
                                    </td>

                                </tr>





                            </form>


                    <?php

                        }
                    }

                    ?>
                </table> <!-- table END -->

            </div>


        </div>


        <div>

            <!-- modal Profile-->
            <div class="modal fade" id="profile">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Profile</h3>
                            <button class="btn-close" data-bs-dismiss='modal'></button>
                        </div>
                        <div class="modal-body">
                            <div>

                                <div class="h4"> <strong>First Name:</strong> <?php echo $_SESSION['fname'];  ?></div>
                                <div class="h4"><strong>Last Name:</strong> <?php echo $_SESSION['lname'];  ?></div>
                                <div class="h4"><strong>Email:</strong> <?php echo $_SESSION['email'];  ?></div>
                                <div class="h4"><strong>Gender:</strong> <?php echo $_SESSION['gender'];  ?></div>
                                <div class="h4"><strong>Phone No:</strong> <?php echo $_SESSION['phone'];  ?></div>


                            </div>

                        </div> <!-- modal-body-end -->
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div> <!-- modal-end -->
        </div>







        <div>






        </div>

    </div> <!-- Heder end -->

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