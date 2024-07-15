<?php

?>
 <span style="font-size:18pt"><div id="window">
               
             
              <b>Welcome to Dashboard Admin</b>
</br>
<table border='0'>
<tr>
<td><div id='navigationadmin'><a href='index.php'><img src='images/home.png' width='80px' title='Beranda' height='80px'/></a></br></br>Dashboard</div></td>
<td><div id='navigationadmin'><a href='index.php?modul=member&aksi=tampil'><img src='images/data.png' width='80px' title='Data Member' height='80px'/></a></br></br>Data Member</div></td>
<?php 	 if ($_SESSION['levelmembership']=="member"){ ?>
<td><div id='navigationadmin'><a href='index.php?modul=member&aksi=tampil'><img src='images/data.png' width='80px' title='Data Member' height='80px'/></a></br></br>Data Member</div></td>

<?php }elseif ($_SESSION['levelmembership']=="kontrol transaksi"){ ?>
<td><div id='navigationadmin'><a href='index.php?modul=member&aksi=tampil'><img src='images/data.png' width='80px' title='Data Member' height='80px'/></a></br></br>Data Member</div></td>
<?php }elseif ($_SESSION['levelmembership']=="manager"){ 
}elseif ($_SESSION['levelmembership']=="admin"){?>
<td><div id='navigationadmin'><a href='index.php?modul=lapkeuangan&aksi=tampil'><img src='images/konten.png' title='Data Keuangan' width='80px' height='80px'/></a></br></br>Laporan Keuangan</div></td>
<td><div id='navigationadmin'><a href='index.php?modul=lappenjualan&aksi=tampil'><img src='images/result.png' title='Data Keuangan' width='80px' height='80px'/></a></br></br>Laporan Produk</div></td>

<?php } ?>
</tr>
</table></br>
            </div>
			</span>

         
		<br> <br>	
 <?php 
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$kurangwaktu = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-7,date("Y")));

echo "</br></br><b><span style='color:white; font-weight:bold'>Berikut Adalah Statistik Member Yang Mendaftar Selama Seminggu Terakhir</span></b>";
/*$query = mysqli_query($conn,"SELECT tanggal_daftar, count(tanggal_daftar) as total FROM tbl_member where tanggal_daftar between '$_POST[tgl_pinjam1]' and '$_POST[tgl_pinjam2]' GROUP BY tanggal_daftar ORDER BY tanggal_daftar ASC");*/
		$query = mysqli_query($conn,"SELECT tanggal_daftar, count(tanggal_daftar) as total FROM tbl_member where tanggal_daftar between '$kurangwaktu' and '$tglsekarang' GROUP BY tanggal_daftar ORDER BY tanggal_daftar ASC");
		$query2 = mysqli_query($conn,"SELECT tanggal_daftar, count(tanggal_daftar) as total FROM tbl_member where tanggal_daftar between '$kurangwaktu' and '$tglsekarang' GROUP BY tanggal_daftar ORDER BY tanggal_daftar ASC");

?>   
<br>
<script src="plugin/highcharts/highcharts.js"></script>
<script src="plugin/highcharts/exporting.js"></script>
<div id="container" style="min-width: 310px; text-align:left; height: 400px; max-width:100%; margin: 0 auto"></div>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
	credits: {
    enabled: false
},
    title: {
        text: 'Statistik Member Mendaftar 1 Minggu Terakhir'
    },
    subtitle: {
        text: 'Sumber : Database'
    },
    xAxis: { 
    //INI ADALAH UNTUK KOLOM KETERANGAN
        categories: [ <?php
		while ($row=mysqli_fetch_array($query)){
			echo "'".$row['tanggal_daftar']."',";
		} ?>
        ],
         title: {
            text: 'Tanggal Daftar'
        },
        crosshair: true
    },
    yAxis: {
         
        title: {
            text: 'Jumlah'
        }
    },
     
    tooltip: {
        headerFormat: '<span style="font-size:8pt">{point.key}</span><table style="font-size:8pt">',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Jml.: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.,
            borderWidth: 0
        }
    },
    series: [{
         colorByPoint: true,
       showInLegend: false,
        
        data: [
		<?php while ($row=mysqli_fetch_array($query2)){
			echo $row['total'].',';
		} ?>
		] //INI ADALAH UNTUK JUMLAH
 
    },
    ]
});
</script>   
