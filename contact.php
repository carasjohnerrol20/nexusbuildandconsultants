
<?php
$title = "Contact Us - Nexus Build and Consultants";

require("header.php");

?>


<!-- Navigation File -->
<?php include_once 'navigation.php';?>
	
	<!-- ============================================================== -->
	<!-- Start NEXUS Breatcome Area -->
	<!-- ============================================================== -->
	<div class="breatcome_area d-flex align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breatcome_title">
						<div class="breatcome_title_inner pb-2">
							<h2>Contact Us</h2>
						</div>
						<div class="breatcome_content">
							<ul>
								<li><a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <a href="#"> Pages</a> <i class="fa fa-angle-right"></i> <span>Contact Us</span></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End NEXUS Breatcome Area -->
	<!-- ============================================================== -->
	
	<!-- ============================================================== -->
	<!-- Start NEXUS Contact Address Area -->
	<!-- ============================================================== -->
	
	<div class="contact_address_area pt-80 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section_title text_center mb-55">
						<div class="section_sub_title uppercase mb-3">
							<h6>CONTACT US</h6>
						</div>
						<div class="section_main_title">
							<h1>We Are Here For You</h1>
						</div>
						<div class="em_bar">
							<div class="em_bar_bg"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- <div class="col-lg-4 col-md-6 col-sm-12">
					<div class="single_contact_address text_center mb-30">
						<div class="contact_address_icon pb-3">
							<i class="fa fa-map-o"></i>
						</div>
						<div class="contact_address_title pb-2">
							<h4>Our Address</h4>
						</div>
						<div class="contact_address_text">
							<p>30 N Gould St. Site N, Sheridan, WY 82801</p>
						</div>
					</div>
				</div> -->
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="single_contact_address text_center mb-30">
						<div class="contact_address_icon pb-3">
							<i class="fa fa-clock-o"></i>
						</div>
						<div class="contact_address_title pb-2">
							<h4>Opening Hours</h4>
						</div>
						<div class="contact_address_text">
							<p>Mon - Fri: 8:00am - 05:00pm</p>
							<br>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12">
					<div class="single_contact_address text_center mb-30">
						<div class="contact_address_icon pb-3">
							<i class="fa fa-volume-control-phone"></i>
						</div>
						<div class="contact_address_title pb-2">
							<h4>Contact Directly</h4>
						</div>
						<div class="contact_address_text">
							<p>marketing@nexusbuildandconsultants.com, <br> (PH) +63 9352314443 / (US) +1 (602) 809-6601</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End NEXUS Contact Address Area -->
	<!-- ============================================================== -->
	
	<!--==================================================-->
	<!----- Start NEXUS Contact Area ----->
	<!--==================================================-->
	<div class="main_contact_area app pt-80 bg_fixed " style="background-image:url(assets/images/slider/slider14.jpg)";>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="single_contact_abs_thumb">
						<img src="assets/images/shape1.png" alt="" />
					</div>
				</div>
				<div class="col-lg-6">
					<div class="section_title white mb-4">
						<div class="section_sub_title uppercase mb-3">
							<h6>Get A Quote</h6>
						</div>
						<div class="section_main_title">
							<h1>Make And Appointment</h1>
						</div>
					</div>
					<div class="contact_from">
						<!-- <form id="contact_form" action="mail.php" method="POST" id="dreamit-form"> -->
						<form action="forms/contact.php" method="post" role="form" class="php-email-form"  data-recaptcha-site-key="6Lfyl6AqAAAAAAtvNKDs8JczaErlZ3AVa9myMnhi">
						<div class="row">
						<div class="col-lg-12">
							<input type="text" class="form-control" name="first_name" hidden>
							<div class="validate"></div>
							<div class="form-box mb-30">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-box mb-30">
							<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-box mb-30">
							<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-box mb-30">
							<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-box mb-30">
							<textarea name="message" class="form-control" cols="30" rows="10" placeholder="Write a Message" required></textarea>
							</div>
							<div class="form-feedback">
							<!-- Loading Message -->
							<div class="loading text-blue font-bold" style="display: none;">Loading...</div>

							<!-- Error Message -->
							<div class="error-message text-red font-bold" style="display: none;">
								<!-- Error message text will be dynamically inserted here by the script -->
							</div>

							<!-- Sent/Success Message -->
							<div class="sent-message text-green font-bold" style="display: none;">
								Your message has been sent. Thank you!
							</div>
							</div>
							<div class="quote_btn text-center">
								<button class="btn text-center" type="submit">Send Message</button>
							</div>
							<br>
						</div>
						</div>

						</form>
						<div class="status"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!----- End NEXUS Contact Area ----->
	<!--==================================================-->

	
	<!--==================================================-->
	<!----- End NEXUS Map Area ----->
	<!--==================================================-->
	<div class="google_map_area">
		<div class="row-fluid">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="google_map_area">
					<!-- <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.167518058788!2d-106.95752532339804!3d44.797774577655815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5335fabc2a655555%3A0x3542e0a22355480!2s30%20N%20Gould%20St%20Ste.%20N%2C%20Sheridan%2C%20WY%2082801%2C%20USA!5e0!3m2!1sen!2sph!4v1733381881340!5m2!1sen!2sph"></iframe>		 -->
				</div>
			</div>				
		</div>
	</div>
	<!--==================================================-->
	<!----- End NEXUS Map Area ----->
	<!--==================================================-->

	  <!-- Footer File -->
	  <?php include_once 'footer.php';?>
