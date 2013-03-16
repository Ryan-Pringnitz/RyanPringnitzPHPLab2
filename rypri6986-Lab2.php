



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Scholarship Form</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="rypri6986-Lab2.css" />
</head>
<!--
/*************************************
* Programmer: Ryan Pringnitz
* Bronco NetID: rypri6986
* Lab #2
* CIS 2800: Internet Programming
* Spring 2013
* Due date: 02/10/13
* Date completed: 02/9/13
*************************************
* Program Explanation
*
* This file contains all my information for basically formatting and layout of the form.
**************************************/

-->
    
<body>
<?php

//required field function
function displayRequired($fieldName) {
     print("<p class=\"error\">The field \"$fieldName\" is required.</p>");
}

//validation function
function validateInput($data, $fieldName) {
     global $errorCount;
     if (empty($data)) {
          displayRequired($fieldName);
          ++$errorCount;
          $retVal = "";
     } else { // Only clean up the input if it isn't empty
          $retVal = trim($data);
          $retVal = stripslashes($retVal);
     }
     return($retVal);
}

//redisplaying the form (a.k.a., sticky form)
function redisplayForm($firstName, $lastName, $userAge, $userPhone, $userEmail) {
?>

<h2>Scholarship Form</h2> <!-- below is a form that we have used many times in this class -->
<form name="scholarship" id="scholarship" action="<?php $_SERVER["SCRIPT_NAME"] ?>" method = "post">
<table>
<tr>
<td>First Name: <input type="text" name="firstName" value="<?php print($firstName); ?>" size="15" maxlength="15" /></td>
</tr>
<tr>
<td>Last Name: <input type="text" name="lastName" value="<?php print($lastName); ?>" size="15" maxlength="15"  /></td>
</tr>
<tr>
<td>Age: <input type="text" name="userAge" size="2" maxlength="2" minlength="2" value="<?php print($userAge); ?>" size="15" maxlength="15"  /></td> <!-- I put a min length of 2 here so the individual must
be at least 10 years old, and it kind of doubles up on my validation -->
</tr>
<tr>
<td>Phone Number: <input type="text" name="userPhone" value="<?php print($userPhone); ?>" size="15" maxlength="15"  /></td>
</tr>
<tr>
<td>E-Mail <input type="text" name="userEmail" value="<?php print($userEmail); ?>" size="35" maxlength="35" /></td> <!-- I made the size and max length a little longer here to accommodate longer names -->
</tr>
<tr>
<td><input type="submit" name="submit" value="Submit Information" /></td>
</tr>
<tr>
<td><input type="reset" value="Clear Form" /></td>
</tr>
</table>
</form>

<?php


}
$lowerFirstName ="";
$lowerLastName = "";
$password = "";
$sha2 = "";

if (isset($_POST['submit'])) {

$errorCount = 0;
$firstName = validateInput($_POST['firstName'], "First name");   //validating the input
$lastName = validateInput($_POST['lastName'], "Last name");  //validating the input
$userAge = validateInput($_POST['userAge'], "User Age"); //validation for userAge
$userPhone = validateInput($_POST['userPhone'], "User Phone"); 
$userEmail = validateInput($_POST['userEmail'], "User E-mail");


if(!empty($userAge)) {
if (preg_match("/^([1-9]{1})([0-9])?$/", $userAge))
{
$userAge = $userAge;
}
else
{
++$errorCount; //this increases the error count if we do the "else" part of the statement
$userAge ="";
print("<p><span class=\"information\">Your age should be from 1 to 99</span></p>"); //if the user age is not 0-99 
}
}

if(!empty($userEmail)) {
if(preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $userEmail)) //this is just one of many times 
// I used preg_match to search through my userEmail variable to ensure validation , then I put it right back in to the variable userEmail
{
$userEmail = $userEmail;
}
else
{
++$errorCount;
$userEmail ="";
print("<p><span class=\"information\">Your e-mail address should be entered</span></p>"); //if does not include an e-mail address 
}
}


if(!empty($userPhone)) {
if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $userPhone) ){ //this performs the search and validation of the $userPhone variable
$userPhone = $userPhone;
}
else
{
++$errorCount;
$userPhone ="";
print("<p><span class=\"information\">Your phone number should be entered</span></p>"); //if the user doesn't include dashes in his phone #
}
}

if(!empty($firstName)) {
if(preg_match("/^[a-zA-Z -]+$/", $firstName) ){ //this search and validation of the $firstName variable
$firstName = $firstName;
}
else
{
++$errorCount;
$firstName ="";
print("<p><span class=\"information\">You need to enter a name</span></p>"); //if the user name is not entered 
}
}

if(!empty($lastName)) {
if(preg_match("/^[a-zA-Z -]+$/", $lastName) ){  //searches through the variable and validates the contents of the lastName variable
$lastName = $lastName;
}
else
{
++$errorCount;
$lastName ="";
print("<p><span class=\"information\">You need to enter a last name</span></p>"); //if the last name is not entered 
}
}

if ($errorCount>0) { //if the variable error count is greater than 0 then you get an error message
     print("<p class=\"error\">Please re-enter the information below.</p><p><hr /></p>");  //this displays if the error count is greater than 0
     redisplayForm($firstName, $lastName, $userAge, $userPhone, $userEmail);
}
else {
   print("<p class=\"correct\">Thank you for filling out the scholarship form " . //this displays if the error count is 0 
           $firstName . " " . $lastName . ".</p>"); //concactination for the name output to thank them
 	
	$strMyString = $firstName;
	$strMyMD5Hash = "";
	$strMySHAHash = "";  //declaring some variables
	
	$lowerFirstName = strtolower($firstName); //convert to lowercase  
	$lowerLastName = strtolower($lastName); //convert to lowercase
	$strMyMD5Hash = md5($strMyString);  //this creates the md5 hash
	$strMySHAHash = sha1($strMyString);  //this creates my sha hash 
	$totalNameCount = (strlen($firstName) +strlen($lastName)); //this counts the length of my string
	$login = (substr($lowerFirstName, 0, 1) . substr($lowerLastName, 0, 3) . $totalNameCount);
	$password = (strrev($lowerLastName) . sprintf("%b", $userAge)); //this is my last name in reverse
	$email =("$lowerFirstName.$lowerLastName@wmich.edu"); //this is the input for my e-mail address
	
	

	print("<p>Your login is: " . $strMyString . "</p>");  //the formatting and output for my 
	print("<p>Your password is: " . $password . "</p>");
	print("<p>Your e-mail is; " . $firstName . "." . $lastName . "@wmich.edu" . "</p>"); //this is the output for my e-mail address
	print("<p>My MD5 hash is " . $strMyMD5Hash ."</p>");	
	print("<p>My SHA password is " . $strMySHAHash ."</p>");	
	
	
}

}

else {
	redisplayForm($firstName = NULL, $lastName=NULL, $userAge=NULL, $userPhone=NULL, $userEmail=NULL);
}
include 'rypri6986-Lab2DateTime.php';  //this includes the footer file
?>

</body>
</html>

