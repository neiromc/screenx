<html>
	<head>
		<meta charset="UTF-8" />
		<title>ScreenX: Rotator</title>

		<meta http-Equiv="Cache-Control" Content="no-cache">
		<meta http-Equiv="Pragma" Content="no-cache">
		<meta http-Equiv="Expires" Content="0">
	</head>

	<link rel="shortcut icon" href="../images/zabbix.ico" />
	<link rel="stylesheet" type="text/css" href="../css/rotater.css" />
	<script type="text/javascript" charset="utf-8" src="../js/jquery-1.4.2.js"></script>


<body>

<?php include 'includes/zabbix_auth.inc.php'; ?>

<div id="_error_div"></div>
<div id="_iframe"><iframe id="_iframe_main">Frames not supported</iframe></div>
<div id="footer"><h1>&copy;20120623 - Created by <a href="mailto: neiromc@gmail.com">Neiro</a></h1></div>


<script type="text/javascript">

//-------------- MAIN CONFIGURATION ---------------- BEGIN

 var changeInterval = 10; 	// Interval in seconds, can change as you wish
 var screensDir = 'screens'; 	// Subfolder in home directory contained screens html files 
 var screens = new Array()	// Array of screens file names in Subfolder
	screens[0] = "1.php";
	screens[1] = "2.php";
	screens[2] = "3.php";

 var currentScreen = 0; 		// First screen in the loop, can change as you wish

//-------------- MAIN CONFIGURATION ---------------- ENDOF


 function changeScreen(currentScreenName) {
	// Text out current screen filename here, for debug
	$("#_error_div").html("Current screen filename: "+screensDir+'/'+currentScreenName);
	//--------------------------------
	$("#_iframe").fadeOut(1500, function() {

        	if ( currentScreen == screens.length-1 ) { 
	         currentScreen = 0;
	        } else { 
	         currentScreen += 1;
	        }

	   $("#_iframe").html('<iframe id="_iframe_main" src="'+screensDir+'/'+currentScreenName+'" frameborder="0" scrolling="no"></iframe>');

	   $("#_iframe").fadeIn(1000, "linear");
	   setTimeout("changeScreen(screens["+currentScreen+"]);", changeInterval*1000)
	});

 }


//--------- MAIN JAVASCRIPT ------------ BEGIN
 $(document).ready(function(){
	
	login2zabbix();

	$("#_iframe").fadeOut(10, function() {
		changeScreen(screens[currentScreen]);
	});
 });
//--------- MAIN JAVASCRIPT ------------ END

</script>



</body>
</html>
