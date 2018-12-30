<?php

include 'config.php';


$unique = true;

$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$usr = $_POST['usr'];
$pwd = $_POST['pwd'];
$pwd_con = $_POST['pwd_con'];
$teachercode = $_POST['teacherCode'];

$res = $db->query("SELECT * FROM TUser");

/* Abfrageergebnis ausgeben */
while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
    if($dsatz["UsrId"] == $usr){
        $unique = false;
    }
}

    /* Create User */
        if ($unique === false || $pwd !== $pwd_con) {

            echo"Fehler";
            header('Location: ./registrieren.php');

        } else {

            /* Create Lehrer */
            if (isset($_POST['teacherCode']) && $teachercode === "teacherCode") {
                echo"Lehrer";
                $sqlstr = "INSERT INTO TUser (UsrId, UsrVorname, UsrNachname, UsrPassword, UsrType) VALUES ";
                $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd', 'Lehrer')");
                header('Location: ./index.php');
            }else{
                echo "Fehler Lehrer";
            }

            /* Create Schueler */
            if ($teachercode !== '') {
                echo "Fehler Schüler";
            }else{
                echo"Schueler";
                $sqlstr = "INSERT INTO TUser (UsrId, UsrVorname, UsrNachname, UsrPassword, UsrType) VALUES ";
                $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd', 'Schüler')");
                header('Location: ./index.php');
            }
        }


?>
