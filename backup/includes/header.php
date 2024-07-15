
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/nk.jpg" alt="image" height="42" width="42"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Email Support : </p>
              <a href="mailto:info@example.com">faisalbar1000@gmail.com</a> </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Call Center: </p>
              <a href="tel:61-1234-5678-09">+62-813-1220-1758</a> </div>
            <div class="social-follow">
              <ul>
                 <li><a href="https://www.facebook.com/ZeroTech123/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="https://twitter.com/kostharapan"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="https://www.instagram.com/zerotech__/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              </ul>
            </div>
   <?php
error_reporting(0);
   if(strlen($_SESSION['login'])==0)
	{	
?>
 <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
<?php }
else{ 
echo "<span style='font-size:10pt;' class='btn btn-success btn-xs'><b>Welcome $_SESSION[fname]</b></span>";
 } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
$email=$_SESSION['login'];
$sql ="SELECT * FROM tbl_member WHERE username='$email' ";
$query = mysqli_query($conn,$sql);
if(mysqli_num_rows($query) > 0)
{
while($result=mysqli_fetch_array($query))
{  
	 echo "Menu Member : ".htmlentities($result['nama']); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="profile.php">Pengaturan Profil</a></li>
              <li><a href="update-password.php">Update Password</a></li>
            <li><a href="my-booking.php">Paket Saya</a></li>
            <li><a href="post-testimonial.php">Berikan Testimoni</a></li>
          <li><a href="my-testimonials.php">Testimoni Saya</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <?php } else { ?>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Pengaturan Profil</a></li>
              <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Paket Saya</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Berikan Testimoni</a></li>
          <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Testimoni Saya</a></li>
            
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
        <!--<div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="#" method="get" id="header-search-form">
            <input type="text" placeholder="Search..." class="form-control">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>-->
      </div>
	  

      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          	 
          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="page.php?type=privacy">Privacy Policy</a></li>
          <li><a href="index.php#layanan">Layanan</a>
          <li><a href="contact-us.php">Contact Us</a></li>
          <li><a href="page.php?type=panduan">Pembayaran</a></li>

        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>