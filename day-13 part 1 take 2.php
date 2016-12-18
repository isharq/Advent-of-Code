<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
//ini_set('max_execution_time', 600); // 


$roundcounter = 0;

$map = array();

$input = "1364"; // real
$input = "10"; // test
	
$mazesize = 150; // real
//$mazesize = 10; // test


$startX = 31; $startY = 39; // real 
//$startX = 1; $startY = 1; // test

$finishX = 1; $finishY = 1; // real
//$finishX = 7; $finishY = 4; // test

function findwall($x,$y)
{
	global $input; 
	global $map;
	global $startX;
	global $startY;
	global $finishX;
	global $finishY;

	$temp = ($x*$x) + (3*$x) + (2*$x*$y) + $y + ($y*$y) + $input;
	
	
	$binary = decbin($temp);
	
	$tile = strlen(trim(str_replace("0","",$binary)));
	
	if ($x == $startX && $y == $startY)
	{
		$map[$x][$y] = "S";
		return; 		
	}
	
	if ($x == $finishX && $y == $finishY)
	{
		$map[$x][$y] = "E";
		return; 		
	}
	
	if ($tile %2 != 0)
	{
		$map[$x][$y] = "#";
	}
	else
	{
		$map[$x][$y] = " ";
	}
		
}

function generatemaze($output = FALSE)
{
	global $mazesize; 
	global $map;
	global $startX;
	global $startY;
	global $finishX;
	global $finishY;
	for ($y=0; $y <= $mazesize; $y++)
	{
		for ($x=0; $x <= $mazesize; $x++)
		{
			findwall ($x,$y);				
			
			if ($map[$x][$y] == " ") 
				{ $fun = "&nbsp;"; }
			else
				{ $fun = $map[$x][$y]; }

				if ($output) { echo "<tt>" . $fun . "</tt>";
			
			}

		}
		 if ($output) { echo "<br />"; }
	}
	
}

function search_path($x, $y) {	
	global $map;
	if (!isset($map[$x][$y])) { return false; }
	if ($map[$x][$y] == 'E') { return true; }
	if (($map[$x][$y] != ' ')
	&&($map[$x][$y] != 'S')) { return false; }
	
	$map[$x][$y] = '.';
	
	if (search_path($x, $y+1)) { return true; }
	if (search_path($x+1, $y)) { return true; }
	if (search_path($x-1, $y)) { return true; }
	if (search_path($x, $y-1)) { return true; }
	
	$maze[$x][$y] = 'x';	
	return false;
}



generatemaze(TRUE);

echo "<h3>Let's do this!</h3>\n\n";

search_path($startX, $startY);
$maze[$startX][$startY] = 'S';
$output = '';
foreach($map as $line) { $output .= implode('',$line)."\n"; }

echo str_replace('x',' ',$output);



?>

<h1>DONE</h1>