<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  Integrated Web system                                      *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: osorio2380@yahoo.es                                            *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('dashboard/database.php');
require_once('dashboard/library.php');
require_once('dashboard/funciones.php');

$tracking= $_POST['shipping'];

$sql = "SELECT c.cid, c.tracking, c.cons_no, c.letra, c.book_mode, c.schedule, c.paisdestino, c.pick_time, c.pick_time2, c.invice_no, c.mode, c.type, c.weight, c.weightx, c.qty, c.comments, c.ship_name, c.s_add, c.rev_name, c.r_add, c.pick_date, c.user, s.color, c.status FROM courier c, service_mode s WHERE s.servicemode = c.status AND c.tracking = '$tracking'";

$result = dbQuery($sql);
$no = dbNumRows($result);
if($no == 1){

while($data = dbFetchAssoc($result)) {
extract($data);

?>


   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->


    <!-- Start #page-title-->
    <section class="page-title bg-overlay-x bg-overlay-dark-x bg-parallax-x" id="page-title">
        <div class="bg-section"><img src="assets/images/page-titles/7.jpg" alt="Background"/></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="title text-lg-left">
                <div class="title-heading">
                  <h1>track &amp; trace</h1>
                </div>
                <div class="clearfix"></div>
                <ol class="breadcrumb justify-content-lg-start">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tracking Result</li>
                </ol>
              </div>
              <!-- End .title -->
            </div>
            <!-- End .col-lg-8 -->
          </div>
          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
      <!-- End #page-title-->




<section class="mt-4">


<div class="container" style="color: #333333;">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="text-center">
        <img src="deprixa_components/images/barcode.png" />
            <h5 class="card-heading-x"><?php echo $tracking; ?></h5>
</div>
<table style="border: none; border-collapse: collapse; width: 100%;">
    <tr>
        <td class="text-left" style="padding: 10px; width: 50%;"">
            Ship Date <br /><strong><?php echo $pick_date; ?></strong>
</td>
<td class="text-left" style="padding: 10px;">
            Actual Delivery <br /><strong><?php echo strtoupper($status); ?></strong>
</td>
    </tr>
</table>

        </div>


        <div class="col-sm-12 col-md-12 col-lg-12">
<hr style="margin-top: 20px; border: none;">
            <div class="text-center mt-4">

<h5 class="card-heading-x">Arrived Port</h5>
</div>
<table style="border: none; border-collapse: collapse; width: 100%;">
    <tr>
        <td class="text-left" style="padding: 10px; width: 50%;">
            <?php echo strtoupper($s_add); ?>
</td>
<td class="text-left" style="padding: 10px;">
            <?php echo strtoupper($pick_time); ?>
</td>
    </tr>
    <tr>
    <td class="text-left" style="padding: 10px; width: 50%;">
            <strong><?php echo $qty; ?> PIECE SHIPMENT</strong>
</td>
    </tr>
</table>



		</div>

        <div class="col-sm-12 col-md-12 col-lg-12">
        <hr style="margin-top: 20px; border: none;">
        <div class="text-center mt-4">

<h5 class="card-heading-x" style="margin-bottom: 5px;">Sender/Receiver Details</h5>
<a href="contact.php" style="color:dodgerblue; ">Contact us now for more information on your package.</a><br /><br />
</div>
<div class="text-left">
<span style="margin-right: 20px;">Sender Name:</span><strong><?php echo strtoupper($ship_name); ?></strong><br /><br />
            <span style="margin-right: 20px;">Receiver Name:</span><strong><?php echo strtoupper($rev_name); ?></strong><br /><br />
            <span style="margin-right: 20px;">Receiver Address:</span><strong><?php echo strtoupper($r_add); ?></strong><br /><br />
            <span style="margin-right: 20px;">Package Name:</span><strong><?php echo strtoupper($comments); ?></strong>

		</div>
        </div>


			<div class="col-sm-12 col-md-12 col-lg-12 mt-4">
            <hr style="margin-top: 20px; border: none;">
            <div class="text-center">

<h5 class="card-heading-x">Shipping History</h5><br />
</div>


					<?php
						require_once('dashboard/database.php');

						//EJECUTAMOS LA CONSULTA DE BUSQUEDA
						$result = mysql_query("SELECT * FROM courier_track WHERE cid = $cid	AND cons_no = '$cons_no' ORDER BY bk_time");
						//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
						echo ' <table class="table table-bordered table-striped table-hover" >
									<tr class="car_bold col_dark_bold" align="center">
										<td><font color="Black" face="arial,verdana"><strong>New Location</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>State</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>Time</strong></font></td>
										<td><font color="Black" face="arial,verdana"><strong>Remarks</strong></font></td>
									</tr>';
						if(mysql_num_rows($result)>0){
							while($row = mysql_fetch_array($result)){
								echo '<tr align="center">
										<td><font size=2>'.$row['pick_time'].'</font></td>
										<td><font size=2>'.$row['status'].'</font></td>
										<td><font size=2>'.$row['bk_time'].'</font></td>
										<td><font size=2>'.$row['comments'].'</font></td>
										</tr>';
							}
						}else{
							echo '<tr>
										<td colspan="5" >There are no results</td>
									</tr>';
						}
						echo '</table>';
					?>
			</div>


        <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
        <hr style="margin-top: 20px; border: none;">
        <div class="text-center">

<h5 class="card-heading-x">Shipment Facts</h5>
</div>
<div class="text-left">
			<span style="margin-right: 20px;">Master Tracking Number:</span><strong><?php echo strtoupper($tracking); ?></strong><br /><br />
            <span style="margin-right: 20px;">Delivered To:</span><strong><?php echo strtoupper($rev_name); ?></strong><br /><br />
            <span style="margin-right: 20px;">Shipper Reference:</span><strong><?php echo strtoupper($invice_no); ?></strong><br /><br />
            <span style="margin-right: 20px;">Expected Delivery Date:</span><strong><?php echo strtoupper($schedule); ?></strong><br /><br />
            <span style="margin-right: 20px;">Service:</span><strong><?php echo strtoupper($mode); ?></strong><br /><br />
            <span style="margin-right: 20px;">Weight:</span><strong><?php echo strtoupper($weight); ?>KG</strong><br /><br />

            <span style="margin-right: 20px;">Total Shipment Weight:</span><strong><?php echo strtoupper($weightx); ?>KG</strong><br /><br />
            <span style="margin-right: 20px;">Packaging:</span><strong><?php echo strtoupper($type); ?></strong><br /><br />

		</div>
        </div>
 <!-- End Deprixa Section -->

        </div>

</div>

</section>

   <!-- Footer -->

 <?php include_once "footer.php"; ?>

    <!-- /Footer -->

    <script>

    const svgIcon = L.divIcon({
  html: `
  <svg xmlns="http://www.w3.org/2000/svg" width="46" height="56"><path fill-rule="evenodd" d="M39.263 7.673c8.897 8.812 8.966 23.168.153 32.065l-.153.153L23 56 6.737 39.89C-2.16 31.079-2.23 16.723 6.584 7.826l.153-.152c9.007-8.922 23.52-8.922 32.526 0zM23 14.435c-5.211 0-9.436 4.185-9.436 9.347S17.79 33.128 23 33.128s9.436-4.184 9.436-9.346S28.21 14.435 23 14.435z"/></svg>`,
});
var mymap = L.map('map').setView([<?php echo $lati; ?>, <?php echo $lngi; ?>], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="#">ExpressFreightMap</a> contributors, <a href="#">CC-BY-SA</a>, Imagery © <a href="#">Mapbox</a>',
    zoomDelta: 14.96,
    zoomSnap: 13,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoia2V2ZXRpaDg2MSIsImEiOiJja2h4MzFxaG8wOW5pMzBsdGZ1NXFoeHh5In0.hw5mLyF4KWalDgcxAWrmuw'
}).addTo(mymap);
var marker = L.marker([<?php echo $lati; ?>, <?php echo $lngi; ?>],{icon: svgIcon}).addTo(mymap);
var point = L.point(200, 300);





function myIPadress(ipAddress) {
    var ip = ipAddress;
    var api_key="at_M6MJOcjeIck4XkW4qTcJmKcezgamn";
    var api_url = 'https://geo.ipify.org/api/v1?';
    var url = api_url + 'apiKey=' + api_key + '&ipAddress=' + ip;
    fetch(url)
    .then((data) => data.json())
        .then((data) => {
            if(!data.code){
              displayInfo(data);
            displayMap(data);
            $(".ErorIP").remove()
            }else{
              $("header").append(
                `<div class="ErorIP"><span>${data.messages}</span></div>`
              )
            }
        })
        .catch(error => {
          console.log("error");
          if(error){
            $("header").append(
              `<div class="ErorIP"><span>your ip Adress is Incorrect !!!</span></div>`
            )
          }
      })

}
  function displayInfo(data){
   $("#ip-address").html(data.ip)
   $("#location").html(data.location.city + "," + data.location.country + " " + data.location.postalCode)
   $("#timezone").html("UTC " + data.location.timezone)
   $("#isp").html(data.isp)
  }
  function displayMap(data){
    mymap.setView([data.location.lat, data.location.lng], 13);
    marker.setLatLng([data.location.lat, data.location.lng])
  }
$("#button-addon2").click(()=>{
  var input = $(".form-control").val()
  if(input==""){
    $("header").append(
      `<div class="Eror"><span>your input is empty !!!</span></div>`
    )
  }else{
    myIPadress(input);
    $(".Eror").remove()
  }
}) </script>


    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/Scripts/tracking.js"></script>
</body>
</html>
<script>
   window.onload=load;
   window.onunload=GUnload;
</script>
<?php

}//while

}//if
else {
echo '';
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8" />
    <title>Track My Parcel  | Express Freights</title>
	<meta name="description" content="Express Freights"/>
	<meta name="keywords" content="Express Freights" />
	<meta name="author" content="Express Freights">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="icon" href="favicon.ico" sizes="20x20" type="image/png">

    <!-- style -->
   <!-- <link href="deprixa_components/content/cssefe4.css" rel="stylesheet"/>-->
	<link rel="stylesheet" href="deprixa/css/tracking.css" type="text/css" />
	<!--<link href="deprixa/css/style.css" rel="stylesheet" media="all">
<link href="files/css/master.css" rel="stylesheet">-->

		<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="files/assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color1.css" title="color1" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color2.css" title="color2" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color3.css" title="color3" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color4.css" title="color4" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color5.css" title="color5" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="files/assets/switcher/css/color6.css" title="color6" media="all" />
</head>

   <!-- Menu -->
<?php include_once "menu.php"; ?>
    <!-- /Menu -->

<div class="slide">
    </div>
        <main class="slide">


        <!-- breadcrumb start -->
    <div class="breadcrumb-area bg-overlay-2" style="background-image:url('assets/img/banner/breadcrumb.png')">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-inner">
                        <div class="section-title mb-0">
                            <h2 class="page-title">Tracking Result</h2>
                            <ul class="page-list">
                                <li><a href="/">Home</a></li>
                                <li>Tracking Result</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

		<div class="container">
				<div class="page-content">

					<div class="text-center">
						<h1><img src="dashboard/img/no_courier.png" /></h1>
						<h3>Tracking number not found,</h3>
						<p><font color="#FF0000"><?php echo $tracking; ?></font> check the number or Contact Us.</p>
						<div class="text-center"><a href="index.php" class="btn-system btn-small">Back To Home</a></div>
					</div>
				</div>
		</div>
		</>
		<!-- End Content -->

   <!-- Footer -->

   <br />
   <br />
   <br />

 <?php include_once "footer.php"; ?>

    <!-- /Footer -->
    </div>

    <script src="deprixa_components/bundles/jquery"></script>
    <script src="deprixa_components/bundles/bootstrap"></script>
    <script src="deprixa_components/bundles/modernizr"></script>
    <script src="deprixa_components/scripts/tracking.js"></script>

</body>
</html>
<?php
}//else
?>