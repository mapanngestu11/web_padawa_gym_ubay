<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo '<h1>Contact Us</h1>';
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;
$sql = mysqli_query($conn,"UPDATE tblcontactusquery SET status='$status' WHERE id='$eid'");
$msg="Pesan Telah Dibaca";
}
?>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="datatables" class="display" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Nama Lengkap</th>
											<th>Alamat Email</th>
											<th>Nomo Telepon</th>
											<th>Isi Pesan</th>
											<th>Tanggal & Waktu</th>
											<th>Tandai Sudah Dibaca</th>
										</tr>
									</thead>
									
									<tbody>

									<?php $sql = "SELECT * from tblcontactusquery";

$cnt=1;
$query = mysqli_query($conn,$sql);
if(mysqli_num_rows($query) > 0)
{
while($result=mysqli_fetch_array($query))
{  					?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result['name']);?></td>
											<td><?php echo htmlentities($result['EmailId']);?></td>
											<td><?php echo htmlentities($result['ContactNumber']);?></td>
											<td><?php echo htmlentities($result['Message']);?></td>
											<td><?php echo htmlentities($result['PostingDate']);?></td>
																<?php if($result['status']==1)
{
	?><td>Telah Dibaca</td>
<?php } else {?>

<td><a href="index.php?modul=web_contactus&aksi=tampil&eid=<?php echo htmlentities($result['id']);?>" onclick="return confirm('Apa anda ingin menandai sudah dibaca ?')" >Belum dibaca</a>
</td>
<?php } ?>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>		
<?php break;


}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>