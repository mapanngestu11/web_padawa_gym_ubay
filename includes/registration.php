<?php
//error_reporting(0);
if(isset($_POST['signup']))
{
$nama=$_POST['fullname'];
$username=$_POST['emailid']; 
$tel=$_POST['mobileno'];
$password=md5($_POST['password']); 
//autonumber
date_default_timezone_set('Asia/Jakarta');
$skrg = mktime(date("m"),date("d"),date("Y"));
$now = date("Y-m-d", $skrg);
$qr1	= mysqli_query($conn,"SELECT MAX(CONCAT(LPAD((RIGHT((id_member),7)+1),7,'0')))FROM tbl_member");
$qr2	= mysqli_query($conn,"SELECT MIN(CONCAT(LPAD((RIGHT((id_member),7)),7,'0')))FROM tbl_member");	
$kde1= mysqli_fetch_array($qr1);
$kde2= mysqli_fetch_array($qr2);
if ($kde2[0]!="0000001"){
$kodea = "0000001";
}
else{
$kodea = $kde1[0];
} 
//autonumber
if($_POST['password']!=$_POST['confirmpassword']){
	echo "<script>alert('Pendaftaran Gagal. Password dan Confirm Tidak Cocok');</script>";
}else{
$sql=mysqli_query($conn,"INSERT INTO tbl_member(id_member,nama,tanggal_daftar,username,tel,password) VALUES('MMB$kodea','$nama','$now','$username','$tel','$password')");
if($sql)
{
	
echo "<script>alert('Pendaftaran Sukses. Anda sudah bisa login untuk melakukan update profil dan pemesanan paket');</script>";
}
else 
{
	$err = mysqli_error();
echo "<script>alert('Pendaftaran Gagal. Silahkan Coba Lagi. $err');</script>";
}
}
}

?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password dan Konfirmasi Password Tidak Cocok  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}

var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirmpassword').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Sudah Cocok';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Belum Cocok';
  }
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Register</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="20" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" onkeyup='check();' placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup='check();' placeholder="Confirm Password" required="required">
				   <span id='message'></span>
                </div>
				
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Sudah Punya akun? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login disini</a></p>
      </div>
    </div>
  </div>
</div>