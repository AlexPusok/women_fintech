<?php
include_once 'includes/header.php';
?>
<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h3 class="text-primary">Register</h3>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="register_query.php" method="POST">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" />
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" />
            </div>
            <br />
            <div class="form-group">
                <button class="btn btn-primary form-control" name="register">Register</button>
            </div>
            <a href="login.php">Log In</a>
        </form>
    </div>
</div>
