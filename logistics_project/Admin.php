<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Package delivery</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ICS_321</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#search">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#send_recive">Recive package</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#update">Update information</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <section id="home">
        <div class="container bg-image img1">
            <div class="col-lg-6">



                <div class="row">

                </div>
                <div class="row">

                </div>
            </div>


        </div>


    </section>
    <hr>


    <section class="search" id="search">
        <div class="container justify-content-center text-center">

            <h4>Trace Packeges</h4>
            <form action="" method="post">

                <div class="input-group">
                    <input name="Pnum" type="search" class="form-control rounded" placeholder="Enter package number"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn btn-light btn-outline-dark">Search</button>
                </div>

            </form>

            <?php
            if (isset($_POST["Pnum"])) {
                $pnum = $_POST["Pnum"];

                $user = $_SESSION['user'];


                $con = new mysqli("localhost", "root", "", "Project_ice321");
                if ($con->connect_error) {
                    die("failed to connect to DB");
                } else {
                    $stmt = $con->prepare("select * from Package where Pnum = ?  and C_id = $user");
                    $stmt->bind_param("s", $pnum);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);


                    echo "<table border='1'>
                        <tr>
                    <th>Package number</th>
                    <th>weight</th>
                    <th>Dimensions</th>
                    <th>Insurance</th>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>

                        </tr>";

                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['Pnum'] . "</td>";
                        echo "<td>" . $row['weight'] . "</td>";
                        echo "<td>" . $row['Dimensions'] . "</td>";
                        echo "<td>" . $row['Insurance'] . "</td>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['C_id'] . "</td>";
                        echo "<td>" . $row['Type'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "<td>" . $row['Date'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";

                    mysqli_close($con);

                }


            } ?>

        </div>

    </section>
    <hr>



    <section id="send_recive">

        <div class="container vh-100 justify-content-center text-center send">
            <h4>Add Package</h4>
            <div class="card-body">

                <form action="" method="get">
                    <div class="form-group">
                        <label for="Pnum"> Package number </label>

                        <input id="Pnum" class="form-control" type="text" name="Pnum" required>

                    </div>

                    <div class="form-group">
                        <label for="weight"> Weight </label>

                        <input id="weight" class="form-control" type="text" name="weight" required>

                    </div>
                    <div class="form-group">
                        <label for="dimensions"> Dimensions</label>
                        <input class="form-control" type="text" name="dimensions" id="dimensions">

                    </div>
                    <div class="form-group w-100">
                        <label for="insurance"> Insurance</label>
                        <input class="form-control" type="text" name="Insurance" id="insurance">

                    </div>

                    <label for="retail">Retail center:</label>

                    <select name="retail" id="retail">
                        <option value="v1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>


                    <label for="type">Type</label>

                    <select name="type" id="type">
                        <option value="Regular">Regular</option>
                        <option value="Fragile">Fragile</option>
                        <option value="Liguid">Liquid</option>
                        <option value="Chemical">Chemical</option>

                    </select>

                    <label for="status">status:</label>

                    <select name="status" id="status">
                        <option value="Transit">Transit</option>
                        <option value="delivered">delivered</option>
                        <option value="lost">lost</option>
                        <option value="damaged">damaged</option>

                    </select>

                    <label for="date">Date:</label>
                    <input type="date" name="date" value="date" id="date">




                    <input class="btn btn-light w-100" type="submit" value="send" name="send">

                </form>


                <?php
                if (isset($_GET['send'])) {
                    $send = $_GET['send'];
                    if ($send) {

                        if (isset($_GET["Pnum"])) {
                            $Pnum = $_GET["Pnum"];


                        }
                        if (isset($_GET["weight"])) {
                            $weight = $_GET["weight"];

                        }

                        if (isset($_GET["dimensions"])) {
                            $dimensions = $_GET["dimensions"];

                        }

                        if (isset($_GET["Insurance"])) {
                            $Insurance = $_GET["Insurance"];

                        }

                        if (isset($_GET["retail"])) {
                            $retial = $_GET["retail"];

                        }


                        if (isset($_GET["type"])) {
                            $type = $_GET["type"];

                        }
                        if (isset($_GET["date"])) {
                            $date = $_GET["date"];

                        }

                        if (isset($_GET["status"])) {
                            $status = $_GET["status"];

                        }

                        $customer = $_SESSION["user"];


                        $con = new mysqli("localhost", "root", "", "Project_ice321");
                        if ($con->connect_error) {
                            die("failed to connect to DB");
                        } else {

                            $sql = "insert into Package Values('$Pnum',$weight,$dimensions,$Insurance,$retial,$customer,'$type','$status','$date')";

                            if ($con->query($sql) === TRUE) {
                                echo "<h4> record inserted successfully </h4> ";
                            } else {
                                echo "<h4> Error: " . $sql . "<br>" . $con->error . "</h4>";
                            }
                        }





                    }


                }




                ?>


            </div>





        </div>

        <hr>



        <div class="container vh-100 justify-content-center text-center">


            <div class="row">
                <div class="col">
                    <h4>Remove packages</h4>


                    <form action="" method="post">

                        <div class="input-group">
                            <input name="Pnum2" type="text" class="form-control rounded"
                                placeholder="Enter package number" aria-label="Text" aria-describedby="search-addon"
                                for="delete" />
                            <button name="delete" type="submit" value="delete"
                                class="btn btn-light btn-outline-dark">delete</button>
                        </div>

                    </form>

                    <?php

                    if (isset($_POST["delete"])) {
                        $delete = $_POST["delete"];
                        if ($delete) {
                            if (isset($_POST["Pnum2"])) {
                                $pnum3 = $_POST["Pnum2"];


                            }

                            $user = $_SESSION['user'];

                            $con = new mysqli("localhost", "root", "", "Project_ice321");

                            if ($con->connect_error) {
                                die("failed to connect to DB");
                            } else {


                                $sql = "delete from Package where Pnum = '$pnum3'";
                                if ($con->query($sql) === TRUE) {
                                    echo "<h4> record deleted successfully </h4> ";
                                } else {
                                    echo "<h4> Error: " . $sql . "<br>" . $con->error . "</h4>";
                                }



                            }



                        }





                    } ?>



                </div>


                <div class="col">
                    <h4>Edit Package</h4>
                    <div class="card-body">

                        <form action="" method="get">
                            <div class="form-group">
                                <label for="Pnum"> Package number </label>

                                <input id="Pnum" class="form-control" type="text" name="Pnum" required>

                            </div>

                            <div class="form-group">
                                <label for="weight"> Weight </label>

                                <input id="weight" class="form-control" type="text" name="weight" required>

                            </div>
                            <div class="form-group">
                                <label for="dimensions"> Dimensions</label>
                                <input class="form-control" type="text" name="dimensions" id="dimensions">

                            </div>
                            <div class="form-group w-100">
                                <label for="insurance"> Insurance</label>
                                <input class="form-control" type="text" name="Insurance" id="insurance">

                            </div>

                            <label for="retail">Retail center:</label>

                            <select name="retail" id="retail">
                                <option value="v1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <label for="type">Type:</label>

                            <select name="type" id="type">
                                <option value="Regular">Regular</option>
                                <option value="Fragile">Fragile</option>
                                <option value="Liguid">Liquid</option>
                                <option value="damaged">Chemical</option>

                            </select>

                            <label for="status">status:</label>

                            <select name="status" id="status">
                                <option value="Transit">Transit</option>
                                <option value="delivered">delivered</option>
                                <option value="lost">lost</option>
                                <option value="damaged">damaged</option>

                            </select>

                            <label for="date">Date:</label>
                            <input type="date" name="date" value="date" id="date">



                            <input class="btn btn-light w-100" type="submit" value="send" name="edit">

                        </form>


                        <?php
                        if (isset($_GET['edit'])) {
                            $send = $_GET['edit'];
                            if ($send) {

                                if (isset($_GET["Pnum"])) {
                                    $Pnum = $_GET["Pnum"];


                                }
                                if (isset($_GET["weight"])) {
                                    $weight = $_GET["weight"];

                                }

                                if (isset($_GET["dimensions"])) {
                                    $dimensions = $_GET["dimensions"];

                                }

                                if (isset($_GET["Insurance"])) {
                                    $Insurance = $_GET["Insurance"];

                                }

                                if (isset($_GET["retail"])) {
                                    $retial = $_GET["retail"];

                                }

                                if (isset($_GET["status"])) {
                                    $status = $_GET["status"];

                                }
                                if (isset($_GET["type"])) {
                                    $type = $_GET["type"];

                                }
                                if (isset($_GET["date"])) {
                                    $status = $_GET["date"];

                                }


                                $customer = $_SESSION["user"];


                                $con = new mysqli("localhost", "root", "", "Project_ice321");
                                if ($con->connect_error) {
                                    die("failed to connect to DB");
                                } else {

                                    $sql = "update Package set Pnum = '$Pnum' , weight = '$weight' , dimensions = '$dimensions',Insurance = '$Insurance' ,ID = '$retial', C_id = '$customer' ,Type = $type ,Status = '$status' , Date = $date where Pnum = '$Pnum' ";

                                    if ($con->query($sql) === TRUE) {
                                        echo "<h4> record updated successfully </h4> ";
                                    } else {
                                        echo "<h4> Error: " . $sql . "<br>" . $con->error . "</h4>";
                                    }
                                }
                            }
                        } ?>







                    </div>


                </div>




















    </section>
    <hr>





    <section id="update">

        <div class="container vh-100 justify-content-center text-center">
            <h4>Update User Information</h4>
            <div class="card-body">
                <form action="" method="post">

                    <div class="form-group">
                        <label for="name"> Name </label>

                        <input id="name" class="form-control" type="text" name="name">

                    </div>
                    <div class="form-group">
                        <label for="email1"> Email </label>

                        <input id="email1" class="form-control" type="email1" name="email1">

                    </div>

                    <div class="form-group">
                        <label for="password1"> Password </label>

                        <input id="password1" class="form-control" type="password1" name="password1">

                    </div>


                    <input class="btn btn-dark w-100" type="submit" value="Update" name="Update">



                </form>


                <?php
                if (isset($_POST["Update"])) {

                    $update = $_POST["Update"];

                    if ($update) {
                        if (isset($_POST["name"])) {
                            $name = $_POST["name"];
                        }

                        if (isset($_POST["email1"])) {
                            $email1 = $_POST["email1"];
                        }

                        if (isset($_POST["password1"])) {
                            $password1 = $_POST["password1"];
                        }




                        $cid = $_SESSION["user"];



                        $con = new mysqli("localhost", "root", "", "Project_ice321");
                        if ($con->connect_error) {
                            die("failed to connect to DB");
                        } else {
                            $sql = "Update Customer set C_id = '$cid' , Name = '$name' , Email = '$email1',Password = '$password1' where C_id = '$cid' ";


                            if ($con->query($sql) === TRUE) {
                                echo "<h4> Information Updated </h4>";
                            } else {
                                echo "<h4> Error: " . $sql . "<br>" . $con->error . "</h4>";
                            }





                        }
                    }






                }


                ?>



            </div>





            <hr>
            <div class="container vh-100 justify-content-center text-center">

                <h2>Reports</h2>

                <hr>


                <h4>Show Payments</h4>

                <form action="" method="post">
                    <button class="btn btn-light btn-outline-dark" value="Payments" name="Payments" type="submit">Show
                        Payments</button>

                </form>




                <?php

                if (isset($_POST['Payments'])) {
                    $payment = $_POST['Payments'];
                }

                if ($payment) {
                    $con = new mysqli("localhost", "root", "", "Project_ice321");
                    if ($con->connect_error) {
                        die("failed to connect to DB");
                    } else {
                        $stmt = $con->prepare("select * from Payment");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);


                        echo "<table border='1'>
                        <tr>
                    <th>Package number</th>
                    <th>Status</th>
                        </tr>";

                        foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['P_num'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";

                        mysqli_close($con);
                    }
                }

                ?>




                <hr>


                <h4>List all Packages</h4>


                <form action="" method="post">

                    <div class="input-group">
                        <input name="id" type="text" class="form-control rounded" placeholder="Enter User id"
                            aria-label="Text" aria-describedby="search-addon" for="id" />
                        <button name="S_id" type="submit" value="S_id"
                            class="btn btn-light btn-outline-dark">Search</button>
                    </div>

                </form>


                <?php

                if (isset($_POST["S_id"])) {
                    $id = $_POST["S_id"];
                    if ($id) {
                        if (isset($_POST["id"])) {
                            $C_id = $_POST["id"];


                        }



                        $con = new mysqli("localhost", "root", "", "Project_ice321");

                        if ($con->connect_error) {
                            die("failed to connect to DB");
                        } else {


                            $stmt = $con->prepare("select * from Package where C_id =?");
                            $stmt->bind_param("s", $C_id);
                            $stmt->execute();

                            $result = $stmt->get_result();
                            $data = $result->fetch_all(MYSQLI_ASSOC);


                            echo "<table border='1'>
                        <tr>
                    <th>Package number</th>
                    <th>weight</th>
                    <th>Dimensions</th>
                    <th>Insurance</th>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                        </tr>";

                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['Pnum'] . "</td>";
                                echo "<td>" . $row['weight'] . "</td>";
                                echo "<td>" . $row['Dimensions'] . "</td>";
                                echo "<td>" . $row['Insurance'] . "</td>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['C_id'] . "</td>";
                                echo "<td>" . $row['Type'] . "</td>";
                                echo "<td>" . $row['Status'] . "</td>";
                                echo "<td>" . $row['Date'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table>";

                            mysqli_close($con);

                        }






                    }
                } ?>

                <hr>



                <h4>
                    List all Types of packages between two dates
                </h4>



                <form name="bwdatesdata" action="" method="post" action="">
                    <table width="100%" height="117" border="0">
                        <tr>
                            <th width="27%" height="63" scope="row">From Date :</th>
                            <td width="73%">
                                <input type="date" name="fdate" class="form-control" id="fdate">
                            </td>
                        </tr>

                        <tr>
                            <th width="27%" height="63" scope="row">To Date :</th>
                            <td width="73%">
                                <input type="date" name="tdate" class="form-control" id="tdate">
                            </td>
                        </tr>

                        <th width="27%" height="63" scope="row">Type :</th>
                            <td width="73%">
                            <select name="type" id="type">
                                <option value="Regular">Regular</option>
                                <option value="Fragile">Fragile</option>
                                <option value="Liguid">Liquid</option>
                                <option value="damaged">Chemical</option>

                            </select>
                                

                            </td>
                        <tr>
                            <th width="27%" height="63" scope="row"></th>
                            <td width="73%">
                                <button class="btn-light rounded btn btn-outline-dark" value="submit" type="submit"
                                    name="submit">Submit</button>
                        </tr>

                    </table>





                </form>

                <?php
if (isset($_POST["submit"])) {
    $submit = $_POST["submit"];
    if ($submit) {

        if (isset($_POST["fdate"])) {
            $fdate = $_POST["fdate"];


        }

        if (isset($_POST["tdate"])) {
            $tdate = $_POST["tdate"];


        }
        if (isset($_POST["type"])) {
            $type = $_POST["type"];


        }




        $con = new mysqli("localhost", "root", "", "Project_ice321");

        if ($con->connect_error) {
            die("failed to connect to DB");
        } else {


            $stmt = $con->prepare("select Pnum,Type , Date from Package where Date between '$fdate' and '$tdate' and Type = '$type'");

            $stmt->execute();

            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            echo "<table border='1'>
            <tr>
            <th>Project number</th>
        <th>Type</th>
       
        <th>Date</th>
            </tr>";
    
                foreach ($data as $row) {
                    echo "<tr>";
    
                    echo "<td>" . $row['Pnum'] . "</td>";
    
                    echo "<td>" . $row['Type'] . "</td>";
    
    
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "</tr>";
                }
    
                echo "</table>";
    
                mysqli_close($con);
    
            }






    }
} ?>


                <hr>



                <h4>
                    List Status of packages between two dates
                </h4>



                <form name="bwdatesdata" action="" method="post" action="">
                    <table width="100%" height="117" border="0">
                        <tr>
                            <th width="27%" height="63" scope="row">From Date :</th>
                            <td width="73%">
                                <input type="date" name="fdate" class="form-control" id="fdate">
                            </td>
                        </tr>

                        <tr>
                            <th width="27%" height="63" scope="row">To Date :</th>
                            <td width="73%">
                                <input type="date" name="tdate" class="form-control" id="tdate">
                            </td>
                        </tr>

                        <tr>
                            <th width="27%" height="63" scope="row">Status :</th>
                            <td width="73%">
                                <select name="status" id="status">
                                    <option value="Transit">Transit</option>
                                    <option value="delivered">delivered</option>
                                    <option value="lost">lost</option>
                                    <option value="damaged">damaged</option>

                                </select>

                            </td>

                        <tr>
                            <th width="27%" height="63" scope="row"></th>
                            <td width="73%">
                                <button class="btn-light rounded btn btn-outline-dark" value="submit" type="submit"
                                    name="submit">Submit</button>
                        </tr>


                        <tr>


                        

                    </table>







                </form>

                <?php
if (isset($_POST["submit"])) {
    $submit = $_POST["submit"];
    if ($submit) {

        if (isset($_POST["fdate"])) {
            $fdate = $_POST["fdate"];


        }

        if (isset($_POST["tdate"])) {
            $tdate = $_POST["tdate"];


        }
        if (isset($_POST["status"])) {
            $status = $_POST["status"];


        }




        $con = new mysqli("localhost", "root", "", "Project_ice321");

        if ($con->connect_error) {
            die("failed to connect to DB");
        } else {


            $stmt = $con->prepare("select Pnum, Status , Date from Package where Date between '$fdate' and '$tdate' and Status = '$status'");

            $stmt->execute();

            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);


            echo "<table border='1'>
        <tr>
        <th>Project number</th>
    <th>Status</th>
   
    <th>Date</th>
        </tr>";

            foreach ($data as $row) {
                echo "<tr>";

                echo "<td>" . $row['Pnum'] . "</td>";

                echo "<td>" . $row['Status'] . "</td>";


                echo "<td>" . $row['Date'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            mysqli_close($con);

        }






    }
} ?>


















            </div>






        </div>


    </section>















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>