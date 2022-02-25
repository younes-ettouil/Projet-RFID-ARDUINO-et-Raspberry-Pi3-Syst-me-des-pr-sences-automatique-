<?php
session_start();

require_once "../config.php";

$nom = $prenom = $role = $RFID = $idSemestre = "";
$nom_err = $prenom_err = $role_err = $RFID_err = $idSemestre_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_nom = trim($_POST["nom"]);
    if (empty($input_nom)) {
        $nom_err = "Nom invalide.";
    } elseif (!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s -]+$/")))) {
        $nom_err = "Nom invalide.";
    } else {
        $nom = $input_nom;
    }
    $input_prenom = trim($_POST["prenom"]);
    if (empty($input_prenom)) {
        $prenom_err = "Prenom invalide.";
    } elseif (!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $prenom_err = "Prenom invalide.";
    } else {
        $prenom = $input_prenom;
    }
    
    $input_RFID = trim($_POST["RFID"]);
    if (empty($input_RFID)) {
        $RFID_err = "RFID invalide..";
    } else {
        $RFID = $input_RFID;
    }

    $input_role = trim($_POST["role"]);
    if (empty($input_role)) {
        $role_err = "role invalide..";
    } else {
        $role = $input_role;
    }

    $input_idSemestre = 1;
    if (empty($input_idSemestre)) {
        $idSemestre_err = "idSemestre  invalide..";
    } else {
        $idSemestre = $input_idSemestre;
    }
 
    if (empty($nom_err) && empty($prenom_err) && empty($role_err)) {
 
        $sql = "INSERT INTO personne (Nom, Prenom, Role,rfid_id,idSemestre) VALUES (?,?,?,?,?)";
        $sql2 ="UPDATE rfid SET rfid.bookedUp=1 WHERE rfid.id=?";
        if ($stmt = mysqli_prepare($link, $sql) and $stmt2 = mysqli_prepare($link, $sql2)) {
            
            mysqli_stmt_bind_param($stmt, "sssss", $param_nom, $param_prenom, $param_role, $param_RFID, $param_idSemestre);
            mysqli_stmt_bind_param($stmt2,"i",$param_RFID);
            
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_role = $role;
            $param_RFID = $RFID;
            $param_idSemestre = $idSemestre;


            if (mysqli_stmt_execute($stmt) and mysqli_stmt_execute($stmt2) ) {
             
                header("location: list.php");
                exit();
            } else {
                echo "Oops! Try later";
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
    
    $query="select * from rfid"; 
    $query2="select * from semestre"; 
    
    $result=mysqli_query($link,$query);
    $result2=mysqli_query($link,$query2);
    if ($_SESSION["name"]) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example" style="background-color: #549EF2!important;">
            <div class="container-xl">
                <a class="navbar-brand" href="../index.php">Dashboard LSI</a>
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
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="nom" placeholder="Nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $nom_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom" placeholder="Prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="enseignant">
                                </div>

                                <div class="row">
                                <div class="form-group col-lg-9">
                                    <select class="form-select" name="RFID" aria-label="Default select example">
                                    <option selected>Choisir RFID</option>
                                        <?php while ($array = mysqli_fetch_row($result)) : ?>
                                            <?php if ($array[2]== false): ?>
                                            <option value="<?=$array[0]?>"><?php echo $array[1]; ?></option>
                                            <?php endif;?>
                                            <?php if ($array[2]== true): ?>
                                            <option value="<?=$array[0]?>" disabled><?php echo $array[1]; ?></option>
                                            <?php endif;?>
                                        <?php endwhile; ?>

                                    </select>
                                    <span class="invalid-feedback"><?php echo $RFID_err; ?></span>
                                </div>
                                <div class="col-lg-3 mt-lg-2 " >
                                    <a href="grfids.php"  ><span class="fa fa-plus">&nbsp; RFID</a>
                                </div>
                                </div>
                                <!-- <div class="form-group">
                                    <select class="form-select" name="idSemestre" aria-label="Default select example">
                                        <option selected>Choisir Semestre</option>
                                        <?php while ($array2 = mysqli_fetch_row($result2)) : ?>
                                        <option value="<?php echo $array2[0]; ?>"><?php echo $array2[1]; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <span class="invalid-feedback"><?php echo $idSemestre_err; ?></span>
                                </div> -->



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