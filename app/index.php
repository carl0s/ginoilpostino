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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Gino il Postino - Servizi al Cittadino</title>
    <meta name="description" content="Gino il Postino - Servizi al Cittadino" />
    <meta name="keywords" content="Gino il Postino - Servizi al Cittadino" />
    <meta name="author" content="Team #keeppushing" />
    <link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="dist/styles/app.css" />
    <script src="dist/scripts/modernizr.custom.js"></script>
    <script src="dist/scripts/webcam.js" type="text/javascript"></script>

</head>
<body class="nl-blurred">
  <div class="container demo-1">
    <!-- Top Navigation -->
    <header>
      <h1>Benvenuto a Gino il Postino</h1>
      <div class="flag">
        <div class="flag-item" data-lang="it"><img src="dist/images/italy.svg"></div>
        <div class="flag-item" data-lang="de"><img src="dist/images/italy.svg"></div>
        <select class="hidden">
          <option value="it" selected></option>
          <option value="de"></option>
        </select>
      </div>
    </header>
  <div class="camera">
    <div id="my_camera" style="width:640px; height:240px; position:absolute; left:5px; top:5px; z-index:1"></div>
    <div id="my_result"></div>
  </div>
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
	var post = JSON.stringify(p);
	$.ajax({
            url: '/process.php',
            type: 'POST',
            data: post,
            dataType: 'json',
            success: function(data,status){
                console.log(data);
            },
			error: function(e) {
				console.log(e);
			}
       });
		
		
		}	
		
    </script>

 <!--<a href="javascript:void(take_snapshot())">Take Snapshot</a>-->
<input type="hidden" id="photo">


<a href="#" onClick="postphoto()" style="position:absolute; bottom:0">CHECK</a>
</div>
</body>
</html>