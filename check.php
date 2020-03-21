<!DOCTYPE HTML>
<html>
<head>
    <title>answer</title>
    <meta charset="utf-8">
    <link href="stylesheet.css" rel="stylesheet">

</head>

<body>
<?php

if (session_id()==="") session_start();

$start = microtime(true);
date_default_timezone_set("UTC");

$currentTime = time() + 3 * 3600;

$x = (float)$_GET["x"];
$yStr = (string)$_GET["y"];
$a = str_replace(",", ".", $yStr);
$y = (float)$a;

// 

$rStr = (string)$_GET["r"];
$b = str_replace(",", ".", $rStr);
$r = (float)$b;

if ($_GET["y"] == "-0" || $_GET["y"] == "-0.0" || $_GET["y"] == "-0.00") $y = (float)0.0;
if ($_GET["r"] == "-0" || $_GET["r"] == "-0.0" || $_GET["r"] == "-0.00") $r = (float)0.0;


if  (!($x ===-2.0 || $x === -1.5 || $x === -1.0 || $x === -0.5 || $x === 0.0 ||
    $x === 0.5 || $x === 1.0|| $x === 1.5|| $x===2.0))
    die("<p align='center'>Координата X указана неверно</p>");
if ($y < -5 || $y > 3)
    die("<p align='center'> Координата Y указана неверно </p>");
if ($r < 1 || $r > 4)
    die("<p align='center'> Радиус R указан неверно </p>"); 

if (!isset($_SESSION['responses'])) $_SESSION['responses']=array();

$response = new Response($x, $y, $r, $currentTime);
array_push($_SESSION['responses'],$response);

$time=(float)round(microtime(true)-$start,4);
if ($time==0) $time='Менее 0.0001';

echo "<p align='right' class='response-content' id='time'> Сейчас ".date("H:i:s", $currentTime)."</p>";
echo "<p align='left' class='response-content'> Точка ($x;$y) "; echo $response->check_area()? "":"не"; echo " входит в область с радиусом $r </p>";
echo "<p align='left' class='response-content'>Время проверки: ".$time." сек.</p>";

$response->setTime($time);
echo
"<table class='block' id='responsesTable'> 
<thead>
<tr >
<th> <h2>Х</h2></th>
<th> <h2>Y</h2></th>
<th> <h2>R</h2></th>
<th> <h2>Текущее время</h2></th>
<th> <h2>Время проверки</h2></th>
<th> <h2>Результат</h2></th>

</tr>
</thead>";

foreach (array_reverse($_SESSION['responses']) as $i=>$response){
    $t = date("H:i:s", $response->currentTime);
    echo "<tr>
<td>$response->x</td>
<td>$response->y</td>
<td>$response->r</td>
<td>$t</td>
<td>$response->time</td> ";
    echo $response->check_area()? "<td>yes </td> </tr>" : "<td>no</td> </tr>";

}

echo "</table>";

// 

class Response{
    public $x;
    public $y;
    public $r;
    public $currentTime;
    public $time;

    function __construct($x,$y,$r, $currentTime)
    {
        $this->x=$x;
        $this->y=$y;
        $this->r=$r;
        $this->currentTime=$currentTime;
    }

    function setTime($time) {
        $this->time = $time;
    }

    //
    function check_area(){
        if ( 
            (($this->x >= 0) && ($this->y >= 0) && ($this->x <= $this->r) && ($this->y <= $this->r)) ||  /*I четверть*/
            (($this->x <= 0) && ($this->y >= 0) && ($this->y <= (0.5 * $this->r + x) ) ) ||   /*II четверть*/
            (($this->x <= 0) && ($this->y <= 0) && (($this->x * $this->x + $this->y * $this->y) <= $this->r))/*IV четверть*/
            )         
            return true;
        else
            return false;
    }
}
?>
<!--  -->




</body>

</html>



