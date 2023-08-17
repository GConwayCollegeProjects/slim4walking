<?php

$color = null;

$color = @$_GET['color'];

// If add ? color=number 1-3 to url then get choice of 4 different color palettes - defaults to green/blue/yellow

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Unibus Main Menu</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<?php
	if($color=='1')
	{
		echo '<link rel="stylesheet" href="assets/css/colors1.css">' ;
	}
	elseif($color=='2')
	{
		echo '<link rel="stylesheet" href="assets/css/colors2.css">' ;
	}	
	elseif($color=='3')
	{
		echo '<link rel="stylesheet" href="assets/css/colors3.css">' ;
	}
	else
	{
		echo '<link rel="stylesheet" href="assets/css/colors.css">' ;
	}		
	
	?>
    <link rel="stylesheet" href="assets/css/styles.css">
	
	<script>
	







function showUser(str) 
{
  	//document.getElementById("result").innerHTML = val;
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() 
	{
		
      if (this.readyState == 4 && this.status == 200) 
	  {
        document.getElementById("default").innerHTML = this.responseText;
      }
    };
    xmlhttp1.open("GET","pdo4.php?q="+str,true);
    xmlhttp1.send();
	
	var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function() 
	{
      if (this.readyState == 4 && this.status == 200) 
	  {
		  document.getElementById("welcome").innerHTML = this.responseText;
      }
    };
    xmlhttp2.open("GET","pdo5.php?q="+str,true);
    xmlhttp2.send();
	
  
} //end Showuser



function showNext(id, val) 
{
	if(parseInt(val)<4) {
  	//document.getElementById("result").innerHTML = val;
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() 
	{
      if (this.readyState == 4 && this.status == 200) 
	  {
		  
		document.getElementById("flags").innerHTML = this.responseText;
      }
    };
    xmlhttp1.open("GET","pdo1.php?i="+id+"&v="+val,true);
    xmlhttp1.send();
	}
	
} //end ShowNext

function showPrev(id, val) 
{
	
	if(parseInt(val)>1) {
  	//document.getElementById("result").innerHTML = val;
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() 
	{
      if (this.readyState == 4 && this.status == 200) 
	  {
		  
		document.getElementById("flags").innerHTML = this.responseText;
      }
    };
    xmlhttp1.open("GET","pdo1.php?i="+id+"&v="+val,true);
    xmlhttp1.send();
	}
	
} //end ShowPrev

function closePopup()
{
	document.getElementById('welcome').innerHTML = ""; 
	

} // end closePopup




</script>
</head>

<body onload='showNext("right","0")'>

<!-- Start of main container which includes full page -->
	<div id="main-container" class="container" style="background-color: var(--my-green);">
<!-- Start of header -->
		<div id="header">
			<div class="container" style="height: 5px; width: 100%;"></div> <!--</div> spacer only -->
		
		<!-- Start of container for -->
			<div class="container" style="margin 0 0 0 30px;">
				<div class="row" style="width=100% ; height: 30px; margin 0 0 0 30px; padding: 0 10px 0 30px; ">
				<!-- Home Widget -->
					<div class="widget" style="padding: 0 20px 0 0; margin 0 0 0 0;">
						<img class="my-widgets " src="assets/img/home.png" style="padding: 0 5px 0 0; margin 0 0 0 0px;"/>
					</div>
				
				
			
			<!-- Search box	 -->
				
					<div style="display: inline-block; height: 10px; margin: 0 auto ; padding: 5px 0 0 0;">
						<form id="searchbox" style="font-size: 11px; display:block; " >
							<p >
								<input type = "text"
								id = "myText"
								size= "55"
								value = ""  
								placeholder="Enter shop name, product name or other key word" />
							</p>
						</form>
					</div>
					
					<!-- Search widget -->
					<div class="widget" style="margin: 0 0 0 0; padding 0 0 0 0; " >
						<img class="my-widgets" src="assets/img/search.png" style="padding: 0 0px 0 0; margin: 0;" >
					</div>
					<div  id="default"  style="float: right;  height: 30px;  padding: 0px;  margin: 0px;">
							<img class="my-widgets" src="assets/flags/UJ.png" style="float: right ; height: 30px ; margin: 5px 5px 0 auto; padding: 0;" />
						</div>
				</div>
				<!-- End of Searchbox row -->
			
				<!-- Container for map buttons row -->
			<div class="container"  style="display: block; width: 100%; margin: 0; padding: 0;" >
				<div class="container" style="width: 100%; margin: 0; padding: 0;">
					<div class="row" style="width: 100% ;display: inline-block; margin: 0 0 0 0px ; padding 0 0 0 0px; height: 20px ;">
						
						<div class="container" id="maps" style="width: auto; height: 20px; padding: 0 0px 0 0px;" >
							<div class="my-button my-heading" style="border-style: none solid none none"><p >TRAFFORD CENTRE MAPS</p></div>
							<div class="my-button my-heading" ><p>CITY CENTRE MAP</p></div>
							<div class="my-button my-heading" style="border-style: none none none solid" ><p>STATION MAPS</p></div>
						</div>	
						<!-- Map widget -->
						
					</div>
					
				</div>
					<!-- end of row for map buttons -->
			</div>
		</div>
			<!-- End of Container for top box -->
	<div class="container" style="height:50px"></div> <!-- spacer only	-->
	
	</div>
<!-- End of Header	-->
<div id="welcome" class="container">

</div>

<!-- Start of Functions Container -->
	<div id="functions" class="container">
















	</div>
	<!-- End of Functions Container -->
	 


	
	<div style="height:5px"></div> <!-- spacer only	-->
	<!-- Start of Footer Container -->
	<div class="container " style="display:float ; background-color: var(--my-green--) ; width=100%;">
	
		<div class="row" style="width=100% ; height: 45px; padding: 0px ; ">
		
			<div class="footer-widget" style="padding: 0 ; margin: 0 0 0px 5px;" >
			
			
			<img class="my-widgets" src="assets/img/disabled.png" style= "height: 60px; width: 45px; padding: 0 0 10px 5px ; margin: 0 0 0px 0px"/>
			</div>
			<div class="footer-widget">
			<img class="my-widgets " src="assets/img/toilet.png" style="height: 70px; width: 65px; padding: 0 0 25px 0 "/>
			</div>
<div id="flags" style="margin: 0px 0px 0px 0px;">	
		<input class="my-flags "  type="image"  value="1"  id = "left" ;
		onclick="showPrev(this.id, this.value)"  ;
		src="assets/img/left.png" style="padding: 0px 0 0px 0px ; margin: 0px 0 0px 0px"</input>
		<input class="my-flags "  type="image"  value="1"  id = "de" onclick="showUser(this.value, this.id)" src="assets/flags/de.png" "</input>
		<input class="my-flags " type="image"  value="2"  id = "de" onclick="showUser(this.value, this.id)" src="assets/flags/dk.png" </input>
		<input class="my-flags " type="image"  value="3"  id = "de" onclick="showUser(this.value, this.id)" src="assets/flags/es.png" </input>
		<input class="my-flags " type="image"  value="4"  id = "de" onclick="showUser(this.value, this.id)" src="assets/flags/fr.png" </input>
		<input class="my-flags " type="image"  value="5"  id = "de" onclick="showUser(this.value, this.id)" src="assets/flags/it.png" </input>
		<input class="my-flags "  type="image"  value="1"  id = "right" ;
		onclick="showNext(this.id, this.value)" ;
		src="assets/img/right.png" style="padding: 0px 0 0px 0px ; margin: 0px 0px 0px 0px"</input>
</div>			 
			 
		 <input class="my-flags "  type="image"  value="taxi"  id = "de" onclick="" src="assets/img/taxi.png" style="padding: 0px 0 0px 0px ; margin: 6px 0 0px 0px"</input>
		
		 <input class="my-flags "  type="image"  value="parking"  id = "de" onclick="" src="assets/img/p.png" style="padding: 0px 0 0px 0px ; margin: 6px 0 0px 0px"</input>
		 
		  <input class="my-flags "  type="image"  value="help"  id = "de" onclick="" src="assets/img/h.png" style="padding: 0px 0 0px 0px ; margin: 6px 0 0px 0px"</input>
		 
			</div>
	
			</div>
			
			
		
		
	</div>
	<!-- End of Footer Container -->
	
	
	
	
</div>
<!-- End of Main Container -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

