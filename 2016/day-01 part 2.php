<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$input = "R4, R3, L3, L2, L1, R1, L1, R2, R3, L5, L5, R4, L4, R2, R4, L3, R3, L3, R3, R4, R2, L1, R2, L3, L2, L1, R3, R5, L1, L4, R2, L4, R3, R1, R2, L5, R2, L189, R5, L5, R52, R3, L1, R4, R5, R1, R4, L1, L3, R2, L2, L3, R4, R3, L2, L5, R4, R5, L2, R2, L1, L3, R3, L4, R4, R5, L1, L1, R3, L5, L2, R76, R2, R2, L1, L3, R189, L3, L4, L1, L3, R5, R4, L1, R1, L1, L1, R2, L4, R2, L5, L5, L5, R2, L4, L5, R4, R4, R5, L5, R3, L1, L3, L1, L1, L3, L4, R5, L3, R5, R3, R3, L5, L5, R3, R4, L3, R3, R1, R3, R2, R2, L1, R1, L3, L3, L3, L1, R2, L1, R4, R4, L1, L1, R3, R3, R4, R1, L5, L2, R2, R3, R2, L3, R4, L5, R1, R4, R5, R4, L4, R1, L3, R1, R3, L2, L3, R1, L2, R3, L3, L1, L3, R4, L4, L5, R3, R5, R4, R1, L2, R3, R5, L5, L4, L1, L1"; 

$location["northsouth"] = 0;
$location["westeast"] = 0;


$inputarray = explode (",", $input);

$orientation = "north";

function storecheck ($northsouth, $westeast)
{
	global $locationregistry; 

	$storestring = "$northsouth" . "," . "$westeast";
	
	foreach ($locationregistry as $location)
	{
		if ($location == $storestring)
		{
			echo("<h1>Found it!</h1>");
			
			echo("<p>Final location is at $northsouth N and $westeast E</p>");
			
			$distancemoved = abs($northsouth ) + abs($westeast);
			
			echo "<h2>We have moved a total of $distancemoved blocks from our starting position.</h2>";
				
				die();
		}
	}
	
	$locationregistry[] = $storestring;
		
}

function turn ($direction, $orientation)
	{
		global $orientation;
		if ($direction == "R")
		{
			echo "turning right from " . $orientation;
			if ($orientation == "north")
			{
				$orientation = "east";
			}
			else if ($orientation == "east")
			{
				$orientation = "south";
			}
			else if ($orientation == "south")
			{
				$orientation = "west";
			}
			else if ($orientation == "west")
			{
				$orientation = "north";
			}
			
			echo " so now facing " . $orientation; 

		}
		if ($direction == "L")
		{
			echo "turning left from $direction";
			if ($orientation == "north")
			{
				$orientation = "west";
			}
			else if ($orientation == "west")
			{
				$orientation = "south";
			}
			else if ($orientation == "south")
			{
				$orientation = "east";
			}
			else if ($orientation == "east")
			{
				$orientation = "north";
			}
			
			echo " so now facing " . $orientation; 
		}
	}
	
function go ($orientation, $distance)
	{
		global $location;
		echo "<br /> Moving $distance blocks";
		echo "<br />Old location: " . $location["northsouth"] . "N ";
		echo " " . $location["westeast"] . "E ";	

		
		if ($orientation == "north")
		{
			for ($i = 1; $i <= $distance; $i++) {
				storecheck($location["northsouth"]+$i,$location["westeast"]);				
			}	
			$location["northsouth"] = $location["northsouth"] + $distance;
		}
		
		if ($orientation == "west")
		{
			for ($i = 1; $i <= $distance; $i++) {
				storecheck($location["northsouth"],$location["westeast"]-$i);				
			}	
			$location["westeast"] = $location["westeast"] - $distance;	
		}
		if ($orientation == "south")
		{
			for ($i = 1; $i <= $distance; $i++) {
				storecheck($location["northsouth"]-$i,$location["westeast"]);				
			}	
			$location["northsouth"] = $location["northsouth"] - $distance;
		}
		if ($orientation == "east")
		{
			for ($i = 1; $i <= $distance; $i++) {
				storecheck($location["northsouth"],$location["westeast"]+$i);				
			}				
			$location["westeast"] = $location["westeast"] + $distance;					
		}
		
		echo "&bull; New location: " . $location["northsouth"] . "N ";
		echo " " . $location["westeast"] . "E ";
		
		

	}


foreach ($inputarray as $instruction)
{
	$instruction = trim($instruction);
	$direction = substr($instruction,0,1);
	$distance  = substr($instruction,1);
	
	echo "<p>Now facing $orientation &bull; ";
		
	turn ($direction, $orientation);

	go ($orientation, $distance);

}
$distancemoved = abs($location["northsouth"] ) + abs($location["westeast"]);
	
echo "<h2>We have moved a total of $distancemoved blocks from our starting position.</h2>"	
	
?>