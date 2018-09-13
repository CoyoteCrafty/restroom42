<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<HTML>

<HEAD>
  <meta name="viewport" content="width=device-width, height=device-height">
  <TITLE>Restroom 42</TITLE>

  <script type="text/javascript">
    <!--

    //-->
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!--
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118825017-1"></script>
-->

  <?php
    error_reporting(0);
    include 'Poll.php';
    $poll = new Poll();
    $listeEtage = array("E3", "E2", "E1", "E0");

    if (isset($_GET['etage'])) {
      $tetage = $_GET['etage'];
   /*   $tetage = mysqli_real_escape_string($poll, $tetage);*/
      $poll->create_Attente( $tetage,"IP");
      unset($_GET['etage']);
    }
/*
    if (isset($_GET['travaux'])) {
      $poll->create_Attente(mysqli_real_escape_string($poll, $_GET['travaux']),"TRAVAUX");
      unset($_GET['travaux']);
    }
  */
    $adel = $poll->delete_Attente();
    $EtageData = $poll->getCountEtage();
    $WaitVotant = $poll->getWaitVotant();
    $CountEtageparvotant =  $poll->getCountEtageparvotant();

  ?>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-118825017-1');
  </script>

    <script>
 /*     window.resizeTo(500, 500);
   */   // Update the count down every 1 second

      var x = setInterval(function () {

        document.getElementById("my_form").action = "index.php";
        document.getElementById("my_form").submit();

      }, 10000);
    </script>
    <script>
      function poll($etage,$WaitVotant,$lCountEtageparvotant) {

        if ($lCountEtageparvotant != ""){
            alert("Toilette unavailable");
            document.getElementById("my_form").action = "index.php";
            document.getElementById("my_form").submit();
        }
        else {
        if ($WaitVotant != "" & $WaitVotant.substr(3,2) > 02 ) {
            alert("No more than 05 minutes");
            document.getElementById("my_form").action = "index.php";
            document.getElementById("my_form").submit();

        }
        else
        {
        document.getElementById("my_form").action = "index.php?etage=" + $etage;
        document.getElementById("my_form").submit();
        }}
      }
        function travaux($etage,$WaitVotant) {

        if ($WaitVotant != "" & $WaitVotant.substr(3,2) > 10 ) {
            alert("No more than 15 minutes");
            document.getElementById("my_form").action = "index.php";
            document.getElementById("my_form").submit();

        }
        else
        {
        document.getElementById("my_form").action = "index.php?travaux=" + $etage;
        document.getElementById("my_form").submit();
        }
      }

    </script>

    <style type="text/css">
      < !-- html {
        height: auto;
      }
 
      body {

        height: auto;

        color: #777777;
        background-color: white;
        background-image: url(background.jpg);
        background-repeat: repeat;
      }

      a {
        animation-duration: 400ms;
        animation-name: blink;
        animation-iteration-count: infinite;
        animation-direction: alternate;
      }

      @keyframes blink {
        from {
          opacity: 1;
        }

        to {
          opacity: 0;
        }
      }

      img {

    background-size: contain ;
 opacity: 0.7;
      }
      .bgwc { 
        width: 4vw;
        height: 4vh;
    /* The image used */
    background-image: url("okay.png");
        background-repeat: no-repeat;
    background-size: contain ;
     background-position: 25% 25%; 


}
      .bgchantier { 
        width: 4vw;
        height: 4vh;
    /* The image used */
    background-image: url("nettoyageencours.jpg");
        background-repeat: no-repeat;
 background-size: contain ;
     background-position: 25% 25%; 

}
     .bgwait { 
        width: 4vw;
        height: 4vh;
    /* The image used */
    background-image: url("flash.gif");
        background-position: center; 
        background-repeat: no-repeat;
 background-size: contain ;
}
     .bgwsign { 
        width: 25vw;
        height: 25vh;
    /* The image used */
    background-image: url("restroom42-sign.png");
        background-position: center; 
        background-repeat: no-repeat;
 background-size: contain ;

}
      h1 {
        text-align: center;
        color: white;
        font-family: Futura, "Trebuchet MS", Arial, sans-serif;
        font-size: x-large;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;

      }

      table {
        width: 100%;
        height: auto;
        padding: 0;
        border-collapse: collapse;
        table-layout: fixed;
        margin-right: 0;
        margin-left: 0;
      }

      td,
      th {
       width: 50%;
      height: 15vh; 
  /*    width: 40 px;
    height:25px;*/
        min-height: 25px;
        margin: 0;

        padding: 0;
        text-align: center;
        word-break: keep-all;
        position: relative;
        border: 1px solid black;
        overflow:hidden
        text-align: center;
        vertical-align: middle;  
        opacity: 0.7;

        font-family: Futura, "Trebuchet MS", Arial, sans-serif;
      }
        .cop{
                 color: white;
    font-family: monospace;
    font-style: italic;
    text-align: right;
  }
    </style>

    <BODY>
      <div >

        <h1 ><img src="restroom42-sign.png" alt="Restroom42" width="75vw"> </h1>
        <table style="100%">
          <form id="my_form" method="post" action=""></form>
      <?php
            foreach ($listeEtage as &$ietage) {

          if ($CountEtageparvotant["T" . $ietage][0] != ""){
                 echo '<tr class="bgchantier" >';
                             echo '<TD ><font size=3vw  style="font-weight:bold;" style="text-align:left;" color="red">Toilet unavailable '.$ietage.' for ' . $CountEtageparvotant["T" . $ietage][0] . ' Minutes<br></font>';
               }
               else
                {
                   echo '<tr class="bgwc">';
                   echo '<TD ><font  style="font-weight:bold;" style="text-align:center;" size=5vw  color="red">'.$ietage. '<br></font>';
            echo '</button>
                <button id="'.$ietage.'b" onclick="poll';
              echo "('" .$ietage. "',"; 
            echo "'" .$WaitVotant[$ietage]. "',"; 

             echo "'" . $CountEtageparvotant["T" . $ietage][0]. "')";
              echo '"><font size=2vh ';
              if ($WaitVotant[$ietage] != "") {
                echo '   color="red"  >you have been waiting for ' . $WaitVotant[$ietage] ;
                 if ( substr($WaitVotant[$ietage],3,2) < 01 ) {
                echo ' <br>press here if you wait for the toilet 5 minutes more';
              }
              } else {
                echo '   color="green">press here <br>if you wait for the toilet 5 minutes' ;
              }
               }
              echo '</font></button></td><td width="70%" >';
              if ($EtageData[$ietage] > 0) {
                echo '      <TABLE cellspacing="0" width="100%">

                  <TR align="center"  COLSPAN=06> ';
                  /*
                                    <TR align="center"  COLSPAN=' .$EtageData[''.$ietage.''].'> ';*/
                echo '<div ><font size=3vw color="red">' . $EtageData['' . $ietage . ''] ;
                 if ($EtageData[$ietage] < 2  ) {
                  echo ' person waiting<br></font></div></TR><TR>';
                }
                else
                {
            echo ' people waiting<br></font></div></TR><TR>';

                }
         /*       for ($x = 1; $x <= $EtageData[''.$ietage.'']; $x++) {*/
                for ($x = 1; $x <= 5; $x++) {
    /*              echo '<TD><img src="wait'. 
                  substr($CountEtageparvotant[$ietage][$x],3,2) . '.gif" alt="Attente"  > ';*/
                  if (substr($CountEtageparvotant[$ietage][$x],3,2) != ""){
                    echo  '<TD <font class="bgwait" size=2vh color="black"  style="font-weight:bold;" style="text-align:center;" style="vertical-align:center">'. 
                    substr($CountEtageparvotant[$ietage][$x],3,2) . '</font></TD> ';
                  }
                else
                  {
                  echo  '<TD></TD> ';
                }   
                     }
                                if ($EtageData[$ietage] > 5  ) {
              echo  '<TD><font class="bgwait" size=4vh color="black"  style="font-weight:bold;" style="text-align:center;" style="vertical-align:center">++</font></TD> ';
                }
                else
                {
        echo  '<TD></TD> ';

                }
              echo '</TR></TABLE>';
            } 
            else {
              echo '<div ><font size=6vw color="#DC143C"><a>Vacancy</a></font></div>';
            }
          }
          echo '</td></tr>';
      ?>
       </table>
      </div>
        <footer>

    <p class="cop">&#169;olepicar,mduclos,krashid-</p>
  </footer>
    </BODY>

</HTML>
