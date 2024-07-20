<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Events</h3>
          <button class="btn btn-primary btn-sm" id="new_event">Add New Event</button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Video</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $events = $conn->query("SELECT * FROM `events`");
              while ($row = $events->fetch_assoc()):
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['description']; ?></td>
                  <td>
                    <video width="100" controls>
                      <source src="<?php echo $row['video_path']; ?>" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                  </td>
                  <td>
                    <button class="btn btn-sm btn-info edit_event" data-id="<?php echo $row['id']; ?>">Edit</button>
                    <button class="btn btn-sm btn-danger delete_event" data-id="<?php echo $row['id']; ?>">Delete</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#new_event').click(function() {
    uni_modal('Add New Event', 'Events/manage.php');
  });

  $('.edit_event').click(function() {
    uni_modal('Edit Event', 'Events/manage.php?id=' + $(this).attr('data-id'));
  });

  $('.delete_event').click(function() {
    _conf('Are you sure to delete this event?', 'delete_event', [$(this).attr('data-id')]);
  });

  $('table').dataTable();
});

function delete_event($id) {
  start_loader();
  $.ajax({
    url: 'Events/ajax.php?action=delete_event',
    method: 'POST',
    data: { id: $id },
    success: function(resp) {
      if (resp == 1) {
        alert_toast('Event successfully deleted', 'success');
        setTimeout(function() {
          location.reload();
        }, 1500);
      }
    }
  });
}

</script>
