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
                    <a class="btn btn-outline-light" href="logout.php"> Log out <span class="fa fa-sign-out"></a>

                </div>
            </div>
        </nav>

        <div class="container">
            <div class="header">
                <h1>Bienvenu Monsieur <?= $_SESSION["name"]; ?></h1>
                <p>L'application de gestion des absences est une plateforme que vous pourrez acquérir pour automatiser la planification des absences des membres de l'université quels soit  enseignant ou étudiant.</p>
            </div>
            <div class="row1-container">
                <div class="box blue">
                    <a href="./g-enseignants/list.php" style="text-decoration: none;">
                        <h2>Gestion des enseignants</h2>
                        <p>Vous pouvez ajouter,modifier et supprimer un enseignant</p>
                        <img src="https://cdn-icons-png.flaticon.com/512/3750/3750020.png" width="90px" alt="">
                    </a>
                </div>
                <div class="box blue">
                    <a href="./g-presences/index.php" style="text-decoration: none;">
                        <h2>Gestion des Presences</h2>
                        <p>Vous pouvez gérer la presence des enseignants et des étudiants</p>
                        <img src="https://cdn-icons-png.flaticon.com/512/2666/2666436.png" width="90px" alt="">
                    </a>
                </div>

                <div class="box blue">
                    <a href="./g-etudiants/list.php" style="text-decoration: none;">
                        <h2>Gestion des Etudiants</h2>
                        <p>Vous pouvez ajouter,modifier et supprimer un étudiant</p>
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135810.png" width="90px" alt="">
                    </a>
                </div>
                

            </div>


        </div>





       



    <?php
    } else header("Location:login.php");
    ?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
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
        cursor: pointer;
        transition: 0.45s;
        
    }
    .box:hover{
        box-shadow: 0 4px 7px 0 rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    img {
        float: right;
    }

    @media (max-width: 450px) {
        .box {
            height: 200px;
            
        }
    }

    @media (max-width: 950px) and (min-width: 450px) {
        .box {
            text-align: center;
            height: 200px;
            
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
            width: 20%;
            cursor: pointer;
        }

        .header p {
            width: 50%;
        }
    }
</style>

</html>