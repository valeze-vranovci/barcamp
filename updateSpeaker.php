<?php
   include 'parts/header.php';
?>
<?php
    // require 'dbconn.php';
 
    $eventi = $_REQUEST['id'];
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    else{
      header("Location: schedule.php");
    }
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM speaker  WHERE id = ? LIMIT 1"; 
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if (!((isset($emri) && ($emri!=null)))) {
      $emri = $row['emri'];
    }
    if (!((isset($mbiemri) && ($mbiemri!=null)))) {
      $mbiemri = $row['mbiemri'];
    }
    if (!((isset($description) && ($description!=null)))) {
      $description = $row['description'];
    }
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['photo'];
    }
    if (!((isset($id_eventi) && ($id_eventi!=null)))) {
      $id_eventi = $row['id_eventi'];
    }

    if(!empty($_POST)){
      $photoError = null;
      $mbiemriError = null;
      $descriptionError = null;
      $emriError = null;
      $id_eventiError = null;

      $id_eventi = $_POST['id_eventi'];
      $emri = $_POST['emri'];
      $mbiemri = $_POST['mbiemri'];
      $description = $_POST['description'];
      $target = "images/".basename($_FILES["photo"]["name"]);
      $image = $_FILES['photo']['name'];
      
        

      $valid = true;
      if (empty($emri)) {
            $id_eventiError = 'Please choose event';
            $valid = false;
        }
        if (empty($id_eventi)) {
            $emriError = 'Please enter name';
            $valid = false;
        }
         
        if (empty($mbiemri)) {
            $mbiemriError = 'Please enter Surname of speaker';
            $valid = false;
        }
        if (empty($description)) {
            $descriptionError = 'Please enter Details';
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
          $q = $pdo->prepare('UPDATE speaker SET photo=:uphoto,
            description=:udescription,
            id_eventi =:uid_eventi,
            emri =:uemri,
            mbiemri =:umbiemri
            WHERE id=:uid');
          $q->bindParam(':uphoto',$target);
            $q->bindParam(':udescription',$description);
            $q->bindParam(':uid_eventi',$id_eventi);
            $q->bindParam(':uemri',$emri);
            $q->bindParam(':umbiemri',$mbiemri);
            $q->bindParam(':uid',$id);
            $q->execute();
            Database::disconnect();
            header("Location: schedule.php");
        }
    }
?>

 
<body>
  <div class="container">
      
    <div class="span10 offset1">
        <div class="row">
            <h3>Update a Customer</h3>
        </div>      
        <form class="form-horizontal" action="updateSpeaker.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
        <div class="control-group <?php echo !empty($emriError)?'error':'';?>">
                  <label class="control-label">Name</label>
                  <div class="controls">
                      <input name="emri" type="text"  placeholder="Name" value="<?php echo !empty($emri)?$emri:'';?>">
                      <?php if (!empty($emriError)): ?>
                          <span class="help-inline"><?php echo $emriError;?></span>
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
            <div class="control-group <?php echo !empty($mbiemriError)?'error':'';?>">
              <label class="control-label">Surname of Speaker</label>
              <div class="controls">
                  <input name="mbiemri" type="text" placeholder="Surname" value="<?php echo !empty($mbiemri)?$mbiemri:'';?>">
                  <?php if (!empty($mbiemriError)): ?>
                      <span class="help-inline"><?php echo $mbiemriError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($id_eventiError)?'error':'';?>">
              <label class="control-label">Event id</label>
              <div class="controls">
                  <input name="id_eventi" type="text" placeholder="Surname" value="<?php echo !empty($id_eventi)?$id_eventi:'';?>">
                  <?php if (!empty($id_eventiError)): ?>
                      <span class="help-inline"><?php echo $id_eventiError;?></span>
                  <?php endif;?>
              </div>
            </div>
            <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                <label class="control-label">Details</label>
                <div class="controls">
                    <input name="description" type="text"  placeholder="Description " value="<?php echo !empty($description)?$description:'';?>">
                    <?php if (!empty($descriptionError)): ?>
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    <?php endif;?>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a class="btn" href="speakers.php">Back</a>
              </div>
        </form>

    </div>
    
  </div>
<?php
   include 'parts/footer.php';
?>