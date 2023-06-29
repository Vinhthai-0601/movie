<?php

class Comment {
  //class properties
  public $comment_text;
  public $comment_author;
  public $comment_user_id;
  public $post_id;
  public $comment_id;
  public $comment = [];
  public $comments = [];
  public $conn;

  // constructor function
  public function __construct($post_id, $conn) {
    $this->post_id = $post_id;
    $this->conn = $conn;
  }

  public function createComment($comment) {
    $this->comment_text = $comment;
    $sql = "INSERT INTO comments (comment_text, comment_user, comment_post) VALUES (?,?,?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sii", $this->comment_text, $_SESSION['user_id'], $this->post_id);
    $stmt->execute();
    if($stmt->affected_rows == 1) {
      $this->insert_id = $stmt->insert_id;
      // this will return the comment as a json encoded string
      $this->getComment();
    }
  }

  // Comment methods : CRUD etc
  public function getComments() {
    $sql = "SELECT cm.ID AS CID, cm.comment_text, u.user_name, u.ID AS UID, cm.date_created, cm.comment_post FROM comments cm JOIN users u ON u.ID = cm.comment_user WHERE cm.comment_post = ? AND cm.comment_parent IS NULL ORDER BY cm.date_created DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $this->comments = $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getComment() {
    $sql = "SELECT cm.ID as comment_id, cm.comment_text, u.user_name, cm.date_created, cm.comment_post FROM comments cm JOIN users u ON u.ID = cm.comment_user WHERE cm.ID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->insert_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}



  public function outputComments($replies) {
    
    foreach ($this->comments as $comment) {
    echo "<div class='comment-wrapper col-md-12'>
      <div class='mt-2 mb-2 comment'>
        <div class='card'>
          <div class='card-header'>
          <a href='profile.php?id={$comment['UID']}' class='comment-user-id' data-comment-user-id='{$comment['UID']}'>
            {$comment['user_name']}</a> | {$comment['date_created']}

              <form class='comment-form' method='POST' action='function/manager.php'>
                <button name='delete-comment' class='btn btn-outline-danger btn-sm  float-right delete-post' data-comment-id={$comment['CID']} >X</button>
                <input type='hidden' name='comment_id' value='{$comment['CID']}'; ?>
                <input type='hidden' name='movie_id' value='{$comment['comment_post']}'; ?>
                <button class='btn float-right btn-sm btn-outline-secondary mr-2 reply-comment' name='reply-comment' data-comment-id='{$comment['CID']}' data-comment-user-id='{$comment['UID']}'>reply</button>
              </form>
            </div>

            <div class='card-body'>
              <p class='card-text comment-p text-black'>{$comment['comment_text']} </p>
            </div>
          </div>
        </div> 
      </div>";

      $replies->outputReplies($comment['CID']);
    }
    echo "</div>";
    
  }

public function getCommentID($comment_id){
  $sql = "SELECT * FROM comments WHERE ID = ?";
  $stmt = $this->conn->prepare($sql);
  $stmt->bind_param("i", $comment_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $this->comment = $result->fetch_assoc();
}

  public function deleteComment($comment_id) {
    $this->getCommentID($comment_id);
    if($this->comment['comment_user'] == $_SESSION['user_id'] || $_SESSION['user_role'] == 1) {
      $sql = "DELETE FROM comments WHERE ID = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $this->comment['ID']);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        echo json_encode(true);
      } else {
        echo json_encode(false);
      }
    } else {
      echo json_encode(false);
    }
  }
}

 ?>