<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="TA4.css">

    <title>HTML5 form validation</title>
 
</head>

<body>



<!-- Author: H. James de St. Germain
     Date: Spring 2015

   This file contains examples of form validation using HTML5


Notes:

1) required field for an input forces it to be ... required ...
2) attribute type: can change input type from "text" to:
                email, url, number, tel, date, color, date, datetime, month, search, time, week, range

     - note "tel" just tells mobile to bring up number inputs, does not validate

2.5)  Not all types supported by all browsers - this is always a concern

3) attribute placeholder:  can show original input field message
4) attribute value: can use to preset data in form
5) attribute pattern: allows regular expression checking


o) For custom message, see setCustomValidity in JS below



-->

<form>

  <ul>
    <li>
      <p>
    Your Name:
    <input type="text" name="name" value="default" required/>
      </p>
    </li>

    <li>
      <p>Your email:
      <input type="email" name="email"
         placeholder="login@gmail.com"
         required/> </p>
    </li>

    <li>
      <p>Your homepage:
      <input type="url" name="url" size="50"
         placeholder="www.cs.utah.edu/~germain"
         required/> </p>
    </li>

    <li>
      <p>Your telephone number:
      <input type="tel" name="telephone"
         placeholder="(801) 123-4567"
         pattern="^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$"
         required/> </p>
    </li>

    <li>
      <p>Your age:
      <input type="number" name="age" size="5"
         min="1" max="150"
         required/> </p>
    </li>

    <li>
      <p>Your favorite color:
      <input type="color" name="color"
         required/> </p>
    </li>
    
    <li>
      <p>Your birthday:
      <input type="date" name="bd"
         required/> </p>
    </li>
    
    <li>
      <p>Search Box:
      <input type="search" name="search"
         required/> </p>
    </li>


    <li>
      <p>How Happy are You:
      <input type="range" name="happy"
         min="1" max="100" value="50"
         required/> </p>
    </li>

    <li>
      <p>Password:
      <input type="password" name="pass"
         required/> </p>
    </li>



  </ul>
  
  <br/>
  <input type="submit"/>
</form>




<script>
$(function(){

    $("input[name='telephone']")[0].oninvalid = function () {
        this.setCustomValidity("Please include area code: XXX-555-1234");
    };

    $("input[name='url']")[0].oninvalid = function () {
        this.setCustomValidity("http://site.com");
    };
});
</script>

</body>