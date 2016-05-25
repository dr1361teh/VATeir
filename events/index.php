<?php
$pagetitle = "Events Home";
require_once("includes/header.php");
?>
<h3 class="text-center">Events Home</h3> <br>
<div class="row col-md-10 col-md-offset-1">

		<?php
		try{
		$events = $ev->future();

			if(!empty($events)) {
				foreach($events as $id => $eventa) {
					$event = a2o($eventa);
		//	print_r($event);

					?>
				<div class="panel panel-success">
					<div class="panel-heading" id="<?php echo $event->id;?>">
						<h3 class="panel-title"><?php echo $event->title; ?></h3>
					</div>
					<div class="panel-body">
						<div class="thumbnail">
							<div class="text-center">
								<img class="img-responsive" data-src="holder.js/300x300" src="<?php echo $event->banner_url;?>" alt="...">
							</div>
							<div class="caption">
								<h4><?php echo $event->title;?><small><br><?php echo $event->starts_date . ' ' . $event->starts_time;?>&ndash;<?php echo $event->ends_time;?></small></h4>
								<p><?php echo $event->description; ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php

				}
			} else { ?>
				<div class="panel panel-success">
					<div class="panel-heading" id="<?php echo $event->id;?>">
						<h3 class="panel-title">Forthcoming Events</h3>
					</div>
					<div class="panel-body">

						<div class="text-danger text-center" style="font-size:16px;"><br>No forthcoming events</div><br>

					</div>
				</div>
					<?php
		}
	}catch (Exception $e) {
		echo $e->getMessage();
	}
	?>


</div>
<?php require_once('../includes/footer.php');
