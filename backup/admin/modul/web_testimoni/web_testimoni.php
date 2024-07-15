<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo '<h1>Data Testimoni</h1>
Jika status <b>Aktive</b> Maka Tampil Di Website, Jika <b>Inactive</b> Maka tidak tampil di website';

if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="0";
$sql =  mysqli_query($conn,"UPDATE tbltestimonial SET status= '$status' WHERE id='$eid'");
$msg="Testimoni Dinonaktifkan
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
";
}

if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;
$sql =  mysqli_query($conn,"UPDATE tbltestimonial SET status= '$status' WHERE id='$aeid'");
$msg="Testimoni Diaktifkan Di Website
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
";
}
?>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo $error; ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo $msg; ?> </div><?php }?>
								<table id="datatables" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Testimonials</th>
											<th>Tanggal Post</th>
											<th>Status</th>
										</tr>
									</thead>
									
									<tbody>

									<?php $sql = "SELECT tbl_member.nama,
									tbltestimonial.UserEmail,
									tbltestimonial.Testimonial,
									tbltestimonial.PostingDate,
									tbltestimonial.status,
									tbltestimonial.id from tbltestimonial join tbl_member on tbl_member.username = tbltestimonial.UserEmail";

$cnt=1;
$query = mysqli_query($conn,$sql);
if(mysqli_num_rows($query) > 0)
{
while($result=mysqli_fetch_array($query))
{  					?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result['nama']);?></td>
											<td><?php echo htmlentities($result['UserEmail']);?></td>
											<td><?php echo htmlentities($result['Testimonial']);?></td>
											<td><?php echo htmlentities($result['PostingDate']);?></td>
											<td><?php if($result['status']=="" || $result['status']==0)
{
	?><a href="index.php?modul=web_testimoni&aksi=tampil&aeid=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Apa Anda ingin Mengaktifkannya di web ?')"> Inactive</a>
<?php } else {?>

<a href="index.php?modul=web_testimoni&aksi=tampil&eid=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Apa anda ingin Menonaktifkan Nya dari web ?')"> Active</a>
<?php } ?></td>
																
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>		
<?php break;


}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>