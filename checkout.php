<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Essentials</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <section class="">
		<?php
			include 'includes/header.php';
		?>

</section>
<?php

                     
						if(isset($_POST['save'])){
							include 'includes/config.php';
						
						
						
							$phonee = $_POST['phonee'];
							$fdate = $_POST['fdate'];
                            $ldate = $_POST['ldate'];
                            $address = $_POST['address'];
                            $pin = $_POST['pin'];
                            $city = $_POST['city'];
                            $cust_id = $_SESSION['u_id'];
                           $fname= $_SESSION['fname'];
                           $lname= $_SESSION['lname'];
                            $email=$_SESSION['email'];
                            $phonee=$_SESSION['phone'];
                            
                            $days=$ldate-$fdate;
                            function tdate($fdate,$ldate){
                                $diff=strtotime($ldate)-strtotime($fdate);
                                return abs($diff/86400);

                            }
                            $datediff=tdate($fdate,$ldate);
                        
                            if (empty($ldate) || empty($fdate) || empty($address) || empty($pin) || empty($city)) {
                                echo "<script type=\"text/javascript\">
                                        alert(\"Fill All The Fields.\");
                                        window.location = \"checkout.php\";
                                      </script>";
                                exit;
                            }
                            
                            $today = new DateTime();
                            $fdatet = new DateTime($fdate);
                            
                            if ($fdatet > $today) {
                                if ($fdate < $ldate) {
                                    if (strlen((string)$pin) == 6) {
                                        $qry = "INSERT INTO payment (cust_id, fname, lname, total_price, email, phoneno, from_date, last_date, address, pin, city, status)
                                                VALUES ('$cust_id', '$fname', '$lname', '$total', '$email', '$phonee', '$fdate', '$ldate', '$address', '$pin', '$city', 'pending')";
                                        $result = $conn->query($qry);
                            
                                        if ($result == TRUE) {
                                            $sql1 = "SELECT order_id FROM payment WHERE from_date = '$fdate' AND last_date = '$ldate' AND cust_id = '$cust_id'";
                                            $result2 = $conn->query($sql1);
                                            $row = mysqli_fetch_assoc($result2);
                                            $order_id = $row['order_id'];
                            
                                            echo "<script type=\"text/javascript\">
                                                    alert(\"Successfully Submitted\");
                                                    window.location.href = \"cnorder.php?dff=$datediff&oid=$order_id\";
                                                  </script>";
                                            exit;
                                        } else {
                                            echo "<script type=\"text/javascript\">
                                                    alert(\"Failed. Try Again\");
                                                    window.location = \"checkout.php\";
                                                  </script>";
                                            exit;
                                        }
                                    } else {
                                        echo "<script type=\"text/javascript\">
                                                alert(\"Enter a valid pin code.\");
                                                window.location = \"checkout.php\";
                                              </script>";
                                        exit;
                                    }
                                } else {
                                    echo "<script type=\"text/javascript\">
                                            alert(\"Enter a correct date.\");
                                            window.location = \"checkout.php\";
                                          </script>";
                                    exit;
                                }
                            } else {
                                echo "<script type=\"text/javascript\">
                                        alert(\"Enter a correct date.\");
                                        window.location = \"checkout.php\";
                                      </script>";
                                exit;
                            }
                        }
?>                            


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="home.php">Home</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <form action="" method="post">
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                       
                        
                      
                       
                        <div class="col-md-6 form-group">
                            <label>Rent From </label>
                            <input class="form-control" name="fdate" type="date" placeholder="cherthala">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Rent Till </label>
                            <input class="form-control" name="ldate" type="date" placeholder="cherthala">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line </label>
                            <input class="form-control" name="address" type="text" placeholder="cherthala">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" name="city" type="text" placeholder="Alappuzha">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>Pincode Code</label>
                            <input class="form-control" name="pin" type="text" placeholder="000-253">
                        </div>
      
                       
                    </div>
                </div>
                <div class="mb-5">
                    
                    <button type="submit" name="save" class="btn btn-block btn-primary font-weight-bold py-3">Sumbit</button>
                </div>
            </div>
           
                
               
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


    <section class="">
		<?php
			include 'includes/footer.php';
		?>

</section>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>