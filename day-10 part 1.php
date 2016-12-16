<?

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$roundcounter = 0;

$cell = array();

$input = file("./day-10-input.txt");

$bot= array();
$output = array();

function executebot($botnumber)
{
	global $bot;
	global $output;
	
	echo "<br /> <strong>Executing bot instructions</strong> for bot $botnumber <tt>::::</tt>";
	
	$high = " " . $bot[$botnumber]["high"];
	$low = " " . $bot[$botnumber]["low"];
	
	if ($bot[$botnumber]["value"][0] > $bot[$botnumber]["value"][1])
	{
		$highvalue = $bot[$botnumber]["value"][0];
		$lowvalue  = $bot[$botnumber]["value"][1];
	}
	else
	{
		$highvalue = $bot[$botnumber]["value"][1];
		$lowvalue  = $bot[$botnumber]["value"][0];
	}
	
	if ($highvalue == 61)
	{
		if ($lowvalue == 17)
		{
			echo "<h1>FOUND THE SOLUTION!</h1>";
			echo "<p>The answer to day 10 part 1 is $botnumber</p>";
			die ();			
		}
	}

	echo " High is $highvalue and should go to $high. Low is $lowvalue and should go to $low";
	
	if (strpos($high,"bot"))
	{
		$high = trim(substr($high,"bot"+4));
		echo "<br /> okay moving high to bot $high";
		
		$bot[$high]["value"][] = $highvalue;		
		checkbot($high);
	}
	else if (strpos($high,"output"))
	{
		$high = trim(substr($high,"output"+7));
		echo "<br /> okay moving high to output $high";
		
		$output[$high][] = $highvalue;		
		checkbot($high);
	}
	else
		{
			die("not sure what to do with thish high instruction");
		}
	
	if (strpos($low,"bot"))
	{
		$low = trim(substr($low,"bot"+4));
		echo "<br /> okay moving low to bot $low";
		
		$bot[$low]["value"][] = $lowvalue;		
		checkbot($low);
	}
	else if (strpos($low,"output"))
	{
		$low = trim(substr($low,"output"+7));
		echo "<br /> okay moving low to output $high";
		
		$output[$low][] = $lowvalue;		
		checkbot($low);
	}
	else
		{
			die("not sure what to do with thish low instruction");
		}

	unset($bot[$botnumber]["value"]);


	
}

function checkbot($botnumber)
{
	global $bot;
	echo "<p> &rarr; Checking bot $botnumber <tt>::</tt>";
	
	if (!isset($bot[$botnumber]["high"]))
	{
		echo " no high set, skipping... ";
		return;
	}
	if (!isset($bot[$botnumber]["high"]))
	{
		echo " no low set, skipping... ";
		return;
	}
	
	if (isset($bot[$botnumber]["value"]))
	{
		echo " - It has a high and a low. It also has " . count($bot[$botnumber]["value"]) . " value(s)";
		
		if (count($bot[$botnumber]["value"]) > 1)
		{
			executebot($botnumber);
		}
	}
	else
	{
		echo " - No values set. No problem.";
	}
}

function evalinstruction($instruction)
{
	global $bot;
	if (strpos($instruction,"gives"))
	{
		echo " Bot instruction ";
			
		$botnumber = trim(substr($instruction,4,strpos($instruction,"gives")-4));
		
		echo " for bot $botnumber";
		
		$low = substr($instruction,strpos($instruction,"gives low to")+12,strpos($instruction,"and high to")-strpos($instruction,"gives low to")-12);

		echo " - Low: $low ";
		
		$high = substr($instruction,strpos($instruction,"and high to")+11);
		
		echo " - High: $high ";	
		
		$bot[$botnumber]["high"] = trim($high);
		$bot[$botnumber]["low"] = trim($low);

		checkbot($botnumber);
		
	}
	else
	{
		echo " Value instruction! ";
		
		$value = trim(substr($instruction,6,strpos($instruction,"goes to bot")-6));
		
		echo " value $value / ";
		
		$thisbot = trim(substr($instruction,strpos($instruction,"goes to bot")+11));
		
		echo " bot $thisbot";
		
		$bot[$thisbot]["value"][] = $value;
		
		checkbot($thisbot);
		
	}
}

foreach ($input as $instruction)
{
	
	echo "<p><strong>NEW INSTRUCTION - </strong>$instruction &rarr; ";
	
	evalinstruction($instruction); 
	
}



?>

<pre><h1>Bots</h1><? print_r ($bot); ?></pre>
<pre><h1>Outputs</h1><? print_r ($output); ?></pre>


<h1>DONE</h1>