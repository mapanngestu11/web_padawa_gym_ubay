<?php
switch ($_GET['aksi'])
{

case "tampil":
echo '<div class="container2">';
echo "<script>
function popup(form) {
    window.open('', 'pinjam', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=400,top=50,left=200');
    form.target = 'pinjam';
}
</script>";
	echo'
	
	
<form id="contactform" class="rounded" action="?modul=statistik&aksi=cetak" method="post" enctype="multipart/form-data">';
echo '<div id="papanpanel2">
	<h3>Cetak Data Statistik Berdasarkan Tanggal Daftar</h3>
	</div>  ';
?>
       
        <div id="tickets">
            <ul>
				  <li>
                    <label for="dari" class="required">Dari Tanggal</label>
                    <input type="date" size="30" maxlength="40" id="dari" name="dari" class="k-textbox" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
					 
                </li>
				<li>
                    <label for="sampai" class="required">Sampai Tanggal</label>
                    <input type="date" size="30" maxlength="40" id="sampai" name="sampai" class="k-textbox" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
				 
                </li>
				                 <li  class="accept">
                    <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp
					<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
                </li>
                <li class="status">
                </li>
				</form>
            </ul>
        </div>

            <style scoped>

                .k-textbox {
                    width: 11.8em;
                }

                #tickets {
                    width: 810px;
                    height: 223px;
                    margin-left: 0px auto;
                    padding: 0px;
                }

                #tickets h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }

                #tickets ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                #tickets li {
                    margin: 10px 0 0 0;
                }

                label {
                    display: inline-block;
                    width: 90px;
                    text-align: right;
                }

                .required {
                    font-weight: bold;
                }

                .accept, .status {
                    padding-left: 90px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
            </style>

            <script>
                $(document).ready(function() {
                    var data = [
                    "12 Angry Men",
                    "Il buono, il brutto, il cattivo.",
                    "Inception",
                    "One Flew Over the Cuckoo's Nest",
                    "Pulp Fiction",
                    "Schindler's List",
                    "The Dark Knight",
                    "The Godfather",
                    "The Godfather: Part II",
                    "The Shawshank Redemption"
                    ];

                    $("#search").kendoAutoComplete({
                        dataSource: data,
                        separator: ", "
                    });

                    var validator = $("#tickets").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            status.text("Complete...!!!").addClass("valid");
                            } else {
                            status.text("Maaf.. Mohon Periksa Kembali Data Yang Anda Masukkan").addClass("invalid");
                        }
                    });
                });
            </script>
			<script>
                $(document).ready(function() {
               

           
                    $("#jenis_kelamin").kendoDropDownList();

                  

                  
                });
            </script>

        </div>
<?php
echo '<style TYPE="text/css" > 
	.container2{ width: 900px; background: transparent;}	
	#contactform {
	
	width: 900px;
	padding-left:0px;
	padding-top:0px;
	background: #f0f0f0;
	overflow:auto;
	
	border: 5px solid #000000;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	
	-moz-box-shadow: 2px 2px 2px #cccccc;
	-webkit-box-shadow: 2px 2px 2px #cccccc;
	box-shadow: 2px 2px 2px #cccccc;
	
	}
	
	.field{margin-bottom:3px;}
	
	label {
	font-family: Arial, Verdana; 
	text-shadow: 2px 2px 2px #ccc;
	display: block; 
	float: left; 
	margin-right:10px; 
	text-align: right; 
	width: 120px; 
	line-height: 20px; 
	font-size: 12px; 
	}
	
	.input{
	font-family: Arial, Verdana; 
	font-size: 12px; 
	padding: 5px; 
	border: 1px solid #b9bdc1; 
	width: 500px; 
	color: #797979;	
	}
	
	.input:focus{
	background-color:#E7E8E7;	
	}
	
	.textarea {
	height:100px;	
	}
	
	.hint{
	display:none;
	}
	
	.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 650px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}
    
   </style>';

break;

case "cetak":
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$kurangwaktu = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-7,date("Y")));
if ((isset($_POST['dari'])) && (isset($_POST['sampai']))){
echo "</br></br><b>Berikut Adalah Statistik Member Yang Mendaftar Dari \"$_POST[dari]\" Sampai \"$_POST[sampai]\"</b>";
}else{
echo "</br></br><b>Berikut Adalah Statistik Member Yang Mendaftar Dari \"$kurangwaktu\" Sampai \"$tglsekarang\"</b>";
}
//echo"<input type=button value='Tambah Anggota' onclick=location.href='?modul=anggota&aksi=tambahanggota'></br></br>";

		if ((isset($_POST['dari'])) && (isset($_POST['sampai']))){
		$query = mysqli_query($conn,"SELECT tanggal_daftar, count(tanggal_daftar) as total FROM tbl_member where tanggal_daftar between '$_POST[dari]' and '$_POST[sampai]' GROUP BY tanggal_daftar ORDER BY tanggal_daftar ASC");
		$query2 = mysqli_query($conn,"SELECT tanggal_daftar, count(tanggal_daftar) as total FROM tbl_member where tanggal_daftar between '$_POST[dari]' and '$_POST[sampai]' GROUP BY tanggal_daftar ORDER BY tanggal_daftar ASC");
		}
?>
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
        text: 'Statistik Member Mendaftar'
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
<?php

break;


}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>