<?php

$dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
/* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
$db = new SQLite3("$dbdir/sq3.db");

$code = '';
$teacherCode = 'teacherCode';
$first = true;

if(isset($_POST['code'])){
    $code = $_POST['code'];
}

    echo "Warte";
    /* Create Teacher */
    if(isset($_POST['code']) && $code == $teacherCode) {

        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
        $pwd_con = $_POST['pwd_con'];

        $res = $db->query("SELECT * FROM TLehrer");

        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            if($dsatz == $user || $pwd != $pwd_con){
                //header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }else{
                $sqlstr = "INSERT INTO TLehrer (LehrVorname, LehrNachname, LehrUser, LehrPassword) VALUES ";
                $db->query($sqlstr . "('".$vorname."','".$nachname."','".$usr."','".$pwd."')");
                $db->close();
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }
        }

        if($first){
            $sqlstr = "INSERT INTO TLehrer (LehrVorname, LehrNachname, LehrUser, LehrPassword) VALUES ";
            $db->query($sqlstr . "('".$vorname."','".$nachname."','".$usr."','".$pwd."')");
            $db->close();
            header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
        }
    }

    /* Create Schueler */
    if($code != $teacherCode) {


        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $usr = $_POST['usr'];
        $pwd = $_POST['pwd'];
        $pwd_con = $_POST['pwd_con'];

        $res = $db->query("SELECT * FROM TSchueler");

        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            $first = false;
            if($dsatz == $user || $pwd != $pwd_con){
                //header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }else{
                $sqlstr = "INSERT INTO TSchueler (SchuVorname, SchuNachname, SchuUser, SchuPassword) VALUES ";
                $db->query($sqlstr . "('".$vorname."','".$nachname."','".$usr."','".$pwd."')");
                $db->close();
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }
        }


        if($first){
            $sqlstr = "INSERT INTO TSchueler (SchuVorname, SchuNachname, SchuUser, SchuPassword) VALUES ";
            $db->query($sqlstr . "('".$vorname."','".$nachname."','".$usr."','".$pwd."')");
            $db->close();
            header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
        }

    }




?>
