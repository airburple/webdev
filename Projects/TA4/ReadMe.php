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
