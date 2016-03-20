<?php



	function getenrollment($year_seme_code,$catalogue,$section,$department){


		 $enrolled= "";
		 $cap ="";
		 $scraper = array("instantiating","values");
		 $x = 0;
		 $fp = fsockopen("www.acs.utah.edu", 80, $errno, $errstr, 5);

		  $out = "GET /uofu/stu/scheduling/crse-info?term=";
    	  $out .= "$year_seme_code";
  
    	  $out .= "&subj=";
    	  $out .= "$department";
    	  $out .="&catno=";
    	  $out .= "$catalogue";
    	  $out .= " HTTP/1.1\r\n";
    	  $out .= "Host:www.acs.utah.edu\r\n";
   	   	  $out .= "Connection: Close\r\n\r\n";


   	   	  //
  // Send GET request
  //
    fwrite($fp, $out);



    if (!$fp)
    {
      $content = " offline ";
    }
    else
    {
      //
      // pull the entire web page and concat it up in a single "page" variable
      //
      $page = "";
      while (!feof($fp))
      {
        $page .= fgets($fp, 1000);
      }
      fclose($fp);

      $doc = new DOMDocument();
      $doc->loadHTML( $page );

      $table = $doc->getElementsByTagName('table');
      $rows = $table->item(0)->getElementsByTagName('tr');

      
      
      foreach ($rows as $row)
      {
        $cells = $row->getElementsByTagName('td');
        foreach ($cells as $cell)
        {
          $scraper[]= $cell->nodeValue;  // push each cell node value into an array for later use.
          $x++; 
          
        }
        


      }
      
    }
    $temp ='';
    $y=0;
    $z = count($scraper);

    while ($y < ($z-1))
    { 
      $temp =$info[$y];

      if (strcmp($temp,$section)===0)
      {

      	$enrolled = escape($scraper[($y+3)]);
      	$enrolled = preg_replace("/\s|&nbsp;/",'',$enrolled);


      	$cap = escape($scraper[($y+2)]);
      	$cap = preg_replace("/\s|&nbsp;/",'',$cap);

      	$enandcap = array ($enrolled,$cap);
      	return $enandcap;
      }






	}


}
// this translates a normal year semester request and returns the U's code for year and semester. The cs schedule goes back to 2008. 
	function gettranslation($wantedyear, $wantedsemester) {
		$translation = '';

		
			
			if($wantedyear === '2008') 
			{
				$translation.='108';
			}


			else if($wantedyear === '2009') 
			{
				$translation.='109';
			}

			else if($wantedyear === '2010') 
			{
				$translation.='110';
			}
			else if($wantedyear === '2011') 
			{
				$translation.='111';
			}
			else if($wantedyear === '2012') 
			{
				$translation.='112';
			}
			else if($wantedyear === '2013') 
			{
				$translation.='113';
			}
			else if($wantedyear === '2014') 
			{
				$translation.='114';
			}
			else if($wantedyear === '2015') 
			{
				$translation.='115';
			}
			

		

		if($wantedsemester === 'fall' ){
			$translation .='8';
		}

		else if($wantedsemester === 'summer' ){
			$translation .='6';
		}

		else if($wantedsemester === 'spring' ){
			$translation .='4';
		}

		return $translation;
	
}