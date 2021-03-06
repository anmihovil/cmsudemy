<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php 

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $user_email    = $_POST['email'];
    $user_password = $_POST['password'];

    if(!empty($username) && !empty($user_email) && !empty($user_password)){

        $username      = mysqli_real_escape_string($connection, $username);
        $user_email    = mysqli_real_escape_string($connection, $user_email);
        $user_password = mysqli_real_escape_string($connection, $user_password);

        $password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10 ));

        // $query = "SELECT randSalt FROM users ";
        // $select_randsalt_query = mysqli_query($connection, $query);
        // if(!$select_randsalt_query){
        //     die("Query failed!". mysqli_error($connection));
        // }

        // $row = mysqli_fetch_array($select_randsalt_query);
        // $salt = $row['randSalt'];
        // $user_password = crypt($user_password, $salt);

        $query = "INSERT INTO users (username, user_email, user_password, user_role ) ";
        $query.= "VALUES('{$username}', '{$user_email}','{$password}', 'subscriber'  )";
        $register_user_query = mysqli_query($connection, $query);
        if(!$register_user_query){
            die("Query failed!". mysqli_error($connection)). ' ' .
            mysqli_errno($connection);
        }

        $message = "Your Registration has been submited";
    }else{

        $message = "Empty fields are not allowed!";
    }    
}

?>
<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">
    
<section id="login">
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
            <h1>Register</h1>
            <h5 class="text-center"><?php echo $message;?></h5>
                <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                        <label for="username" class="sr-only">username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Your email: somebody@example.com">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                    </div>
            
                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                </form>
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>
