<?php
$pagetitle = "Weather";
require_once('includes/header.php');
?>
<h3 class="text-center">Weather</h3>
<div class="text-danger text-center" style="font-size:16px; margin-top:8px;">Not for real world use</div> <br>
<div class="row">
	<div class="col-md-8 col-md-offset-2">


		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Weather Station</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action="" method="post" autocomplete="off">
					<div class="form-group">
						<label for="icao" class="col-lg-4 col-xs-4 control-label">ICAO</label>
						<div class="col-lg-8 col-xs-8">
							<input required class="form-control" style="text-transform:uppercase" id="icao" name="icao" placeholder="EICK" maxlength="4" value="<?php echo (Input::exists()) ? Input::get('icao') : '';?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-6 col-lg-offset-5 col-xs-6 col-xs-offset-3">
							<input type="submit" name="get" class="btn btn-info" value="Get Weather">
						</div>
					</div>
				</form>
			</div>
	</div>
	<?php
	if(Input::exists()) {
		try{
			$oad = new OAD;
			$metar = $oad->metar(Input::get('icao'));

			$taf = $oad->taf(Input::get('icao'));
			$icao = $oad->icaoInfo(Input::get('icao'));
				?>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Station Location</h3>
					</div>
					<div class="panel-body">
						<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
				  		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>

				  		 <div id="map" class="img-responsive" style="width: 500px; height: 400px;"></div>
				  		  <script type="text/javascript">
							function initMap() {
							  var station = {lat: <?php echo $icao->lat;?>, lng: <?php echo $icao->lon;?>};

							  var map = new google.maps.Map(document.getElementById('map'), {
							    zoom: 6,
							    center: station,
				    			disableDefaultUI: true
							  });

							  var marker = new google.maps.Marker({
							    position: station,
							    map: map
							  });
							}
							initMap();



						  </script>
					</div>
				</div>



				<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">METAR</h3>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-striped">
						<tr>
							<td><strong>Station:</strong></td>
							<td><?php echo $icao->name . ' (' . $icao->icao . ')'; ?></td>
						</tr>
						<tr>
							<td><strong>Reported:</strong></td>
							<td><?php 	$date = new DateTime($metar->observation_time);
										echo $date->format('jS F Y H:i');?></td>
						</tr>
						<tr>
							<td><strong>Temperature:</strong></td>
							<td><?php echo $metar->tmp;?></td>
						</tr>
						<tr>
							<td><strong>Dew Point:</strong></td>
							<td><?php echo $metar->dewpt;?></td>
						</tr>
						<tr>
							<td><strong>Wind:</strong></td>
							<td><?php echo $metar->wind->dir . ' @ ' . $metar->wind->spd . ' kt / Gust: ' . $metar->wind->gust;?></td>
						</tr>
						<tr>
							<td><strong>Visibility:</strong></td>
							<td><?php echo $metar->visibility;?> mi</td>
						</tr>
						<tr>
							<td><strong>Pressure:</strong></td>
							<td><?php echo $metar->pressure . ' / ' .$metar->altimeter;?></td>
						</tr>
						<tr>
							<td><strong>Cloud:</strong></td>
							<td><?php foreach($metar->sky_conditions as $s) {
								echo 'Sky Cover: ';
								echo $s->sky_cover;
								echo ' / Cloud Base: ';
								echo $s->cloud_base_ft_agl . 'ft agl';
								echo '<br>';
							}
								?></td>

						</tr>
						<tr>
							<td><strong>Category:</strong></td>
							<td><?php echo $metar->category; ?></td>
						</tr>
						<tr>
							<td><strong>Raw:</strong></td>
							<td><samp><?php echo $metar->raw; ?></samp></td>
						</tr>
					</table>
				</div>
			</div>
<?php


				?>
				<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">TAF</h3>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-striped">
						<tr>
							<td><strong>Station:</strong></td>
							<td><?php echo $taf->station; ?></td>
						</tr>
						<tr>
							<td><strong>Issued:</strong></td>
							<td><?php 	$date = new DateTime($taf->bulletin_time);
										echo $date->format('jS F Y H:i');?></td>
						</tr>
						<tr>
							<td><strong>Raw:</strong></td>
							<td><samp><?php echo $taf->raw;?></samp></td>
						</tr>
					</table>
				</div>
			</div>






			<?php


		} catch(Exception $e) {
			echo $e->getMessage();
		}


		?>
		<br><br>
		<?php
	}






	?>

</div>


<?php

require_once('../includes/footer.php');
