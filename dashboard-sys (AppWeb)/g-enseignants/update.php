<?php
session_start();
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$nom = $prenom = $role = $RFID = $idSemestre = "";
$nom_err = $prenom_err = $role_err = $RFID_err = $idSemestre_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate nom
    $input_nom = trim($_POST["nom"]);
    if (empty($input_nom)) {
        $nom_err = "Please enter a nom.";
    } elseif (!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s -]+$/")))) {
        $nom_err = "Please enter a valid nom.";
    } else {
        $nom = $input_nom;
    }
    $input_prenom = trim($_POST["prenom"]);
    if (empty($input_prenom)) {
        $prenom_err = "Please enter a prenom.";
    } elseif (!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $prenom_err = "Please enter a valid prenom.";
    } else {
        $prenom = $input_prenom;
    }
    // Validate RFID
    $input_RFID = trim($_POST["RFID"]);
    if (empty($input_RFID)) {
        $RFID_err = "Please enter an RFID.";
    } else {
        $RFID = $input_RFID;
    }

    $input_role = trim($_POST["role"]);
    if (empty($input_role)) {
        $role_err = "Please enter an role.";
    } else {
        $role = $input_role;
    }

    $input_idSemestre = trim($_POST["idSemestre"]);
    if (empty($input_idSemestre)) {
        $idSemestre_err = "Please enter an idSemestre.";
    } else {
        $idSemestre = $input_idSemestre;
    }
    $id =  trim($_GET["id"]);
    // Check input errors before inserting in database
    if (empty($nom_err) && empty($prenom_err) && empty($role_err)) {
        // Prepare an insert statement
        $sql = "UPDATE personne SET nom=?, prenom=?, role=?,rfid_id=?,idSemestre=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql) ){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_nom, $param_prenom, $param_role, $param_RFID, $param_idSemestre,$param_id);
      
            // Set parameters
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_role = $role;
            $param_RFID = $RFID;
            $param_idSemestre = $idSemestre;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: list.php");
                exit();
            } else{
                echo "Oops! Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM personne WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $nom = $row["Nom"];
                    $prenom = $row["Prenom"];
                    $role = $row["Role"];
                    $RFID = $row["rfid_id"];
                    $idSemestre = $row["idSemestre"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ../error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }
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
                <a class="navbar-brand" href="#">Dashboard LSI</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample07XL">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <a class="btn btn-outline-light" href="logout.php"> Log out <span class="fa fa-sign-out"></a>

                </div>
            </div>
        </nav>

        <section class="ftco-section">
            <div class="container" style="margin-top: -10px;">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-2">
                        <h2 class="heading-section">Ajouter Enseignant</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/3750/3750020.png" width="90px" alt="" style="float: right ;">
                            </div>
                            <h3 class="text-center mb-4">Infromations d'enseignant</h3>
                            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="nom" placeholder="Nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                                    <span class="invalid-feedback"><?php echo $nom_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom" placeholder="Prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prenom; ?>">
                                    <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="enseignant">
                                </div>
                                <input type="hidden" name="RFID" value="<?php echo $RFID; ?>">

                                <div class="form-group">
                                <label class="form-label ml-lg-2"> Semestre  de <?=$nom .":S". $idSemestre ?></label>
                                    <select class="form-select"  name="idSemestre" aria-label="Default select example">
                                        <option selected>Choisir Semestre</option>
                                        <option value="1">Semestre 1</option>
                                        <option value="2">Semestre 2</option>
                                        <option value="3">Semestre 3</option>
                                        <option value="4">Semestre 4</option>
                                        <option value="5">Semestre 5</option>
                                        <option value="6">Semestre 6</option>
                                    </select>
                                    <span class="invalid-feedback"><?php echo $idSemestre_err; ?></span>
                                </div>



                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="list.php" class="btn btn-secondary ml-2">Cancel</a>
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
            $('[data-toggle="tooltip"]').tooltip();});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<style>
    body {
        background: #F8F9FD;
    }
</style>

</html>