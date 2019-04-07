<?php

if(isset($_POST['add_user'])){
  
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $username = $_POST['username'];
  $user_role = $_POST['user_role'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];

  $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10 ));
  
  $query = "INSERT INTO users( user_firstname, user_lastname, username, user_role,
  user_email, user_password ) " ;
  $query.= " VALUES( '{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_role}', 
  '{$user_email}', '{$user_password}' ) ";

  $create_user_query = mysqli_query($connection, $query);
  if(!$create_user_query){
    die("Query failed! ".mysqli_error($connection));
  }

  confirmQuery($create_user_query); 
  echo "New User created: "." "."<a href='users.php'>View Users</a>";

} 

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="title">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
    <label for="post_author">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="title">User Role </label>
    <select name="user_role" id="">

     <option value="subscriber">select options</option>
     <option value="admin">admin</option>
     <option value="editor">editor</option>
     <option value="subscriber">subscriber</option>

    </select>
    </div>

  <div class="form-group">
    <label for="post_tags">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_tags">Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
  </div>

</form>
