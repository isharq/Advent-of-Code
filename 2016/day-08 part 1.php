<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter = 0;

$cell = array();

for ($x=1;$x<=300;$x++)
{
		$cell[$x] = 0;
}

function drawrect($instruction)
{
	global $cell; 
	echo "<p>Okay, let's draw a rectangle.";
	
	$todo = substr($instruction, strpos($instruction, "rect ")+5);
	
	$wide = trim(substr($todo, 0, strpos($todo, "x")));
	
	$tall = trim(substr($todo, strpos($todo, "x")+1));
	
	echo "that is $wide wide and $tall tall";
	
	echo $tall . "/" . $wide;
		
	for($i=0; $i<= $tall-1; $i++)
	{
		for($x=1; $x<= $wide; $x++)
		{
			$topaint = $i*50 + $x; 
			$cell[$topaint] = 1;
		}
	}	
	
}

function rotaterow($row)
{
	global $cell; 
	$newcell = array();
			
	$index = $row * 50; 

	$temp = $cell[50+$index];
	for ($i = 49; $i >= 1; $i--) { $cell[$i+1+$index] = $cell[$i+$index]; }
	$cell[1+$index] = $temp;	
}

function rotatecol($col)
{	
	$col = $col+1;
	global $cell; 
	$newcell = array();

	$temp = $cell[$col+(50*5)];
		
	for ($i = 5; $i >= 1; $i--) {		 
		$tocell 	= $col+(($i)*50);
		$fromcell   = $col+(($i-1)*50); 
		$cell[$tocell] = $cell[$fromcell]; 
	}
	$cell[$col] = $temp;	
}




function drawtable($show=TRUE)
{
	global $cell; 
	$counter = 1;
	
	echo "<table style='border: 1px solid black'>";
	
		echo "<tr>"; 
		for ($x=1;$x<=300;$x++)
		{
			if ($cell[$x] == 1)
			{
				$background = "black";
				$foreground = "white";
			}
			else
			{
				$background = "white";
				$foreground = "black";
			}
			$counter++;
			
			if ($show == TRUE)
			{
				$showcounter = $counter;
			}
			else
			{
				$showcounter = "";
			}
			echo "<td style='width: 30px; height: 30px; border: 1px solid black; background: $background'>";
			echo "&nbsp;"; echo "<small style='color: " . $foreground . "'>" . $showcounter ."</small>"; 
			echo "</td>";
			
			if ($x % 50 == 0)
			{
				echo "</tr>";
				echo "<tr>";
			}

		}	
		echo "</tr>";
	echo "</table>";
	
	
}

$input = file("./day-08-input.txt");

foreach ($input as $instruction)
{
	echo "<p>" . $instruction;
	if (0 === strpos($instruction,"rect"))
	{
		drawrect ($instruction);
	}
	
	if (strpos($instruction,"row"))
	{
		$todo = substr($instruction, strpos($instruction, "row y=")+6);
	
		$row = trim(substr($todo, 0, strpos($todo, " by ")));
	
		$move = trim(substr($todo, strpos($todo, "by ")+3));
				
		echo "<p>OK we need to rotate row $row for $move times.</p>";
		
		for($i = $move; $i >= 1; $i--)
		{
			rotaterow ($row);			
		}		
	}
	
	if (strpos($instruction,"column"))
	{
		$todo = substr($instruction, strpos($instruction, "x=")+2);
	
		$col = trim(substr($todo, 0, strpos($todo, " by ")));
	
		$move = trim(substr($todo, strpos($todo, "by ")+3));
				
		echo "<p>OK we need to rotate column $col for $move times.</p>";
		
		for($i = $move; $i >= 1; $i--)
		{
			rotatecol ($col);			
		}		
	}
	
	drawtable();
	
	
}

$counter = 0;
foreach ($cell as $thiscell)
	{ $counter = $counter + $thiscell; }

echo "<p>$counter segments are lit up</p>";

drawtable($show=FALSE);
?>

<h1>DONE</h1>