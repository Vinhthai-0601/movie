<?php
include '../classes/Comment.php';
include '../classes/movie.php';
include '../classes/Reply.php';
include '../classes/config.php';
var_dump($_GET);
if(isset($_POST['comment-submit'])) {
  $movie_id = $_POST['id'];
  $comment_text = $_POST['comment-text'];
  $comment = new Comment($movie_id, $conn);
  $comment->createComment($comment_text);
  header("Location: ../Watchmovie.php?id=$movie_id");
}

if(isset($_POST['delete-comment'])){
  $movie_id = $_POST['movie_id'];
  $comment_id = $_POST['comment_id'];
  $post_id = $_SESSION['query_history'];
  $comment = new Comment($post_id, $conn);
  $comment->deleteComment($comment_id);
  header("Location: ../Watchmovie.php?id=$movie_id");
}

if(isset($_POST['reply-comment'])) {
  $movie_id = $_POST['movie_id'];
  $reply_to_comment_id = $_POST['comment_id'];
  $post_id = $_SESSION["query_history"][3];
  $post_id = explode("=", $post_id);
  $reply_user_id = $_POST['reply_user_id'];
  $comment_text = $_POST['comment_text'];
  $reply = new Reply($post_id[1], $conn);
  $reply->setReplyDetails($reply_to_comment_id, $reply_user_id, $comment_text);
  $reply->createReply();
  echo json_encode($reply);
  header("Location: ../Watchmovie.php?id=$movie_id");
}

if(isset($_GET['id'])){
  $movie_id = $_GET['id'];
  $post_id = $_SESSION['query_history'];
  $movie = new Movie($post_id, $conn);
  $movie->deleteMovie($movie_id);
  header("Location: ../admin.php");
}


 ?>