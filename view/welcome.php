<!DOCTYPE html>
<?php
//1525 Program 1
$response = filter_input(INPUT_GET, "txtresponse", FILTER_VALIDATE_FLOAT);
$txt_num1 = filter_input(INPUT_GET, "num1", FILTER_VALIDATE_FLOAT);
$txt_num2 = filter_input(INPUT_GET, "num2", FILTER_VALIDATE_FLOAT);
$txt_sign = filter_input(INPUT_GET, "symbol");
$colors= array();
$colors[0] = "color: red;";
$colors[1] = "color: blue;";
$color = "color: black;";
if (!isset($error_message)) {
   $error_message = "";
}
if (!isset($message)) {
   $message = "";
}
if (!isset($color)) {
   $color = "color: black;";
}
if (!isset($txt_num1)) {
   $txt_num1 = 0.0;
}
if (!isset($txt_num2)) {
   $txt_num2 = 0.0;
}


function gen_num($num = 1)
{
	$holder = array();
        $finalholder = array();
	$i = 0;
        $max;
        $min;
	while($i < $num)
	{
		$rand = rand(10, 100);		
		while(in_array($rand, $holder))
		{
                    $rand = rand(10, 100);
		}
		$holder[$i] = $rand;
		$i ++;
	}
        //if(){
     
	return $holder;
}

function gen_symbol($num = 1)
{
	$sign = array();
	$i = 0;
	while($i < $num)
	{
		$counter = rand(1, 4);	
		while(in_array($counter, $sign))
		{
                    $counter = rand(1, 4);
		}
		$sign[$i] = $counter;
		$i ++;
	}
	return $sign;
}

$numbers = gen_num(2);
$symbol = gen_symbol(1);




//$counter = rand(1, 4);
function gen_answer($num1,$num2,$symbol)
{
    $answer = "0";
    
    if ($symbol === "1") 
    {
        $answer = $num1 + $num2;
    } else if ($symbol === "2") {
        $answer = $num1 - $num2; 
    } else if ($symbol === "3") {
        $answer = $num1 * $num2;
    } else if ($symbol === "4") {
        $answer = $num1 / $num2;
    }
    
  
    return number_format($answer,0, '.', '');
}


$symbols = array(
    "1" => "+",
    "2" => "-",
    "3" => "*",
    "4" => "/",
);


$answer = gen_answer($txt_num1,$txt_num2,$txt_sign);
$problem = $numbers[0] . " " . $symbols[$symbol[0]] . " " . $numbers[1];


if($answer === "0")
{
     $question = $problem;
}
else
{

   
     $message ="Reminder: Round to nearest 10th place and NO commas";
    $x;
    if($response === FALSE || $response != $answer){
        $x = 1;
    }
    else{$x = 0;}
    
    while($x === 1) {
        $color = $colors[0];
        $numbers[0] = $txt_num1;
        $numbers[1] = $txt_num2;
        $symbol = $txt_sign;
        If ($response === FALSE) {
        $error_message = "Please enter a valid answer";
        $question = $txt_num1." " . $symbols[$txt_sign] . " " . $txt_num2;
        } 
        else if ($response != $answer) {
            $error_message = "Answer is incorrect";
            $question = $txt_num1." " .$symbols[ $txt_sign] . " " . $txt_num2;
        }
        $x = 0;
    } 
    if($response === (float)$answer){
        $error_message = " Good job! " . $answer . " was correct! Here's the next question.";
         $question = $problem;
         $color = $colors[1];
    }
}




?>
<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="program1.css">
                <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MathWizard</title>
    </head>
    <body>
    <header role="banner">
         <h2><span class="logo">Math</span>Wizard</h2><br>
    </header>
    <div id="wrapper">

        <main>
        <h1>Do your best!</h1><br>
        <p> <?php
            if (isset($message)) {
                echo $message;
            }
        ?></p><br>
        
        <form action="welcome.php" method="get">
         
            <div id="card">
                <label style="<?php echo $color?>"><?php if (isset($error_message)) {
                echo $error_message;
            } ?></label><br><br>
             <label id="question"><?php echo $question ?></label><br><br>
            <input type="text" id="response" name="txtresponse"></section>
            <input type="hidden" name="num1" value="<?php echo $numbers[0] ?>"><br>
            <input type="hidden" name="num2" value="<?php echo $numbers[1] ?>"><br>
            <input type="hidden" name="symbol" value="<?php echo $symbol[0] ?>">
            <input type="submit" class="submit" value="Submit"> <br>
		
            </div>
        </form>
        </main>
    

    </div>
            <div id="footer">
            <p>1525 Program 1 - Renell Yonkedeh</p>
         </div>
    </body>
  </html>
