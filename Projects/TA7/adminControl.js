var xmlHttp = createXmlHttpRequestObject();
//var xmlHttp2 = createXmlHttpRequestObject2();

function createXmlHttpRequestObject() {

	var xmlHttp;

	if (window.ActiveXObject){
		try{
			xmlHttp = new ActiveXObject("Microsofot.XMLHTTP");
		} catch (e) {
			xmlHttp = false;
		}
	}else{
		try{
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			xmlHttp = false;
		}
	}

	if (!xmlHttp) {
		alert("Could not create XML Object");
	} else {
		return xmlHttp;
	}
}

// function createXmlHttpRequestObject2() {

// 	var xmlHttp2;

// 	if (window.ActiveXObject){
// 		try{
// 			xmlHttp2 = new ActiveXObject("Microsofot.XMLHTTP");
// 		} catch (e) {
// 			xmlHttp2 = false;
// 		}
// 	}else{
// 		try{
// 			xmlHttp2 = new XMLHttpRequest();
// 		} catch (e) {
// 			xmlHttp2 = false;
// 		}
// 	}

// 	if (!xmlHttp2) {
// 		alert("Could not create XML Object");
// 	} else {
// 		return xmlHttp2;
// 	}
// }

function process() {


		course = encodeURIComponent(document.getElementById("userInput").value);
		//TA = encodeURIComponent(document.getElementById("userInput2").value);
		
		
		xmlHttp.open("GET", "adminControl.php?course="+course, true);
		//xmlHttp.open("GET", "adminControl.php?TA="+TA, true);
		xmlHttp.onreadystatechange = handleServerResponse;
		xmlHttp.send();

		

}

function handleServerResponse () {

	if ( xmlHttp.readyState==4 )
		if ( xmlHttp.status==200) {
		xmlResponse = xmlHttp.responseXML;
		xmlDocumentElement = xmlResponse.documentElement;
		message = xmlDocumentElement.firstChild.textContent;
		document.getElementById("underInput").innerHTML = '<span style="color:blue">' + message + '</span>';
	}
}


// 	function processAssign() {


// 		TA = encodeURIComponent(document.getElementById("userInputAssign").value);
// 		//alert(food);
// 		xmlHttp2.open("GET", "assignTA.php?TA="+TA, true);
// 		xmlHttp2.onreadystatechange = handleServerResponseAssign;
// 		xmlHttp2.send();

// }

// function handleServerResponseAssign () {

// 	if ( xmlHttp2.readyState==4 )
// 		if ( xmlHttp2.status==200) {
// 		xmlResponse = xmlHttp2.responseXML;
// 		xmlDocumentElement = xmlResponse.documentElement;
// 		message = xmlDocumentElement.firstChild.textContent;
// 		document.getElementById("underInputAssign").innerHTML = '<span style="color:blue">' + message + '</span>';
// 	}


// }