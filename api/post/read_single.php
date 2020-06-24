<?php
   
   header('Access-Control-Allow-Origin: *');
   header('Content-Type:application/json');

   include_once '../../config/Database.php';
   include_once '../../models/Post.php';
 
   $database = new Database();
   $db= $database->connect();

    $post = new Post($db);
   
    $id = isset($_GET['id']) ? $_GET['id'] : die();  // getting the id form url 
    $post->read_single($id);

    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
      );
    
      // Make JSON
      print_r(json_encode($post_arr));
   

 ?>   