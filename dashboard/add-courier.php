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
//Include database configuration file
require_once('database-settings.php');
require_once('database.php');
$db = conexion();

require_once('library.php');
require_once('funciones.php');
require 'requirelanguage.php';
include_once "filtro/class/class.php";;
include_once "filtro/class_buscar.php";
require_once("filtro/class/class.inputfilter.php");
$ifilter = new InputFilter();
$_POST = $ifilter->process($_POST);

$sql = "SELECT DISTINCT(off_name)
		FROM offices";
$result = dbQuery($sql);

$company=mysql_fetch_array(mysql_query("SELECT * FROM company"));
date_default_timezone_set($_SESSION['ge_timezone']);
$fechai=date('Y-m-d');
$fechaf=date('Y-m-d');

isUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $_SESSION['ge_cname']; ?> | <?php echo $ENVIOS; ?></title>
	<meta name="description" content="<?php echo $_SESSION['ge_description']; ?>"/>
	<meta name="keywords" content="<?php echo $_SESSION['ge_keywords']; ?>" />
	<meta name="author" content="Jaomweb">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../bower_components/animate.css/animate.css" type="text/css" />
	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="../bower_components/simple-line-icons/css/simple-line-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/font.css" type="text/css" />
	<link rel="stylesheet" href="css/app.css" type="text/css" />
	<link href="css/style.css" rel="stylesheet" media="all">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

    <!-- Switchery css -->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />


	<!-- Plugins css -->
	<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="assets/plugins/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

</head>
<body>
<?php
include("header.php");
?>

  <!-- content -->
  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">

<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12">
      <div class="blog-post">
        <div class="panel">
			<div class="wrapper-lg">
				<div>
					<tbody>
						<div class="row alertaCaja" style="display: none;">
							<div class="col-xs-4 col-sm-4 col-md-4" style="float: none; margin: 0 auto;">
								<div class="alert alert-dismissible alert danger">
									<button type="button" class="close" data-dismiss="alert"><img src="img/close.png"  height="15" width="15"></button>
										<center>
											<?php
											require_once('database.php');
											$query= mysql_query("SELECT MAX(cid) AS id FROM courier");
											 if ($row = mysql_fetch_row($query))
											 {

											?>
												<a target="_blank" href="print-invoice/invoice-print.php?cid=<?php echo codificar($id = trim($row[0])); ?>">
												<img src="img/print-invoice.png"  height="76" width="79"></a>
											<?php } ?>

											<?php
											require_once('database.php');
											$query= mysql_query("SELECT MAX(cid) AS id FROM courier");
											 if ($row = mysql_fetch_row($query))
											 {

											?>
												<a target="_blank" href="print-invoice/ticket-print.php?cid=<?php echo codificar($id = trim($row[0])); ?>">
												<img src="img/print_label.png"  height="76" width="79"></a>
											<?php } ?>
										</center>
								</div>
							</div>
						</div>

						<?php	if ( isset ( $_GET ['tipo'] ) ) {	?>
						<div class="row alertaCaja" style="display: none;" >
							<div class="col-xs-6 col-sm-6 col-md-6" style="float: none; margin: 0 auto;">
								<div class="alert alert-dismissible alert-<?php echo $_GET ['tipo'] ?>">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong><?php echo $L_['message']; ?></strong><br/><br/> <?php echo $_GET ['mensaje']; ?>
								</div>
							</div>
						</div>
						<?php } ?>

						<tr>
						<h3 class="classic-title"><span><strong><i class="fa fa-truck icon text-default-lter"></i>&nbsp;&nbsp;<?php echo $ADICIONAR; ?></strong></h3>

						<!-- START Checkout form -->

						<form action="settings/add_courier/agregar.php"   method="post" >
							<table border="0" align="center" width="100%" >
								<div class="row">

										<!-- START Presonal information -->
										<fieldset class="col-md-6">
											<legend><?php echo $datosremite; ?></legend>
											<!-- Name -->
											<div class="row" >
												<div class="col-sm-2 form-group">
														<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffRole; ?><span class="required-field">*</span></label>
														<input type="text"  class="form-control" name="officename" id="officename" value="<?php echo $_SESSION['user_type'] ;?>"   readonly="true" />
												</div>
												<div class="col-sm-2 form-group">
														<label  class="control-label"><i class="fa fa-user icon text-default-lter"></i>&nbsp;<?php echo $StaffUser; ?><span class="required-field">*</span></label>
														<input type="text" class="form-control" name="user" id="user" value="<?php echo $_SESSION['user_name'] ;?>"   readonly="true" />
												</div>
												<div class="col-sm-8 form-group">

													<label class="control-label" >Sender Name<span class="required-field">*</span></label>
													 <input type="text" class="form-control" name="Shippername"  id="Shippername" autocomplete="on" list="customers" />
													   <datalist id="customers">
														<?php
															$sql=mysql_query("SELECT * FROM tbl_clients");
															while($row=mysql_fetch_array($sql)){
																echo '<option data-value="'.$row['id'].'">'.utf8_encode($row['name']).'</option>';
															}
														?>
													  </datalist>
													<input type="hidden" name="Shippername-hidden" id="Shippername-hidden" />
												</div>
											</div>
											<div class="row">
												<div id="divRemi">
													<div class="col-sm-6 form-group">
														<label  class="control-label">Arrived Port Address<span class="required-field">*</span></label>
														<input type="text"  class="form-control" name="Shipperaddress" id="Shipperaddress" placeholder="<?php echo $placeremi; ?>" />
													</div>


													<div class="col-sm-3 form-group" style="display:none">
														<label class="control-label"><?php echo $L_['lockerid']; ?></i></label>
														<input type="text" class="form-control" name="Shipperlocker" id="Shipperlocker"  placeholder="<?php echo $L_['lockerid']; ?>">
													</div>
													<div class="col-sm-3 form-group">
														<label class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>Arrived Port Country</strong></label>
															<input type="text" class="form-control" name="Pickuptime" id="Shippercountry" placeholder="<?php echo $L_['placecountry']; ?>">
													</div>
													<div class="col-sm-3 form-group">
														<label class="control-label"><strong>Sender State</strong></label>
															<input  type="text"  class="form-control" name="state"  id="Shipperstate"  placeholder="<?php echo $L_['placestate']; ?>">
													</div>
													<div class="col-sm-3 form-group" style="display:none">
														<label class="control-label"><strong><?php echo $CODIGO; ?></strong></label>
															<input type="text" class="form-control" name="iso" id="Shipperiso" placeholder="<?php echo $L_['placeiso']; ?>" >
													</div>




													<div class="col-sm-12 form-group">
														<p class="error"></p>
														<label class="control-label">Sender Email<font color="#FF6100"><?php echo $notaemail; ?></font></i></label>
															<input type="email" class="form-control" name="Shipperemail" id="idemail"   placeholder="demo@emo.com" autocomplete=" off" onKeyUp="javascript:validateeMail('idemail')" />
														<strong><span id="mailOK"></span></strong>
														<p class="error"></p>
													</div>
												</div>
											</div>
											<!-- Adress and Phone -->

											<!-- START Shipment information -->
											</br></br>
											<legend><?php echo $Informaciondeenvio; ?></legend>

											<div class="row">

											<!-- Origin Office -->

											   <div class="col-sm-3 form-group">
												 <label for="zipcode" class="control-label"><i class="fa fa-angle-double-right icon text-default-lter"></i>&nbsp;<strong>Shipper Reference</strong></label>
                                                 <input type="text" class="form-control" name="Invoiceno"  placeholder="Shipper Reference" />

												</div>
												<div class="col-sm-3 form-group">
													<label for="ccv" class="control-label"><strong><?php echo $CantidadPaquetes; ?></strong></i></label>
													<input type="number" class="form-control" name="Qnty"  placeholder="<?php echo $placecant; ?>" />
												</div>
													<!-- Text area -->
												<div class="col-sm-6 form-group">
													<label for="inputTextarea" class="control-label"><i class="fa fa-comments icon text-default-lter"></i>&nbsp;Package Name</label>
													<textarea class="form-control" name="Comments" placeholder="<?php echo $placedetails; ?>" ></textarea>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-5 form-group">
													<label class="control-label"><i class="fa fa-database icon text-default-lter"></i>&nbsp;<strong><?php echo $Pagos; ?></strong></label>
													<select class="form-control" name="bookingmode">
														<option selected="selected" value="Effective"><?php echo $Effective; ?></option>
														<option value="Debit_card"><?php echo $Debitcard; ?></option>
														<option value="Credit_card"><?php echo $Creditcard; ?></option>
														<option value="Transfer"><?php echo $Transfer; ?></option>
														<option value="Online"><?php echo $Payonline; ?></option>
														<option value="Paypal"><?php echo $L_['type_paypal']; ?></option>
													</select>
												</div>

												<div class="col-sm-4 form-group">
													<label class="control-label">Packaging</label>
													<select  type="text" class="form-control" name="Shiptype"  >
														<?php
															$sql="SELECT name FROM type_shipments  GROUP BY name";
																$query=$db->query($sql);
																if($query->num_rows>0){
																	while($row=$query->fetch_array()){
																	echo '<option data-value="'.$row['name'].'">'.utf8_encode($row['name']).'</option>';
																}
															}
														?>
													</select>
												</div>
												<div class="col-sm-3 form-group">
													<label class="control-label"><i class="fa fa-plane icon text-default-lter"></i>&nbsp;<?php echo $MododelServicio; ?></label>
												  <select class="form-control" name="Mode">
													<?php
														$sql="SELECT name FROM mode_bookings  GROUP BY name";
															$query=$db->query($sql);
															if($query->num_rows>0){
																while($row=$query->fetch_array()){
																echo '<option data-value="'.$row['name'].'">'.utf8_encode($row['name']).'</option>';
															}
														}
													?>
												  </select>
												</div>
											</div>

											 <!-- Payment Mode -->
											 <div class="row">





												<div class="col-sm-3 form-group">
													<label class="text-danger"><strong>Package Weight(kg)<strong></label>
													<input type="text" class="form-control" required  name="Weight" value="0" placeholder="Package weight" />
												</div>
                                                <div class="col-sm-3 form-group">
													<label class="text-danger"><strong>Total Package Weight(kg)<strong></label>
													<input type="text" class="form-control" required  name="Weightx" value="0" placeholder="Total Package weight" />
												</div>
												<div class="col-sm-3 form-group">
													<label class="text-danger"><strong><?php echo $SubtotalEnvio; ?><strong></i></label>
													<input  type="text" class="form-control" name="shipping_subtotal" id="resultado" value="0" />
												</div>
												<div class="col-sm-3 form-group">
													<label class="text-danger"><strong>Package Weight Price(USD)<strong></label>
													<input type="text" class="form-control"  id="pesoreal" name="pesoreal" >
												</div>
											</div>



											<!-- Peso Volumetrico -->


										</fieldset>

										<!-- START Receiver info  -->
										<fieldset class="col-md-6">
											<legend><?php echo $DatosDestinatario; ?></legend>

											<!-- Name -->
											<div class="form-group">
												<label  class="control-label">Receiver Name<span class="required-field">*</span></label>
												<input type="text" class="form-control" name="Receivername" id="Receivername" autocomplete="on" list="customers" >

											</div>


											<!-- Adress and Phone -->
											<div class="row">
												<div class="col-sm-3 form-group">
													<label  class="control-label">Receiver Address<span class="required-field">*</span></label>
													<input type="text"  class="form-control" name="Receiveraddress" id="Receiveraddress" placeholder="<?php echo $placedirdesti; ?>" >
												</div>




												<div class="col-sm-3 form-group" style="display:none">
													<label class="control-label"><strong><?php echo $CODIGO; ?></strong></label>
														<input type="text" class="form-control" name="iso1"  id="Receiveriso1"  placeholder="<?php echo $L_['placeiso']; ?>" >
												</div>



												<div class="col-sm-12 form-group">
													<p class="error"></p>
													<label class="control-label"><?php echo $EMAIL; ?><font color="#FF6100"><?php echo $notaemail; ?></font></i></label>
													<input type="email" class="form-control" name="Receiveremail" id="id_mail"   placeholder="demo@emo.com"  onKeyUp="javascript:validateMail('id_mail')" >
													<strong><span id="emailOK"></span></strong>
													<p class="error"></p>
												</div>
											</div>
											</br></br>

											<!-- Name -->
											<div class="form-group">
												<label for="name-card" class="text-success"><strong><?php echo $NUMEROENVIO; ?></strong></label>
											<?php
												$qryEmpresa =  mysql_query("SELECT * FROM company");
												while($row = mysql_fetch_array($qryEmpresa)) {
													$pre  = $row["prefijo"];
													$cons  = $row["cons_no"];
												}
												mysql_free_result($qryEmpresa);
												$pa=mysql_query("SELECT MAX(cons_no)as maximo FROM c_tracking");
												if($row=mysql_fetch_array($pa)){
													if($row['maximo']==NULL){
														$cons_no=''.$cons.'';
													}else{
														$cons_no=$row['maximo']+1;
													}
												}

											?>
											<input type="text" class="form-control"  name="cons_no" value="" placeholder="Type 7 digit tracking code">
											</div>
											</br>

											<!-- Status and Pickup Date -->
											<div class="form-group">
												<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;Shipment Date</i></label>
												<div>
													<div class="input-group">
														<input type="text" class="form-control" name="Packupdate" placeholder="mm/dd/yyyy" id="datepicker-autoclose" >
														<span class="input-group-addon bg-custom b-0"><i class="glyphicon glyphicon-calendar"></i></span>
													</div><!-- input-group -->
												</div>
											</div>

											<div class="row">
												<div class="col-sm-4 form-group">
													<label for="month" class="control-label"><i class="fa fa-sort-amount-asc icon text-default-lter"></i>&nbsp;Actual Delivery</label>
													<select class="form-control" name="status" id="status">
															<?php
																$sql="SELECT servicemode FROM service_mode  GROUP BY servicemode";
																$query=$db->query($sql);
																if($query->num_rows>0){
																	while($row=$query->fetch_array()){
																	echo '<option data-value="'.$row['servicemode'].'">'.utf8_encode($row['servicemode']).'</option>';

																	}
																}

															?>
													</select>
												</div>
												<div class="col-sm-8 form-group">
														<label for="dtp_input1" class="control-label"><i class="fa fa-calendar icon text-default-lter"></i>&nbsp;<?php echo $fechaestimadadeliver; ?></i></label>
													<div>
														<div class="input-group">
															<input type="text" class="form-control" name="Schedule" placeholder="mm/dd/yyyy" id="datepicker">
															<span class="input-group-addon bg-custom b-0"><i class="glyphicon glyphicon-calendar"></i></span>
														</div><!-- input-group -->
													</div>

													</fieldset>
													<div class="col-md-6 text-left">
														</br></br>
														<button type="submit"  id="submit" class="btn btn-large btn-success"><?php echo $GUARDARENVIO; ?></button>
													</div>
												</div>
											</div>
										</div>
									</table>
								</form>
							</div>
						</div>
					</div>
				  </div>
			   </div>
		  </div>
		</div>
	</div>
  </div>
  <!-- / content -->

<?php include("footer.php"); ?>

<?php include("footer_add_courier.php"); ?>