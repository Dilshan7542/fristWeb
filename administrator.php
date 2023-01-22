<?php session_start();


?>
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

        $query = "SELECT * FROM emp 
        WHERE email='{$email}' AND password='{$hash}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $admin = mysqli_fetch_assoc($result);
                $_SESSION['email_5'] = $admin['email'];
                $_SESSION['fname_5'] = $admin['fname'];
                $_SESSION['lname_5'] = $admin['lname'];
                $_SESSION['gender_5'] = $admin['gender'];
                $_SESSION['phone_5'] = $admin['phone'];
                $_SESSION['NIC_5'] = $admin['NIC'];




                header('location:admin_edit.php');
            } else {
                $errors[] = "Invalid";
            }
        }
    }
}

?>


<?php
if (isset($_POST['submit_2'])) {
    $fname = "";
    $lname = "";
    $email = "";
    $pwd = "";
    $comment = "";
    $gender = "";
    $msg = "";



    $fname = input_varify($_POST['fname']);
    $lname = input_varify($_POST['lname']);
    $email = input_varify($_POST['email']);
    $pwd = input_varify($_POST['pwd']);
    $hash = sha1($pwd);
    $phone = input_varify($_POST['phone']);

    $gender = input_varify($_POST['gender']);
    $nic = input_varify($_POST['nic']);

    $query_2 = "SELECT * FROM emp WHERE email= '{$email}' LIMIT 1";

    $showResult = mysqli_query($connection, $query_2);

    if ($showResult) {

        if (mysqli_num_rows($showResult) == 1) {


            $msg =   "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Sing Up Faild
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } else {

            $query = "INSERT INTO emp(fname,lname,email,password,gender,NIC,phone,last_login)
                VALUES ('{$fname}','{$lname}','{$email}','{$hash}','{$gender}','{$nic}','{$phone}', NOW() )";


            $result = mysqli_query($connection, $query);

            if ($result) {

                header('location:administrator.php?insert=yes');
            }
        }
    }
} /* isset() end-- -------*/

function input_varify($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>


<?php

if (isset($_POST['forget'])) {


    $f_email = $_POST['email'];
    $error = array();

    $f_query = "SELECT * FROM emp WHERE email='{$f_email}' LIMIT 1";

    $f_result = mysqli_query($connection, $f_query);

    if ($f_result) {

        if (mysqli_num_rows($f_result) == 1) {
            $f_record = mysqli_fetch_assoc($f_result);
            $_SESSION['for_idd'] = $f_record['ID'];
            header('location:administrator.php?forget=yes');
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
    $msg = "";

    $phone = $_POST['phone'];

    $p_query = "SELECT * FROM emp WHERE phone='{$phone}' LIMIT 1";

    $p_result = mysqli_query($connection, $p_query);

    if ($p_result) {
        if (mysqli_num_rows($p_result) == 1) {
            header('location:administrator.php?phone=yes');
        } else {
            $msg = "invalid";
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
        $for_id = $_SESSION['for_idd'];

        $f_query = "UPDATE emp SET password='{$hash}' WHERE ID='{$for_id}' LIMIT 1";
        "INSERT INTO emp=(password) VALUES ('{$hash}')";

        $result_f = mysqli_query($connection, $f_query);
        if ($result_f) {
            if (mysqli_affected_rows($connection)) {

                header('location:administrator.php?updated=yes');
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
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;
        }

        ul li a {
            color: white;
        }

        ul li a.nav-link {
            color: #FFF8DC;
        }

        a.nav-link {
            color: burlywood;
        }

        a.nav-link:hover {
            color: #FF1493;
        }
    </style>
</head>

<body style="background-image:url(img/2.jpg);background-size: 100% ;background-repeat: no-repeat;" onload="load_f()">


    <!-- navbar -->
    <div class=" container">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="border-bottom: solid #FFFAF0;">
            <a href="administrator.php" style="margin-left: 2em;" class="navbar-brand"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /> <a href="administrator.php" class="nav-link h3">Sri Lanka Bus</a> </a>
            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">
                    <li class="nav-item">
                        <a href="http://localhost/myphp/Project%20New/admin_edit.php" class="nav-link h5">To do list</a>
                    </li>
                    <li class="nav-item">
                        <a href="administrator.php" class="nav-link h5">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-target="#login" data-bs-toggle="modal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link h5" data-bs-target="#singup" data-bs-toggle="modal">Sing Up</a>
                    </li>
                </ul>


            </div>


        </nav> <!-- navbar-end -->


        <?php if (isset($errors) && !empty($errors)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'> Invalid Email/ Password</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } ?>

        <?php if (isset($_GET['logout_2'])) {
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Logout SuccessFully</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } ?>


        <?php if (isset($_GET['insert'])) {
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Now You Can Login
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>




        <?php if (isset($_GET['notmach'])) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    you don't have access, please first enter email /password you can login
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>
        <?php if (isset($_GET['forget'])) {
            echo
            " <a  data-bs-target='#forget_2' data-bs-toggle='modal' id='oload' >Login</a>";
        }  ?>
        <?php if (isset($_GET['phone'])) {
            echo
            " <a  data-bs-target='#pwd_ff' data-bs-toggle='modal' id='oload'></a>";
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
        <?php if (!empty($msg)) {
            echo
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                 <p class='h6'>Pleace enter Valid Your Phone Number</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } ?>
        <?php if (isset($_GET['updated'])) {
            echo
            "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                 <p class='h6'> Now You can login</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        }  ?>

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

                            <form action="administrator.php" method="POST">




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

                            <form action="administrator.php" method="POST">


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

                            <form action="administrator.php" method="POST">


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








        <!--Sing UP modal -->
        <div class="modal fade" id="singup">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" style="margin-left: 10px;">New User</h3>
                        <button class="btn-close" data-bs-dismiss='modal'></button>
                    </div>
                    <div class="modal-body">

                        <div class="container">

                            <form action="administrator.php" method="POST" class="was-validated" autocomplete="off">
                                <?php if (!empty($msg)) {
                                    echo $msg;
                                }                           ?>
                                <br><br>
                                <h1> Sing Up</h1>



                                <label for="fname" class="from-label">Frist Name:</label>
                                <input type="fname" name="fname" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>


                                <label for="lname">Last name :</label>
                                <input type="lname" name="lname" value="" class="form-control w-25" placeholder="Last Name" required>


                                <label for="email">Email :</label>
                                <input type="email" name="email" value="" class="form-control w-25" placeholder="Email" required autocomplete="on">

                              
                                <label for="password">Password:</label>
                                <input type="password" name="pwd" value="" class="form-control w-25" placeholder="Password " required>

                             


                                <label for="sex" required>Gender:</label>
                                <br>

                                <label for="radio" name="gender">Male</label>
                                <input type="radio" name="gender" id="male" value="male" required>
                                <br>

                                <label for="radio">Female</label>
                                <input type="radio" name="gender" id="female" value="female" required>

                                <br>
                                <label for="phone">Phone:</label>
                                <input type="phone" name="phone" value="" class="form-control w-25" placeholder="Phone Number " maxlength="10" required>


                                <label for="nic">INC:</label>
                                <input type="nic" name="nic" value="" class="form-control w-25" autocomplete="off" placeholder="INC Number " maxlength="10" required>





                                <button type="submit" name="submit_2" class="btn btn-primary mt-3">Sing Up </button>
                                <button type="reset" name="submit_2" class="btn btn-success mt-3">Reset</button>









                            </form>
                        </div>

                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- modal-end -->


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

                            <form action="administrator.php" method="POST">

                                <?php if (isset($errors) && !empty($errors)) {
                                    echo "<p class='bg-danger'> Invalid Email/ Password</p>";
                                } ?>

                                <label for="email">Email</label>
                                <input type="email" name="email" value="" class="form-control w-25" placeholder="Enter you email.." required>

                                <label for="password" class="from-label">Password</label>
                                <input type="password" name="pwd" value="" class="form-control w-25" placeholder="Password" required>








                                <button class="btn btn-primary mt-3 mb-2" type="submit" name="submit">Login</button>
                                <br>

                                <a href="" data-bs-target="#forget" data-bs-toggle="modal">Forget Password</a>
                            </form>


                        </div>

                    </div> <!-- modal-body-end -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div> <!-- Login END -->

        <div class="container mt-5">


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