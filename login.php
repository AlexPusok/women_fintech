<?php
include_once 'includes/header.php';
?>
<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h3 class="text-primary">Log In</h3>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-8">

        <form action="login_query.php" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" />
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary form-control" name="login">Log In</button>
            </div>
            <a class="text-login" href="register.php">Register</a>
        </form>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>