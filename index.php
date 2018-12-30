<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login sPORTcLIPs</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
        </head>

  <body id="page-top">

    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">sPORTcLIPs</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="registrieren.php">Registrieren</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Login</h1>
        <p class="lead">Login to see all the great clips</p>
      </div>
    </header>

    <p style="text-align: center; font-size: 1.5em; color: red; padding-top: 2%">
        <?php

    include 'config.php';

        $res = $db->query("SELECT * FROM TUser");

        if(isset($_POST['submit'])){
            $user = $_POST['usr'];
            $pwd = $_POST['pwd'];

            $res = $db->query("SELECT * FROM TUser where UsrId = '$user' and UsrPassword = '$pwd'");

            /* Abfrageergebnis ausgeben */
            while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
                header('Location: ./galerie.php');
                $_SESSION["user"] = $dsatz['UsrType'];
                $_SESSION["id"] = $dsatz['UsrId'];
                $_SESSION["vorname"] = $dsatz['UsrVorname'];
                $_SESSION["UsrNachname"] = $dsatz['UsrType'];
                exit;

            }

            echo "Wrong Password or User";

            /* Verbindung zur Datenbankdatei wieder lösen */
            $db->close();
        }
        ?>
        </p>

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">


            <form method="post" action="index.php">
            <div class="form-group">
              <label for="usr">Username:</label>
              <input type="text" class="form-control" name="usr" required>
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="pwd" required>
              </div>
              <button type="submit" class="btn btn-default" name="submit">Submit</button><a href="galerie.php" onclick="<?php $_SESSION["user"] = "guest" ?>"> login as guest</a>
            </form>
          </div>
        </div>
      </div>


    </section>


    <!-- Footer -->
    <footer>

        <p>Copyright &copy; Florentin Nüesch 2018</p>

      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

  </body>

</html>
