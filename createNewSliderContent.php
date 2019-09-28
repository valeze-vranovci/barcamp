<?php
   include 'parts/header.php';
?>

<?php
     
    // require 'dbconn.php';
    if (!empty($_POST)) {
        // keep track validation errors
        $photoError = null;
        $dataError = null;
        $textiError = null;
         
        // keep track post values
        $texti = $_POST['texti'];
        $data = $_POST['data'];
        $photo = $_FILES['photo']['name'];
        $target = "images/owl/".basename($_FILES["photo"]["name"]);

        // validate input
        $valid = true;
        if (empty($data)) {
            $dataError = 'Please enter date';
            $valid = false;
        }
         
        if (empty($texti)) {
            $textiError = 'Please enter text description';
            $valid = false;
        }
        if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $photoError = 'Please choose a photo for event';
            $valid = false;
        }

        // insert data
        if ($valid && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO aboutslider (image,data,texti) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($target,$data,$texti));
            Database::disconnect();
            echo "
             <script>
              alert('Added..');
              window.location.href='about.php';
              </script>
             ";
        }

    }
?>

<br>
<br>
<br>
  <main class="createNewSliderContent">
    <div class="container">
     <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      {

     ?>
          <div class="span10 offset1">
              <div class="row">
                  <h3>Create new slider content</h3>
              </div>
             
              <form class="form-horizontal" action="createNewSliderContent.php" method="post" enctype="multipart/form-data">
                <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                  <label class="control-label">Date</label>
                  <div class="controls">
                      <input maxlength="11" name="data" type="texti"  placeholder="Data" value="<?php echo !empty($data)?$data:'';?>">
                      <?php if (!empty($dataError)): ?>
                          <span class="help-inline"><?php echo $dataError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="control-group <?php echo !empty($textiError)?'error':'';?>">
                  <label class="control-label">Text description</label>
                  <div class="controls">
                      <textarea name="texti" rows="7" cols="60" placeholder="text" maxlength="512"><?php echo !empty($texti)?$texti:'';?></textarea>
                      <?php if (!empty($textiError)): ?>
                          <span class="help-inline"><?php echo $textiError;?></span>
                      <?php endif;?>
                  </div>
                </div>
                <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                  <label class="control-label">Photo</label>
                  <div class="controls">
                      <input name="photo" type="file" accept="image/*" placeholder="Upload event photo" id="uploaded">
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-default" href="about.php">Back</a>
                  </div>
              </form>
          </div>
        <?php
          }
        ?>
      </div> <!-- /container -->
    </main>

<?php
   include 'parts/footer.php';
?>