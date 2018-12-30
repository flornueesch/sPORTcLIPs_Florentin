<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>galerie sPORTcLIPs</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

  </head>

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
              <a class="nav-link js-scroll-trigger" href="index.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>Galerie</h1>
        <p class="lead">Hello <?php include 'config.php';
        echo $_SESSION["vorname"];?>, below are viedos about sports and stuff</p>
      </div>
    </header>


    <!-- Page Content -->
    <div class="container">

        <div style="text-align: center; font-size: 1.5em; color: #007bff; padding-top: 2%">
            <?php


            if(isset($_POST['videoupload'])) {

                //Quelle: https://www.w3schools.com/php/php_file_upload.asp
                $target_dir = "videos/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $filename = basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.<br>";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "mp4" && $imageFileType != "mov") {
                    echo "Sorry, only mp4, mov files are allowed.<br>";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.<br>";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";

                        $_SESSION["VidUpload"] = 0;
                        $beschriebung = $_POST['des'];
                        $schlagwort = $_POST['vidname'];
                        $usrid = $_SESSION["id"];

                        $sqlstr = "INSERT INTO TVideos (VidName, VidSchlagwort, VidBeschreibung, UsrId) VALUES ";
                        $db->query($sqlstr . "('$filename', '$schlagwort', '$beschriebung', '$usrid')");

                    } else {
                        echo "Sorry, there was an error uploading your file.<br>";
                    }
                }

            }

            unset($_POST['videoupload']);

            if(isset($_POST['delete'])){

                $file = $_POST['delete'];
                echo $file;
                echo unlink("./videos/$file");
                $db->query("delete from TVideos where VidName = '$file'");
            }




            ?>
        </div>
        <br><br>

        <div class="col-lg-8 mx-auto">


            <form method="post" action="galerie.php">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="Search.." name="search">
                </div>
                <button type="submit" style="width: 49%" class="btn btn-default">Submit</button>
                <button type="submit" style="width: 49%; float: right" name="reset" value="reset" class="btn btn-default">Reset</button>
            </form>

        </div>


        <div class="row">
        <?php
        if(isset($_POST['search'])) {
            $schlagwort = $_POST['search'];
        }

        if(isset($_POST['reset'])) {
            $schlagwort = '';
        }


        if(isset($_POST['search'])){

            $res = $db->query("SELECT * FROM TVideos where VidSchlagwort LIKE '%$schlagwort%'");
        }else{
            $res = $db->query("SELECT * FROM TVideos");
        }



        $beschreibung = '';
        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $file = $dsatz["VidName"];
            $beschreibung = $dsatz["VidBeschreibung"];
            $schlagwort = $dsatz["VidSchlagwort"];
            $id = $dsatz["VidNummer"];
            $upUsrId = $dsatz["UsrId"];

            $pfad = "videos/".$file;
        ?>






            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <video id="<?=$schlagwort;?>" width="100%" height="auto" controls>
                        <source src="<?php echo $pfad; ?>" type="video/mp4">
                        <source src="<?php echo $pfad; ?>" type="video/ogg">
                        Your browser does not support HTML5 video.
                    </video>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#"><?php echo $schlagwort." (".$file.")"?></a>
                        </h4>
                        <p class="card-text"><?php echo $beschreibung?>
                        <p>This Viedo was uploaded by the user: <?php echo $upUsrId; ?></p></p>

                        <button onclick="setPlaySpeed('<?=$schlagwort;?>')" type="button" class="btn btn-primary">Slow Motion (x0.5)</button>
                        <button onclick="resetPlaySpeed('<?=$schlagwort;?>')" type="button" class="btn btn-secondary">Reset</button><br><br>

                        <?php
                        if($_SESSION["user"] == 'Lehrer'){
                            ?>
                            <p>
                                <form action="galerie.php" method="post">
                                <button type="submit" style="width: 100%" class="btn btn-default" name="delete" value="<?php echo $file?>">Delete</button>
                            </form>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php } ?>



        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
<?php if($_SESSION["user"] == 'Lehrer' || $_SESSION["user"] == 'Schüler'){ ?>
    <section id="about">
        <div class="container">
            <div class="row">
                <div style="text-align: center; font-weight: lighter" class="col-lg-8 mx-auto">
                    <h1>Upload video</h1><br>
                    <p style="font-size: 1.2em">Here, you can upload a sportclip.</p><br>
                    <form method="post" action="insertVid.php">
                        <button type="submit" class="btn btn-default" style="width: 100%" name="submit">Upload Video</button><br><br><br>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <?php }?>

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
