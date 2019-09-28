<?php
   include 'parts/header.php';
?>

<?php
    //require 'database.php';
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    else{
      header("Location: index.php");
    }

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM abouttext  WHERE id = ? LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
    if (!((isset($heading) && ($heading!=null)))) {
      $heading = $row['heading'];
    }
    if (!((isset($paragrafi) && ($paragrafi!=null)))) {
      $paragrafi = $row['paragrafi'];
    }
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['photo'];
    }
    
    if (!empty($_POST)) {
        // keep track validation errors
        $headingError = null;
        $paragrafiError = null;
        $photoError = null;
         
        // keep track post values
        $heading = $_POST['heading'];
        $paragrafi = $_POST['paragrafi'];
        if($row['photo']!=null){
          $target = "images/".basename($_FILES["photo"]["name"]);
          $image = $_FILES['photo']['name'];
        }

        // validate input
        $valid = true;
        if (empty($heading)) {
            $headingError = 'Please enter heading text';
            $valid = false;
        }
         
        if (empty($paragrafi)) {
            $paragrafiError = 'Please enter paragraph text';
            $valid = false;
        }

        if($row['photo']!=null){
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
        }
        else{
          $target = null;
        }
        // insert data
        if ($valid) { 
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE abouttext 
              SET heading=:uheading, 
               paragrafi=:uparagrafi,
               photo=:uphoto 
               WHERE id=:uid');
            $q->bindParam(':uheading',$heading);
            $q->bindParam(':uparagrafi',$paragrafi);
            $q->bindParam(':uphoto',$target);
            $q->bindParam(':uid',$id);
            $q->execute();
            Database::disconnect();
            echo "
             <script>
              alert('Updated..');
              window.location.href='about.php';
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
  <main class="editAboutContent">
    <div class="container">
     <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
          <div class="span10 offset1">
              <div class="row">
                  <h3>Edit about content</h3>
              </div>
             
              <form class="form-horizontal" <?php echo 'action="editAboutContent.php?id='.$id.'"' ?> method="post" enctype="multipart/form-data">
                <div class="control-group <?php echo !empty($headingError)?'error':'';?>">
                  <label class="control-label">Heading</label>
                  <div class="controls">
                      <input name="heading" type="text"  placeholder="Heading" value="<?php echo !empty($heading)?$heading:'';?>">
                      <?php if (!empty($headingError)): ?>
                          <span class="help-inline"><?php echo $headingError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                <div class="control-group <?php echo !empty($paragrafiError)?'error':'';?>">
                  <label class="control-label">Paragrafi</label>
                  <div class="controls">
                      <textarea id="paragrafi" name="paragrafi" rows="7" cols="60" placeholder="Paragraph" maxlength="512"><?php echo !empty($paragrafi)?$paragrafi:'';?></textarea>
                      <?php if (!empty($paragrafiError)): ?>
                          <span class="help-inline"><?php echo $paragrafiErrors;?></span>
                      <?php endif;?>
                  </div>
                </div>
                <?php
                  if($row['photo']!=null){ ?>
                    <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                  <label class="control-label">Photo</label>
                  <div class="controls">
                      <input name="photo" type="file" accept="image/*" placeholder="Upload logo photo" id="uploaded">
                      <span id="currentPhoto">Current: <i for="uploaded"><?php echo $photo ?></i></span>
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                  </div>
                <?php  }
                ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-default" href="about.php">Back</a>
                  </div>
              </form>
          </div>
               <?php } ?>  
        </div> <!-- /container -->
    <?php
   include 'parts/footer.php';
?>
