<!DOCTYPE html>
<html>
<head>
  <title>My Jokes Application</title>
  <style type='text/css'>
    .joke
    {
      font-family: Georgia, serif;
      font-size: 25px;
      letter-spacing: 2px;
      word-spacing: 2px;
      text-align: center;
    }
    .jokeans
    {
      font-family: Georgia, serif;

      color: red;
      font-size: 25px;
      font-style: italic;
      letter-spacing: 2px;
      word-spacing: 2px;
      text-shadow: 0px 1px #5b8a3c;
      text-align: center;
    }
    .button{
      box-shadow:0px 10px 14px -7px #3e7327;
      background: linear-gradient(to bottom, ##77b55a 5%, #72b352 100%);
      background-color: #77b55a;
      border: 1px solid #4b8f29;
      cursor: pointer;
      display: inline-block;
      color: #ffffff;
      font-family: Arial;
      font-size:13px;
      font-weight: bold;
      padding: 6px 12px;
      text-shadow: 0px 1px #5b8a3c;

    }
    .wrapper
    {
      text-align:center;
    }

  </style>
  <script type='text/javascript'>
     function showAnswer()
     {
       answer = document.getElementById("answer");
       answer.style.display = "block";
     }



  </script>
</head>
<body>

<?php
  $curl = curl_init();
  $URL = "https://icarus.cs.man.ac.uk/official_joke_api/jokes/random";
  curl_setopt($curl, CURLOPT_URL, $URL);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $response = curl_exec($curl); //display the array
  $err = curl_errno($curl);


  if($err)
  {
    die("curl error: " . $err);
  }
  else
  {
    // echo("It worked!");
  }
  // echo(gettype($response));



  $response = json_decode($response, true);


  // foreach ($response as $key => $value)
  // {
  //   echo("IN array");
  //   if(gettype($value) == "array")
  //   {
  //
  //     foreach($value as $key2 => $value2)
  //     {
  //       echo("Inside inner array<br><br>");
  //       echo("key: $key2 | value: $value2<br>");
  //     }
  //   }
  //   else {
  //     echo("key: $key | value: $value");
  //   }
  // }
  //
  // echo(gettype($response));

  echo("<p class='joke'>" . $response[0]['setup'] . "</p>");
  echo("<p class='jokeans' id='answer' style='display:none;'>" . $response[0]['punchline'] . "</p>");

  echo("<form method='post'>");

  echo("<div class='wrapper'>");
  echo("<input type='submit' class='button' value='New Joke' onclick='submit'>");
  echo("<input type='button' class='button' value='Show me answer' onclick='showAnswer()'>");
  echo("</div>");

  echo("</form>");


  ?>

</body>
</html>
