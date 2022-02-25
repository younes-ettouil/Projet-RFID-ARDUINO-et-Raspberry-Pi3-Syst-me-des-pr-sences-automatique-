<?php
session_start();
?>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <?php
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
                    <a class="btn btn-outline-light" href="../logout.php"> Log out <span class="fa fa-sign-out"></a>

                </div>
            </div>
        </nav>

        <div class="container">
            <div class="header">
            </div>
            <div class="row1-container">
                <div class="box blue">
                    <div style="display: flex;">
                        <h2>Liste des etudiants</h2>
                        <a class="btn btn-outline-primary" href="../g-etudiants/create.php" style="height: 65px; width:90px;margin:10px 0 0 80px">Ajouter Etudiant</a>
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135810.png" width="90px" alt="">
                    </div>
                    <br>
                    <?php
                    // Include config file
                    require_once "../config.php";

                    // Attempt select query execution
                    $sql = "select personne.id , personne.Nom,personne.Prenom,rfid.rfid ,semestre.nomSemestre from personne join semestre JOIN rfid where personne.Role like 'etudiant' and personne.idSemestre = semestre.id AND personne.rfid_id = rfid.id";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Nom</th>";
                            echo "<th>Prenom</th>";
                            echo "<th>RFID</th>";
                            echo "<th>Semestre</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['Nom'] . "</td>";
                                echo "<td>" . $row['Prenom'] . "</td>";
                                echo "<td>" . $row['rfid'] . "</td>";
                                echo "<td>" . $row['nomSemestre'] . "</td>";
                                echo "<td>";
                                echo '<a href="listpre.php?id=' . $row['id'] . '" class="mr-3" title="List des presences" data-toggle="tooltip"><span class="fa fa-list"></span></a>&nbsp&nbsp';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Modifer" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>&nbsp&nbsp';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="supprimer" data-toggle="tooltip" style="color:red;"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>aucun résultat.</em></div>';
                        }
                    } else {
                        echo "Oops! Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>


                </div>

            </div>


        </div>









    <?php
    } else header("Location:../login.php");
    ?>
    <script>
        // Basic example
        $(document).ready(function() {
            $('#dtBasicExample').DataTable({
                "paging": true // false to disable pagination (or any other option)
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
<style>
    html,
    body {
        background: #F8F9FD;
    }

    :root {
        --red: hsl(0, 78%, 62%);
        --cyan: hsl(180, 62%, 55%);
        --orange: hsl(34, 97%, 64%);
        --blue: hsl(212, 86%, 64%);
        --varyDarkBlue: hsl(234, 12%, 34%);
        --grayishBlue: hsl(229, 6%, 66%);
        --veryLightGray: hsl(0, 0%, 98%);
        --weight1: 200;
        --weight2: 400;
        --weight3: 600;
    }

    body {
        font-size: 15px;
        font-family: "Poppins", sans-serif;
        background-color: var(--veryLightGray);
    }

    .attribution {
        font-size: 13px;
        text-align: center;
    }

    .attribution a {
        color: hsl(228, 45%, 44%);
    }

    h1:first-of-type {
        font-weight: var(--weight1);
        color: var(--varyDarkBlue);
    }

    h1:last-of-type {
        color: var(--varyDarkBlue);
    }

    @media (max-width: 400px) {
        h1 {
            font-size: 1.5rem;
        }
    }

    .header {
        text-align: center;
        line-height: 0.8;
        margin-bottom: 50px;
        margin-top: 70px;
    }

    .header p {
        margin: 0 auto;
        line-height: 2;
        color: var(--grayishBlue);
    }

    .box p {
        color: var(--grayishBlue);
    }

    .box {
        border-radius: 5px;
        box-shadow: 0px 30px 40px -20px var(--grayishBlue);
        padding: 30px;
        margin: 0 20px 20px 20px;

        transition: 0.45s;

    }

    .box:hover {
        box-shadow: 0 4px 7px 0 rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    img {
        float: right;
    }

    @media (max-width: 450px) {
        .box {
            height: 700px;
        }
        .box .table {
            height: 400px;
            margin-left: -20px;
        }

    }

    @media (max-width: 950px) and (min-width: 450px) {
        .box {
            text-align: center;
            height: 700px;

        }
        .box .table {
            height: 400px;
            margin-left: -20px;
        }
    }

    .cyan {
        border-top: 3px solid var(--cyan);
    }

    .red {
        border-top: 3px solid var(--red);
    }

    .blue {
        border-top: 3px solid var(--blue);
    }

    .orange {
        border-top: 3px solid var(--orange);
    }

    h2 {
        color: var(--varyDarkBlue);
        font-weight: var(--weight3);
    }

    @media (min-width: 950px) {
        .row1-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row2-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box-down {
            position: relative;
            top: 150px;
        }

        .box {
            width: 50%;


        }

        .header p {
            width: 50%;
        }
    }
</style>

</html>