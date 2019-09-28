<?php
   include 'parts/header.php';
?>

<?php
     
    // require 'dbconn.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $photoError = null;
        $paragraphError = null;
        $footerError = null;
        $nameError = null;
         
        // keep track post values
        $photo = $_POST['photo'];
        $name = $_POST['name'];
        $paragraph = $_POST['paragraph'];
        $footer = $_POST['footer'];
        $target = "images/".basename($_FILES["photo"]["name"]);
        $image = $_FILES['photo']['name'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter name';
            $valid = false;
        }
        if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $photoError = 'Please choose a photo with logo';
            $valid = false;
        }
         
        if (empty($paragraph)) {
            $paragraphError = 'Please enter Name of testimonial';
            $valid = false;
        }
        if (empty($footer)) {
            $footerError = 'Please enter Quote';
            $valid = false;
        }
         
        // insert data
        if ($valid && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO testimonials (photo,paragraph,footer,name) values(?,?, ?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($target,$paragraph,$footer,$name));
            Database::disconnect();
            header("Location: testimonials.php");
        }
    }
?>

    <div class="container">

     <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Testimonial</h3>
                    </div>
             
                    <form class="form-horizontal" action="createTestimonial.php" method="post" enctype="multipart/form-data">
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
                      <input name="photo" type="file" accept="image/*" placeholder="Upload logo photo">
                      <?php if (!empty($photoError)): ?>
                          <span class="help-inline"><?php echo $photoError;?></span>
                      <?php endif; ?>
                      
                  </div>
                </div>


                      <div class="control-group <?php echo !empty($paragraphError)?'error':'';?>">
                        <label class="control-label">Name of Testimonial</label>
                        <div class="controls">
                            <input name="paragraph" type="text" placeholder="Testimonial name" value="<?php echo !empty($paragraph)?$paragraph:'';?>">
                            <?php if (!empty($paragraphError)): ?>
                                <span class="help-inline"><?php echo $paragraphError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($footerError)?'error':'';?>">
                        <label class="control-label">Quote</label>
                        <div class="controls">
                            <input name="footer" type="text"  placeholder="Quote" value="<?php echo !empty($footer)?$footer:'';?>">
                            <?php if (!empty($footerError)): ?>
                                <span class="help-inline"><?php echo $footerError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="testimonials.php">Back</a>
                        </div>
                    </form>
                </div>
               <?php } ?>  
    </div> <!-- /container -->
<?php
   include 'parts/footer.php';
?>