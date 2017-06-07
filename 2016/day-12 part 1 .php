<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter = 0;

$cell = array();

$input = file("./day-12-input.txt");

$reg = array();

$tochange = 0;

$reg["a"] = 0;
$reg["b"] = 0;
$reg["c"] = 0;
$reg["d"] = 0;

$debug = FALSE;


for ($a=0; $a<= count ($input); $a++)
{	
	
	if ($roundcounter++ % 1000 == 0)
		
		{ echo ". "; }
	
	flush();
	if ($debug) { echo "<br />$roundcounter / <strong>OP $a </strong> <tt>::</tt> "; }
	 
	$command = trim($input[$a]);
	
	if ($debug) { echo " <tt>$command</tt>"; }
	
	if (substr($command,0,3) == "cpy")
	{
		if ($debug) {  echo " is a copy command"; }
		
		$what = trim(substr($command,4,strrpos($command," ")-strpos($command," ")));
		
		if ($debug) { echo " to copy $what "; }
		
		if (!is_numeric($what))
		{
			if ($debug) { echo " which is a <em>register</em>, storing "; }
			if ($debug) { echo $reg[$what]; }
			$what = $reg[$what];
		}
		
		$where = trim(substr($command,strrpos($command," ")));
		
		if ($debug) { echo " to $where "; }
		
		$reg[$where] = $what;
	} 
	else if (substr($command,0,3) == "inc")
	{
		if ($debug) { echo " is an increment command "; }
		
		$tochange = trim(substr($command,strrpos($command," ")));
		
		if ($debug) { echo " for $tochange. It was " . $reg[$tochange]; }
		
		$reg[$tochange]++;

		if ($debug) { echo " and is now " . $reg[$tochange];		 }
		
	}
	else if (substr($command,0,3) == "dec")
	{
		if ($debug) { echo " is a decrement command"; }
		
		$tochange = trim(substr($command,strrpos($command," ")));
		
		if ($debug) { echo " for $tochange. It was " . $reg[$tochange];}
		
		$reg[$tochange]--;
		
		if ($debug) { echo " and is now " . $reg[$tochange];	}	

		
	}
	else if (substr($command,0,3) == "jnz")
	{
		if ($debug) { echo " is a jump command "; }
		
		$index = trim(substr($command,4,strrpos($command," ")-strpos($command," ")));
		
		if ($debug) { echo " for $index, which is "; }
		
		if (!is_numeric($index))
		{
			if ($debug) { echo " <strong>a register</strong> storing "; }
			$index = $reg[$index];
		}

		if ($debug) { echo $index; }
		
		if ($index == 0)
		{
			if ($debug) { echo " but because that's zero, we aren't doing it. Going to "; echo ($a + 1); echo " instead."; }
		}
		else
		{		
			if ($debug) { echo " and because it's not zero, let's go! "; }
			$tojump = trim(substr($command,strrpos($command," ")));
		
			if ($debug) { echo " Jumping by $tojump "; }
			
			$a = $a + $tojump -1;
		
		}
	}
		
	?><?
	
}

?>
<h1>Reg a:</h1>
<pre><? echo $reg["a"]; ?></pre>

<h1>Number of rounds:</h1>
<pre><? echo $roundcounter; ?></pre>



<h1>Full reg:</h1>
<pre><? print_r($reg); ?></pre>


<h1>DONE</h1>