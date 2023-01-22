<?php require_once('inc/connection.php'); ?>
<?php

if (isset($_POST['submit'])) {
    
    $city= "";
    $city_to = "";
    $pax = "";
    $date = "";
    $price = "";

    
    $city = input_verify($_POST['city']);
    $city_to = input_verify($_POST['city_to']);
    $pax = input_verify($_POST['pax']);
    $date = input_verify($_POST['date']);
    $price = input_verify($_POST['price']);

    $query = "INSERT INTO booking(city,city_to,pax,date,price) VALUES ('{$city}','{$city_to}','{$pax}','{$date}','{$price}')";

    $result = mysqli_query($connection, $query);
    if ($result) {
        header('location:admin_edit.php?booking_ready=yes');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/js.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ul li a.nav-link:hover {
            color: #FF1493;
            font-size: 18px;
        }

        table {
            border-collapse: collapse;

            border: 2px solid red;



        }

        th,
        td {
            border: 2px solid burlywood;
            padding: 10px;

            border-radius: 12px;

        }

        tr:hover {
            background-color: blue;
        }

        .btn-success {
            margin-left: 20rem;
        }

        ul li a.nav-link {
            color: #FFF8DC;
        }
    </style>
</head>

<body style="background-color:gray">
    <div class="container mt-5">

        <?php


        $table_query = "SELECT id,city,city_to,pax,price,date FROM booking";
        $table_result = mysqli_query($connection, $table_query);
        ?>

        <table>
            <tr>
                <th>Email</th>
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
                                <input type="email" value="" name="email" size="30">
                            </td>

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

                                <input type="submit" name="submit">
                            </td>

                        </tr>





                    </form>


            <?php

                }
            }

            ?>
    </div>
</body>

</html>

<?php mysqli_close($connection); ?>