<?php


     $host = 'localhost';
     $user = 'id6889550_restroom42';
     $password = 'Room42Rest!';
     $database = 'id6889550_restroom42';
     $pollTable = 'poll';
     $dbConnect = false;

    /*    if (!$dbConnect) {*/
            $conn = new mysqli($host, $user, $password, $database);
            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $dbConnect = $conn;
            }
      /*  }*/
        $sqlQuery = "DELETE FROM `Etage` WHERE date_expiration < CURRENT_TIMESTAMP()";
        $result = mysqli_query($dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }

                   $sqlQuery = "SELECT Numero_Etage , count(*) AS NB FROM `Etage` WHERE `IP_votant` != '00.00.00.00' GROUP BY Numero_Etage ORDER BY Numero_Etage";
        $result = mysqli_query($dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $EtageData = array();
        while ($row = mysqli_fetch_row($result)) {
            ecrire_log('requete ' . $sqlQuery . ',' . $row[0] . ',' . $row[1]);
            $EtageData[$row[0]] = $row[1];
        }
                $sqlQuery = "SELECT Numero_Etage, TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage`  WHERE `IP_votant`= '" . get_ip() . "'";

        $result = mysqli_query($dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $WaitVotant = array();
        $WaitVotant['V'] = "";
        while ($row = mysqli_fetch_row($result)) {
            $WaitVotant[$row[0]] = $row[1];
          /*        printf ("%s (%s)\n", $row[0], $row[1]);
       */
        }
     $sqlQuery = "SELECT Numero_Etage , IP_votant,   TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage` 
        GROUP BY Numero_Etage  , IP_votant ORDER BY Numero_Etage , time_wait
 ";
        $result = mysqli_query($dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $CountEtageparvotant = array();
        $x = 1;
        $svip = '*';
        while ($row = mysqli_fetch_row($result)) {
             if ($row[1] == '00.00.00.00') {
                           $CountEtageparvotant["T" . $row[0]][0] = $row[2];
                                           ecrire_log('requete00.00.00.00 ' . $sqlQuery . ' Error in query: ' . $row[0] . '  ' . $row[1] . '  ' . $row[2]);
            }
            else
            {
            if ($svip == $row[0]) {
                if ($x<6){
                    $CountEtageparvotant[$row[0]][$x] = $row[2];
                    ecrire_log('requete ' . $sqlQuery . 'x=' . $x . ',' . $row[0] . ',' . $row[1] . ',' . $row[2]);
                    }
                $x = $x + 1;
            } else {
                $svip = $row[0];
                $x = 1;
                $CountEtageparvotant[$row[0]][$x] = $row[2];
                ecrire_log('requete ' . $sqlQuery . 'x=' . $x . ',' . $row[0] . ',' . $row[1] . ',' . $row[2]);
                $x = $x + 1;
            }}
        }

	/*	$out['$EtageData'] = $EtageData;
		$out['$WaitVotant'] = $WaitVotant;
		$out['$CountEtageparvotant'] = $CountEtageparvotant;
*/
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
	$crud = $_GET['crud'];
}


if($crud = 'read'){

	$out['EtageData'] = $EtageData;
	$out['WaitVotant'] = $WaitVotant;
	$out['CountEtageparvotant'] = $CountEtageparvotant;

		$out['members'] = $EtageData;

}


$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();


    function ecrire_log($errtxt)
    {
        $fp = fopen('log.txt', 'a+'); // ouvrir le fichier ou le créer
        fseek($fp, SEEK_END); // poser le point de lecture à la fin du fichier
        $nouverr = date("Y-m-d H:i:s") . " " . $errtxt . "\r\n"; // ajouter un retour à la ligne au fichier
        fputs($fp, $nouverr); // ecrire ce texte
        fclose($fp); //fermer le fichier

    }

    function get_ip()
    {
        // IP si internet partagé
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        // IP derrière un proxy
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        // Sinon : IP normale
        else {
            return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        }
    }

    function getData($sqlQuery)
    {
        $result = mysqli_query($dbConnect, $sqlQuery);
        if (!$result) {
            die('Error in query: ' . mysqli_error());
        }
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

?>