-------------------------------
ScreenX readme file
-------------------------------


Version 0.1 (beta)

This is the beta version.<br>
License GPLv2<br>
Open Source

Created by Yury Boykov (aka Neiro) in 20120626, Russia, Moscow<br>
email: neiromc@gmail.com<br>

''DEPENDS: Apache or other web-server, PHP

HINT: For Development use browser in private mode, without saving cache.
If you didn't see graphics from Zabbix with error somthing that "..corrupted image.." do login to the zabbix as corrected user.


INSTALLATION
---------------

Add user to zabbix:
<br />Username: ScreenX
<br />Password: your_password_here

Go to screenX/html/includes/zabbix_auth.inc.php and change:

     //---------------- AUTH CONFIGURATION ---------------- BEGIN
     _zurl = "10.33.101.186"; 	<--- PATH to Zabbix server, IP address or hostname. Don't use http or other symbols before
     _zusername = "ScreenX";  	<--- Username in zabbix for ScreenX
     _zpasswd= "ScreenX";		<--- Password for ScreenX
     //---------------- AUTH CONFIGURATION ---------------- ENDOF


Save, and navigate in browser to http://hostname_or_ipaddress/screenx/html


----------


index.php	<--- It's rotater, looper or somthing that :)
	in this file You can change parameters for rotater. See section "MAIN CONFIGURATION"

screens/	<--- Subfolder for screens.



You can navigate in you browser for static screen if you wan't use rotater.
Go to http://hostname_or_ipaddress/screenx/html/screens/1.php
and you'll see all time only this screen

You can change style in screenX/css
