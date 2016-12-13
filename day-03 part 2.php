<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
$input = file("./day-03-input.txt");

$possible = 0;
$tested   = 0;

foreach ($input as $triangle)
{
	strlen($triangle);
	
	$tested++;
	
	$n1 = trim(substr($triangle,0,5));
	$n2 = trim(substr($triangle,7,3));
	$n3 = trim(substr($triangle,12,3));
	
	if ($n1 + $n2 > $n3)
	{
		if ($n1 + $n3 > $n2)
			{
				if ($n2 + $n3 > $n1)
					{
						$possible++;
					}
			}		
	}

}

echo "<p>Out of the $tested triangles, $possible were possible</p>";


?>