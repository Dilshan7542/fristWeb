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

        $query = "SELECT * FROM customers 
        WHERE email='{$email}' AND password='{$pwd}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {

            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['id'] = $user['id'];
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['email'] = $user['email'];
                header('location: index_test.php');
            } else {
                $errors[] = "INVALID";
            }
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

        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;

        }

        ul li a.nav-link {
            color: #FFF8DC;
        }
    </style>
</head>

<body style="background-color: #696969;">
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="" class="navbar-brand" style="margin-left: 2em;"><img src="https://img.icons8.com/external-victoruler-flat-victoruler/50/000000/external-bus-education-and-school-victoruler-flat-victoruler.png" /></a>
            <button class="navbar-toggler" data-bs-toggle='collapse' data-bs-target='#nav_collapse'><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="nav_collapse">
                <ul class="navbar nav">
                    <li class="nav-item">
                        <a href="http://localhost/myphp/Project%20New/form_user.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link" data-bs-target="#login" data-bs-toggle="modal">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">Order</a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php if (isset($errors) && !empty($errors)) {
            echo "<p class='bg-danger'> Invalid Email/ Password</p>";
        } ?>

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

                            <form action="test_login.php" method="POST" name="f1">

                                <?php if (isset($errors) && !empty($errors)) {
                                    echo "INVALID PWD ? EMAIL";
                                } ?>
                                <label for="email">Email</label>



                                <input type="email" name="email" value="" id="inp_1" class="form-control w-25" placeholder="Enter you email.." required>

                                <label for="password" class="from-label">Password</label>
                                <input type="password" name="pwd" value="" class="form-control w-25" placeholder="Password" required id="e1">
                                <br>







                                <button class="btn btn-primary mt-3" type="submit" name="submit">Submit</button>
                                <br>
                                <a href="" class="" style="float: left;">Froget password</a>
                            </form>

                            <!--  <form action="test.php" method="POST" id="sub">
                                <input type="text" name="email" value="" id="inp_2">




                            </form> -->
                            <!-- <script>
                                function submit_1() {
                                    document.getElementById('inp_1').value= document.getElementById('inp_2').innerHTML;
                                    document.getElementById('sub').submit();
                                   

                                }
                            </script> -->

                        </div>
                        <div>D</div>

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
    <div>




    </div>

</body>

</html>

<?php mysqli_close($connection); ?>