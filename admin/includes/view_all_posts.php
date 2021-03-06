
<?php 

if(isset($_POST['checkBoxArray'])){
  foreach($_POST['checkBoxArray'] as $postValueId){
    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options){
      case 'published':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
      $update_to_published_status = mysqli_query($connection, $query);
      confirmQuery($update_to_published_status);
      break;
      case 'draft':
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
      $update_to_draft_status = mysqli_query($connection, $query);
      confirmQuery($update_to_draft_status);
      break;
      case 'delete':
      $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
      $delete_query = mysqli_query($connection, $query);
      confirmQuery($delete_query);
      break;
      case 'clone':
      $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
      $select_post_query = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($select_post_query)){
        $post_title=$row['post_title'];
        $post_category_id=$row['post_category_id'];
        $post_date=$row['post_date'];
        $post_author = $row['post_author'];
        $post_status=$row['post_status'];
        $post_image=$row['post_image'];
        $post_tags=$row['post_tags'];
        $post_content=$row['post_content'];
      }

      $query = "INSERT INTO posts( post_title, post_category_id, post_date, post_author, 
      post_status, post_image, post_tags, post_content ) " ;
      $query.= " VALUES( '{$post_title}', {$post_category_id}, now(), '{$post_author}', 
      '{$post_status}','{$post_image}','{$post_tags}', '{$post_content}' ) ";

      $clone_query = mysqli_query($connection, $query);
      if(!$clone_query){
        die("Clone query failed!". mysqli_error($connection));
      }
      break;
      default:

    }
  }
}

?>

<form action="" method='post'>
  <table class="table table-bordered table-hover">

  <div id="bulkOptionsContainer" class="col-xs-3">
    <select class="form-control" name="bulk_options" id="">
      <option value="">Select Options</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
      <option value="clone">Clone</option>
    </select>
  </div>

  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
  </div>
  

    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Date</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Views count</th>
        <th>Status</th>
        <th>View Post</th>
        <th>Delete</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>

      <?php

      global $connection;

      $query = "SELECT * FROM posts ORDER BY post_id DESC ";
      $select_posts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($select_posts)){
        $post_id=$row['post_id'];
        $post_category_id=$row['post_category_id'];
        $post_title=$row['post_title'];
        $post_author = $row['post_author'];
        $post_date=$row['post_date'];
        $post_image=$row['post_image'];
        $post_content=$row['post_content'];
        $post_tags=$row['post_tags'];
        $post_comment_count=$row['post_comment_count'];
        $post_views_count=$row['post_views_count'];
        $post_status=$row['post_status'];

        echo "<tr>";
        ?>

        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>;

        <?php 
        
        echo "<td>$post_id</td>";

        $query = "SELECT * FROM categories WHERE cat_id ={$post_category_id} ";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)){
          $cat_id=$row['cat_id'];
          $cat_title=$row['cat_title'];
        }

        echo "<td>{$cat_title}</td>";
        echo "<td>$post_title</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_date</td>";
        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_content</td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
        echo "<td>$post_status</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
        echo "<td><a onClick=\" javascript: return confirm('Are You Sure To Delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "</tr>";
      }

      ?>

    </tbody>
  </table>
</form>

<?php

if(isset($_GET['delete'])){
  $the_post_id = $_GET['delete'];

  $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
  $delete_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}

if(isset($_GET['reset'])){
  $the_post_id = $_GET['reset'];

  $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
  $reset_query = mysqli_query($connection, $query);
  header("Location: posts.php");
}

?>
