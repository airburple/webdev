<u>Selenium</u>
<p>I used Selenium with C# and my TA7 project to test the registration process 
followed by an application process with that same user.</p>
<p>starting from the index page I click on the register link and find and fill all the text areas. 
I even check to make sure the red X changes to the check jpeg on one of the fields by printing the path to that image.
On the password field the tester is asked to <u>ENTER PASSWORD</u> in the console, so a password isn't written in the code.</p>
<p>Once the submit is clicked the user is registered and taken back to home where they click to login. 
The login fields are filled and submitted, and we then click the link to apply</p>
<p>We can note that the username is filled in the enter username field by the database.</p>
<p>I then use the <u>XPATH</u> feature to parse through the courses hiring table to get a course name and a coorisponding course id.
I then fill the form with those values and fill the other fields and submit.</p>
<p>Finally after the application is submited I click the view/start application link to see that the application has posted below from the database.</p>
<p>I can see this as a way to test adding  several users by looping through this process with random usernames and passwords. Or adding several applications by simply adding a random number generator to pick classes from the list.
I could also do similar testing with an admin, parsing through different applicants and assigning them to classes would be another test I 
would write next and shouldn't require much more than some copy and pasting.</p>
<p>I felt like I was able to test the core process for a TA applicant. I was able to test a good sample and got my feet well wetted with the process of Selenium testing. </p>
<p>The path to the actual cs file should be ..../trunk/html/Projects/Selenium Selenium.cs</p>



<u>TA7</u>
<p>test admin username: newguy passwor: password2</p>
<p>I was able to get all of the checkpoints for the first part of the assignment but it took me too long to venture into the TA eval form, right now it is stubbed out but I plan to remove that after the readme is done.</p>
<p>Thanks to New Boston and Php academy and Professor Jim for code and tutorials that helped on this assignment.</p>
<p>Only an admin has access to the updateTA.php page which uses updateTA.js and tempControl.php handles all of the conditions like assigned, unassigned, and probable.</p>
<p>When an admin falls on the TA update page it shows all courses hiring and once the Admin enters a class number and hits submit, ajax returns a list of all applicants with some relevant data.</p>
<p>The admin will then need to enter a TA number to change assignment for the already selected class number. Once submit is clicked a message will appear telling the admin what was changed, the admin will hit 
an OK button and the changes will then show on the courses hiring list. A class remains in the hiring list until an admin removes it elsewhere, this will allow changes to be made until a course is removed from 
the hiring list, but just because A TA is assigned does not remove it from that list.  </p>

<p>Finally this change WILL UPDATE the profile page of the user assigned. You can check this on William Williams who is id=99 password = password username = William Williams</p>

<u>TA6</u>
<p>I had major issues and had to reset the VM and fresh install everything and rebuild the DB.</p>

<p>Test using username: newguy password: password2</p>

<p>The admin_course_list page is where you go to generate new scrapers to grab new year semester combos that are then displayed for admins
at the course_update.php page. From the page after login click the Admins may View and Update Course And Applicant Lists link</p>

<p> The couese_update page is where I did all of my jquery DOM work. the page loads and hides all the sibling rows of each class name and as you go
through and click the td the siblings will show up.</p>

<p>The two scraper files are scrape_course and scrape_enrollment. I tried doing the enrollment scraping at the same time but 
the internet connection didn't like that. I printed out each time the scaper went to the individual pages to get enrollment and got seating recprd is not available
I kept this in to show the grader, normally I would header over to the course_update.pgp page, please go there after you pick a semester to scrape.</p>
overall time on this assignment including rebuilding the VM was about 25 hours.


<u>TA5</u>
<br>
<p>I used <u>JAVASCRIPT/JQUERY</u> on the application page I now allow the users to show and hide the courses hiring table to help them populate the application. 
I also added hide show buttons to the course_update page to allow users to hide and show different tables. Admins for example would have 3 tables of info which may be too much 
so they can hide and show what they like. </p>
<br>
<p>I added some hover features to change the color of links to red when hovered over and blue when unhovered. On the submit buttons and cancel buttons on the apply and register 
pages I had them change to green and red when hovered over to give the user a little nod to which button they are about to push. </p>
<br>
<p>I added a custom validation message to the email field on the register page to let the user know they should be using the form username@provider.com and I added a red X and 
green check jpeg I made in paint to add a little originality.</p>

<br>
<p><u>VALIDATION</u> I used a function called echo that sanitizes the form info before DB insertion. It uses the htmlentities function which is similar to specialchars but 
covers a few more characters. As for SQL BINDING please note this is done in the DB CLASS in the query function. 
In each of the forms in each field I made them required and set some min max settings as well as a couple custom settings. I also repeat the validation in php
before passing it along to the DB insertion. I use a custom check for passwords that make the user enter the same password twice on registration and if that fails the 
php echos the custom error message. Other error messages are mostly handled by the HTML 5 and the email custom message is from Jim's Jquery url check script
So again user input is validated in html5 forms as well as in php and is also sanitized using htmlentities and finally BIND is used in the DB class. 
</p>

<br>
<p><u>SOURCES AND FINAL NOTES:</u> I built on TA4 which was modeled after php Academy's 23 part register/login tutorial series. I also used Professor Jim's class examples 
which use the custom validation in jquery as well as adding required to fields and max min checks. 
I DID NOT change the DB SCHEMA from TA4. I am still using the same DB I also kept the css file name as TA4.css so I didn't have to go in and edit all the references to it. </p>
I am also a little unclear on propper file structure of the MVC format, but I seperated the classes into the model folder and have all the pages users interact with in the main folder
along with the two jpegs and css file. Other folders contain the sanitize function and config files. I also prepopulated the fields on the application page for easy application
submissions. Also <u>username: newguy password: password2</u> is an admin/instructor and is a good user to test with. I also fetch the user id automatically so the user doesn't have to insert that in the application. 


<br><br>
TA4
PHP Acadamy gave me the core to this functionality. I added classes and functions ass needed for the functionality of this class.
(newguy with password2) should get you in as an admin to test. Also (eddy with password: password) is an instructor. Signing up will get you an applicant.

Permissions allow admins and instructors to see full courselists. Admin can see all applicants. 



The template from php academy did not include the Application class or the Course class. I added several getter and to string functions that created the tables that
would be called throughout the site. 

Concerning OOP in PHP I followed the structure of the 23 part tutorial series on php academy. The Classes are all seperated and in the main folder are all the views.

I spent 30+ hours on this assignment, mostly learning along with the tutorial series, there is a lot of extra functionality like remember me and a profile page.

I also added cookies to the db schema.

<br><br>
TA3
I used sessions with choosing appropriate landing pages on the login process and also with when you look at the course list page that is available to everyone to see the home link in the nav bar is changed according to the role you are in.

I updated the schema to be only 3 tables and only one constraint that you can see in the reversed engineering is the cid (course id) I have populated the 
DB and right now bobby has the crypted password stored, I poppulated the other users before the crypt addition so please test with bobby or add a new user.
You must apply for a course using a propper cid, is the only constraint.

I also need to credit some of the girlscout cookie exmple as well as the new boston and php academy for helping me with this assignment.



<br><br>
TA2 
The Application form requires the user to submit an email in order to be assigned a user ID.
Once a user has an ID they may proceed with the application. They may check the course list for available classes.<br>

That course list is being fed by the DB. And the response from the application queries the DB as well as when the user signs up with their email.<br>


THe schema we came up with proved to be a little over complicated for a beginner like me, with too many foreign key contstrains. A dumbed down version might have been better choice for a first itteration, howvewr in the long run the schema we came up with does require the data to be kept track of properly.
<br>

As I am new to workbench, or at least haven't used it in quite some time it was rather time consuming getting up to speed on it, as well
as mySQl in general. I spent a lot of time on figuring out how to get the last row only to show up so the user wasn't getting everyon elses information. I made the application page show results as well as after the submission. <br>
<br>




My parter this week was Tigran Mnatsakanyan<br>


My peer review paragraph for Tigran:
Your application form seems pretty straight forward and it looks like you are making use of the schema. One thing I would think about is when you ask them to fill out the form for classes that they took, do you want them to fill out all the classes they have ever taken or just relevant classes. I see advantages in requiring them to submit more classes as far as seeing if they are good students but that also is a lot of data being stored. The alternative would be just requiring them to submit grades for only the classes they are applying for, but if they are an inconsistent student you might get a lemon. We might also consider asking for overall GPA in the future.<br>
<br>



Our Peer group was Young Soo Choi #10 and Seongman Kim #42
We had a good discussion with them, I go into further detail in the schema.html file. 
They seemed to have a more simplified Schema with 5 tables at first and I think probably had an easier time implimenting their schema. <br>


My paragraph for Young Soo Choi:<br>


I think your color scheme is appealing, I like the clouds. I think the radio bottons at the top of the navigation bar add a unique touch. Your updated schema looks good. I think there is a lot of information you can store. We didn't go with a GPA field and I think that is usefull. Your Course list is very well detailed as well. I like the prerequisite field.<br>


My paragraph for Seongman Kim:
<br>

Your home page is relaxing. I like the stars. As I told your partner I thought your updated schema looked good and had plenty of information and details, and your course list has good detail. I like the prerequisite field. The color scheme for your site is good, the colors are soothing and not annoying. Some of the text is a little hard to read but that is in the example portions of your text boxes, so I don't think that is a big deal. I would consider putting a Navigation Bar at the top of your application page as well I see you have one at the bottom. <br>


Aaron Burrell  
