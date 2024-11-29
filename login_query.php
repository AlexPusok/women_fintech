<?php
session_start();
require_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
if(isset($_POST['login'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM members WHERE email=?";
        $query = $db->prepare($sql);
        $query->execute([$email]);
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        if($fetch && $password == $fetch['password']) {
            $_SESSION['user'] = [
                'id' => $fetch['id'],
                'status' => $fetch['status']
            ];
            header("location: dashboard.php");
        } else{
            echo "<script>alert('Invalid username or password')</script>
                  <script>window.location = 'login.php'</script>";
        }
    }else{
        echo "<script>alert('Please complete the required field!')</script>
              <script>window.location = 'index.php'</script>";
    }
}
?>