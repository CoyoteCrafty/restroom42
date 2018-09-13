
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<HTML>
 <HEAD>
  <TITLE>Restroom 42</TITLE>
  <META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=iso-8859-1'>
<script type="text/javascript">
<!--

//-->
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118825017-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-118825017-1');
</script>
<?php
include 'Poll.php';
$poll = new Poll();
?>
<script>
function AttenteE2($Netage)
{
    <?php

$Etagecreate = $poll->create_Attente($Netage);

?>

}
</script>
<style type="text/css">
<!--
body {margin:0;background-color:Gainsboro;}

#led {top:16px;left:16px;width:353px;height:353px;position:absolute;}
#e3 { display: inline-block;width: 49%;margin: 0;text-align: center;}

#e2 { display: inline-block;width: 49%;margin: 0;text-align: center;}

#e1 { display: inline-block;width: 49%;margin: 0;text-align: center;}
#e0 { display: inline-block;width: 49%;margin: 0;text-align: center;}
    h1 {
        text-align: center;
        color: black;
	font-family: Futura, "Trebuchet MS", Arial, sans-serif;
	font-size: 100px;
	font-style: normal;
	font-variant: normal;
	font-weight: 500;
	line-height: 155px;
    }
        table {
        width: 100%;
        height: 100%;
    }

    td,
    th {
        text-align: center;
        position: relative;
        border: 2px solid black;
                font-size: 5vw;
                	font-family: Futura, "Trebuchet MS", Arial, sans-serif;
    }
//-->
</style>

 </HEAD>
<?php
$EtageData = $poll->getCountEtage();
?>
 <BODY >
 	    <div class="wrapper">
 	<h1>Restroom 42</h1>
 		<table style="100%">
            <form action="">
			<tr>
                <td >
                    <p>e3</p>
                    <button id="e3b" onclick="<?php
$Etagecreate = $poll->create_Attente('E3');
?>"><font size=100% color="red">Attente</font></button>
                </td>
                <td>
<?php
if ($EtageData['E3'] > 1) {
    echo '<p id="e3"><font size=100% color="red">Occupied By ' . $EtageData['E3'] . '</font></p>';} 
    else {
    echo '<p id="e3"><font size=100% color="green">Vacancy</font></p>';
}
?>
                </td>
			</tr>
            </form>
			<tr>
				<td>
                    <p>e2</p>
                   <input type="button" value="Attente"  id="e2b" onclick="<?php
$Etagecreate = $poll->create_Attente('E2');
?>">

                </td>
                <td>
<?php
if ($EtageData['E2'] > 1) {
    echo '<p id="e2"><font size=100% color="red">Occupied By ' . $EtageData['E2'] . '</font></p>';} 
    else {
    echo '<p id="e2"><font size=100% color="green">Vacancy</font></p>';
}
?>
                </td>
			</tr>
			<tr>
				<td>
                    <p>e1</p>
                     <button id="e1b" onclick="<?php
$Etagecreate = $poll->create_Attente('E1');
?>"><font size=100% color="red">Attente</font></button>

                </td>
                <td>
<?php
if ($EtageData['E1'] > 1) {
    echo '<p id="e1"><font size=100% color="red">Occupied By ' . $EtageData['E1'] . '</font></p>';} 
    else {
    echo '<p id="e1"><font size=100% color="green">Vacancy</font></p>';
}
?>
                 </td>
			</tr>
			<tr>
				<td>
                    <p>e0</p>
                    <button id="e0b" onclick="<?php
$Etagecreate = $poll->create_Attente('E0');
?>"><font size=100% color="red">Attente</font></button>


                 </td>
                <td>
<?php
if ($EtageData['E0'] > 1) {
    echo '<p id="e0"><font size=100% color="red">Occupied By ' . $EtageData['E0'] . '</font></p>';} 
    else {
    echo '<p id="e0"><font size=100% color="green">Vacancy</font></p>';
}
?>
                </td>
			</tr>
		</div>
 </BODY>
</HTML>