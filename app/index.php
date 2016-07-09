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
    <div id="my_result"></div>
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
</body>
</html>