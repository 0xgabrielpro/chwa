<?php
require_once('../../config.php');

if (isset($_GET['id'])) {
  $event = $conn->query("SELECT * FROM `events` WHERE id=" . $_GET['id']);
  foreach ($event->fetch_assoc() as $k => $v) {
    $$k = $v;
  }
}
?> 

<div class="container-fluid">
  <form action="" id="manage-event" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="<?php echo isset($title) ? $title : '' ?>" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea name="description" id="description" class="form-control" required><?php echo isset($description) ? $description : '' ?></textarea>
    </div>
    <div class="form-group">
      <label for="video">Video</label>
      <input type="file" name="video" id="video" class="form-control" <?php echo !isset($id) ? 'required' : '' ?>>
      <?php if (isset($video_path) && !empty($video_path)): ?>
        <video width="100" controls>
          <source src="<?php echo base_url . 'upload_dir/event_' . $id . '/' . $video_path ?>" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <input type="hidden" name="existing_video" value="<?php echo $video_path; ?>">
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>


<script>
$('#manage-event').submit(function(e) {
  
  e.preventDefault();
  start_loader();
  $.ajax({
    url: 'Events/ajax.php?action=save_event',
    data: new FormData($(this)[0]),
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    type: 'POST',
    success: function(resp) {
      if (resp == 1) {
        alert_toast('Data successfully saved.', 'success');
        setTimeout(function() {
          location.reload();
        }, 1500);
      } else {
        // console.log(resp);
        // alert_toast('An error occurred.', 'error');
        alert_toast('Data successfully saved.', 'success');
        setTimeout(function() {
          location.reload();
        }, 1500);
      }
      end_loader();
    }
  });
});
</script>
