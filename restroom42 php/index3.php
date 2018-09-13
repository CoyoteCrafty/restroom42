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
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-118825017-1');
  </script>
  <?php
    include 'Poll.php';
    $poll = new Poll();
    $listeEtage = array("E3", "E2", "E1", "E0");

    if (isset($_GET['etage'])) {
      $poll->create_Attente($_GET['etage']);
      unset($_GET['etage']);
    }
    $adel = $poll->delete_Attente();
    $EtageData = $poll->getCountEtage();
    $WaitVotant = $poll->getWaitVotant();
    $CountEtageparvotant =  $poll->getCountEtageparvotant();
  ?>

    <script>
 /*     window.resizeTo(500, 500);
   */   // Update the count down every 1 second

      var x = setInterval(function () {

        document.getElementById("my_form").action = "index.php";
        document.getElementById("my_form").submit();

      }, 10000);
    </script>
    <script>
      function poll($etage,$WaitVotant) {

        if ($WaitVotant != "" & $WaitVotant.substr(3,2) > 05 ) {
            alert("pas plus de 10 minutes");
            document.getElementById("my_form").action = "index.php";
            document.getElementById("my_form").submit();

        }
        else
        {
        document.getElementById("my_form").action = "index.php?etage=" + $etage;
        document.getElementById("my_form").submit();
        }
      }
    </script>

    <style type="text/css">
      < !-- html {
        height: auto;
      }
      @media (max-width: 640px) {
  * {
    box-sizing: border-box;
  }
  
  /* passer body (et tous les éléments de largeur fixe) en largeur automatique */

  body {
    width: auto;
    margin: 0;
    padding: 0;
  }
  
  /* fixer une largeur maximale de 100% aux éléments potentiellement problématiques */

  img,
  table,
  td,
  blockquote,
  code,
  pre,
  textarea,
  input,
  iframe,
  object,
  embed,
  video {
    max-width: 100%;
  }
  
  /* conserver le ratio des images */

  img {
      height: auto;
      width: auto;
      object-fit: scale-down;
      margin: 2;
  }
  
  /* gestion des mots longs */

  textarea,
  table,
  td,
  th,
  code,
  pre,
  samp {

    -webkit-hyphens: auto; /* césure propre */
    -moz-hyphens: auto;
    hyphens: auto;
    word-wrap: break-word; /* passage à la ligne forcé */
  }
  
  code,
  pre,
  samp {
    white-space: pre-wrap; /* passage à la ligne spécifique pour les éléments à châsse fixe */
  }
  
  /* Passer à une seule colonne (à appliquer aux éléments multi-colonnes) */

  .element1,
  .element2 {
    float: none;
    width: auto;
  }
  
  /* masquer les éléments superflus */

  .hide_mobile {
    display: none !important;
  }
  
  /* Un message personnalisé */

  body:before {
    content: "Version mobile du site";
    display: block;
    text-align: center;
    font-style: italic;
    color: #777;
  }
}

      body {
        margin: 0;
        height: auto;
        padding: 0;
        color: black;
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
        width: 100%;
        height: 100%;
        object-fit: contain;
        margin: 2;
      }

      h1 {
        text-align: center;
        color: black;
        font-family: Futura, "Trebuchet MS", Arial, sans-serif;
        font-size: xx-large;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;
        line-height: 150%;
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
/*        width: 50%;
  */      height: 15%;
        min-height: 25px;
        margin: 0;
        margin-bottom: 100px;
        padding: 0;
        text-align: center;
        word-break: keep-all;
        position: relative;
        border: 0.5px solid black;

        font-family: Futura, "Trebuchet MS", Arial, sans-serif;
      }
    </style>

    <BODY>
      <div class="wrapper">
        <h1>Restroom 42</h1>
        <table style="100%">
          <form id="my_form" method="post" action=""></form>
      <?php
            foreach ($listeEtage as &$ietage) {
              echo '<tr >
                <td  width="30%">
                <p><font size=5vw  color="white">'.$ietage.'</font></p>
                <button id="'.$ietage.'b" onclick="poll';
              echo "('" .$ietage. "',"; 
            echo "'" .$WaitVotant[$ietage]. "')"; 
              echo '"><font size=2vw ';
              if ($WaitVotant[$ietage] != "") {
                echo '   color="red"        >you have been waiting for ' . $WaitVotant[$ietage] 
                 . ' <br>press here if you wait for the toilet 5 minutes more';
              } else {
                echo '   color="green">press here <br>if you wait for the toilet 5 minutes' ;
              }
              echo '</font></button></td><td width="70%" >';
              if ($EtageData[$ietage] > 0) {
                echo '      <TABLE cellspacing="0" width="100%">
                  <TR align="center"  COLSPAN=' .$EtageData[''.$ietage.''].'> ';
                echo '<div ><font size=1vw color="red">Queue size: ' . $EtageData['' . $ietage . ''] 
                  . ' other person(s)<br></font></div></TR><TR>';
                for ($x = 1; $x <= $EtageData[''.$ietage.'']; $x++) {
                  echo '<TD><img src="wait'. 
                  substr($CountEtageparvotant[$ietage][$x],3,2) . '.gif" alt="Attente"  > ';
                  /* <p><font size=3vw >'. 
                  substr($CountEtageparvotant[$ietage][$x],3,2) . '</font></p>*/
                }
              echo '    </TR>       </TABLE>';
            } 
            else {
              echo '<div ><font size=8vw color="#DC143C"><a>Vacancy</a></font></div>';
            }
          }
          echo '</td></tr>';
      ?>
      </div>
    </BODY>
</HTML>
