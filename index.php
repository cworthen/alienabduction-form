<?php

// PHP form to get input from user

//include the function to clean data
include "cleanData.php";

//declaring variables

//clean data before adding to text file

$firstname =  cleanData($_POST['firstname']);

$lastname  =  cleanData($_POST['lastname']);

$email     =  cleanData($_POST['email']);

$subject   =  cleanData($_POST['Alien Submission Form']);

$mydate    =  cleanData($_POST['mydate']);

$howlong   =  cleanData($_POST['howlong']);

$howmany   =  cleanData($_POST['howmany']);

$describe  =  cleanData ($_POST['describe']);

$whatdidtheydo = cleanData($_POST['whatdidtheydo']);

$fluffy   = cleanData($_POST['radio1']);

$mycomment     = cleanData($_POST['mycomment']);


// email address removed for git repo
$to =' ';

$subject = "Aliens abducted me form Submission";

$body = "$firstname $lastname - $email \n Date: $date \n";

mail($to,$subject,$body);


if ($_SERVER['REQUEST_METHOD'] == 'POST'){


 checkForm($firstname, $lastname, $email, $fluffy,
     $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
     $mycomment);

}else{


 showForm($firstname, $lastname, $email, $fluffy,
     $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
     $mycomment,$firstnameError, $lastnameError, $emailError,$radio_valueError,$FcharErr, $LcharErr );

}



//function to validate the form

function checkForm($firstname, $lastname, $email, $fluffy,
                   $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
                   $mycomment)
{

 //validating for special characters
 if (preg_match('/[^a-zA-Z\s]/i', $firstname)) {
  $FcharErr ="<br><font color='red'>Only letters and white space allowed</font>" ;
 }

 if (preg_match('/[^a-zA-Z\s]/i', $lastname)) {
  $LcharErr = "<br><font color='red'>Only letters and white space allowed";
 }

 //validating for blank fields

 if (empty($firstname)) {

  $firstnameError = "<br><font color='red'>Please enter your first name</font>";
 }

 if (empty($lastname)) {

  $lastnameError = "<br><font color='red'>Please enter your last name</font>";

 }

 if (empty($email)) {

  $emailError = "<br><font color='red'>Please enter your email address</font>";

 }
  if (empty($fluffy)) {
   $radio_valueError = "<br><font color='red'>Please tell us if you've seen Fluffy</font>";
  }

//if statement to check if the fields are empty, show the form again otherwise confirm


   if (!($firstname && $email && $lastname && $fluffy && preg_match("/^[a-zA-Z ]*$/", $firstname))) {


    showForm($firstname, $lastname, $email, $fluffy,
        $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
        $mycomment, $firstnameError, $lastnameError, $emailError, $radio_valueError, $FcharErr, $LcharErr);

   } else {

    confirm($firstname, $lastname, $email, $fluffy,
        $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
        $mycomment);


  }

}//ends checkForm function



function confirm($firstname, $lastname, $email, $fluffy,
                 $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
                 $mycomment){

 if($firstname && $lastname && $email && $fluffy){

  print "Thanks for submitting the form <strong>$firstname

 $lastname</strong><br><br>";

  print "You were abducted on <strong> $mydate </strong>";

  print "and gone for <strong>$howlong</strong>
       <br><br>";

  print "You said they were <strong>$howmany aliens
      </strong><br><br>";

  print "And they <strong>$whatdidtheydo</strong><br><br>";

  print "You described them as <strong>$describe</strong><br><br>";

  print "Did you see my dog Fluffy? You answered:$fluffy<br><br>";


  print "Your other comments were: <strong>
     $mycomment</strong><br><br>";

  print "We will contact you at <strong>
     $email</strong> if we have any relevant news <br>";


  print "<br>sighting added!";


  addData($firstname, $lastname, $email, $fluffy,
      $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
      $mycomment);
 }
}//end confirm function

//function to add data
function addData($firstname, $lastname, $email, $fluffy,
                 $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
                 $mycomment)
{

include("mysqli_connect.php");

 $query = "INSERT INTO aliens_abduction VALUES (null,'$firstname', '$lastname', '$email',
'$mydate','$howlong','$howmany','$describe','$whatdidtheydo', '$fluffy','$mycomment')";


 $result = mysqli_query($dbc, $query); print mysqli_error($dbc);
 if ($result) {

  print "OK!!";

 }else{

  print "Not Ok!!";

 }

}


//function to display the form without an html file

function showForm($firstname, $lastname, $email, $fluffy,
                  $mydate, $howlong, $howmany, $describe, $whatdidtheydo,
                  $mycomment, $firstnameError, $lastnameError, $emailError, $radio_valueError,$FcharErr,$LcharErr)
{



 //if-else statement to make radio buttons sticky


 if ($fluffy == "Yes") {
  $fluffy = "<input type=\"radio\" name=\"radio1\" value=\"Yes\" id=\"fluffy_0\" checked=\"checked\"> Yes
			<input type=\"radio\" name=\"radio1\" value=\"No\" id=\"fluffy_1\">No";
 } elseif ($fluffy == "No") {
  $fluffy = "<input type=\"radio\" name=\"radio1\" value=\"Yes\" id=\"fluffy_0\" > Yes
			<input type=\"radio\" name=\"radio1\" value=\"No\" id=\"fluffy_1\"checked=\"checked\">No";
 } else {
  $fluffy = "<input type=\"radio\" name=\"radio1\" value=\"Yes\" id=\"fluffy_0\"> Yes
			<input type=\"radio\" name=\"radio1\" value=\"No\" id=\"fluffy_1\">No";
 }




 print <<< SOMETEXT

<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8">
    <title>Alien Abduction Form</title>
    <!-- Add any other metadata here -->


<link href="alien.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--[if It IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->


  </head>
  <body>
    <!-- Add here all content exposed to the user -->

<h1>Aliens Abducted Me - Report an Abduction</h1>


<h2>Share your story of alien abduction:</h2>


<form method="post" action="index.php">


<!-- firstname text box -->

<label for="firstname">&#42;First Name:</label>
<input type="text" name="firstname"
placeholder="firstname" class="firstname" value="$firstname">$FcharErr $firstnameError<br>



<!-- lastname text box -->

<label for="lastname">&#42;Last Name:</label>
<input type="text" name="lastname" placeholder="lastname"
class="lastname" value="$lastname">$lastnameError $LcharErr<br>

<!-- email text box -->


<label for="email">&#42;What is your email address ?</label>
<input type="text" name="email" placeholder="email" class="email" value="$email">$emailError<br>


<!-- date text box -->

 <label for="mydate">When did it happen? </label>
 <input type="date" name="mydate" class="mydate"><br>

<!-- How long were you gone text box -->

<label for="howlong">How long were you gone?</label>
<input type="text" placeholder="hours, days, years?" name="howlong"><br>


<!-- How many did you see text box -->


<label for="howmany">How many did you see?</label>
<input type="text" placeholder="Enter a number" name="howmany"></textarea><br>


<!-- Describe them text box -->

<label for ="describe">Describe them:</label>
<input type="text" placeholder="What did they look like" name="describe"><br>


<!-- What did they do text box -->

<label for = "whatdidtheydo">What did they do to you?</label>
<input type = "text" placeholder="Describe what they did " name="whatdidtheydo"><br><br>


<!-- Fluffy text box -->

<label>&#42;Have you seen my dog Fluffy?</label>

$fluffy $radio_valueError<br><br>


<!-- Image source of Fluffy -->


<img src="images/fluffy.jpg" alt="fluffy" class="fluffy">


<!-- Comments text box -->

 <br><label>Anything else you want to add?</label>
<textarea class="mycomment" name="mycomment" placeholder="Your comments..."  cols="30" rows="3"></textarea><br>

<p>*Required Fields</p>

<input type="submit" id="submitbtn" value="Report Abduction">

    </form>
  </body>
</html>



SOMETEXT;



}//ends showForm function


?>
