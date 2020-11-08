<?php
   // headers for creating
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: DELETE');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
 
   include_once '../../config/Database.php';
   include_once '../../models/Post.php';

   $db = new Database();
   $conn = $db->connect();
 
   $postModel = new Post($conn);


   // Set ID to update
   $id = isset($_GET['id']) ? $_GET['id'] : die();
   $postModel->id = $id;
 

  // Delete post
  if($postModel->delete()) {
    echo json_encode(
      ['message' => 'Successfully Deleted']
    );
  } else {
    echo json_encode(
      ['message' => 'Request Failed']
    );
  }

?>