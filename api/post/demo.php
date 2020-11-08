<?php
   // headers for creating
   header('Access-Control-Allow-Origin: *');
   header('Content-Type: application/json');
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
     echo json_encode(['message' => 'Success' ]);
   } else {
     echo json_encode(['messge' => 'Failed']);
   }