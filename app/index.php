<?php
/*
 * Copyright 2015, Google, Inc.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include_once 'creds.php'; // Get $bucket
use google\appengine\api\cloud_storage\CloudStorageTools;
$options = ['gs_bucket_name' => $bucket];
$upload_url = CloudStorageTools::createUploadUrl('/process.php', $options);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cloud Vision API PHP Example</title>
     <script src="js/webcam.js" type="text/javascript"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
</head>
<body style="margin:0">
    <div id="my_camera" style="width:320px; height:240px; position:absolute; left:5px; top:5px; z-index:1"></div>
    <div id="my_result" style="width:320px; height:240px; position:absolute; left:5px; top:5px; z-index:2"></div>
    <script language="JavaScript">
        Webcam.attach( '#my_camera' );

        var take_snapshot = function () {
            Webcam.snap( function(data_uri) {
                document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
				
				var img = data_uri.slice(23);
				document.getElementById('photo').value = img;
				
            } );
			
			
        }
		
	
	var postphoto = function(){
	take_snapshot();
	var x = $('#photo').val();
	var p = new Object;
	p.img = x;
	console.log(p);
	var post = JSON.stringify(p);
	$.ajax({
            url: '/process.php',
            type: 'POST',
            data: post,
            dataType: 'json',
            success: function(data,status){
                console.log(data);
				console.log(data.responses[0].textAnnotations.length)
				var x = data.responses[0].textAnnotations.length;
				var patt = new RegExp('^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$');
				var pt = new RegExp('^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$');
				for(i=0;i<x;i++){
					
					var y = data.responses[0].textAnnotations[i].description;
					if(y.length===3 && !isNaN(y)){
						
						console.log('numerino ' + y);
						
						
						}
					if (patt.test(y)){
						
						console.log(y);
						
						}
					
					
					}
				var u = x - 1;
				var b = data.responses[0].textAnnotations[u].description
				console.log('Utenti attesa:' + b);
				
				 var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = dd+'/'+mm+'/'+yyyy;
	console.log(today);
			
		var str = data.responses[0].textAnnotations[0].description
		var servizio = '';		
		if(str.includes('FINA')){
			
			servizio = 'F'
			
			}else if(str.includes('SOL')){
				
				servizio = 'S'
				
				}else{
					
					servizio = 'P'
					}		
				console.log(servizio);
            },
			error: function(e) {
				console.log(e);
			}
       });
		

		}	


	
    </script>

 <!--<a href="javascript:void(take_snapshot())">Take Snapshot</a>-->
<input type="hidden" id="photo">
<input type="hidden" id="v">
<div style="position:absolute; bottom:25%">
<a href="#" onClick="services()" style="">SERVICES</a>

<a href="#" onClick="postphoto()" style="">CHECK</a>
</div>
</body>
</html>