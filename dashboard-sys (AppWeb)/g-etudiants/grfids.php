<?php
session_start();
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
 $RFID =  "";
 $RFID_err =  "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate RFID
    $input_RFID = trim($_POST["RFID"]);
    if (empty($input_RFID)) {
        $RFID_err = "Please enter an RFID.";
    } else {
        $RFID = $input_RFID;
    }


    // Check input errors before inserting in database
    if (empty($RFID_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO rfid (RFID, bookedUp) VALUES (?,0)";
       
        if ($stmt = mysqli_prepare($link, $sql) ) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_RFID);
            
            //Set parameters
           
            $param_RFID = $RFID;
         


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt) ) {
                // Records created successfully. Redirect to landing page
                header("location:create.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<html>

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php
    if ($_SESSION["name"]) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example" style="background-color: #549EF2!important;">
            <div class="container-xl">
                <a class="navbar-brand" href="index.php">Dashboard LSI</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample07XL">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <a class="btn btn-outline-light border" href="../logout.php"> Log out <span class="fa fa-sign-out"></a>

                </div>
            </div>
        </nav>

        <section class="ftco-section">
            <div class="container" style="margin-top: -10px;">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-2">
                        <h2 class="heading-section">Ajouter RFID</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                          
                            <h3 class="text-center mb-4">Infromations d'enseignant</h3>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="RFID" placeholder="RFID" class="form-control <?php echo (!empty($RFID_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $RFID_err; ?></span>
                                </div>
                                



                                <input type="submit" class="btn btn-primary" value="Ajouter">
                                <a href="create.php" class="btn btn-secondary ml-2">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>









    <?php
    } else header("Location: ../login.php");
    ?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<style>
    body {
        background: #F8F9FD;
    }
</style>

</html>