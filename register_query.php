<?php
session_start();
require_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
if(ISSET($_POST['register'])){
    if($_POST['first_name'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
        try{
            $query = "INSERT INTO members (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";

            $stmt = $db->prepare($query);

            $stmt->execute([
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['password']
            ]);

            $memberID = $db->lastInsertId();

            $notificationQuery = "INSERT INTO notifications (member_id, message) VALUES (?, ?)";
            $notificationStmt = $db->prepare($notificationQuery);

            $message = "Welcome to Women in FinTech, " . $_POST['first_name'] . "! Your account has been created successfully.";
            $notificationStmt->execute([$memberID, $message]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
        $db = null;
        header('location:login.php');
    }else{
        echo "<script>alert('Please fill up the required field!')</script>
              <script>window.location = 'register.php'</script>";
    }
}
?>