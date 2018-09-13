<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<HTML>

<HEAD>
  <meta name="viewport" content="width=device-width, height=device-height">
  <TITLE>Staff 42</TITLE>

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
      $poll->create_Attente($_GET['etage'],"IP");
      unset($_GET['etage']);
    }

    if (isset($_GET['travaux'])) {
      $poll->create_Attente($_GET['travaux'],"TRAVAUX");
      unset($_GET['travaux']);
    }
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

        document.getElementById("my_form").action = "staff.php";
        document.getElementById("my_form").submit();

      }, 10000);
    </script>
    <script>
      function poll($etage,$WaitVotant,$lCountEtageparvotant) {

        if ($lCountEtageparvotant != ""){
            alert("Toilette unavailable");
            document.getElementById("my_form").action = "staff.php";
            document.getElementById("my_form").submit();
        }
        else {
        if ($WaitVotant != "" & $WaitVotant.substr(3,2) > 02 ) {
            alert("No more than 05 minutes");
            document.getElementById("my_form").action = "staff.php";
            document.getElementById("my_form").submit();

        }
        else
        {
        document.getElementById("my_form").action = "staff.php?etage=" + $etage;
        document.getElementById("my_form").submit();
        }}
      }
        function travaux($etage,$WaitVotant) {

        if ($WaitVotant != "" & $WaitVotant.substr(3,2) > 10 ) {
            alert("No more than 15 minutes");
            document.getElementById("my_form").action = "staff.php";
            document.getElementById("my_form").submit();

        }
        else
        {
        document.getElementById("my_form").action = "staff.php?travaux=" + $etage;
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
  /*  margin-bottom: : 25;*/
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
        width: 5vw;
        height: 5vh;
 background-size: contain ;
  }
  
  /* gestion des mots longs */

  textarea,
  table,
  td,
  th,
  code,
  pre,
  samp {
    width: 40px;
    height:25px;
    -webkit-hyphens: auto; /* césure propre */
    -moz-hyphens: auto;
    hyphens: auto;
    word-wrap: break-word; /* passage à la ligne forcé */
    /*    margin-bottom: 120vh;*/
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
 /*   content: "Version mobile du site";*/
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
        width: 5vw;
        height: 5vh;
      object-fit: scale-down;
        margin: 2;
 opacity: 0.7;
      }
      .bgwc { 
        width: 5vw;
        height: 5vh;
    /* The image used */
    background-image: url("wc.jpeg");
        background-repeat: no-repeat;
 background-size: contain ;

}
      .bgchantier { 
        width: 5vw;
        height: 5vh;
    /* The image used */
    background-image: url("attention-nettoyage-en-cours.jpg");
        background-repeat: no-repeat;
 background-size: contain ;

}
     .bgwait { 
        width: 5vw;
        height: 5vh;
    /* The image used */
    background-image: url("wit.gif");
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
    </style>

    <BODY>
      <div class="wrapper">

        <h1 class="bgwsign" >Staff Travaux Toilette</h1>
        <table style="100%">
          <form id="my_form" method="post" action=""></form>
      <?php
            foreach ($listeEtage as &$ietage) {

          if ($CountEtageparvotant["T" . $ietage][0] != ""){
                 echo '<tr class="bgchantier" >';
               }
               else
                {
                   echo '<tr class="bgwc">';
               }
              echo '<td  width="30%"><button id="'.$ietage.'t" onclick="travaux';
              echo "('" .$ietage. "',"; 
             echo "'" . $CountEtageparvotant["T" . $ietage][0]. "')";
            echo '"';   
            echo '<font size=5vw  color="Black">Toilette unavailable '.$ietage.' ? ' . $CountEtageparvotant["T" . $ietage][0] . '</font>';
           echo '</td></tr>';
        
       }
      ?>
      </div>
    </BODY>
</HTML>
