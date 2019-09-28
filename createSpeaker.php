<?php
   include 'parts/header.php';
?>
<?php
     
    // require 'dbconn.php';
    $eventi = $_REQUEST['id'];
    if (empty($eventi)) {
      echo " <script>
                 alert('URL is not right..');
                  window.location.href='schedule.php';
             </script> ";
    }
    $pdo = Database::connect();
    $sql = 'SELECT * FROM eventi WHERE id = '.$eventi.'';
    $res = $pdo->query($sql);
    Database::disconnect();

    // kqyre a ka event me kete id
    if($res->fetchColumn() < 1) {
      echo " <script>
                 alert('Not a valid id for event..');
                  window.location.href='schedule.php';
             </script> ";
    }
    else{
      $pdo = Database::connect();
      $sql = 'SELECT * FROM eventi WHERE id = '.$eventi.'';
      $stmt = $pdo->prepare($sql); 
      $stmt->execute();
      $row = $stmt->fetch();
      
      Database::disconnect();
    }
    if ( !empty($_POST)) {
        // keep track validation errors
        $emriError = null;
        $mbiemriError=null;
        $pershkrimiError = null;
        $photoError = null;
        
        // keep track post values
        
        $emri = $_POST['emri'];
        $mbiemri  = $_POST['mbiemri'];
        $pershkrimi  = $_POST['pershkrimi'];
        $photo = $_FILES['photo']['name'];
        $target = "images/".basename($_FILES["photo"]["name"]);
         
        // validate input
        $valid = true;
         
        
        if (empty($emri)) {
            $emriError = 'Please enter emri';
            $valid = false;
        }
        if (empty($mbiemri)) {
            $mbiemriError = 'Please enter mbiemri';
            $valid = false;
        }
        if (empty($pershkrimi)) {
            $pershkrimiError = 'Please enter pershkrimi';
            $valid = false;
        }
         
        if(!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE)
        {
            $photoError = 'Please choose a photo for speaker';
            $valid = false;
        }
        // insert data
        if ($valid && move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO speaker (id_eventi,emri,mbiemri,description,photo) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($eventi,$emri, $mbiemri, $pershkrimi, $target));
            Database::disconnect();
            header("Location: schedule.php");
        }
    }
?>

  <main class="createSchedule">
    <div class="container createSchedule">
        <?php 
      if(!isset($_SESSION['user_session'])){
        echo "<div class='noPermission'>You don't have the permission to view this page.</div>";
      }
      else
      { ?>
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 class="orange">Add a Speaker</h3>
                    </div>
             <?php
                  echo  '<form class="form-horizontal" action="createSpeaker.php?id='.$eventi.'" method="post" enctype="multipart/form-data">';
              ?>
                      <div class="control-group <?php echo !empty($eventiError)?'error':'';?>">
                        <label class="control-label">Eventi:</label>
                          <div class="controls">
                            <?php 
                            echo '<input name="emri_eventit" type="text"  placeholder="" value="'.$row['name'].'" disabled>';
                            ?>
                          </div>
                      </div>
                      <div class="control-group <?php echo !empty($emriError)?'error':'';?>">
                        <label class="control-label">Emri:</label>
                        <div class="controls">
                            <input name="emri" type="text"  placeholder="speaker name" value="<?php echo !empty($emri)?$emri:'';?>" required>
                            <?php if (!empty($emriError)): ?>
                                <span class="help-inline"><?php echo $emriError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mbiemriError)?'error':'';?>">
                        <label class="control-label">Mbiemri:</label>
                        <div class="controls">
                            <input name="mbiemri" type="text" placeholder="speaker surname" value="<?php echo !empty($mbiemri)?$mbiemri:'';?>" required>
                            <?php if (!empty($mbiemriError)): ?>
                                <span class="help-inline"><?php echo $mbiemri;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($pershkrimiError)?'error':'';?>">
                        <label class="control-label">Pershkrimi:</label>
                        <div class="controls">
                            <textarea id="pershkrimi" name="pershkrimi" rows="7" cols="60" maxlength="512" required><?php echo !empty($pershkrimi)?$pershkrimi:'';?></textarea>
                            <?php if (!empty($pershkrimiError)): ?>
                                <span class="help-inline"><?php echo $pershkrimiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                        <label class="control-label">Photo</label>
                        <div class="controls">
                            <input name="photo" type="file" accept="image/*">
                            <?php if (!empty($photoError)): ?>
                                <span class="help-inline"><?php echo $photoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-primary">Create</button>
                          <a class="btn btn-default" href="schedule.php">Back</a>
                        </div>
                    </form>
                </div>
                 <?php } ?>
    </div> <!-- /container -->
    </main>
<?php
   include 'parts/footer.php';
?>