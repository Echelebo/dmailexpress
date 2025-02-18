<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA -  logistics Worldwide Software                               *
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
	require_once('../../database.php');
	require_once('../../database-settings.php');

	$cid = (int)$_POST['cid'];
	$Shippername = $_POST['Shippername'];
	$Shipperaddress = $_POST['Shipperaddress'];

	$Receivername = $_POST['Receivername'];
	$Receiveraddress = $_POST['Receiveraddress'];
	$Receiveremail = $_POST['Receiveremail'];

	$Shiptype = $_POST['Shiptype'];
	$Weight = $_POST['Weight'];
    $Weightx = $_POST['Weightx'];
	$shipping_subtotal = $_POST['shipping_subtotal'];
	$Invoiceno = $_POST['Invoiceno'];
	$Qnty = $_POST['Qnty'];

	$pesoreal = $_POST['pesoreal'];

	$Bookingmode = $_POST['Bookingmode'];
	$Mode = $_POST['Mode'];

	$Packupdate = $_POST['Packupdate'];
	$Schedule = $_POST['Schedule'];
	$Pickuptime = $_POST['Pickuptime'];
	$iso = $_POST['iso'];
	$state = $_POST['state'];
	$ciudad = $_POST['ciudad'];

	$paisdestino = $_POST['paisdestino'];
	$iso1 = $_POST['iso1'];
	$state1 = $_POST['state1'];
	$city1 = $_POST['city1'];
	$status = $_POST['status'];
	$Comments = $_POST['Comments'];
	$officename = $_POST['officename'];
	$user = $_POST['user'];

	$sql = "UPDATE courier
   SET ship_name='$Shippername',s_add='$Shipperaddress', rev_name='$Receivername',r_add='$Receiveraddress', email='$Receiveremail', type='$Shiptype', weight='$Weight', weightx='$Weightx', invice_no='$Invoiceno', mode ='$Mode', pick_date='$Packupdate' , schedule='$Schedule',pick_time='$Pickuptime',iso='$iso',state='$state',ciudad='$ciudad',paisdestino='$paisdestino',iso1='$iso1',state1='$state1',city1='$city1',book_mode='$Bookingmode',qty='$Qnty', shipping_subtotal='$shipping_subtotal', status='$status', comments='$Comments', officename='$officename', user='$user' , pesoreal='$pesoreal'
   WHERE cid = '$cid'";
		//echo $sql;
	dbQuery($sql);

    require '../../requirelanguage.php';

	echo "<script type=\"text/javascript\">
			alert(\"$updateexit\");
			window.location = \"../../index.php\"
		</script>";

	//echo $Ship;

?>