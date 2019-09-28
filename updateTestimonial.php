<?php
   include 'parts/header.php';
?>
<?php
    // require 'dbconn.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    else{
      header("Location: testimonials.php");
    }
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM testimonials  WHERE id = ? LIMIT 1"; 
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if (!((isset($name) && ($name!=null)))) {
      $name = $row['name'];
    }
    if (!((isset($paragraph) && ($paragraph!=null)))) {
      $paragraph = $row['paragraph'];
    }
    if (!((isset($footer) && ($footer!=null)))) {
      $footer = $row['footer'];
    }
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['photo'];
    }

    if(!empty($_POST)){
      $photoError = null;
      $paragraphError = null;
      $footerError = null;
      $nameError = null;


      $name = $_POST['name'];
      $paragraph = $_POST['paragraph'];
      $footer = $_POST['footer'];
      $target = "images/".basename($_FILES["photo"]["name"]);
        $image = $_FILES['photo']['name'];

      $valid = true;
      if (empty($name)) {
            $nameError = 'Please enter name';
            $valid = false;
        }
         
        if (empty($paragraph)) {
            $paragraphError = 'Please enter Name of Speaker';
            $valid = false;
        }
        if (empty($footer)) {
            $footerError = 'Please enter Quote';
            $valid = false;
        }
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

        if($valid){
          move_uploaded_file($_FILES['photo']['tmp_name'], $target); 
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
          $q = $pdo->prepare('UPDATE testimonials SET photo=:uphoto,
            paragraph=:uparagraph,
            footer =:ufooter,
            name =:uname
            WHERE id=:uid');
          $q->bindParam(':uphoto',$target);
            $q->bindParam(':uparagraph',$paragraph);
            $q->bindParam(':ufooter',$footer);
            $q->bindParam(':uname',$name);
            $q->bindParam(':uid',$id);
            $q->execute();
            Database::disconnect();
            header("Location: testimonials.php");
        }
    }
?>

 
<body>
  <div class="container">
      <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
    <div class="span10 offset1">
        <div class="row">
            <h3>Update a Customer</h3>
        </div>      
        <form class="form-horizontal" action="updateTestimonial.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
        <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                  <label class="control-label">Name</label>
                  <div class="controls">
                      <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                      <?php if (!empty($nameError)): ?>
                          <span class="help-inline"><?php echo $nameError;?></span>
                      <?php endif; ?>
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
            <div class="control-group <?php echo !empty($paragraphError)?'error':'';?>">
              <label class="control-label">Name of Testimonal</label>
              <div class="controls">
                  <input name="paragraph" type="text" placeholder="Testimonial Name" value="<?php echo !empty($paragraph)?$paragraph:'';?>">
                  <?php if (!empty($paragraphError)): ?>
                      <span class="help-inline"><?php echo $paragraphError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($footerError)?'error':'';?>">
                <label class="control-label">Quote</label>
                <div class="controls">
                    <input name="footer" type="text"  placeholder="Quote " value="<?php echo !empty($footer)?$footer:'';?>">
                    <?php if (!empty($footerError)): ?>
                        <span class="help-inline"><?php echo $footerError;?></span>
                    <?php endif;?>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn" href="testimonials.php">Back</a>
              </div>
        </form>

    </div>
    <?php } ?>
  </div>
<?php
   include 'parts/footer.php';
?>