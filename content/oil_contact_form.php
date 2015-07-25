<?php 
error_reporting(E_ALL);
ini_set('dispaly_errors', '1');

$meg ="";


// get the info from the form -add-

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$subject  = $_POST['subject'];
	$email    = $_POST['email'];
	$message  = $_POST['message'];
  // Filter
    $username = stripcslashes($username);
	$subject  = stripcslashes($subject);
	$email    = stripcslashes($email);
	$message  = stripcslashes($message);

	$username = strip_tags($username);
	$subject  = strip_tags($subject);
	$email    = strip_tags($email);
	$message  = strip_tags($message);
	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$subject  = filter_var($subject, FILTER_SANITIZE_STRING);
	$message  = filter_var($message, FILTER_SANITIZE_STRING);


     // be sure write all data in all inputs

    if ((!$username) || (!$subject) || (!$email) || (!$message)) {

      $meg=' <div class="alert alert-danger" role="alert"> Sorry, all fields are required</div>';

    }
    else{

		   // connect to database
		  require ("data/connect.php");
		  // insert product to database
		  $sql5 =$conn->query("INSERT INTO contact(username, subject, email, message, date_time) VALUES('$username','$subject','$email','$message', now())")or die (mysql_error());
			    if ($sql5) {
			    	$meg = '<div class="alert alert-success" role="alert">Your message has been sent successfully</div>';
			  			 

			    }else{
	$meg = "<div class='alert alert-warning' role='alert'>Warning ! You Enter Some Invalid Character Like ', / Or Back Slashe \ . Please Enter Text Without those Character .!</div>";
}

	  
	    
	   }

} 


 ?>

<section class="contact text-center">
	<div class="fields">	
	<div class="container">
	<h1 class="firstcolor first-h">CONTACT US</h1>
	<p class="lead">Feel Free To Contact Us Anytime</p>
	<div class="row">
	<form action="" enctype="multipart/form-data" method="POST">
	<div class="col-sm-6">
	<div class="form-group">
		<input type="text" class="form-control input-lg" name="username" placeholder="Username" maxlength="100" required>
	</div>
	<div class="form-group">
		<input type="text" class="form-control input-lg" name="subject" placeholder="Subject" maxlength="255" required>
	</div>
	<div class="form-group">
		<input type="email" class="form-control input-lg" name="email" placeholder="Email : Example@OilArgan.com" maxlength="255" required>
	</div>
	</div>
	<div class="col-sm-6">
	<div class="form-group">
	<textarea name="message" class="form-control" placeholder="Your Message Here" maxlength="1000" required></textarea>
	</div>
	<div class="input-group">
        <span class="input-group-addon" id="basic-addon1">Contact US</span>
        <input type="submit" class="form-control btn btn-primary" name="submit" value="Send Message" aria-describedby="basic-addon1">
      </div>

	</div>
	</form>
	
	</div>
	<?php echo $meg; ?>

	</div>
	</div>
</section>
<div class="map">
<div class="container text-center">
	<h1 class="firstcolor first-h">Find Us On Maps</h1>
	<hr class="center-block">
	<div class="row">
		<div class="col-sm-12">
			<div id="googleMap" ></div>

		</div>
	</div>
</div>
</div>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>
	var myCenter=new google.maps.LatLng(30.922972,-6.896885);  

	function initialize()
	{
	var mapProp = {
	  center:myCenter,
	  zoom:15,
	  mapTypeId:google.maps.MapTypeId.ROADMAP
	  };

	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

	var marker=new google.maps.Marker({
	  position:myCenter,
	  });

	marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>