<?php	
	
	require_once('function.php');

	// Studiju gada sadalījums. http://www.liepu.lv/lv/295/studiju-gada-sadalijums

	$sg = array();
	$sg['42'] = $sg['44'] =  $sg['46'] = $sg['48'] = $sg ['50'] = '1. Nedēļa';
	$sg['43'] = $sg['45'] =  $sg['47'] = $sg['49'] = $sg ['51'] = '2. Nedēļa';

	$sg['01'] = 'Ziemassvētku brīvdienas';
	$sg['02'] = $sg['03'] = $sg['04'] = $sg['05'] = 'Pārbaudījumi';
	$sg['06'] = 'Reģistrācija studijām';
	
	$sg['07'] = $sg['09'] =  $sg['11'] = $sg['13'] = $sg ['15'] = $sg ['17'] = $sg ['19'] = $sg ['21'] = '1. Nedēļa';
	$sg['08'] = $sg['10'] =  $sg['12'] = $sg['14'] = $sg ['16'] = $sg ['18'] = $sg ['20'] = $sg ['22'] = '2. Nedēļa';
		
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Liepājas Universitāte: informācijas ekrāns</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">  
        <link rel="stylesheet" href="css/app.css">
         
    </head> 
    <body>    
     <div class="header">
		<div class="left small"> <span class="error">&bull;</span> <?php echo $sg[date('W')]; ?> </div>
		<a href="http://time.is/Latvia" id="time_is_link"></a>
		<span class="right" id="Latvia_z722" style="font-size:2em; padding: 10px 120px 5px 10px"></span>
  	</div>
    <div id="slideshow">
	    
	    <?php
 				$fs = '';
		 	 	$faili = read_dir(__DIR__.'/atteli/');
				asort($faili);
			 	foreach($faili as $fails)
				{
					echo '
		        	<div class="info">
			        	 <img src="atteli/'.$fails.'">  
			        </div>  
		            <!-- -->';
					$fs = $fs . $fails;
				}			 
		?> 
		
	    <div class="info info_laiks">
			 <div class="laiksa">...</div>
	    </div>  
	    	    
	</div>
  
     <script src="js/vendor/jquery-1.8.3.min.js"></script>
     <script src="js/jquery.simpleWeather.min.js"></script>
     
     <script src="http://widget.time.is/t.js"></script>
     <script>
     
     //Mainīgais, lai banāli pārliecinātos par jaunu plakātu esamību
     var kautkasjauns = "<?php echo $fs ?>";
     
     //laikapstaakli
     	function refresh_weather() {
     		//console.log('Laikapstākļi ielādējās');
			  $.simpleWeather({
			    location: 'Liepaja',
			    unit: 'c',
			    success: function(weather) {
			      html = 'Šobrīd temperatūra Liepājā ir ap '+ weather.temp+'&deg; C ' 
			      	     +'<br/><h1><span class="laika_ikona icon-'+weather.code+'"></span></h1>'
			      	     +'<div class="citi">'
			      	     +'<div class="diena"><span class="laika_ikona icon-'+weather.forecast[3].code+'"></span> <br/> ' + weather.forecast[3].low +'&deg;/ ' + weather.forecast[3].high +'&deg; <br/>  <small>aizparīt</small></div>'
			      	     +'<div class="diena"><span class="laika_ikona icon-'+weather.forecast[2].code+'"></span> <br/> ' + weather.forecast[2].low +'&deg;/ ' + weather.forecast[2].high +'&deg; <br/>  <small>parīt</small></div>'
			      	     +'<div class="diena"><span class="laika_ikona icon-'+weather.forecast[1].code+'"></span> <br/> ' + weather.forecast[1].low +'&deg;/ ' + weather.forecast[1].high +'&deg; <br/>  <small>rīt</small></div>';
			       		 $(".laiksa").html(html); 
			  	 	  	 console.log(weather);
			  	 		    },
			    error: function(error) {
			      $(".laiksa").html('<p>'+error+'</p>');
			    } 
			  });
		}


		function irNets() {
		    var xhr = new XMLHttpRequest();
		    var file = "http://dev.liepu.lv/info/index.php";
		    var randomNum = Math.round(Math.random() * 10000);
		     
		    xhr.open('HEAD', file + "?rand=" + randomNum, false);
		     
		    try {
		        xhr.send();
		        if (xhr.status >= 200 && xhr.status < 304) {
		            return true;
		        } else {
		            return false;
		        }
		    } catch (e) {
		        return false;
		    }
		}

		function doRefreshs (){
			 			
			$.get( "refresh.php", function(  ) {
			  //  console.log('Notiek ielāde');
			    $('.erroris').hide();

			}).done(function(data) {
			    var s2 = data.trim();
				var m = s2.localeCompare(kautkasjauns);
				 
				 if(m!=0) {				 	
				 	location.reload();
				 }
				   
			}).fail(function() {
				 $('.error').show();
			  //   console.log('Nav interneta? :()');
			  });
								
		}
		
		setInterval(doRefreshs, 600000);
		
		//ielādējam laikapstākļus pirmo reizi
		refresh_weather();
		//ielādējam laikapstākļus ik pēc 10 minutem
		setInterval(refresh_weather, 600000);
     	
     	$("#slideshow > div:gt(0)").hide();
		//slaidi
		setInterval(function() { 
			  $('#slideshow > .info:first')
			    .fadeOut(2000)
			    .next()
			    .fadeIn(2000)
			    .end()
			    .appendTo('#slideshow');
			},  16000);
		//laiks	
		time_is_widget.init({Latvia_z722:{}});

	 </script>
    </body>
</html>
