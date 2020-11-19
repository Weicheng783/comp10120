<!DOCTYPE html>
<html>
<head>
  <title>Countries v1 Quiz</title>
</head>
<body>

<?php
if(!isset($_SESSION['started']))
{
   $_SESSION['qa'] = buildQA();
   $_SESSION['started'] = true;
}

$qa = $_SESSION['qa'];

if(isset($_POST['correctAnswer']))
{
  $correctAnswer = $_POST['correctAnswer'];
  if($_POST['answer'] == $qa[$correctAnswer][1])
  {
    echo("Correct !!! Well Done!<br><br>");
  }else{
    echo("Incorrect... Try again!<br><br>");

  }
  echo("Try another... <br><br>");
}

showQA($qa);

function showQA($qa){
   $answer[] = rand(0, sizeof($qa) - 1);
   echo("Question " . $answer[0]);

   for($i=0; $i<3; $i++)
   {
     $answer[] = rand(0, sizeof($qa)-1);
   }
   // foreach($answer as $value){
   //   echo($value. "<br>");
   // }

  $correct = "<input type='hidden' value='$answer[0]' name='correctAnswer' >";

  echo("<p>What is the Capital of " . $qa[$answer[0]][0] . "?</p>");
  shuffle($answer);

  $choice = "";

  foreach($answer as $value)
  {
    $choice .= "<input type='radio' name='answer' value='" . $qa[$value][1] . "'> " . $qa[$value][1]  . "<br>";
  }
  echo("<form method='post' >");
  echo($choice);
  echo($correct);
  echo("<br> <input type='submit' value='Check Answer'></turn>");

}

function buildQA()
 {

  $curl = curl_init();

  curl_setopt_array($curl, [
  	CURLOPT_URL => "https://ajayakv-rest-countries-v1.p.rapidapi.com/rest/v1/all",
  	CURLOPT_RETURNTRANSFER => true,
  	CURLOPT_FOLLOWLOCATION => true,
  	CURLOPT_ENCODING => "",
  	CURLOPT_MAXREDIRS => 10,
  	CURLOPT_TIMEOUT => 30,
  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  	CURLOPT_CUSTOMREQUEST => "GET",
  	CURLOPT_HTTPHEADER => [
  		"x-rapidapi-host: ajayakv-rest-countries-v1.p.rapidapi.com",
  		"x-rapidapi-key: a49dc929femshc87b60a034b2731p1b814fjsn9f75652a1842"
  	],
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
  	echo "cURL Error #:" . $err;
  } else {
  	// echo $response;
  }
    $response = json_decode($response, true);
    $qa = [];

    foreach($response as $item) {
      // echo("Country: " . $item['name'] . "<br>");
      // echo("Capital: " . $item['capital'] . "<br>");

      array_push($qa, array($item['name'], $item['capital']));
    }
    return $qa;
}

?>













</body>
</html>
