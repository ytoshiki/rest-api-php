<?php
   // headers for creating
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: PUT');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
 
   include_once '../../config/Database.php';
   include_once '../../models/Post.php';
 
   $db = new Database();
   $conn = $db->connect();
 
   $postModel = new Post($conn);

   // Get raw posted data
   $json = file_get_contents('php://input');
   $data = json_decode($json);

   // Set ID to update
   $postModel->id = $data->id;
  $postModel->title = $data->title;
  $postModel->body = $data->body;
  $postModel->author = $data->author;
  $postModel->category_id = $data->category_id;

  // Create post
  if($postModel->update()) {
    echo json_encode(
      ['message' => 'Successfully Updated']
    );
  } else {
    echo json_encode(
      ['message' => 'Request Failed']
    );
  }

?>