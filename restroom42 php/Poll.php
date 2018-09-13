<?php
class Poll
{
    private $host = 'localhost';
    private $user = 'id6889550_restroom42';
    private $password = 'Room42Rest!';
    private $database = 'id6889550_restroom42';
    private $pollTable = 'poll';
    private $dbConnect = false;


    public function __construct()
    {
        if (!$this->dbConnect) {
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if ($conn->connect_error) {
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else {
                $this->dbConnect = $conn;
            }
        }
        $adel = $this->delete_Attente();
        $EtageData = $this->getCountEtage();
        $WaitVotant = $this->getWaitVotant();
        $CountEtageparvotant =  $this->getCountEtageparvotant();

    }
    public function ecrire_log($errtxt)
    {
        $fp = fopen('log.txt', 'a+'); // ouvrir le fichier ou le créer
        fseek($fp, SEEK_END); // poser le point de lecture à la fin du fichier
        $nouverr = date("Y-m-d H:i:s") . " " . $errtxt . "\r\n"; // ajouter un retour à la ligne au fichier
        fputs($fp, $nouverr); // ecrire ce texte
        fclose($fp); //fermer le fichier

    }

    public function get_ip()
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

    private function getData($sqlQuery)
    {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('Error in query: ' . mysqli_error());
        }
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

    public function getCountEtage()
    {
        /*       $adel = $this->delete_Attente();
         */
/*
        $sqlQuery = "SELECT Numero_Etage , count(*) AS NB FROM `Etage` WHERE `IP_votant` != '" . $this->get_ip() . "' AND `IP_votant` != '00.00.00.00' GROUP BY Numero_Etage ORDER BY Numero_Etage";
  */
                $sqlQuery = "SELECT Numero_Etage , count(*) AS NB FROM `Etage` WHERE `IP_votant` != '00.00.00.00' GROUP BY Numero_Etage ORDER BY Numero_Etage";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $data = array();
        while ($row = mysqli_fetch_row($result)) {
            $this->ecrire_log('requete ' . $sqlQuery . ',' . $row[0] . ',' . $row[1]);
            $data[$row[0]] = $row[1];
        }
        return $data;
    }
/*
SELECT Numero_Etage , IP_votant,  date_expiration,CURRENT_TIMESTAMP() , TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage`  GROUP BY Numero_Etage  , IP_votant ORDER BY Numero_Etage , time_wait
 */
    public function getCountEtageparvotant()
    {
        /*       $adel = $this->delete_Attente();
         */
/*
        $sqlQuery = "SELECT Numero_Etage , IP_votant,   TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage` WHERE `IP_votant` != '" . $this->get_ip() . "' 
        GROUP BY Numero_Etage  , IP_votant ORDER BY Numero_Etage , time_wait
 ";
 */
         $sqlQuery = "SELECT Numero_Etage , IP_votant,   TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage` 
        GROUP BY Numero_Etage  , IP_votant ORDER BY Numero_Etage , time_wait
 ";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $data = array();
        $x = 1;
        $svip = '*';
        while ($row = mysqli_fetch_row($result)) {
             if ($row[1] == '00.00.00.00') {
                           $data["T" . $row[0]][0] = $row[2];
                                           $this->ecrire_log('requete00.00.00.00 ' . $sqlQuery . ' Error in query: ' . $row[0] . '  ' . $row[1] . '  ' . $row[2]);
            }
            else
            {
            if ($svip == $row[0]) {
                if ($x<6){
                    $data[$row[0]][$x] = $row[2];
                    $this->ecrire_log('requete ' . $sqlQuery . 'x=' . $x . ',' . $row[0] . ',' . $row[1] . ',' . $row[2]);
                    }
                $x = $x + 1;
            } else {
                $svip = $row[0];
                $x = 1;
                $data[$row[0]][$x] = $row[2];
                $this->ecrire_log('requete ' . $sqlQuery . 'x=' . $x . ',' . $row[0] . ',' . $row[1] . ',' . $row[2]);
                $x = $x + 1;
            }}
        }
        return $data;
    }
/*

SELECT Numero_Etage , IP_votant,   TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage` GROUP BY Numero_Etage  , IP_votant ORDER BY Numero_Etage
 */

/*
INSERT INTO `Etage`(`Numero_etage`, `IP_votant`, `date_expiration`) VALUES ('E1','63.210.32.84', '2018-05-28 18:13:18')
 */

    public function getWaitVotant()
    {
        /*       $adel = $this->delete_Attente();
         */
        
         $sqlQuery = "SELECT Numero_Etage, TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) AS time_wait FROM `Etage`  WHERE `IP_votant`= '" . $this->get_ip() . "'";

        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }
        $data = array();
        $data['V'] = "";
        while ($row = mysqli_fetch_row($result)) {
            $data[$row[0]] = $row[1];
          /*        printf ("%s (%s)\n", $row[0], $row[1]);
       */
        }
        return $data;
    }

    public function delete_Attente()
    {

        $sqlQuery = "DELETE FROM `Etage` WHERE date_expiration < CURRENT_TIMESTAMP()";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }

        return;
    }

    public function InsertEtageHistory($NEtage,$IPV)
    {
        $sqlQuery = "INSERT INTO `EtageHistory`(`Numero_etage`, `IP_votant`, `date_expiration`, `date_creation`) SELECT `Numero_etage`, `IP_votant`, `date_expiration` , CURRENT_TIMESTAMP() FROM `Etage`  WHERE Numero_etage = '" . $NEtage . "' AND `IP_votant`= '" . $IPV . "'";

        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }

        return;
    }

    public function create_Attente($NEtage,$IP)
    {

        if ($IP == "IP"){
            $IPV = $this->get_ip();
            $IPwait = "5";
                 $sqlQuery = "DELETE FROM `Etage` WHERE `Numero_etage` != '" . $NEtage . "' AND `IP_votant` = '" . $IPV . "'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if (!$result) {
            die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
        }

        }
        else
        {
         $IPV = "00.00.00.00";
                     $IPwait = "15";
        }


                     $this->ecrire_log('create attente  ' . $IP . ' IPV= ' . $IPV . ' Error in query: ' . $IPwait);
        $sqlQuery = " UPDATE `Etage` SET date_expiration = DATE_ADD(date_expiration, INTERVAL " . $IPwait . " MINUTE)  WHERE Numero_etage = '" . $NEtage . "' AND IP_votant = '" . $IPV . "'";

        $result = mysqli_query($this->dbConnect, $sqlQuery);

        /*                 $this->ecrire_log('requete ' . $sqlQuery . ' Error in query: ' .  mysqli_affected_rows($this->dbConnect) . mysqli_error($this->dbConnect)  );
         */
        if (!$result or mysqli_affected_rows($this->dbConnect) == 0) {
            $sqlQuery = "INSERT INTO `Etage`(`Numero_etage`, `IP_votant`, `date_expiration`) VALUES ('" . $NEtage . "','" . $IPV . "', DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL " . $IPwait . " MINUTE) )";
            $result2 = mysqli_query($this->dbConnect, $sqlQuery);
            if (!$result2) {
                $this->ecrire_log('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error($this->dbConnect));
                die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
            }
        }
        $this->InsertEtageHistory($NEtage,$IPV);
        $adel = $this->delete_Attente();

        return;
    }

    public function create_test()
    {
        $listeEtage = array("E3", "E2", "E1", "E0");
        $xdeb = rand(63, 88);
        for ($x = $xdeb; $x <= $xdeb + 5; $x++) {
            foreach ($listeEtage as &$ietage) {
                $ipvot = $x . '.210.32.84';
                $vminunte = rand(1, 15);

                $sqlQuery = " UPDATE `Etage` SET date_expiration = DATE_ADD(date_expiration, INTERVAL " . $vminunte . " MINUTE)  WHERE Numero_etage = '" . $ietage . "' AND IP_votant = '" . $ipvot . "' ";
/*
AND TIME( TIMEDIFF(date_expiration,CURRENT_TIMESTAMP())) < CAST('00:02:00' AS TIME)
*/
                $result = mysqli_query($this->dbConnect, $sqlQuery);

                /*               $this->ecrire_log('requete ' . $sqlQuery . ' Error in query: ' .  mysqli_affected_rows($this->dbConnect) . mysqli_error($this->dbConnect)  );
                 */
                if (!$result or mysqli_affected_rows($this->dbConnect) == 0) {

                    $sqlQuery = "INSERT INTO `Etage`(`Numero_etage`, `IP_votant`, `date_expiration`) VALUES ('" . $ietage . "','" . $ipvot . "', DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL " . $vminunte . " MINUTE) )";
                    $this->ecrire_log('requete ' . $sqlQuery . ' Error avant: ' . mysqli_error($this->dbConnect));

                    $result2 = mysqli_query($this->dbConnect, $sqlQuery);
                    if (!$result2) {
                        $this->ecrire_log('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error($this->dbConnect));
                        die('requete ' . $sqlQuery . ' Error in query: ' . mysqli_error());
                    }
                }
            }
        }
               $sqlQuery3 = "DELETE FROM `Etage` WHERE date_expiration > DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 9 MINUTE)";
        $result3 = mysqli_query($this->dbConnect, $sqlQuery3);
        if (!$result3) {
            die('requete ' . $sqlQuery3 . ' Error in query: ' . mysqli_error());
        }

        return;
    }

}
