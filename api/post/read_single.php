<?php
  // headers for read only
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  $db = new Database();
  $conn = $db->connect();

  $postModel = new Post($conn);

  // Get ID from url
  $postModel->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $postModel->read_single();

  // Create array
  $post_array = [
    'id' => $postModel->id,
    'title' => $postModel->title,
    'body' => $postModel->body,
    'author' => $postModel->author,
    'category_id' => $postModel->category_id,
    'category_name' => $postModel->category_name
  ];

  // Make JSON
  echo json_encode($post_array);

  

