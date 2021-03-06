<?php
$pagetitle = "My Sessions";
require_once('includes/header.php');
echo '<h3 class="text-center">My Sessions</h3><br>';

$s = new Sessions;

?>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Forthcoming Sessions</h3>
			</div>
			<div class="panel-body">
				<?php
				try {
					$sessions = $s->get(array(
							'student' => $user->data()->id,
							'future' => 1,
							'deleted'	=> 0
						));
					if(!empty($sessions)) {
					?>
					<table class="table table-condensed table-striped">
						<tr>
							<td>
								<strong>Mentor</strong>
							</td>
							<td>
								<strong>Program</strong>
							</td>
							<td>
								<strong>Position</strong>
							</td>
							<td>
								<strong>Type</strong>
							</td>
							<td>
								<strong>Date</strong>
							</td>
							<td>
								<strong>Start</strong>
							</td>
							<td>
								<strong>Finish</strong>
							</td>
							<td>
								<strong>Comment</strong>
							</td>
							<td>
								<strong>Cancel</strong>
							</td>
						</tr>

						<?php foreach($sessions as $session): ?>
							<tr id="s<?php echo $session->session_id; ?>">
								<td>
									<?php echo $session->mfname . ' ' . $session->mlname; ?>
								</td>
								<td>
									<?php echo $session->program_name; ?>
								</td>
								<td>
									<?php echo $session->position_name . ' (' . $session->callsign . ')'; ?>
								</td>
								<td>
									<?php echo $session->session_name; ?>
								</td>
								<td>
									<?php echo date("j-M-y", strtotime($session->start)); ?>
								</td>
								<td>
									<?php echo date("H:i", strtotime($session->start)); ?>
								</td>
								<td>
									<?php echo date("H:i", strtotime($session->finish)); ?>
								</td>
								<td>
									<?php if($session->comment != null) :?>
										<button title="" data-original-title="" type="button" class="btn btn-xs btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?php echo $session->comment; ?>" style="cursor:pointer; text-decoration:none;"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
									<?php endif; ?>

								</td>
								<td>
									<a id="cancel" href="cancel_session.php?id=<?php echo $session->session_id; ?>" class="btn btn-xs btn-warning" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
								</td>
							</tr>

						<?php endforeach; ?>

					</table>
					<?php
					} else {
						echo '<br><div class="row">
								<div class="col-md-6 col-md-offset-3">
							<div class="text-danger text-center" style="font-size:16px;">No sessions</div><br>
							</div></div>';}
				} catch(Exception $e) {
					echo $e->getMessage();
				}
				?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Past Sessions</h3>
			</div>
			<div class="panel-body">
				<?php
				try {
					$sess = $s->get(array(
							'student' => $user->data()->id,
							'future' => 2,
							'cancelled' => 1
						));
					if(!empty($sess)) {
					?>
					<table class="table table-condensed table-striped">
						<tr id="s<?php echo $sess->session_id; ?>">
							<td>
								<strong>Mentor</strong>
							</td>
							<td>
								<strong>Program</strong>
							</td>
							<td>
								<strong>Position</strong>
							</td>
							<td>
								<strong>Type</strong>
							</td>
							<td>
								<strong>Date</strong>
							</td>
							<td>
								<strong>Start</strong>
							</td>
							<td>
								<strong>Finish</strong>
							</td>
							<td>
								<strong>Comment</strong>
							</td>
							<td>
								<strong>Report</strong>
							</td>
						</tr>

						<?php foreach($sess as $session): ?>
							<tr>
								<td>
									<?php echo $session->mfname . ' ' . $session->mlname; ?>
								</td>
								<td>
									<?php echo $session->program_name; ?>
								</td>
								<td>
									<?php echo $session->position_name . ' (' . $session->callsign . ')'; ?>
								</td>
								<td>
									<?php echo $session->session_name; ?>
								</td>
								<td>
									<?php echo date("j-M-y", strtotime($session->start)); ?>
								</td>
								<td>
									<?php echo date("H:i", strtotime($session->start)); ?>
								</td>
								<td>
									<?php echo date("H:i", strtotime($session->finish)); ?>
								</td>
								<td>
									<?php if($session->comment != null) :?>
										<button title="" data-original-title="" type="button" class="btn btn-xs btn-default" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?php echo $session->comment; ?>" style="cursor:pointer; text-decoration:none;"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
									<?php endif; ?>

								</td>
								<td>
									<?php if($session->report_id != null) { echo '<a href="history.php#r' . $session->report_id .'" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>'; }?>
							</td>
							</tr>

						<?php endforeach; ?>

					</table>
					<?php
					} else {
						echo '<br><div class="row">
								<div class="col-md-6 col-md-offset-3">
							<div class="text-danger text-center" style="font-size:16px;">No Sessions</div><br>

							</div></div>';}
				} catch(Exception $e) {
					echo $e->getMessage();
				}
				?>
			</div>
		</div>
	</div>
</div>
</div>

<?php
require_once('../includes/footer.php');
?>
<script>
$('#cancel').click(function(e){
		event.preventDefault();
    var c = confirm('Are you sure you would like to cancel this session?');
		if (c == true) {
			$('#cancel').addClass('disabled');
			$('#cancel').click(false);
			window.location = $(this).attr('href');
		}

});
</script>
