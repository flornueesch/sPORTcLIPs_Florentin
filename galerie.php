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

  </head>

  <?php
  include 'config.php';

  echo $_SESSION["user"];

  if(isset($_POST['videoupload'])) {

      //Quelle: https://www.w3schools.com/php/php_file_upload.asp
      $target_dir = "videos/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $filename = basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if ($imageFileType != "mp4" && $imageFileType != "mov") {
          echo "Sorry, only mp4, mov files are allowed.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

              $beschriebung = $_POST['des'];

              $sqlstr = "INSERT INTO TVideos (VidPfand, VidBeschreibung) VALUES ";
              $db->query($sqlstr . "('$filename', '$beschriebung')");

          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }
  }



  ?>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Galerie</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Galerie</h1>
        <p class="lead">Below are viedos about sports and stuff</p>
      </div>
    </header>


    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <?php
        $res = $db->query("SELECT * FROM TVideos");

        $beschreibung = '';
        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $file = $dsatz["VidPfand"];
            $beschreibung = $dsatz["VidBeschreibung"];

            $pfad = "videos/". $file;

        ?>


            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <video height="302px" controls>
                            <source src="<?php $pfad ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#"><?php echo $file?></a>
                        </h4>
                        <p class="card-text"><?php echo $beschreibung?></p>
                    </div>
                </div>
            </div>

            <?php }?>



        </div>
        <!-- /.row -->

        <!-- Pagination
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>-->

    </div>
    <!-- /.container -->

    <section id="about">
        <div class="container">
            <div class="row">
                <div style="text-align: center; font-weight: lighter" class="col-lg-8 mx-auto">
                    <h1>Upload video</h1><br>
                    <form method="post" action="insertVid.php">
                        <button type="submit" class="btn btn-default" style="width: 100%" name="submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <form action="insertVid.php">
        <button type="submit" class="btn btn-default"></button>
    </form>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Florentin Nüesch 2018</p>
      </div>
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
