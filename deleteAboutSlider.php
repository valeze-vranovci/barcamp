<?php
   include 'parts/header.php';
?>
<?php
    // require 'dbconn.php';
    $name = 'default';
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM aboutslider  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        echo "
             <script>
              alert('Deleted..');
              window.location.href='about.php';
              </script>
             ";
    }
?>

<br>
<br>
<br>
    <main class="deleteAboutSlider">
    <div class="container">
    <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
        <div class="span10 offset1">
            <div class="row">
                <h3>Delete slider content</h3>
            </div>
             
            <form class="form-horizontal" action="deleteAboutSlider.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;?>"/>
              <p class="alert alert-error">Are you sure to delete this content?</p>
              <div class="form-actions">
                  <button type="submit" class="btn btn-danger">Yes</button>
                  <a class="btn btn-primary" href="about.php">No</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div> <!-- /container -->
    </main>
  <?php
   include 'parts/footer.php';
?>