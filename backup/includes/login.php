<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT * FROM tbl_member WHERE username = '$email' and password='$password'";
$query= mysqli_query($conn,$sql);
$results = mysqli_fetch_array($query);
if(mysqli_num_rows($query) > 0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['fname']=$results['nama'];
$currentpage=$_SERVER['REQUEST_URI'];
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
} else{ 
  echo "<script>alert('Invalid Login');</script>";
}
}

?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Belum punya akun ? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Disini</a></p>
        <!--<p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Lupa Password ?</a></p>-->
      </div>
    </div>
  </div>
</div>