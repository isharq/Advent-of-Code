<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ini_set('max_execution_time', 600); // 

function gendisc($positions, $position)
{
	$string = str_pad("0",$positions,"1");
	
	echo "<br />" . $string . " has " . strlen($string) . " positions now. ";
	
	$string = rotatedisc($string,$position);
	
	echo " after rot $position it is $string";
	
	return $string; 
}

function rotatedisc($string,$number=1)
{
	for($i = 1; $i <= $number; $i++)
	{
	 	$string = substr($string,-1) . substr($string,0,strlen($string)-1);
	}
	
	return $string; 
}

$disc[1] = gendisc(13,1);
$disc[2] = gendisc(19,10);
$disc[3] = gendisc(3,2);
$disc[4] = gendisc(7,1);
$disc[5] = gendisc(5,3);
$disc[6] = gendisc(17,5);

//test
//$disc[1] = gendisc(5,4);
//$disc[2] = gendisc(2,1);

	
	
$solution = FALSE;
$time = 0;

function checksolution ()
{
	global $disc;
	
	for ($d=1; $d <= count($disc); $d++)
	{
		$pos = strlen($disc[$d])-$d;
		if ($disc[$d][$pos] != 0) { return FALSE; }      		
	}
	return TRUE; 
}
	
while ($solution == FALSE)
{
	$time++; 
	
	for($d=1; $d <= count($disc); $d++)
	{
		$disc[$d] = rotatedisc($disc[$d]);
	}
	
	if (checksolution() == TRUE)
		{ echo "<p><strong>FOUND A SOLUTION</strong> at time <strong>t= $time</strong></p>";}
}
	
	
	?>
<ol>
<li>Disc #1 has 13 positions; at time=0, it is at position 1.</li>
<li>Disc #2 has 19 positions; at time=0, it is at position 10.</li>
<li>Disc #3 has 3 positions; at time=0, it is at position 2.</li>
<li>Disc #4 has 7 positions; at time=0, it is at position 1.</li>
<li>Disc #5 has 5 positions; at time=0, it is at position 3.</li>
<li>Disc #6 has 17 positions; at time=0, it is at position 5.</li>
</ol>