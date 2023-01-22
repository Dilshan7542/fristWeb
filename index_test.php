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

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
            font-size: 1rem;

        }


        th.thh,
        td.tdd {
            border: 4px solid #FF00FF;
            padding: 10px;
            font-size: 1rem;
            background-color: black;
            opacity: 0.8;
            color: #FFF8DC;

        }

        th.thh {
            color: #FFF8DC;
            font-family: Verdana, sans-serif;
        }

        tr.trd:hover {
            background-color: #00BFFF;

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
            <a href="" class="navbar-brand" style="margin-left: 2em;"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /> <a href="" class="nav-link h3 hh" data-bs-toggle='modal' data-bs-target='#profile' title='You Can See Your Profile'> <?php echo $_SESSION['fname']; ?></a><span id="greeting"></span></a>


            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-toggle='modal' data-bs-target='#tel'>Contact Us</a>
                    </li>

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


        <!-- tel MODAL -->
        <div class="modal fade" id="tel_2">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Contact us
                            <em>8.00 am</em> to
                            <em>5.00pm</em>
                        </h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->
                        <p><b>Tel: 075-2277759</b></p>
                        <p><b>Email: dilshan.maduranga7542@gmail.com</b></p>

                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- Tel END -->



        <!-- Contact us MODAL -->
        <div class="modal fade" id="tel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Contact Us</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">






                        <div class="d-flex justify-content-center">
                            <a href="https://www.facebook.com/" class="">
                                <!-- facebook-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/" style="margin-left: 1rem;">
                                <!-- twitter-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-twitter text-danger" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                </svg>
                            </a>

                            <a href="#" style="margin-left: 1rem;">
                                <!-- Email-icon -->

                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
                                </svg>

                            </a>

                            <a href="https://in.pinterest.com/" style="margin-left: 1rem;">
                                <!-- pinterest-icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-pinterest text-danger" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0z" />
                                </svg>
                            </a>

                            <!-- Whatsapp-icon -->
                            <a href="" style="margin-left: 1rem;" data-bs-toggle='modal' data-bs-target='#tel_2'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-whatsapp text-success" viewBox="0 0 16 16">
                                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                            </a>



                        </div>




















                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">

                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
        <!--Contact usMODAL END -->



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

                                <option value="45" name='pax' id="i3" for='pax'>30</option>
                                <option value="40" name='pax'>35</option>
                                <option value="30" name='pax'>40</option>
                                <option value="30" name='pax'>45</option>
                                <option value="30" name='pax'>50</option>
                            </select>




                            <br> <br>

                            <label for="date" class='date h5'>Date</label>
                            <br>

                            <input type="date" id="date" name="date">

                            <br>
                            <input type="price" id="p_list" name="price" value="Shedul Order" style="display: none;">
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



        <div class="container mt-5 ">
            <div class="container">

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

    <script>
        $(document).ready(function() {
            $('#i3').on("change", function() {

                var xl = $('#i3').val();
                document.getElementById('pi').innerHTML = xl;

            });
        });
    </script>

</body>

</html>

<?php mysqli_close($connection); ?>