using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using OpenQA.Selenium;
using OpenQA.Selenium.Support.UI;
using OpenQA.Selenium.Firefox;
using OpenQA.Selenium.Interactions;
using System;
using System.IO;

namespace SeleniumTA
{
    class Program
    {
        static void Main(string[] args)
        {
            TextReader tIn = Console.In;
            TextWriter tOut = Console.Out;



            //Test Registration and Application Process starting from Index page
            //click the register nav to get started.


            IWebDriver driver = new FirefoxDriver();
            driver.Navigate().GoToUrl(("http://uofu-cs4540-7.cloudapp.net/Projects/TA7/index.php"));

            IWebElement element = driver.FindElement(By.Id("nav8"));
            element.Click();

            // Send Keys to each field and hit submit. Green Check marks should appear.
            String applicantname = "Tester";
            applicantname += DateTime.Now.ToString("yyMMddHHmmss");

            element = driver.FindElement(By.Id("username"));
            element.SendKeys(applicantname);

            IWebElement photoContainer = driver.FindElement(By.Id("username"));
            String imgUrl = photoContainer.GetCssValue("background-image");
            Console.WriteLine(imgUrl);
            //check to see if the background image url is the check image.

            

            element = driver.FindElement(By.Id("name"));
            element.SendKeys("Selena Uzor");

            element = driver.FindElement(By.Id("email"));
            element.SendKeys("Tester@somewhere.com");

            tOut.Write("What is your password: ");
            String password = tIn.ReadLine(); //  pause the console get tester to input password.

            element = driver.FindElement(By.Id("password1"));
            element.SendKeys(password);

            element = driver.FindElement(By.Id("password2"));
            element.SendKeys(password);

            element = driver.FindElement(By.Id("submit"));
            element.Click();

            //database should reflect the new user 
            //with this user we should now be able to test the application process.


            element = driver.FindElement(By.Id("nav5"));
            element.Click();

            element = driver.FindElement(By.Name("username"));
            element.Clear();
            element.SendKeys(applicantname); // might need to clear if autofilled.

            element = driver.FindElement(By.Name("password"));
            element.SendKeys(password); // sends the password stored earlier.

            element = driver.FindElement(By.Id("login"));
            element.Click();

            element = driver.FindElement(By.Id("nav4")); // Start or View Applications
            element.Click();

            //Fill Out all the fields...the first should be autofilled with Selena Uzor
            //element = driver.FindElement(By.XPath("//table[@id='HiringTable']//tr[2]//td[4]" ));
            // tOut.Write(element.ToString()); 
            // tIn.ReadLine();


            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> td =
               driver.FindElements(By.XPath("//td[@class='cname']"));

            Console.WriteLine("found: " + td.Count);
            String cname = null; // grab the last cname from the xpath and apply using that value.
            foreach (IWebElement d in td)
            {
                cname = d.Text;
                Console.WriteLine(cname);
            }

            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> td2 =
              driver.FindElements(By.XPath("//td[@class='cnumber']"));

            Console.WriteLine("found: " + td2.Count);
            String cnumber = null; // grab the last cnumber from the xpath and apply using that value.
            foreach (IWebElement d2 in td2)
            {
                cnumber = d2.Text;
                Console.WriteLine(cnumber);
            }

            // Console.Read();



            element = driver.FindElement(By.Name("coursename"));
            element.Clear();
            element.SendKeys(cname);

            element = driver.FindElement(By.Name("cid"));
            element.Clear();
            element.SendKeys(cnumber);

            element = driver.FindElement(By.Name("grade"));
            element.Clear();
            element.SendKeys("A");

            element = driver.FindElement(By.Name("semesterTaken"));
            element.Clear();
            element.SendKeys("Spring 2012");

            element = driver.FindElement(By.Name("semesterApplying"));
            element.Clear();
            element.SendKeys("Fall 2015");


            element = driver.FindElement(By.Id("submit"));
            element.Click();
            // this will take us back to index, to see if application posted 
            //go back to start or view application "nav4".

            element = driver.FindElement(By.Id("nav4"));
            element.Click();

            // the data for this application should show under submitted applications.

            //our assertion will test to assert that the application featuring the cname and cnumber are the same as
            //what is displayed in the displayed application on the user's page.

            //First we need to pull those two values so we can compare them.

            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> td3 =
             driver.FindElements(By.XPath("//td[@class='myappname']"));

            Boolean firstEntry = false;
            Console.WriteLine("found: " + td3.Count);
            String cname2 = null; // grab the first myappname from the xpath and apply using that value.
            foreach (IWebElement d3 in td3)
            {
                
                
                    cname2 = d3.Text;
                    Console.WriteLine(cname2);
                    firstEntry = true;
                
            }



            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> td4 =
             driver.FindElements(By.XPath("//td[@class='myappcid']"));

            firstEntry = false;
            Console.WriteLine("found: " + td4.Count);
            String cnumber2 = null; // grab the first myappname from the xpath and apply using that value.
            foreach (IWebElement d4 in td4)
            {
                
                    cnumber2 = d4.Text;
                    Console.WriteLine(cnumber2);
                    
                
            }

            if (cname == cname2) {
                Console.WriteLine("The course name: "+cname+
                    " which was entered in making the application matches the course name:"+cname2+
                    " that is displayed in the application");
            }
            else { Console.WriteLine("the course names "+cname+" and "+cname2+"did not match up from application submission and application displayed"); }

            if (cnumber == cnumber2)
            {
                Console.WriteLine("The course number: " + cnumber +
                    " which was entered in making the application matches the course number:" + cnumber2 +
                    " that is displayed in the application");
            }
            else { Console.WriteLine("The course numbers"+cnumber+" and "+cnumber2+" did not match up from application submission and application displayed"); }

            if (cnumber == cnumber2 & cname == cname2) { 
                Console.WriteLine("Both Assertions passed!"); 
            }
            else { 
                Console.WriteLine("Both Assertions did NOT pass!"); 
            }
            Console.Read();

        }
    }
}
