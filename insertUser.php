<?php

include 'config.php';

$code = null;
$teacherCode = 'teacherCode';

$firstLehr = true;

$reslehr = $db->query("SELECT * FROM TLehrer");
/* Abfrageergebnis ausgeben */
while ($dsatz = $reslehr->fetchArray(SQLITE3_ASSOC)) {
    $firstLehr = false;
}

$firstSchu = true;
$resschu = $db->query("SELECT * FROM TSchueler");
/* Abfrageergebnis ausgeben */
while ($dsatz = $resschu->fetchArray(SQLITE3_ASSOC)) {
    $firstSchu = false;
}

    /* Create Teacher */
    if(isset($_POST['teacherCode'])) {

        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
        $pwd_con = $_POST['pwd_con'];

        $res = $db->query("SELECT * FROM TLehrer");

        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            if($dsatz == $usr || $pwd != $pwd_con){
               header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
                $_SESSION["insertUser"] = "n";
            }else{
                $sqlstr = "INSERT INTO TLehrer (LehrUser, LehrVorname, LehrNachname, LehrPassword) VALUES ";
                $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd')");
                $db->close();
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
                $_SESSION["insertUser"] = "j";
            }
        }

        if($firstSchu){
            $sqlstr = "INSERT INTO TLehrer (LehrUser, LehrVorname, LehrNachname, LehrPassword) VALUES ";
            $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd')");
            $db->close();
            header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            $_SESSION["insertUser"] = "j";
        }
    }else{
        echo "Fehler Lehr";
    }


    /* Create Schueler
    if($code = "lol") {

        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
        $pwd_con = $_POST['pwd_con'];

        $res = $db->query("SELECT * FROM TSchueler");

        /* Abfrageergebnis ausgeben
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $first = false;
            if($dsatz == $usr || $pwd != $pwd_con){
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
                $_SESSION["insertUser"] = "n";
            }else{
                $sqlstr = "INSERT INTO TSchueler ( SchuUser, SchuVorname, SchuNachname, SchuPassword) VALUES ";
                $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd')");
                $db->close();
                header('http://localhost:63342/sPORTcLIPs_Florentin/index.php');
                $_SESSION["insertUser"] = "j";
            }
        }


        if($first){
            $sqlstr = "INSERT INTO TSchueler ( SchuUser, SchuVorname, SchuNachname, SchuPassword) VALUES ";
            $db->query($sqlstr . "('$usr','$vorname','$nachname','$pwd')");
            $db->close();
            header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            $_SESSION["insertUser"] = "j";
        }

    }else{
        echo "Fehler Schuüler";
    }*/

?>
