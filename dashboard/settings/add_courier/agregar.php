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
	require '../../requirelanguage.php';
	require_once('../../funciones.php');
	include ( "../../css/sms/src/NexmoMessage.php" );
	require '../../css/GUMP/gump.class.php';


		## Validos los valores que llegan del formulario
		$validator = new GUMP();

		// sanitizo la variable POST
		$_POST = $validator->sanitize($_POST);

		// defino reglas y filtros
		$validator->filter_rules( array(
			'Shippername'       	=> 'trim|sanitize_string',
			'Shipperaddress'    	=> 'trim|sanitize_string',
			'Shipperemail'	  		=> 'trim|sanitize_email',
			'address'     			=> 'trim|sanitize_string',
			'Receivername'     		=> 'trim|sanitize_string',
			'Receiveraddress'       => 'trim|sanitize_string',
			'Receiveremail'     	=> 'trim|sanitize_email',
			'Weight'				=> 'trim|sanitize_string',
            'Weightx'				=> 'trim|sanitize_string',
			'Qnty'       			=> 'trim|sanitize_string',
			'Pickuptime'	  		=> 'trim|sanitize_string',
			'state'     			=> 'trim|sanitize_string',
			'Comments'     			=> 'trim|sanitize_string'));


			$validator->validation_rules( array(
			'Shippername'       	=> 'required',
			'Shipperaddress'    	=> 'required',
			'Shipperemail'     		=> 'required|valid_email',
			'Receivername'     		=> 'required',
			'Receiveraddress'       => 'required',
			'Receiveremail'			=> 'required|valid_email',
			'Weight'				=> 'required',
            'Weightx'				=> 'required',
			'Qnty'       			=> 'required',
			'Pickuptime'     		=> 'required',
			'state'     			=> 'required',
			'Comments'				=> 'required'));


		// se realiza las validaciones
		$validated_data = $validator->run($_POST);

		# si hubo errores lo informamos
		if($validated_data === false) {
			header ( "Location: ../../add-courier.php?tipo=danger&mensaje=".$validator->get_readable_errors(true));
		} else {

		$Shippername 		= $_POST['Shippername'];
		$Shipperaddress		= $_POST['Shipperaddress'];
		$Shipperlocker 		= $_POST['Shipperlocker'];
		$Shipperemail 		= $_POST['Shipperemail'];
		$Receivername 		= $_POST['Receivername'];
		$Receiveraddress 	= $_POST['Receiveraddress'];
		$Receiveremail 		= $_POST['Receiveremail'];
		$tracking 			= $_POST['tracking'];
		$ConsignmentNo 		= $_POST['ConsignmentNo'];
		$letra 				= $_POST['letra'];
		$Shiptype 			= $_POST['Shiptype'];
		$Weight 			= $_POST['Weight'];
        $Weightx 			= $_POST['Weightx'];
		$shipping_subtotal 	= $_POST['shipping_subtotal'];
		$pesoreal 			= $_POST['pesoreal'];
		$Invoiceno 			= $_POST['Invoiceno'];
		$Qnty 				= $_POST['Qnty'];
		$bookingmode 		= $_POST['bookingmode'];
		$Mode 				= $_POST['Mode'];
		$Packupdate 		= $_POST['Packupdate'];
		$Schedule 			= $_POST['Schedule'];
		$Pickuptime 		= $_POST['Pickuptime'];
		$iso 				= $_POST['iso'];
		$state 				= $_POST['state'];
		$iso1 				= $_POST['iso1'];
		$status 			= $_POST['status'];
		$Comments 			= $_POST['Comments'];
		$officename 		= $_POST['officename'];
		$user 				= $_POST['user'];
		$status_delivered 	= $_POST['status_delivered'];


		## Obtengo datos de la empresa
		$qryEmpresa =  mysql_query("SELECT * FROM company");

		while($row = mysql_fetch_array($qryEmpresa)) {

			$pre  = $row["prefijo"];
			$cons  = $row["cons_no"];
		}
		mysql_free_result($qryEmpresa);

		$pa=mysql_query("SELECT MAX(cons_no)as maximo FROM c_tracking");
			if($row=mysql_fetch_array($pa)){
				if($row['maximo']==NULL){
					$cons_no=$_POST['cons_no'];
				}else{
					$cons_no=$_POST['cons_no'];
				}
			}


		$sql = "INSERT INTO courier (tracking,cons_no, letra,ship_name, s_add, locker, correo, rev_name, r_add, email, type, weight, weightx, shipping_subtotal, invice_no, qty, book_mode, mode, pick_date, schedule, pick_time, pick_time2, iso,
		state, iso1, status, comments, officename, status_delivered, user, book_date, pesoreal)
		VALUES('$cons_no','$cons_no', '$pre', '$Shippername', '$Shipperaddress', '$Shipperlocker', '$Shipperemail', '$Receivername', '$Receiveraddress', '$Receiveremail', '$Shiptype', '$Weight', '$Weightx', '$shipping_subtotal', '$Invoiceno', $Qnty, '$bookingmode', '$Mode', '$Packupdate', '$Schedule', '$Pickuptime', '$Pickuptime', '$iso', '$state', '$iso1', '$status', '$Comments', '$officename', '$status_delivered', '$user', curdate(), '$pesoreal')";
			//echo $sql;
		dbQuery($sql);

		$sql_1 = "INSERT INTO c_tracking (tracking,cons_no,officename,user, book_date)
				VALUES('$cons_no','$cons_no','$officename','$user',curdate() )";
			//echo $sql;
		dbQuery($sql_1);

		$sql_2 = "INSERT INTO accounting (tracking,ship_name,locker,book_mode,shipping_subtotal,office,user, book_date)
				VALUES('$cons_no','$Shippername','$Shipperlocker','$bookingmode','$shipping_subtotal','$officename','$user',curdate() )";
			//echo $sql;
		dbQuery($sql_2);



		// Step 3: Display an overview of the message

		$result131 =  mysql_query("SELECT * FROM company");
		while($row = mysql_fetch_array($result131)) {

		$to  = $row["bemail"];
		$address  = $row["caddress"];
		$namecompanie  = $row["cname"];
		$footer  = $row["footer_website"];
		$web  = $row["website"];
		$url = APP_URL."/logo-image/image_logo.php?id=1'";
		// subject

		$subject = ''.$envioasudestino.' | '.$row["cname"].'';
		$from = $row["bemail"];
		// message

		// HTML email starts here

		$message  = "<html><body>";
		$message .= "<div style='font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee'>
								<table align='center' width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
								<tbody>
									<tr>
										<td>
											<table align='center' width='750px' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='width:750px!important'>
											<tbody>
												<tr>
													<td>
														<table width='690' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
														<tbody>
															<tr>
																<td colspan='3' height='80' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='padding:0;margin:0;font-size:0;line-height:0'>
																	<table width='690' align='center' border='0' cellspacing='0' cellpadding='0'>
																	<tbody>
																		<tr>
																			<td width='30'></td>
																			<td align='left' valign='middle' style='padding:0;margin:0;font-size:0;line-height:0'><a href='$web' target='_blank'><img src='$url' height='59' width='310'></a></td>
																			<td width='30'></td>
																		</tr>
																	</tbody>
																	</table>
																</td>
															</tr>
															<tr>
																<td colspan='3' align='center'>
																	<table width='630' align='center' border='0' cellspacing='0' cellpadding='0'>
																	<tbody>
																		<tr>
																			<td colspan='3' height='60'></td></tr><tr><td width='25'></td>
																			<td align='center'>
																				<h1 style='font-family:HelveticaNeue-Light,arial,sans-serif;font-size:40px;color:#404040;line-height:40px;font-weight:bold;margin:0;padding:0'>$welcometo $namecompanie</h1>
																			</td>
																			<td width='25'></td>
																		</tr>
																		<tr>
																			<td colspan='3' height='40'></td></tr><tr><td colspan='5' align='center'>
																				<p style='color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0'>$hola  <strong>$Receivername</strong></p><br>
																				<p style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>
																				<strong><strong>$Shippername</strong>, $tehaenviado</p><br>
																			</td>
																		</tr>
																		<tr>
																	</tr>
																	<tr><td colspan='3' height='30'></td></tr>
																</tbody>
																</table>
															</td>
														</tr>

														<tr bgcolor='#ffffff'>
															<td width='30' bgcolor='#eeeeee'></td>
																<table width='570' align='center' border='0' cellspacing='0' cellpadding='0'>
															<td>
																<tbody>
																	<tr>
																		<td colspan='4' align='center'>&nbsp;</td>
																	</tr>
																	<tr>
																		<td colspan='4' align='center'><h2 style='font-size:24px'>$envioasudestino</h2></td>
																	</tr>
																	<tr>
																		<td colspan='4'>&nbsp;</td>
																	</tr>
																	<tr>
																		<td width='120' align='right' valign='top'><img src='https://elexpressfreight.com/icon-destination.png' alt='tool' width='150' height='138'></td>
																		<td width='30'></td>
																		<td align='left' valign='middle'>
																			<h3 style='color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0'>$estadodelenvio</h3>
																			<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$_Tracking:</strong> <strong>$cons_no</strong></div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$estado:</strong> <strong>$status</strong></div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$email1:</strong> <strong>$Receiveremail</strong></div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>$direccion:</strong> <strong>$Receiveraddress</strong></div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>Expected Delivery Date:</strong> <strong>$Schedule</strong></div>
																			<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'><strong>Package name:</strong> <strong>$Comments</strong></div>
																		</td>
																		<td width='30'></td>
																	</tr>
																	<tr>
																		<td colspan='4'>&nbsp;</td>
																	</tr>
																</tbody>
																</table>
																<table width='570' align='center' border='0' cellspacing='0' cellpadding='0'>
																	<tbody>
																		<tr>
																			<td align='center'>
																				<div style='text-align:center;width:100%;padding:40px 0'>
																					<table align='center' cellpadding='0' cellspacing='0' style='margin:0 auto;padding:0'>
																					<tbody>
																						<tr>
																							<td align='center' style='margin:0;text-align:center'><a href='$web' style='font-size:18px;font-family:HelveticaNeue-Light,Arial,sans-serif;line-height:22px;text-decoration:none;color:#ffffff;font-weight:bold;border-radius:2px;background-color:#00a3df;padding:14px 40px;display:block' target='_blank'>$tracking!</a></td>
																						</tr>
																					</tbody>
																					</table>
																				</div>
																			</td>
																	  </tr>
																	  <tr><td>&nbsp;</td>
																	  </tr>
																	  <tr>
																		<td>
																			<h2 style='color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0'>&nbsp;</h2>
																			<div style='color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0'>$hola $rev_name $estaes <br /><br /> <strong> $address $porfavor</div>
																		</td>
																	</tr>
																	<tr><td>&nbsp;</td>
																	</tbody>
																</table>
															</td>
															<td width='30' bgcolor='#eeeeee'></td>
														</tr>
														</tbody>
														</table>
														<table align='center' width='750px' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee' style='width:750px!important'>
														<tbody>
															<tr>
																<td>
																	<table width='630' align='center' border='0' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
																	<tbody>
																		<tr><td colspan='2' height='30'></td></tr>
																		<tr>
																			<td width='360' valign='top'>
																				<div style='color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0'>$footer</div>
																				<div style='line-height:5px;padding:0;margin:0'>&nbsp;</div>
																				<div style='color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0'>$namecompany</div>
																			</td>
																			<td align='right' valign='top'>
																				<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/BggPYqAh.png' alt='fb'></a>&nbsp;</span>
																				<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/j3NsGLak.png' alt='twit'></a>&nbsp;</span>
																				<span style='line-height:20px;font-size:10px'><a href='' target='_blank'><img src='http://i.imgbox.com/wFyxXQyf.png' alt='g'></a>&nbsp;</span>
																			</td>
																		</tr>
																		<tr><td colspan='2' height='5'></td></tr>

																	</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
														</table>
													</td>
												</tr>
											</tbody>
											</table>
										</td>
									</tr>
								</tbody>
								</table>
							</div>";
		$message .= "</body></html>";

		}
		// To send HTML mail, the Content-type header must be set

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	   // Additional headers
		$headers .= 'From: '.$from."\r\n";
		// this line checks that we have a valid email address
		mail($to, $subject, $message, $headers); //This method sends the mail.
		mail($Receiveremail, $subject, $message, $headers); //This method sends the mail.
	   mail($Shipperemail, $subject, $message, $headers);
	   echo "<script type=\"text/javascript\">
				alert(\"$envioclienteok\");
				window.location = \"../../add-courier.php\"
			</script>";

		//echo $Ship;
	}
?>