<?php
   include 'parts/header.php';
?>
 
<?php
	// require 'dbconn.php';
	if ( !empty($_POST)) {
        // keep track validation errors
        $photoError = null;
        $headingError = null;
        $descriptionError = null;
        $nameError = null;
         
        // keep track post values
        $photo = $_POST['photo'];
        $name = $_POST['name'];
        $heading = $_POST['heading'];
        $description = $_POST['description'];
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
         
        if (empty($heading)) {
            $headingError = 'Please enter Name of speaker';
            $valid = false;
        }
        if (empty($description)) {
            $descriptionError = 'Please enter details';
            $valid = false;
        }
         
        // insert data
        if ($valid && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO speakers (photo,heading,description,name) values(?,?, ?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($target,$heading,$description,$name));
            Database::disconnect();
            header("Location: speakers.php");
        }
	}
?>

<body>
    <div class="container">

     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Speaker</h3>
                    </div>
             
                    <form class="form-horizontal" action="createSpeakers.php" method="post" enctype="multipart/form-data">
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


                      <div class="control-group <?php echo !empty($headingError)?'error':'';?>">
                        <label class="control-label">Name of Speaker</label>
                        <div class="controls">
                            <input name="heading" type="text" placeholder="Speaker Name" value="<?php echo !empty($heading)?$heading:'';?>">
                            <?php if (!empty($headingError)): ?>
                                <span class="help-inline"><?php echo $headingError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Details</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="Details" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $description;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="speakers.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
<?php
   include 'parts/footer.php';
?>