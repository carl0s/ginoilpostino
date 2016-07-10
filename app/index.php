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
    <title>PosteChiare - Amicizia lunga</title>
    <meta name="description" content="PosteChiare - Amicizia lunga" />
    <meta name="keywords" content="PosteChiare - Amicizia lunga" />
    <meta name="author" content="Team #keeppushing" />
    <link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="dist/styles/app.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
    <script src="dist/scripts/modernizr.custom.js"></script>
    <script src="dist/scripts/webcamjs/webcam.js" type="text/javascript"></script>
<style>
.spinner {
  width: 400px;
  height: 150px;
  font-size: 10px;
  position: absolute;
  right: 40px;
  bottom: 0
}

.spinner > div {
  background-color: #0047bb;
  height: 100%;
  width: 20px;
  display: inline-block;
  
  -webkit-animation: sk-stretchdelay 1.8s infinite ease-in-out;
  animation: sk-stretchdelay 1.8s infinite ease-in-out;
}

.spinner .rect2 {
  -webkit-animation-delay: -1.7s;
  animation-delay: -1.7s;
}

.spinner .rect3 {
  -webkit-animation-delay: -1.6s;
  animation-delay: -1.6s;
}

.spinner .rect4 {
  -webkit-animation-delay: -1.5s;
  animation-delay: -1.5s;
}

.spinner .rect5 {
  -webkit-animation-delay: -1.4s;
  animation-delay: -1.4s;
}
.spinner .rect6 {
  -webkit-animation-delay: -1.3s;
  animation-delay: -1.3s;
}.spinner .rect7 {
  -webkit-animation-delay: -1.2s;
  animation-delay: -1.1s;
}.spinner .rect8 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}
.spinner .rect9 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}
.spinner .rect10 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}
.spinner .rect11 {
  -webkit-animation-delay: -0.7s;
  animation-delay: -0.7s;
}
.spinner .rect12 {
  -webkit-animation-delay: -0.6s;
  animation-delay: -0.6s;
}
.spinner .rect13 {
  -webkit-animation-delay: -0.5s;
  animation-delay: -0.5s;
}
.spinner .rect14 {
  -webkit-animation-delay: -0.4s;
  animation-delay: -0.4s;
}
.spinner .rect15 {
  -webkit-animation-delay: -0.3s;
  animation-delay: -0.3s;
}
.spinner .rect16 {
  -webkit-animation-delay: -0.2s;
  animation-delay: -0.2s;
}
.spinner .rect17 {
  -webkit-animation-delay: -0.1s;
  animation-delay: -0.1s;
}



@-webkit-keyframes sk-stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
  20% { -webkit-transform: scaleY(1.0) }
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% { 
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% { 
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}

.hideright{
left: 100%;

}
.hideleft{
transform:translate(-100%,0);
opacity: 0;

}
.shiftleft{
transform:translate(0,0);

}

.coin{

	width:42px;
	height: 42px;
	border-radius:50%;
	border: 2px solid #fff;
    position: absolute;
    z-index: 10;
    left: calc(50% - 21px);
    top: calc(50% - 21px);


}

.square{

height: 60px;
width: 60px;
background-color: #999;

}


}
</style>
   </head>

<body class="nl-blurred">
  <div class="container demo-1">
    <!-- Top Navigation -->
    <header>
      <h1>PosteChiare</h1>
      <div class="flag">
        <div class="flag-item" data-lang="it"><img src="dist/images/italy.svg"></div>
        <div class="flag-item" data-lang="de"><img src="dist/images/italy.svg"></div>
        <select class="hidden">
          <option value="it" selected></option>
          <option value="de"></option>
        </select>
      </div>
    </header>
  <div class="camera" style="position:absolute; width:100%; transition: 1s; background-color:#fff; z-index:101">
  <div style="position:absolute; top:0; right:40px; width: 500px;text-align: right;">
  	<p style="margin-top: 0px;font-size: 4em; margin:0">MOSTRA IL TUO TICKET ALLA CAMERA</p>
  	<p style="margin-top: 0px;font-size: 2em;">E CLICCA AVANTI</p>

  	<p style="margin-top: -20px;font-size: 2em; color:#ff867d; display:none; font-weight: 700;" id="riprova">RIPROVA</p>

  </div>
  <div class="spinner" style="display:none">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
  <div class="rect6"></div>
  <div class="rect7"></div>
  <div class="rect8"></div>
  <div class="rect9"></div>
  <div class="rect10"></div>
  <div class="rect11"></div>
  <div class="rect12"></div>
  <div class="rect13"></div>
  <div class="rect14"></div>
  <div class="rect15"></div>
  <div class="rect16"></div>
  <div class="rect17"></div>  
</div>
<button class="next-slide" style="bottom:0" onClick="postphoto()">
AVANTI
</button>
    <div id="my_camera" style="width:640px; height:240px; margin: 20px 20px;"></div>
	<!---<div class="overlay" style="top: calc(50% - 120px);left: calc(50% - 160px);">
    	<div class="top"></div>
    	<div class="bottom"></div>
    	<div class="left"></div>
    	<div class="right"></div>
    </div>-->
    <div id="my_result" style="width:640px; height:240px;position:absolute;margin: 20px 20px; top:0; z-index:5"></div>
  </div>

<div id="shift" style="position:absolute; width:100%;height:520px;transition: 1s;background-color:#fff; z-index:99">
<div id="ticket" style="width:300px; height:320px;box-shadow: 0px 0px 20px #333;left:150px; margin-top:100px;position:absolute; text-align:center">
<p style="margin-bottom: 0;font-size:30px"><strong>Poste</strong>italiane</p>
<p style="margin:0"><i>ANDRIA</i></p>
<p id="service" style="margin-bottom: 0;"></p>
<div style ="display:inline-block; position:relative;" class="square">
<div class="coin" style="color:#fff">
<p style="margin:0; font-size:30px; margin-top: -2px;" id="icn">€</p>
</div>
</div>
<p id="numero" style="font-size: 65px;font-weight: 700;margin: 0;display:inline-block;    vertical-align: super;"></p>
<p id="data" style="margin:0"></p>
<p id="utenti"></p>
</div>
  <div style="position:absolute; top:0; right:40px; width: 500px;text-align: right; margin-top:20px">
  	<p style="margin-top: 0px;font-size: 4em;">SCANSIONE CORRETTA</p>
  	<p style="margin-top: 0px;font-size: 2em;">SE COMPILERAI DEI MODULI SARANNO COLLEGATI A QUESTO TICKET</p>

  </div>
<button class="next-slide" style="bottom:0" onClick="next();">
INIZIA ORA
</button>
</div>
    <script language="JavaScript">

    var next = function(){
window.location.href ='./cosa?u='+$('#fila').val;


    }
	
	Webcam.set({
        width: 640,
        height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });
	
	
        Webcam.attach( '#my_camera' );


        var take_snapshot = function () {
            Webcam.snap( function(data_uri) {
             document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
				
				var img = data_uri.slice(23);
				document.getElementById('photo').value = img;
				
            } );
			
			
        }
		
	
	var postphoto = function(){
	$('#riprova').hide();

	take_snapshot();

	$('.spinner').show()
	$('.next-slide').attr('disabled');
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
            	var h ='';
	var n='';
	var b='';
	var servizio = '';
	var today = '';
                console.log(data);
				console.log(data.responses[0].textAnnotations.length)
				var x = data.responses[0].textAnnotations.length;
				var patt = new RegExp('^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$');
				var pt = new RegExp('^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$');
				for(i=0;i<x;i++){
					
					var y = data.responses[0].textAnnotations[i].description;
					if(y.length===3 && !isNaN(y)){
						
						console.log('numerino ' + y);
						var n = y;	

						
						
						}
					if (patt.test(y)){
						var h = y;
						console.log(y);
						
						}
					
					
					}
				var u = x - 1;
				var b = data.responses[0].textAnnotations[u].description
				console.log('Utenti attesa: ' + b);
				$('#fila').val(b);
				
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
			
			servizio = 'FINANZIARIO'
			
			}else if(str.includes('SOL')){
				
				servizio = '1 SOLA OPERAZIONE - 1 SOLO SERVIZIO'
				
				}else{
					
					servizio = 'POSTALE E SERVIZI AL CITTADINO'
					$('#icn').html('<i class="fa fa-envelope-o" aria-hidden="true"></i>');
					$('.coin').css('border','none');
					}		
				console.log(servizio);
			if(h !=='' && n !=='' && b !=='' && servizio !=='' && today !==''){
				$('#numero').html(n);



				$('#service').html(servizio);
				$('#utenti').html('Utenti attesa: ' + b);
				$('#data').html(today + ' ' + h);

				console.log('DAICAZZO');
				$('.camera').addClass('hideleft');

			}else{
				$('img').removeAttr('src');
				$('#riprova').show();
				console.log('FANCULO');}
				$('.spinner').hide()
				$('.next-slide').removeAttr('disabled');

            },
			error: function(e) {
				console.log(e);
				$('img').removeAttr('src');
				$('#riprova').show();
				$('.spinner').hide()
				$('.next-slide').removeAttr('disabled');
			}
       });
		

		}	


	
    </script>

 <!--<a href="javascript:void(take_snapshot())">Take Snapshot</a>-->
 
 
<input type="hidden" id="fila">

<input type="hidden" id="photo">
<input type="hidden" id="v">

</body>
</html>