<?php
require_once('../../config.php');

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'save_event':
      save_event();
      break;
    case 'delete_event':
      delete_event();
      break;
  }
}

function save_event() {
  global $conn;
  extract($_POST);

  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $title = $_POST['title'];
  $description = $_POST['description'];
  $video_path = '';

  if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
    $video_tmp = $_FILES['video']['tmp_name'];
    $video_name = $_FILES['video']['name'];

    // Define the upload directory path
    $upload_dir = '../../upload_dir/event_' . ($id ? $id : time()) . '/';

    // Create the directory if it doesn't exist
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    // Add a timestamp to the video file name to ensure uniqueness
    $timestamp = time();
    $video_path = $upload_dir . $timestamp . '_' . basename($video_name);

    if (move_uploaded_file($video_tmp, $video_path)) {
      // Store the relative path for accessing the video on the site
      $video_path = 'upload_dir/event_' . ($id ? $id : $timestamp) . '/' . $timestamp . '_' . basename($video_name);
    } else {
      echo json_encode(['error' => 'Failed to upload video']);
      exit;
    }
  } elseif (isset($_POST['existing_video'])) {
    $video_path = $_POST['existing_video'];
  }

  if ($id) {
    // Update existing event
    $stmt = $conn->prepare("UPDATE `events` SET `title` = ?, `description` = ?, `video_path` = ? WHERE `id` = ?");
    $stmt->bind_param('sssi', $title, $description, $video_path, $id);
  } else {
    // Insert new event
    $stmt = $conn->prepare("INSERT INTO `events` (`title`, `description`, `video_path`) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $title, $description, $video_path);
  }

  if ($stmt->execute()) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['error' => 'Database error']);
  }

  $stmt->close();
}

function delete_event() {
  global $conn;
  extract($_POST);
  $delete = $conn->query("DELETE FROM `events` where id = $id");
  if ($delete) {
    echo 1; 
  
  }
}
?>
