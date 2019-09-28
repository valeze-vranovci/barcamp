<?php
   include 'parts/header.php';
?>

<?php
     
    // require 'dbconn.php';
    if (!empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $websiteError = null;
        $photoError = null;

         
        // keep track post values
        $name = $_POST['name'];
        $website = $_POST['website'];
        $photo = $_POST['photo'];
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
        if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $photoError = 'Please choose a photo with logo';
            $valid = false;
        }
        // insert data
        if ($valid && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO sponsors (name,website,photo) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$website,$target));
            Database::disconnect();
            header("Location: ../sponsors.php");
        }

    }
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
                  <h3>Create a sponsor</h3>
              </div>
             
              <form class="form-horizontal" action="createSponsor.php" method="post" enctype="multipart/form-data">
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
                      <input name="photo" type="file" accept="image/*" placeholder="Upload logo photo">
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                      
                  </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-default" href="../sponsors.php">Back</a>
                  </div>
              </form>
          </div>
                <?php } ?>
      </div> <!-- /container -->
    </main>

<?php
   include 'parts/footer.php';
?>