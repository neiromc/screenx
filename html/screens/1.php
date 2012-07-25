<!doctype html>
<html>

<head>
        <meta charset="UTF-8" />
        <title>ScreenX: Tranzware #1</title>
                <meta http-Equiv="Cache-Control" Content="no-cache">
                <meta http-Equiv="Pragma" Content="no-cache">
                <meta http-Equiv="Expires" Content="0">
</head>



<?php include '../includes/head.inc.php'; ?>

<body>

<?php include '../includes/zabbix_auth.inc.php'; ?>





<!-- header -->
<div id="header"><h1>Tranzware - Screen #1</h1></div>

<div id="test_1" style="display: none;">TEST_1</div>

<!-- content -->

<div id="group_1" class="screenGroup" style="">
 <div id="block_6" class="itemBox" style="width: 782px;">
   <div id="block_6-caption" class="itemBox-caption"></div>
   <div id="block_6-body" class="itemBox-body"></div>
   <div id="block_6-update_interval" class="itemBox-update_interval"></div>
 </div>
<!--
 <div id="block_7" class="itemBox">
   <div id="block_7-caption" class="itemBox-caption"></div>
   <div id="block_7-body" class="itemBox-body"></div>
   <div id="block_7-update_interval" class="itemBox-update_interval"></div>
 </div>
-->
</div>


<!--
<div id="group_2" class="screenGroup" style="display: none;">
 <div id="block_1" class="itemBox">
   <div id="block_1-caption" class="itemBox-caption"></div>
   <div id="block_1-body" class="itemBox-body"></div>
   <div id="block_1-update_interval" class="itemBox-update_interval"></div>
 </div>

 <div id="block_2" class="itemBox">
   <div id="block_2-caption" class="itemBox-caption"></div>
   <div id="block_2-body" class="itemBox-body"></div>
   <div id="block_2-update_interval" class="itemBox-update_interval"></div>
 </div>

 <div id="block_4" class="itemBox">
   <div id="block_4-caption" class="itemBox-caption"></div>
   <div id="block_4-body" class="itemBox-body"></div>
   <div id="block_4-update_interval" class="itemBox-update_interval"></div>
 </div>

</div>
-->

<div id="group_3" class="screenGroup" style="height: 498px;">
 <div id="block_5" class="graphBox" style="width: 582px; float: left;">
   <div id="block_5-caption" class="graphBox-caption"></div>
   <div id="block_5-body" class="graphBox-body"></div>
   <div id="block_5-update_interval" class="itemBox-update_interval"></div>
 </div>


 <div id="block_3" class="graphBox" style="width: 582px; float: left;">
   <div id="block_3-caption" class="graphBox-caption"></div>
   <div id="block_3-body" class="graphBox-body"></div>
   <div id="block_3-update_interval" class="itemBox-update_interval"></div>
 </div>
</div>





<script>

//var zabbix_url = 'http://10.33.101.186';
var loading_gif = '<div id="update_image"></div>';
//var clock_icon = '<span id="clock_icon"><img src="../images/clock.ico" /></span>';
var clock_icon = '<div id="clock_icon"><img src="../../images/clock.ico" /></div>';
var update_interval_text = '<div id="update_interval_text">';
//var _value = 0;
var _value_last = new Array()
var _firstSTART = 'true';
var issues_count_max = 9;
var _criticalALARM = 5;

var success = function() { alert('success!'); }
var error = function() { alert('error!'); }



//var cur_datetime = function get_cur_datetime() {
var cur_datetime = function() {
 var today = new Date();
 var dd = today.getDate();
 var mm = today.getMonth()+1; //January is 0!
 var HH = today.getHours();
 var MM = today.getMinutes();
 var SS = today.getSeconds();
 var yyyy = today.getFullYear();
 var yy = today.getYear()-100;

  if(dd<10){dd='0'+dd} 
   if(mm<10){mm='0'+mm} 
    if(HH<10){HH='0'+HH} 
     if(MM<10){MM='0'+MM} 
      if(SS<10){SS='0'+SS} 
   
 var today = dd+'.'+mm+'.'+yy+' '+HH+':'+MM+':'+SS;

 return today;
}



var convert_datetime = function(_datetime) {
 var today = new Date(_datetime*1000);
 var dd = today.getDate();
 var mm = today.getMonth()+1; //January is 0!
 var HH = today.getHours();
 var MM = today.getMinutes();
 var SS = today.getSeconds();
 var yyyy = today.getFullYear();
 var yy = today.getYear()-100;

  if(dd<10){dd='0'+dd} 
   if(mm<10){mm='0'+mm} 
    if(HH<10){HH='0'+HH} 
     if(MM<10){MM='0'+MM} 
      if(SS<10){SS='0'+SS} 
   
 var today = dd+'.'+mm+'.'+yy+' '+HH+':'+MM+':'+SS;

 return today;
}

//--- ITEM: ------------------------ BEGIN
//--- ITEM: ------------------------ END


function animate_itemChange(block_id, show_or_hide, speed) {
	$('#'+block_id+'-body').animate({ opacity: show_or_hide }, speed);

}

//--- ITEM: ----------------------- BEGIN
var _up_alarm = new Array();

function get_item_float(method, itemid, block_id, upd_interval, caption, divider) {
      animate_itemChange(block_id, 'hide', 'fast');
      $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;'+caption+loading_gif);
         params = {};
         params.itemids = itemid;
         params.output = 'extend';
          server.sendAjaxRequest(method, params, function(response){
          _value = Math.round(response.result[0,0].lastvalue / divider * 100) / 100;
	 
          if (_value_last[itemid] == null) { _value_last[itemid] = _value }
	  	if (_value > _value_last[itemid]) 
		{ 
		  _value_change = "&#9650"; 
		  _value_change_color = "up"; 
		  _up_alarm[itemid] += 1;
	        } else
	  	 if (_value < _value_last[itemid]) 
		 { 
		  _value_change = "&#9660"; 
		  _value_change_color = "down"; 
		  _up_alarm[itemid] = 0;
		 } else {
	  	   _value_change = "&#9679";
	  	   _value_change_color = "null";
		   _up_alarm[itemid] = 0;
		  }

//           $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;'+caption+'-'+_up_alarm[itemid]);
           $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;'+caption);


          if (_up_alarm[itemid] > _criticalALARM) { 
	   // ALARM here!!! Body in RED!!!
	    document.getElementById(block_id+'-body').style.backgroundColor = '#f00';
            $('#' + block_id + '-body').html('<div class="br_80"></div><span style="color: #fff;">'+_value+'</span>');
	  } else {
	    document.getElementById(block_id+'-body').style.backgroundColor = '#fff';
            $('#' + block_id + '-body').html('<div class="br_80"></div><span class="value_change_2_'+_value_change_color+'">'+_value+'</span>');

	  }	
           $('#' + block_id + '-update_interval').html(update_interval_text+'<span id="upd_int_1">'+upd_interval+' sec.</span>&nbsp;&nbsp;'
		  +cur_datetime()+' - ['+_value_last[itemid]+'] <span id="value_change" class="value_change_1_'+_value_change_color+'">'+_value_change+'</span></div>'+clock_icon);
          _value_last[itemid] = _value;
          }, error);

      animate_itemChange(block_id, 'show', 'slow');

      _cmd='get_item_float("'+method+'", "'+itemid+'", "'+block_id+'", '+upd_interval+',"'+caption+'", '+divider+');';
      setTimeout(_cmd, upd_interval*1000);
}
//--- ITEM: ---------------------- END




//--- GRAPH: --------------------- BEGIN
function get_graph(graph_id, graph_id_type, chart, graph_period, graph_width, block_id, upd_interval, caption) {
     animate_itemChange(block_id, 'hide', 'fast');
      iframe_url=zabbix_url + "/"+chart+".php?"+graph_id_type+"="+graph_id+"&sid=b3d4f589c88f88f8&width="+graph_width+"&period="+graph_period;
           $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;'+caption);
           $('#' + block_id + '-body').html('<iframe src="' + iframe_url 
                  //+ '" style="height: 100%; width: '+(graph_width+150)+'px; margin-left: 8px; margin-top: 8px;" frameborder=0 scrolling=no>Frames not supported</iframe>');
                  + '" style="height: 100%; width: '+(graph_width+150)+'px; margin-left: 0px; margin-top: 0px;" frameborder=0 scrolling=no>Frames not supported</iframe>');
           $('#' + block_id + '-update_interval').html(update_interval_text+'<span id="upd_int_1">'+upd_interval+' sec.</span> ('
		  +cur_datetime()+')</div>'+clock_icon);


      animate_itemChange(block_id, 'show', 'slow');

      _cmd='get_graph("'+graph_id+'", "'+graph_id_type+'", "'+chart+'", '+graph_period+', '+graph_width+', "'+block_id+'", '+upd_interval+', "'+caption+'");'
      setTimeout(_cmd, upd_interval*1000);
}
//--- GRAPH: --------------------- END




//--- ISSUES: -------------------- BEGIN
var get_hostName_byTriggerID = function(_triggerid, callback) {
         params = {};
         params.output = 'extend';
         params.triggerids = _triggerid;
          server.sendAjaxRequest('host.get', params, function(response){
		_mystr = response.result[0].host;
	   }, error, function(){
		callback(_triggerid, _mystr);
	   }
	  );
}


var _hostNames_inAlarms = new Array();
var _triggerSeverities = new Array();

	_triggerSeverities[0] = "#DBDBDB";	// Not classified
	_triggerSeverities[1] = "#D6F6FF";	// Information
	_triggerSeverities[2] = "#FFF6A5";	// Warning
	_triggerSeverities[3] = "#FFB689";	// Average
	_triggerSeverities[4] = "#FF9999";	// High
	_triggerSeverities[5] = "#FF3838";	// Disaster


function get_alarms(block_id, upd_interval, caption) {
      animate_itemChange(block_id, 'hide', 'fast');
      $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;'+caption+loading_gif);
         params = {};
         params.output = 'extend';
         params.only_true = true;
         params.monitored = true;
	 params.sortfield = 'lastchange';
         params.filter = {value: 1};
          server.sendAjaxRequest('trigger.get', params, function(response){
           var alarms_result = response.result;
           var _str = "";

	   if (alarms_result.length <= issues_count_max) { 
		issues_count = alarms_result.length
	   } else
	    if (alarms_result.length > issues_count_max) {
		issues_count = issues_count_max;
	    }


            for (var i=0;i<issues_count;i++) {
		get_hostName_byTriggerID(alarms_result[i].triggerid, function(id, arg) {
	  		_hostNames_inAlarms[id] = arg;
		});

		_alarmDateTime = convert_datetime(alarms_result[i].lastchange);
	  	_hostName = _hostNames_inAlarms[alarms_result[i].triggerid];
		_alarmIssue = alarms_result[i].description.replace("{HOSTNAME}", _hostName);
		_alarmPriority = alarms_result[i].priority;

		_div_issue='<div id="issue_lines" style="background-color: #fff";>';

 		 if (_hostName != null) {
	          _str = _str + _div_issue
		    + '<div id="issue_lines_item" class="issue_lines_item_date_'+i%2+'">' + _alarmDateTime + '</div>'
		    + '<div id="issue_lines_item" class="issue_lines_item_srvname_'+i%2+'">' + _hostName + '</div>'
		    + '<div id="issue_lines_item" class="issue_lines_item_issue" style="background-color: '
		    +_triggerSeverities[_alarmPriority]+'; ">' 
		    + _alarmIssue + '</div>'
		    + "</div>";

		 } else {
		     _str='<div id="loaderb32"></div>';
		 }
            }


           $('#' + block_id + '-caption').html('<div class="br_5"></div>&nbsp;Last '+issues_count_max+' of '+alarms_result.length+' issues');
           $('#' + block_id + '-body').html('<div class="alarms_list">'+_str+'</div>');
           $('#' + block_id + '-update_interval').html(update_interval_text+'<span id="upd_int_1">'+upd_interval+' sec.</span> ('
		  +cur_datetime()+')</div>'+clock_icon);

          }, error);

      animate_itemChange(block_id, 'show', 'slow');

      _cmd='get_alarms("'+block_id+'", "'+upd_interval+'", "'+caption+'");'
      if (_firstSTART != 'true') {
      	setTimeout(_cmd, upd_interval*1000);
      } else {
	_firstSTART = 'false';
      	setTimeout(_cmd, 2000);
      }
}
//--- ISSUES: -------------------- END


//--------- MAIN JAVASCRIPT --------------- BEGIN
$(document).ready(function(){

login2zabbix();


/*
// ------ API LOGIN ----------- BEGIN
server = new $.jqzabbix({
    url: zabbix_url + '/api_jsonrpc.php',  // URL of Zabbix API
    username: 'ScreenX',   // Zabbix login user name
    password: 'ScreenX',  // Zabbix login password
});
// ------ API LOGIN ----------- ENDOF
*/


    //server.getApiVersion();
    server.userLogin(null, function(){

//   var method = 'item.get';
//   var params = {};
//   var my_result = {};


	//---ITEM: TPS on Main INstance on TW DB -------
	//	get_item_float('item.get', '100100000022785', 'block_1',  5, 'TPS on instance: MAIN', 1);
//		get_item_float('item.get', '100100000022195', 'block_1',  5, 'CPU on server: TW App', 1);
	//---ITEM: CPU load on TW App ---
//		get_item_float('item.get', '100100000022297', 'block_2',  5, 'CPU on server: TW DB', 1);
	//---ITEM: TW App Free space on / ---
//		get_item_float('item.get', '100100000018504', 'block_4', 10, 'Free space on /: TW App (Gb)', 1024*1024*1024);
	//---GRAPH: CPU load on TWO ---
		get_graph('100100000000391', 'graphid', 'chart2',3600, 450, 'block_5', 15, 'CPU Load: TW App');
        //---GRAPH: CPU load on Zabbix Server ---
                get_graph('100100000018468',  'itemid',  'chart',3600, 450, 'block_3', 10, 'CPU Load: Zabbix');

	//---ISSUES: Last Issues ---
		get_alarms('block_6', 10);

    }, error);


});
//--------- MAIN JAVASCRIPT --------------- END

</script>

</body>
</html>
