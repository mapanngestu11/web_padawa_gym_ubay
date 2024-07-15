<?php
echo '
 <nav>
 "</br><br>"
      <ul style="float:left" id="nav">
	  <li><div style="border:1px solid white; width:70px; height:70px; margin:10px; float:left">';
if (file_exists("images/user/$_SESSION[adminmembership].jpg")) {
	echo '<img width="70px" height="63px" src="images/user/' . $_SESSION['adminmembership'] . '.jpg"/>';
} else {
	echo '<img width="70px" height="63px" src="images/user/def.png"/>';
}
echo '</div><br><br></br><span style="font-size:10pt;color:white"><strong>' . $_SESSION['adminmembership'] . '</strong></span></br></br>
	  <br><br>
	  ';
if ($_SESSION['levelmembership'] == "admin" || $_SESSION['levelmembership'] == "manajer" || $_SESSION['levelmembership'] == "kontrol transaksi") {
	echo '
          
       <form action="?modul=myprofile&aksi=tampil&id=' . $_SESSION['adminmembership'] . '" method="POST"><input type="submit" class="button" value="My Profile"/></form><br><br>';
} else {
	echo "</br></br></br></br><br>";
}

echo ' 
	  <form action="loginadmin/aksilogout.php" method="POST"><input type="submit" class="button button-red" value="Logout"/></form></br></br></br></li>
	  ';
echo '<li><a href="index.php"  onclick="location.href = \'index.php\';"><i class="icon-home" style="width:30px"></i>Dashboard</a>
         
        </li>';
if ($_SESSION['levelmembership'] == "admin") {
	$ckonf = mysqli_fetch_array(mysqli_query($conn, "select count(id) as jl from tblcontactusquery where status is NULL"));
	if ($ckonf['jl'] > 0) {
		$nt = ' <span style="height: 13x; font-size:10pt; background-color: #fcff00; color:black; border-radius: 50%; padding:5px 8px 5px 8px">' . $ckonf['jl'] . '</span>';
	} else {
		$nt = '';
		if ($_SESSION['levelmembership'] == "admin" || $_SESSION['levelmembership'] == "member" || $_SESSION['levelmembership'] == "kontrol transaksi") {
			echo ' <li><a href="#"><i class="icon-users" style="width:30px"></i>Member</a>
          <ul>
		   <li><a href="index.php?modul=member&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Lihat Data Member</a></li>
            <li><a href="index.php?modul=member&aksi=tambahmember"><i class="icon-circle-small" style="width:30px"></i>Tambah Data Member</a></li>
          </ul>
        </li>';
		}
	}
	if ($_SESSION['levelmembership'] == "admin") {
		echo '<li><a href="#"><i class="icon-price-tag3" style="width:30px"></i>List Paket & Tarif</a>
          <ul>
		   <li><a href="index.php?modul=tarif&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Tarif Membership</a></li>
          </ul>
        </li>';
	}
	if ($_SESSION['levelmembership'] == "admin") {
		echo ' <li><a href="#"><i class="icon-user-tie" style="width:30px"></i>Trainer</a>
          <ul>
		   <li><a href="index.php?modul=trainer&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Lihat Data Trainer</a></li>
            <li><a href="index.php?modul=trainer&aksi=tambahtrainer"><i class="icon-circle-small" style="width:30px"></i>Tambah Data Trainer</a></li>
          </ul>
        </li>';
	}


	if ($_SESSION['levelmembership'] == "admin" || $_SESSION['levelmembership'] == "manajer" || $_SESSION['levelmembership'] == "kontrol transaksi" || $_SESSION['levelmembership'] == "member") {


		echo '
		';
	}

	if ($_SESSION['levelmembership'] == "admin" || $_SESSION['levelmembership'] == "manajer" || $_SESSION['levelmembership'] == "kontrol transaksi") {
		echo ' <li><a href="#"><i class="icon-printer" style="width:30px"></i>Cetak</a>
          <ul>
            <li><a href="index.php?modul=rekmember&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Rekap Data Member</a>
			 <li><a href="index.php?modul=lapkeuangan&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Laporan Transaksi Deposit</a>
			</li>
            </ul>
        </li>';
	}
	if ($_SESSION['levelmembership'] == "admin") {
		echo '
		<li><a href="#"><i class="icon-gear" style="width:30px"></i>Pengaturan</a>
          <ul>
		  <li><a href="?modul=identitas&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Identitas Untuk Faktur</a></li>
		    <li><a href="?modul=myprofile&aksi=tampil&id=' . $_SESSION['adminmembership'] . '"><i class="icon-circle-small" style="width:30px"></i>Ubah Password Login Saya</a></li>
                      </ul>
        </li>';
	}

	echo '  <li><a href="#"><i class="icon-users" style="width:30px"></i>Manajemen Admin</a>
          <ul>
            <li><a href="index.php?modul=user&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Lihat Data User</a></li>
            <li><a href="index.php?modul=user&aksi=tambahuser"><i class="icon-circle-small" style="width:30px"></i>Tambah Data User</a></li>
          </ul>
        </li>';
}

if ($_SESSION['levelmembership'] == "Karyawan") {
	echo ' <li><a href="#"><i class="icon-users" style="width:30px"></i>Member</a>
	  <ul>
	   <li><a href="index.php?modul=member&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Lihat Data Member</a></li>
	   <li><a href="index.php?modul=member&aksi=tambahmember"><i class="icon-circle-small" style="width:30px"></i>Tambah Data Member</a></li>
	  </ul>
	</li>';
}
echo '  <li><a href="#"><i class="icon-users" style="width:30px"></i>Laporan Keuangan</a>
          <ul>
            <li><a href="?modul=lapkeuangan&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Cetak Data Keuangan</a></li>
          </ul>
        </li>';
echo '  <li><a href="#"><i class="icon-price-tag3" style="width:30px"></i>PRODUK</a>
          <ul>
            <li><a href="?modul=datakonfirmasi&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>List Produk</a></li>
			<li><a href="?modul=lappenjualan&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>Laporan</a></li>
          </ul>
        </li>';
echo '  <li><a href="#"><i class="icon-price-tag3" style="width:30px"></i>INVOICE</a>
          <ul>
            <li><a href="?modul=transaksi&aksi=tampil"><i class="icon-circle-small" style="width:30px"></i>List Produk</a></li>
          </ul>
        </li>';


echo '</ul>
    </nav>
	';
