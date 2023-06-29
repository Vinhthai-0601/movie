<?php
class User {
    public $user_id;
    public $user_name;
    public $user_email;
    public $user_role;
    public $profile_img;
    public $profile_desc;
    public $user_des;
    public $conn;
    public $user_password1;
    public $user_password2;
    public $user_hash;
    public $users = [];
    public $email = [];
    public $errors = [];
    public function __construct($conn) {
      $this->conn = $conn;
    }
    public function minmaxChars($string, $min, $max = 1000) {
        if(strlen($string)< $min || strlen($string) > $max) {
          return false;
        } else {
          return true;
        }
      }
    public function getUsername() {
        $sql = "SELECT * FROM users WHERE user_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->user_name);
        $stmt->execute();
        $results = $stmt->get_result();
        if($results->num_rows == 1) {
          $this->users = $results->fetch_assoc();
        }
    }
    public function getUserId($user_id) {
      $this->user_id = $user_id;
      $sql = "SELECT * FROM users WHERE ID = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("i", $this->user_id);
      $stmt->execute();
      $results = $stmt->get_result();
      if($results->num_rows == 1) {
        $this->users = $results->fetch_assoc();
      }
    }
    public function checkEmails($user_email) {
      $this->user_email = $user_email;
      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $this->user_email);
      $stmt->execute();
      $results = $stmt->get_result();
      return $results->num_rows;
    }
    public function checkExistedEmail() {
      $sql = "SELECT * FROM users WHERE email = ?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $this->user_email);
      $stmt->execute();
      $results = $stmt->get_result();
      if($results->num_rows == 1) {
        $this->users = $results->fetch_assoc();
      }
    }
    public function checkLogin($user_email, $user_password1) {
      $this->user_email = $user_email;
      $this->user_password1 = $user_password1;
      $this->checkExistedEmail();
      if(empty($this->users) || !password_verify($this->user_password1, $this->users['hash'])) {
        $this->errors['unexisted_email'] = "*Incorrect email or password";
      } else {
        $this->checkExistedEmail();
        $this->login();
      }
    }
    public function createAccount(){
      $this->user_role = 3;
      $this->user_hash = password_hash($this->user_password1, PASSWORD_DEFAULT);
      $this->profile_img = "images/Default.jpg";
      $this->profile_desc = "You can change your description here for your profile!!!";
      $sql = "INSERT INTO users (user_name, email, hash, profile_img, user_description, user_role) VALUES (?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("sssssi", $this->user_name, $this->user_email, $this->user_hash, $this->profile_img, $this->profile_desc, $this->user_role);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        $this->getUsername();
        $this->login();
     }
    }
    public function editProfile($profile_img, $user_id) {
      $this->profile_img = $profile_img;
      //var_dump($this->user_name);
      // var_dump($this->profile_img);
      $sql = "UPDATE users 
              SET profile_img = ?
              WHERE ID = $user_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("s", $this->profile_img);  
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        $this->getUsername();
        // $this->pic();
      }
        header("Location: Profile.php");
        
    }
    public function editProfileDesc($user_name, $profile_desc, $user_id) {
      $this->user_name = $user_name;
      $this->profile_desc = $profile_desc;
      $this->user_id = $user_id;
      $this->getUserId($this->user_id);
      $sql = "UPDATE users
              SET user_name = ?, user_description = ?
              WHERE ID = $user_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ss", $this->user_name, $this->profile_desc);
      $stmt->execute();
      if($stmt->affected_rows == 1) {
        $this->getUserId($this->user_id);
        $this->profile_desc();
      }
      header("Location: Profile.php");
    }
    public function checkNewUser($user_name, $user_email, $user_password1, $user_password2) {
        $this->user_name = $user_name;
        $this->user_email = $user_email;
        $this->user_password1 = $user_password1;
        $this->user_password2 = $user_password2;
        $this->getUsername();
        // check user name is available
        if(!$this->minmaxChars($this->user_password1, 5, 20)) {
          $this->errors['create_password'] = "*Password must be between 5-20 characters long";
        }
        if(!empty($this->users)) {
          $this->errors['username_existed'] = "*Username already taken";
        }
        if($this->checkEmails($this->user_email) == 1) {
          $this->errors['email_existed'] = "*Email already exist";
        }
        if(empty($this->user_name)){
            $this->errors['signup_username'] = "*Username cannot left blank";
        }
        // validate email
        if(!filter_var($this->user_email, FILTER_VALIDATE_EMAIL)) {
          $this->errors['signup_email'] = "*This email is invalid!";
        }
        if($this->user_password1 != $this->user_password2) {
          $this->errors['pw_error'] = "*The passwords are not match";
        }
        //create new user and login
        if(empty($this->errors)) {
          $this->createAccount();
          //$this->createTeacherAccount();
        }
    }
    public function profile_desc() {
      $_SESSION['description'] = $this->users['user_description'];
      $_SESSION['user_name'] = $this->users['user_name'];
    }
    public function login() {
      $_SESSION['user_id'] = $this->users['ID'];
      $_SESSION['user_name'] = $this->users['user_name'];
      $_SESSION['description'] = $this->users['user_description'];
      $_SESSION['user_role'] = $this->users['user_role'];
      $_SESSION['loggedin'] = true;
      if($_SESSION['user_role'] == 1) {
        header("Location: admin.php?login=success");
      } else {
        header("Location: Homepage.php?login=success");
      }
    }
    // public function pic() {
    //   $_SESSION['profile'] = $this->users['profile_img'];
    // }
    public static function logout() {
      $_SESSION = [];
      session_destroy();
      header("Location: index.php?logout");
    }
}
?>