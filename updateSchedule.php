<?php
   include 'parts/header.php';
?>

<?php
    // require 'dbconn.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    else if(!isset($_SESSION['user_session'])){ 
      $notConnected = "You don't have the permission to do this action";
    }
    else{
      header("Location: schedule.php");
    }
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM schedule  WHERE id = ? LIMIT 1"; 
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();

    if (!((isset($Qyteti) && ($Qyteti!=null)))) {
      $Qyteti = $row['Qyteti'];
    }
    if (!((isset($Paragraf) && ($Paragraf!=null)))) {
      $Paragraf = $row['Paragraf'];
    }
    if (!((isset($EmriDheMbiemri) && ($EmriDheMbiemri!=null)))) {
      $EmriDheMbiemri = $row['EmriDheMbiemri'];
    }
    if (!((isset($Kompania) && ($Kompania!=null)))) {
      $Kompania = $row['Kompania'];
    }
    if (!((isset($Description) && ($Description!=null)))) {
      $Description = $row['Description'];
    }
    if (!((isset($Rruga) && ($Rruga!=null)))) {
      $Rruga = $row['Rruga'];
    }
    if (!((isset($Data) && ($Data!=null)))) {
      $Data = $row['Data'];
    }
    if (!((isset($Ora) && ($Ora!=null)))) {
      $Ora = $row['Ora'];
    }
    if (!((isset($photo) && ($photo!=null)))) {
      $photo = $row['photo'];
    }
    if (!((isset($name) && ($name!=null)))) {
      $name = $row['name'];
    }





    if(!empty($_POST)){
      $QytetiError = null;
      $ParagrafError = null;
      $EmriDheMbiemriError = null;
      $KompaniaError = null;
      $DescriptionError = null;
      $RrugaError = null;
      $DataError = null;
      $OraError = null;
      $photoError = null;
      $nameError = null;

      $Qyteti = $_POST['Qyteti'];
      $Paragraf = $_POST['Paragraf'];
      $EmriDheMbiemri = $_POST['EmriDheMbiemri'];
      $Kompania = $_POST['Kompania'];
      $Description = $_POST['Description'];
      $Rruga = $_POST['Rruga'];
      $Data = $_POST['Data'];
      $Ora = $_POST['Ora'];
      $photo = $_POST['photo'];
      $name = $_POST['name'];
      $target = "images/".basename($_FILES["photo"]["name"]);
      $image = $_FILES['photo']['name'];

      $valid = true;

        if (empty($Qyteti)) {
            $QytetiError = 'Please enter the city';
            $valid = false;
        }
        if (empty($Paragraf)) {
            $ParagrafError = 'Please enter Paragraf';
            $valid = false;
        }
        if (empty($EmriDheMbiemri)) {
            $EmriDheMbiemriError = 'Please enter Name and LastName';
            $valid = false;
        }
        if (empty($Kompania)) {
            $KompaniaError = 'Please enter Kompania';
            $valid = false;
        }
        if (empty($Description)) {
            $DescriptionError = 'Please enter Description';
            $valid = false;
        }
        if (empty($Rruga)) {
            $RrugaError = 'Please enter Rruga';
            $valid = false;
        }
        if (empty($Data)) {
            $DataError = 'Please enter Data';
            $valid = false;
        }
        if (empty($Ora)) {
            $OraError = 'Please enter Ora';
            $valid = false;
        }
      if (empty($name)) {
            $nameError = 'Please enter name';
            $valid = false;
        }
        if((!isset($_FILES['photo']) || $_FILES['photo']['error'] == UPLOAD_ERR_NO_FILE) && !((isset($photo) && ($photo!=null))))
        {
            $photoError = 'Please choose a photo';
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
          $q = $pdo->prepare('UPDATE schedule SET Qyteti=:uQyteti,
            Paragraf=:uParagraf,
            EmriDheMbiemri =:uEmriDheMbiemri,
            Kompania=:uKompania,
            Description =:uDescription,
            Rruga=:uRruga,
            Data =:uData,
            Ora=:uOra,
            photo =:uphoto,
            name =:uname
            WHERE id=:uid');
          $q = $pdo->prepare($sql);
            $q->bindParam(':uQyteti',$Qyteti);
            $q->bindParam(':uParagrafP',$Paragraf);
            $q->bindParam(':uEmriDheMbiemri',$EmriDheMbiemri);
            $q->bindParam(':uKompania',$Kompania);
            $q->bindParam(':uDescription',$Description);
            $q->bindParam(':uRruga',$Rruga);
            $q->bindParam(':uData',$Data);
            $q->bindParam(':uOra',$Ora);
            $q->bindParam(':uphoto',$target);
            $q->bindParam(':uname',$name);
            $q->bindParam(':uid',$id);
            $q->execute();
          // $q->execute(array($Qyteti,$Paragraf, $EmriDheMbiemri, $Kompania, $Description, $Rruga, $Data, $Ora,$target, $name, $id));
            Database::disconnect();
            header("Location: schedule.php");
        }
    }
?>

<br><br><br>
<body>
<div class="container">

     <?php 
        if(isset($notConnected))
        {
          echo "<p>".$notConnected."</p>";
        }
        else{
     ?>
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Schedule</h3>
                    </div>
      
                    <form class="form-horizontal" action="updateSchedule.php?id= <?php echo $id ?>" method="POST">
                      <div class="control-group <?php echo !empty($QytetiError)?'error':'';?>">
                        <label class="control-label">Qyteti:</label>
                        <div class="controls">
                            <input name="Qyteti" type="text" placeholder="" value="<?php echo !empty($Qyteti)?$Qyteti:'';?>">
                            <?php if (!empty($QytetiError)): ?>
                                <span class="help-inline"><?php echo $QytetiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($ParagrafError)?'error':'';?>">
                        <label class="control-label">Paragraf:</label>
                        <div class="controls">
                            <input name="Paragraf" type="text"  placeholder="" value="<?php echo !empty($Paragraf)?$Paragraf:'';?>">
                            <?php if (!empty($ParagrafError)): ?>
                                <span class="help-inline"><?php echo $ParagrafError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($EmriDheMbiemriError)?'error':'';?>">
                        <label class="control-label">Emri dhe Mbiemri:</label>
                        <div class="controls">
                            <input name="EmriDheMbiemri" type="text" placeholder="" value="<?php echo !empty($EmriDheMbiemri)?$EmriDheMbiemri:'';?>">
                            <?php if (!empty($EmriDheMbiemriError)): ?>
                                <span class="help-inline"><?php echo $EmriDheMbiemriError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($KompaniaError)?'error':'';?>">
                        <label class="control-label">Kompania:</label>
                        <div class="controls">
                            <input name="Kompania" type="text" placeholder="" value="<?php echo !empty($Kompania)?$Kompania:'';?>">
                            <?php if (!empty($KompaniaError)): ?>
                                <span class="help-inline"><?php echo $KompaniaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($DescriptionError)?'error':'';?>">
                        <label class="control-label">Description:</label>
                        <div class="controls">
                            <input name="Description" type="text" placeholder="" value="<?php echo !empty($Description)?$Description:'';?>">
                            <?php if (!empty($DescriptionError)): ?>
                                <span class="help-inline"><?php echo $DescriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($RrugaError)?'error':'';?>">
                        <label class="control-label">Rruga:</label>
                        <div class="controls">
                            <input name="Rruga" type="text" placeholder="" value="<?php echo !empty($Rruga)?$Rruga:'';?>">
                            <?php if (!empty($RrugaError)): ?>
                                <span class="help-inline"><?php echo $RrugaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($DataError)?'error':'';?>">
                        <label class="control-label">Data:</label>
                        <div class="controls">
                            <input name="Data" type="text" placeholder="" value="<?php echo !empty($Data)?$Data:'';?>">
                            <?php if (!empty($DataError)): ?>
                                <span class="help-inline"><?php echo $DataError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($OraError)?'error':'';?>">
                        <label class="control-label">Ora:</label>
                        <div class="controls">
                            <input name="Ora" type="text" placeholder="" value="<?php echo !empty($Ora)?$Ora:'';?>">
                            <?php if (!empty($OraError)): ?>
                                <span class="help-inline"><?php echo $OraError;?></span>
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
                <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                  <label class="control-label">Name</label>
                  <div class="controls">
                      <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                      <?php if (!empty($nameError)): ?>
                          <span class="help-inline"><?php echo $nameError;?></span>
                      <?php endif; ?>
                  </div>
                </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href=" schedule.php">Back</a>
                        </div>
                    </form>
    </div>
    <?php
     }

     ?>
    </div>
<?php
   include 'parts/footer.php';
?>
