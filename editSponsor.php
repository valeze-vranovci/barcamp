<?php
   include 'parts/header.php';
?>
<?php
     
    // require 'dbconn.php';
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    else{
      header("Location: index.php");
    }

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM sponsors  WHERE id = ? LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    if (!((isset($name) && ($name!=null)))) {
      $name = $row['name'];
    }
    if (!((isset($website) && ($website!=null)))) {
      $website = $row['website'];
    }
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['photo'];
    }
    

    if (!empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $websiteError = null;
        $photoError = null;

         
        // keep track post values
        $name = $_POST['name'];
        $website = $_POST['website'];
        #$photo = $_POST['photo'];
        $target = "images/".basename($_FILES["photo"]["name"]);
        $image = $_FILES['photo']['name'];


        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter name';
            $valid = false;
        }
         
        if (empty($website)) {
            $websiteError = 'Please enter website url';
            $valid = false;
        } else if(!filter_var($website, FILTER_VALIDATE_URL)) {
            $websiteError = 'Please enter a valid website format';
            $valid = false;
        }
        /*
        if (empty($photo)) {
            $photoError = 'Please choose a photo with logo';
            $valid = false;
        }*/
        if((!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) && !((isset($photo) && ($photo!=null))))
        {
            $photoError = 'Please choose a photo with logo';
            $valid = false;
        }
        else if(isset($_FILES['photo']) && $_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE){
          unlink($photo);
        }
        else if((!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)) {
           $target = $photo;
        }
        // insert data
        if ($valid) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $target); 
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE sponsors 
              SET name=:uname, 
               website=:uwebsite, 
               photo=:uphoto 
               WHERE id=:uid');
            $q->bindParam(':uname',$name);
            $q->bindParam(':uwebsite',$website);
            $q->bindParam(':uphoto',$target);
            $q->bindParam(':uid',$id);
            $q->execute();
            Database::disconnect();
            echo "
             <script>
              alert('Updated..');
              window.location.href='sponsors.php';
              </script>
             ";
            #header("Location: sponsors.php");
        }
    }/*
    else{
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM sponsors  WHERE id = ? LIMIT 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $row = $q->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $website = $row['website'];
        $photo = $row['photo'];
        Database::disconnect();
    }*/
?>
<br>
<br>
<br>
  <main class="createSponsors">
    <div class="container">
     <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
          <div class="span10 offset1">
              <div class="row">
                  <h3>Edit sponsor</h3>
              </div>
             
              <form class="form-horizontal" <?php echo 'action="editSponsor.php?id='.$id.'"' ?> method="post" enctype="multipart/form-data">
                <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                  <label class="control-label">Name</label>
                  <div class="controls">
                      <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                      <?php if (!empty($nameError)): ?>
                          <span class="help-inline"><?php echo $nameError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="control-group <?php echo !empty($websiteError)?'error':'';?>">
                  <label class="control-label">Website url</label>
                  <div class="controls">
                      <input name="website" type="text" placeholder="Website url" value="<?php echo !empty($website)?$website:'';?>">
                      <?php if (!empty($websiteError)): ?>
                          <span class="help-inline"><?php echo $websiteError;?></span>
                      <?php endif;?>
                  </div>
                </div>
                <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                  <label class="control-label">Logo</label>
                  <div class="controls">
                      <input name="photo" type="file" accept="image/*" placeholder="Upload logo photo" id="uploaded">
                      <span id="currentPhoto">Current: <i for="uploaded"><?php echo $photo ?></i></span>
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-default" href="sponsors.php">Back</a>
                  </div>
              </form>
          </div>
                 <?php } ?>
      </div> <!-- /container -->
    </main>
<?php
   include 'parts/footer.php';
?>