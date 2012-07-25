<div id="_login" style="display: none;"><iframe id="_iframe_login">Frames not supported</iframe></div>

<script type="text/javascript">

//---------------- AUTH CONFIGURATION ---------------- BEGIN
var _zurl 	= '10.33.101.186';
var _zusername 	= 'ScreenX';
var _zpasswd	= 'ScreenX';
//---------------- AUTH CONFIGURATION ---------------- ENDOF


var zabbix_url 	= 'http://' + _zurl;

 function login2zabbix(){
        _url = zabbix_url + '/index.php?&name=' + _zusername + '&password=' + _zpasswd + '&enter=Sign in';

        //go to url and try login
        $("#_login").html('<iframe id="_iframe_login" src="'+_url+'"></frame>');
        
 }

// ------ API LOGIN ----------- BEGIN
	server = new $.jqzabbix({
	    url: zabbix_url + '/api_jsonrpc.php',  	// URL of Zabbix API
	    username: _zusername,   			// Zabbix login user name
	    password: _zpasswd,  			// Zabbix login password
	});
// ------ API LOGIN ----------- ENDOF



</script>

