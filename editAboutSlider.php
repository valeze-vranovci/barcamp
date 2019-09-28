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
    $sql = "SELECT * FROM aboutslider  WHERE id = ? LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['image'];
    }
    if (!((isset($data) && ($data!=null)))) {
      $data = $row['data'];
    }
    if (!((isset($texti) && ($texti!=null)))) {
      $texti = $row['texti'];
    }
    

    if (!empty($_POST)) {
        // keep track validation errors
        $photoError = null;
        $dataError = null;
        $textiError = null;

         
        // keep track post values
        $texti = $_POST['texti'];
        $data = $_POST['data'];
        #$photo = $_POST['photo'];
        $photo = $_FILES['photo']['name'];
        if((!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)){
          $target = $row["image"];
        }
        else{
          $target = "images/owl/".basename($_FILES["photo"]["name"]);  
        }
        


        // validate input
        $valid = true;
        if (empty($data)) {
            $dataError = 'Please enter date';
            $valid = false;
        }
         
        if (empty($texti)) {
            $textiError = 'Please enter website url';
            $valid = false;
        }
        // insert data
        if ($valid) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $target); 
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE aboutslider 
              SET image=:uphoto, 
               data=:udata, 
               texti=:utexti 
               WHERE id=:uid');
            $q->bindParam(':uphoto',$target);
            $q->bindParam(':udata',$data);
            $q->bindParam(':utexti',$texti);
            $q->bindParam(':uid',$id);
            $q->execute();
            Database::disconnect();
            echo "
             <script>
              alert('Updated..');
              window.location.href='about.php';
              </script>
             ";
        }
    }
?>
<br>
<br>
<br>
  <main class="editAboutSlider">
    <div class="container">
     <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
          <div class="span10 offset1">
              <div class="row">
                  <h3>Edit Slider Element</h3>
              </div>
             
              <form class="form-horizontal" <?php echo 'action="editAboutSlider.php?id='.$id.'"' ?> method="post" enctype="multipart/form-data">
                <div class="control-group <?php echo !empty($dataError)?'error':'';?>">
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
                      <span id="currentPhoto">Current: <i for="uploaded"><?php echo $photo ?></i></span>
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-default" href="about.php">Back</a>
                  </div>
              </form>
          </div>
                 <?php } ?>
      </div> <!-- /container -->
    </main>
<?php
   include 'parts/footer.php';
?>