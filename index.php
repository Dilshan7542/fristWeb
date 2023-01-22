<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php


if (isset($_POST['submit'])) {

    $errors = array();
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1) {
        $errors[] = 'Please Enter email';
    }
    if (!isset($_POST['pwd']) || strlen(trim($_POST['pwd'])) < 1) {
        $errors[] = 'Pwd';
    }
    if (empty($errors)) {

        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);
        $hash = sha1($pwd);

        $query = "SELECT * FROM customers 
            WHERE email='{$email}'
            AND password='{$hash}' LIMIT 1";
 
        $result = mysqli_query($connection, $query);

        if ($result) {

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['id_c'] = $user['id'];
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['lname'] = $user['lname'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['gender'] = $user['gender'];
                header('location:index_test.php');
            } else {
                $errors[] = "INVALID";
            }
        }
    }
}





?>

<?php
if (isset($_POST['submit_form'])) {
    $fname = "";
    $lname = "";
    $email = "";
    $pwd = "";
    $comment = "";
    $gender = "";
    $msg = "";
    $msg_2 = "";



    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);


    $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);

    $phone = mysqli_real_escape_string($connection, $_POST['phone']);

    $gender = mysqli_real_escape_string($connection, $_POST['gender']);

    $query_2 = "SELECT * FROM customers 
        WHERE email='{$email}' LIMIT 1";


    $showResult = mysqli_query($connection, $query_2);

    if ($showResult) {

        if (mysqli_num_rows($showResult) == 1) {


            $msg =   "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h4'> Sing Up Failed Invalid Email</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
            $msg_2 = "<p class='h4 bg-danger' style='width: 400px;'>Sing Up Failed Invalid Email</p>";
        } else {
            $hash = sha1($pwd);
            $query = "INSERT INTO customers(fname,lname,email,password,gender,phone,last_login)
                VALUES ('{$fname}','{$lname}','{$email}','{$hash}','{$gender}','{$phone}', NOW() )";


            $result = mysqli_query($connection, $query);

            if ($result) {

                header('location:index.php?insert=done');
            }
        }
    }
} /* isset() end-- -------*/






?>

<?php

if (isset($_POST['forget'])) {


    $f_email = $_POST['email'];
    $error = array();

    $f_query = "SELECT * FROM customers WHERE email='{$f_email}' LIMIT 1";

    $f_result = mysqli_query($connection, $f_query);

    if ($f_result) {

        if (mysqli_num_rows($f_result) == 1) {
            $f_record = mysqli_fetch_assoc($f_result);
            $_SESSION['for_id'] = $f_record['ID'];

            header('location:index.php?forget=yes');
        } else {
            $error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Email is not valid
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }
    }
}

if (isset($_POST['phone_f'])) {

    $phone = "";
    $msg_7 = "";

    $phone = $_POST['phone'];

    $p_query = "SELECT * FROM customers WHERE phone='{$phone}' LIMIT 1";

    $p_result = mysqli_query($connection, $p_query);

    if ($p_result) {
        if (mysqli_num_rows($p_result) == 1) {


            header('location:index.php?phone=yes');
        } else {
            $msg_7 = "invalid";
        }
    }
}



if (isset($_POST['pwd_f'])) {



    $errors_2 = array();

    if (!isset($_POST['pwd']) || strlen(trim($_POST['pwd'])) < 1) {
        $errors_2[] = 'Pwd';
    }

    if (empty($errors_2)) {
        $pwd = mysqli_real_escape_string($connection, $_POST['pwd']);
        $hash = sha1($pwd);
        $for_id = $_SESSION['for_id'];


        $f_query = "UPDATE customers SET password='{$hash}' WHERE ID='{$for_id}' LIMIT 1";
        "INSERT INTO customers=(password) VALUES ('{$hash}')";

        $result_f = mysqli_query($connection, $f_query);
        if ($result_f) {
            if (mysqli_affected_rows($connection)) {

                header('location:index.php?updated=yes');
            }
        } else {
            $errors_2[] = "Invalid";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            border: 3px solid #FF00FF;
            padding: 10px;
            font-size: 20px;
            background-color: black;
            opacity: 0.8;

        }

        th {
            color: #FFF8DC;
        }

        tr:hover {
            background-color: #00BFFF;

        }

        a {

            float: right;
        }

        .btn-danger {
            margin-left: 2rem;
        }



        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;

        }

        ul li a.nav-link {
            color: #FFF8DC;
        }

        div.fm {
            margin-left: 10rem;

        }

        h3.fm {
            margin-left: 10rem;

        }

        a.nav-link {
            color: burlywood;
        }

        a.nav-link:hover {
            color: #FF1493;
        }
    </style>
</head>

<body style="background-image:url(img/2.jpg);background-size: 100% ;background-repeat: no-repeat;" onload='load_f()'>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="border-bottom: solid #FFFAF0;">
            <a href="index.php" class="navbar-brand" style="margin-left: 2em;"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /> <a href="index.php" class="nav-link h3">Sri Lanka Bus</a></a>
            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">
                    <li class="nav-item">
                        <a href="" class="nav-link" data-bs-target="#singup" data-bs-toggle="modal">Sing Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" data-bs-target="#login" data-bs-toggle="modal">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link"></a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php if (!empty($msg)) {
            echo $msg;
        } ?>
        <?php if (!empty($msg_7)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'> Invalid Phone Number</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } ?>

        <?php if (isset($_GET['notmach'])) {
            echo
            $msg =   "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    you don't have access, please first enter email /password you can login
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>
        <?php if (isset($errors) && !empty($errors)) {

            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'> Invalid Email/ Password</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } ?>
        <?php if (isset($_GET['logout'])) {

            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Logout SuccessFully</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>
        <?php if (isset($_GET['insert'])) {
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Now You can login</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>

        <?php if (isset($_GET['updated'])) {
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Now You can login</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>

        <?php if (isset($_GET['forget'])) {
            echo
            " <a  data-bs-target='#forget_2' data-bs-toggle='modal' id='oload' >Login</a>";
        }  ?>
        <?php if (isset($_GET['phone'])) {
            echo
            " <a  data-bs-target='#pwd_ff' data-bs-toggle='modal' id='oload'>Logindd</a>";
        }  ?>

        <?php
        if (!empty($error)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Email is not valid
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }

        ?>

        <?php if (isset($errors_2) && !empty($errors_2)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'>Pleace enter Valid Password</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }    ?>
        <!-- forget_2........PWD MODAL -->
        <div class="modal fade" id="pwd_ff">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Sri lankan Bus</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="index.php" method="POST">




                                <label for="name" class="h5">New Password</label> <br>



                                <input type="password" name="pwd" value="" class="form-control w-25" placeholder="Enter you New Password.." required>


                                <button class="btn btn-primary mt-3" type="submit" name="pwd_f" style='margin-bottom:15px;'>Go</button>
                                <br>
                                <!--   <a href="" class="" style="float: left;">forget password</a> -->
                            </form>



                        </div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- forget_2.........Pwd -->


        <!-- forget MODAL -->
        <div class="modal fade" id="forget">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Please Enter Your Email</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="index.php" method="POST">


                                <label for="email" class="h5">Email</label>



                                <input type="email" name="email" value="" id="inp_1" class="form-control w-25" placeholder="Enter you email.." required>


                                <button class="btn btn-success mt-3" type="submit" name="forget" style='margin-bottom:15px;'>Next</button>
                                <br>
                                <!--   <a href="" class="" style="float: left;">forget password</a> -->
                            </form>



                        </div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- forget END -->



        <!-- forget_2.........phone MODAL -->
        <div class="modal fade" id="forget_2">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Pleace Enter Your Phone Number</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="index.php" method="POST">


                                <label for="name" class="h5">Phone</label>



                                <input type="name" name="phone" value="" class="form-control w-25" placeholder="Enter you phone.." required>


                                <button class="btn btn-success mt-3" type="submit" name="phone_f" style='margin-bottom:15px;'>Next</button>
                                <br>
                                <!--   <a href="" class="" style="float: left;">forget password</a> -->
                            </form>



                        </div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- forget_2.........phone END -->










        <!-- LOGIN MODAL -->
        <div class="modal fade" id="login">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Login</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal-body-top -->

                        <div class="container">

                            <form action="index.php" method="POST" name="f1">

                                <?php if (isset($errors) && !empty($errors)) {
                                    echo "<p class='bg-danger'> INVALID PWD /EMAIL</p>";
                                } ?>
                                <label for="email">Email</label>



                                <input type="email" name="email" value="" id="inp_1" class="form-control w-25" placeholder="Enter you email.." required>

                                <label for="password" class="from-label">Password</label>
                                <input type="password" name="pwd" value="" class="form-control w-25" placeholder="Password" required id="e1">
                                <br>








                                <button class="btn btn-primary mt-3" type="submit" name="submit" style='margin-bottom:15px;'>Login</button>
                                <br>
                                <!--   <a href="" class="" style="float: left;">forget password</a> -->
                            </form>

                            <a href="" data-bs-target="#forget" data-bs-toggle="modal" style="float: left;">Forget Password</a>

                        </div>


                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- Login END -->




        <div class="container mt-5">
            <?php


            $table_query = "SELECT id,city,city_to,pax,price,date FROM booking";
            $table_result = mysqli_query($connection, $table_query);
            ?>

            <table class="d-flex justify-content-center">
                <tr>

                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Pax</th>
                    <th>Date</th>
                    <th>Order</th>
                </tr>

                <?php


                if (mysqli_num_rows($table_result)) {
                    while ($record = mysqli_fetch_assoc($table_result)) {

                ?>

                        <form action="index_test.php" method="POST">




                            <tr>


                                <td>


                                    <input type="text" value="<?php echo $record['city']; ?>" name="city_1" readonly>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $record['city_to']; ?>" name="city_to" readonly>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $record['pax']; ?>" name="pax" size="5" readonly>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $record['date']; ?>" name="date" readonly>
                                </td>
                                <td>

                                    <a href="" class="btn btn-primary" data-bs-target="#login" data-bs-toggle="modal">Go</a>
                                </td>

                            </tr>





                        </form>


                <?php

                    }
                }

                ?>

        </div>

        <div>

            <div class="modal fade" id="singup">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fm" style="margin-left: 150px;">Enter Your Details</h2>
                            <button class="btn-close" data-bs-dismiss='modal'></button>
                        </div>
                        <div class="modal-body">
                            <div class="container fm">
                                <form action="index.php" method="POST" class="was-validated" autocomplete="off">
                                    <?php if (!empty($msg_2)) {
                                        echo $msg_2;
                                    }                           ?>
                                    <br><br>
                                    <h1>Sing Up</h1>



                                    <label for="fname" class="from-label">Frist Name:</label>
                                    <input type="fname" name="fname" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>


                                    <label for="lname">Last name :</label>
                                    <input type="lname" name="lname" value="" class="form-control w-25" placeholder="Last Name" id="lname" required>


                                    <label for="email">Email :</label>
                                    <input type="email" name="email" value="" id="email" class="form-control w-25" autocomplete="on"     placeholder="Email" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">invalid</div>
                                    <!-- valid -->
                                    <label for="password">Password:</label>
                                    <input type="password" name="pwd" value="" id="pwd" class="form-control w-25" placeholder="Password " required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">invalid</div>
                                    <!-- valid-pwd -->
                                    <br>

                                    <label for="sex" required>Gender:</label>
                                    <br>

                                    <label for="male" name="gender">Male</label>
                                    <input type="radio" name="gender" id="male" value="male" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">invalid</div> <br>

                                    <label for="female">Female</label>
                                    <input type="radio" name="gender" id="female" value="female" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">invalid</div> <br> <br>

                                    <label for="phone">Phone</label>
                                    <input type="phone" name="phone" value="" class="form-control w-25" placeholder="Phone Number " maxlength="10" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">invalid</div>






                                    <input type="submit" name="submit_form" class="btn btn-primary mt-3" value="Sing Up">
                                    <input type="reset" class="btn btn-success mt-3">








                                </form>
                            </div>
                        </div> <!-- modal-body-end -->
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>

            </div> <!-- modal-end -->




        </div>

    </div>

    <script>
        function load_f() {
            document.getElementById('oload').click();



        }
    </script>

</body>

</html>

<?php mysqli_close($connection); ?>