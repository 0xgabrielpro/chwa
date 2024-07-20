<?php
require_once('path/to/config.php');
$Master = new Master();
$events = json_decode($Master->get_events(), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Events</title>
</head>
<body>
	<h1>Events</h1>
	<?php if(!empty($events)): ?>
		<?php foreach($events as $event): ?>
			<div class="event">
				<h2><?php echo $event['event_name']; ?></h2>
				<p><?php echo $event['description']; ?></p>
				<p>Date: <?php echo $event['event_date']; ?></p>
				<p>Location: <?php echo $event['location']; ?></p>
				<?php if(!empty($event['video_path'])): ?>
					<video controls src="<?php echo $event['video_path']; ?>"></video>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<p>No events available.</p>
	<?php endif; ?>
</body>
</html>
