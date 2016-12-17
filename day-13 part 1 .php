<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('max_execution_time', 300); // 


$roundcounter = 0;

$map = array();

function findwall($x,$y)
{
	global $input; 
	global $map;

	$temp = ($x*$x) + (3*$x) + (2*$x*$y) + $y + ($y*$y) + $input;
	
	
	$binary = decbin($temp);
	
	$tile = strlen(trim(str_replace("0","",$binary)));
	
	if ($tile %2 != 0)
	{
		$map[$x][$y] = "#";
	}
	else
	{
		$map[$x][$y] = ".";
	}
		
}


$input = "1364";


for ($y=0; $y <= 500; $y++)
{
	for ($x=0; $x <= 500; $x++)
	{
		findwall ($x,$y);

	
		if ($x == 31 && $y == 39)
		{
			echo "<tt><strong>O</strong></tt>"; 
		}
		else
		{		echo "<tt>" . $map[$x][$y] . "</tt>";
			
		}

	}
	 echo "<br />";
}

$restart = TRUE;
$lowestsolution = 1000000000;

$solutions = 0;
$attempt = 0; 
$prevdirection = 5; 

while ($solutions < 10000)
{
	if ($restart == TRUE)
	{
		$restart = FALSE;
		$tryX = 31;	$tryY = 39;		
		$steps = 0; 
		$attempt++; 
	}
	
	// echo "Now at $tryX,$tryY / "; 
	
	$direction = rand(1,4);
		
	if ($direction == 1)
	{
		if ($prevdirection == 3) { continue; }
		$prevdirection = 1; 
		if ($tryY < 1) { continue; } // cant go up from zero
		if ($map[$tryX][$tryY-1] == "#") { continue; }
		$tryY = $tryY - 1;
		$steps++;
	}
	else if ($direction == 3)
	{
		if ($prevdirection == 1) { continue; }
		$prevdirection = 3; 
		if ($map[$tryX][$tryY+1] == "#") { continue; }
		$tryY = $tryY + 1; 
		$steps++;
	}
	else if ($direction == 2)
	{
		if ($prevdirection == 4) { continue; }
		$prevdirection = 2; 
		if ($map[$tryX+1][$tryY] == "#") { continue; }
		$tryX = $tryX + 1; 
		$steps++;
	}
	else if ($direction == 4)
	{
		if ($prevdirection == 2) { continue; }
		$prevdirection = 4; 
		if ($tryX < 1) { continue; } // cant go left from zero
		if ($map[$tryX-1][$tryY] == "#") { continue; }
		$tryX = $tryX - 1; 
		$steps++;
	}
	
	if ($tryX > 500) { $restart = TRUE; echo "fail. ($attempt) "; }
	if ($tryX < 0) 	  { $restart = TRUE; echo "fail. ($attempt) "; }
	if ($tryY > 500) { $restart = TRUE; echo "fail. ($attempt) "; }
	if ($tryY < 0) 	  { $restart = TRUE; echo "fail. ($attempt) "; }
	
	flush();
	
	if ($tryX == 1 AND $tryY == 1)
	{
		echo "$steps... ";
		if ($steps < $lowestsolution)
		{
			echo "<p><strong>New best solution = $steps</strong> - ";
			$lowestsolution = $steps; 
		}
		$solutions++; 
		$restart = TRUE;
	}
	
}



?>

<h1>DONE</h1>