<?php include_once('inc/connection.php'); ?>

<?php
if (isset($_POST['submit_form'])) {
    $fname = "";
    $lname = "";
    $email = "";
    $pwd = "";
    $comment = "";
    $gender = "";
    $msg = "";


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
                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                <button type='button' class='btn-close' data-bs-dismiss='alert'> </button>
                </div>";
        } else {

            $query = "INSERT INTO customers(fname,lname,email,password,gender,phone,last_login)
                VALUES ('{$fname}','{$lname}','{$email}','{$pwd}','{$gender}','{$phone}', NOW() )";


            $result = mysqli_query($connection, $query);

            if ($result) {

                header('location:index.php?insert=done');
            }
        }
    }
} /* isset() end-- -------*/





?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Google Form</title>
    <link rel="stylesheet" type="text/css" href="css/Bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 19px;
        }
    </style>

</head>

<body class="bg-info" style="background-image: url(4.gif);">
    <div class="container">

        <a href="http://localhost/myphp/ums/index.php" class="btn btn-success">Back</a>


        <div class="container mt-5 text-primary">
            <form action="form_user.php" method="POST" class="was-validated">
                <?php if (!empty($msg)) {
                    echo $msg;
                }                           ?>
                <br><br>
                <h1> My First Form</h1>

                <label for="fname" class="from-label">Frist Name:</label>
                <input type="fname" name="fname" value="" class="form-control w-25" placeholder="Frist Name" id="fname" required>


                <label for="lname">Last name :</label>
                <input type="lname" name="lname" value="" class="form-control w-25" placeholder="Last Name" id="lname" required>


                <label for="email">Email :</label>
                <input type="email" name="email" value="" id="email" class="form-control w-25" placeholder="Email" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">invalid</div>
                <!-- valid -->
                <label for="password">Password:</label>
                <input type="password" name="pwd" value="" id="pwd" class="form-control w-25" placeholder="Password " required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">invalid</div>
                <!-- valid-pwd -->


                <label for="sex" required>Gender:</label>
                <br>

                <label for="male" name="gender">Male</label>
                <input type="radio" name="gender" id="male" value="male" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">invalid</div>

                <label for="female">Female</label>
                <input type="radio" name="gender" id="female" value="female" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">invalid</div>

                <label for="phone">Phone</label>
                <input type="phone" name="phone" value="" class="form-control w-25" placeholder="Phone Number " maxlength="10" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">invalid</div>




                <input type="submit" name="submit" class="btn btn-primary mt-3">
                <input type="reset" class="btn btn-primary mt-3">








            </form>





        </div>
    </div>
</body>

</html>