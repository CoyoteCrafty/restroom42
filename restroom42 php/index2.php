<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<HTML>
 <HEAD>
    <meta name="viewport" content="width=device-width, height=device-height">
  <TITLE>Restroom 42</TITLE>
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">

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
  function gtag(){dataLayer.push(arguments);}
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
window.resizeTo(800,800);
// Update the count down every 1 second

var x = setInterval(function() {

    document.getElementById("my_form").action="index.php";
    document.getElementById("my_form").submit();

}, 10000);

</script>
<script>
function pollE0($etage)
{
    $etage = 'E0';
    document.getElementById("my_form").action="index.php?etage=" + $etage;
    document.getElementById("my_form").submit();
}
function pollE1($etage)
{
        $etage = 'E1';
    document.getElementById("my_form").action="index.php?etage=" + $etage;
    document.getElementById("my_form").submit();
}
function pollE2($etage)
{
        $etage = 'E2';
    document.getElementById("my_form").action="index.php?etage=" + $etage;
    document.getElementById("my_form").submit();
}
function pollE3($etage)
{
        $etage = 'E3';
    document.getElementById("my_form").action="index.php?etage=" + $etage;
    document.getElementById("my_form").submit();
}
// progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

var bar = new ProgressBar.Circle(container, {
  color: '#aaa',
  // This has to be the same size as the maximum width to
  // prevent clipping
  strokeWidth: 4,
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 1400,
  text: {
    autoStyleContainer: false
  },
  from: { color: '#aaa', width: 1 },
  to: { color: '#333', width: 4 },
  // Set default step function for all animate calls
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

    var value = Math.round(circle.value() * 100);
    if (value === 0) {
      circle.setText('');
    } else {
      circle.setText(value);
    }

  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';

bar.animate(1.0);  // Number from 0.0 to 1.0
</script>

<style type="text/css">
<!--
html {
  height: 100%;
}
body {margin:0;
  height: 100%;
  padding: 0;
color:black;
background-color:white;
background-image:url(fond.jpg);
background-repeat:repeat;}
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
#container {
  margin: 20px;
  width: 200px;
  height: 200px;
  position: relative;
}
#e3 { display: inline-block;width: 49%;margin: 0;text-align: center;}

#e2 { display: inline-block;width: 49%;margin: 0;text-align: center;}

#e1 { display: inline-block;width: 49%;margin: 0;text-align: center;}
#e0 { display: inline-block;width: 49%;margin: 0;text-align: center;}
#E3b{
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: normal;
                    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    }
    #E2b{
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: normal;
                    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    }
    #E1b{
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: normal;
                    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    }#E0b{
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: normal;
                    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
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
        height: 100%;
	margin-right: 0;
	margin-left: 0;
    }

    td,
    th {
              width: 50%;
        min-height: 50px;
        height: 25%;
        margin: 0;
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: 10%;
                    font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    }
	

</style>

 <BODY >
        <div class="wrapper">
    <h1>Restroom 42</h1>
        <table style="100%">
            <form id="my_form"  method="post" action=""></form>
<?php
            foreach ($listeEtage as &$ietage) {
echo '
            <tr height="20%">
                <td  width="50%">
                    <p><font size=5% >'.$ietage.'</font></p>

                     <button id="'.$ietage.'b" onclick="poll' .$ietage.'()">
        <font size=3% ';
                    if ($WaitVotant[$ietage] != "") {
               echo '   color="red">you have been waiting for ' . $WaitVotant[$ietage] . ' <br>press here if you wait for the toilet 5 minutes more';
                    } else {
                     echo '   color="green">press here <br>if you wait for the toilet 5 minutes' ;

                    }
                   echo '</font></button>
                </td>
                <td width="50%" >';

if ($EtageData[$ietage] > 0) {
 echo '      <TABLE border="0" cellspacing="0" width="100%">
                <TR align="center">';
                echo '<TD><p id="container"></p><TD><p id="' . $ietage . '"><font size=3% color="red">Queue size: ' . $EtageData['' . $ietage . ''] . ' person<br></font></p>';

    for ($x = 1; $x <= $EtageData[''.$ietage.'']; $x++) {
        echo '<TD><img src="atente.gif" alt="Attente" width="50" height="50">  <p><font size=3% >'.$CountEtageparvotant[$ietage][$x].'</font></p>';
    }
    echo '           </TABLE>';
} 
    else {
    echo '<p id="'.$ietage.'"><font size=4% color="#DC143C"><a>Vacancy</a></font></p>';
}
}
           echo '     </td>
            </tr>'
    ?>     
        </div>
 </BODY>

</HTML>
