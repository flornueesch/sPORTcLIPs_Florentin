<?php

$dbdir = 'Z:\Eigene Dateien\IWeb\sPORTcLIPs_Florentin';
/* Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen */
$db = new SQLite3("$dbdir/sq3.db");

$code = '';
$teacherCode = 'teacherCode';

if(isset($_POST['code'])){
    $code = $_POST['code'];
}

if(isset($_POST['usr']) && isset($_POST['pwd']) && isset($_POST['pwd_con'])&& isset($_POST['vorname'])&& isset($_POST['nachname'])) {

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
                echo "nö";
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }else{
                echo "Gemacht";
                $db->query("insert into TLehrer values (null,".$vorname.",".$nachname.",".$user.",".$pwd.")");
                $db->close();
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }
        }
    }

    /* Create Schueler */
    if($code != $teacherCode) {

        $user = $_POST['vorname'];
        $pwd = $_POST['nachname'];
        $pwd = $_POST['pwd'];
        $pwd = $_POST['pwd_con'];

        $res = $db->query("SELECT * FROM TSchueler");

        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            if($dsatz == $user || $pwd != $pwd_con){
                echo "nö";
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }else{
                echo "Gemacht";
                $db->query("insert into TSchueler values (null,".$vorname.",".$nachname.",".$user.",".$pwd.")");
                $db->close();
                header('Location: http://localhost:63342/sPORTcLIPs_Florentin/index.php');
            }
        }

    }

}


?>
