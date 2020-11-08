<?php
   // headers for creating
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
 
   include_once '../../config/Database.php';
   include_once '../../models/Post.php';
 
   $db = new Database();
   $conn = $db->connect();
 
   $postModel = new Post($conn);

   // Get raw posted data
   $json = file_get_contents('php://input');
   $data = json_decode($json);

  $postModel->title = $data->title;
  $postModel->body = $data->body;
  $postModel->author = $data->author;
  $postModel->category_id = $data->category_id;

  // Create post
  if($postModel->create()) {
    echo json_encode(
      ['message' => 'Successfully Created']
    );
  } else {
    echo json_encode(
      ['message' => 'Request Failed']
    );
  }

?>