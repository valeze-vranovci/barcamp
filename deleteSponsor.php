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
        $sql = "DELETE FROM sponsors  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: sponsors.php");
    }
    else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT name FROM sponsors  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $name = $q->fetchColumn();
        Database::disconnect();
    }
?>

<br>
<br>
<br>
    <main class="deleteSponsors">
    <div class="container">
    <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
        <div class="span10 offset1">
            <div class="row">
                <h3>Delete a Sponsor</h3>
            </div>
             
            <form class="form-horizontal" action="deleteSponsor.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;?>"/>
              <p class="alert alert-error">Are you sure to delete "<?php echo $name ?>" as a sponsor?</p>
              <div class="form-actions">
                  <button type="submit" class="btn btn-danger">Yes</button>
                  <a class="btn btn-primary" href="sponsors.php">No</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div> <!-- /container -->
    </main>
  <?php
   include 'parts/footer.php';
?>