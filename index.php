<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Scrolling Nav - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

      <?php
      $dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
      /* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
      $db = new SQLite3("$dbdir/sq3.db");

      $db->query("create table if not exists TLehrer(
LehrId int primary key AUTOINCREMENT,
LehrVorname String not null,
LehrNachname String not null,
LehrUser String not null,
LehrPassword String not null
);");


      $db->query("create table if not exists TSchueler(
Schuid int primary key AUTOINCREMENT,
SchuVorname String not null,
SchuNachname String not null,
SchuUser String not null,
SchuPassword String not null
);");

      $db->close();
      ?>

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

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">


            <form method="post" action="bestaetigung.php">
            <div class="form-group">
              <label for="usr">Username:</label>
              <input type="text" class="form-control" id="usr">
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
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
