<?php
   include 'parts/header.php';
?>
<?php
     
    // require 'dbconn.php';
    $id = $_REQUEST['id'];

    if(isset($id) && empty($_POST)){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM eventi  WHERE id = ? LIMIT 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $row = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $Qyteti = $row['id_qyteti'];
        $emri = $row['name'];
        $tema  = $row['tema'];
        $pershkrimi  = $row['description'];
        $adresa  = $row['rruga'];
        $Data  = $row['data'];
        $Ora  = $row['ora'];
    }
 
    else if ( !empty($_POST)) {
        // keep track validation errors
        $QytetiError = null;
        $emriError = null;
        $temaError=null;
        $pershkrimiError = null;
        $adresaError = null;
        $DataError = null;
        $OraError = null;
        
        // keep track post values
        $Qyteti = $_POST['select'];
        $emri = $_POST['emri'];
        $tema  = $_POST['tema'];
        $pershkrimi  = $_POST['pershkrimi'];
        $adresa  = $_POST['adresa'];
        $Data  = $_POST['Data'];
        $Ora  = $_POST['Ora'];
         
        // validate input
        $valid = true;
         
        if (empty($Qyteti)) {
            $QytetiError = 'Please enter Qyteti';
            $valid = false;
        }
        if (empty($emri)) {
            $emriError = 'Please enter emri';
            $valid = false;
        }
        if (empty($tema)) {
            $temaError = 'Please enter tema';
            $valid = false;
        }
        if (empty($pershkrimi)) {
            $pershkrimiError = 'Please enter pershkrimi';
            $valid = false;
        }
        if (empty($adresa)) {
            $adresaError = 'Please enter adress';
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
         
         
        // insert data
        if  ($valid)  {
            $data = str_replace('/', '-', $data);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(isset($id)){
                 $sql = "UPDATE eventi SET id_qyteti='".$Qyteti."' ,name='".$emri."' ,tema='".$tema."' ,description='".$pershkrimi."' ,rruga='".$adresa."' ,data='".$Data."' ,ora='".$Ora."' WHERE id='".$id."'";
                 $q = $pdo->exec($sql);
            }
            else{
                $sql = "INSERT INTO eventi (id_qyteti,name,tema,description,rruga,data,ora) values(?, ?, ?, ?, ?, ?, ?)";
                 $q = $pdo->prepare($sql);
                $q->execute(array($Qyteti,$emri, $tema, $pershkrimi, $adresa, $Data, $Ora));
            }
           
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
                        <h3 class="orange">Create a Schedule</h3>
                    </div>
                    <?php
                        if(isset($id)){
                            echo '<form class="form-horizontal" action="createSchedule.php?id='.$id.'" method="post" enctype="multipart/form-data">';
                        }
                        else{
                    
             
                        echo '<form class="form-horizontal" action="createSchedule.php" method="post" enctype="multipart/form-data">';
                    
                        }
                    ?>
                      <div class="control-group <?php echo !empty($QytetiError)?'error':'';?>">
                        <label class="control-label">Qyteti:</label>
                        <?php 
                        $pdo = Database::connect();
                        $sql = "SELECT emri,id FROM qyteti order by emri";
                        
                        echo  "<select name='select'>";

                        foreach ($pdo->query($sql) as $row) {
                          echo "<option value=".$row['id'].">".$row['emri']."</option>";
                        }
                        echo "</select>";
                        ?>
                      </div>
                      <div class="control-group <?php echo !empty($emriError)?'error':'';?>">
                        <label class="control-label">Emri i evenit:</label>
                        <div class="controls">
                            <input name="emri" type="text"  placeholder="" value="<?php echo !empty($emri)?$emri:'';?>" required>
                            <?php if (!empty($emriError)): ?>
                                <span class="help-inline"><?php echo $emriError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($temaError)?'error':'';?>">
                        <label class="control-label">Tema:</label>
                        <div class="controls">
                            <input name="tema" type="text" placeholder="" value="<?php echo !empty($tema)?$tema:'';?>" required>
                            <?php if (!empty($temaError)): ?>
                                <span class="help-inline"><?php echo $tema;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($pershkrimiError)?'error':'';?>">
                        <label class="control-label">Pershkrimi:</label>
                        <div class="controls">
                            <textarea id="pershkrimi" name="pershkrimi" rows="7" cols="60" maxlength="512" value="" required><?php echo !empty($pershkrimi)?$pershkrimi:'';?></textarea>
                            <?php if (!empty($pershkrimiError)): ?>
                                <span class="help-inline"><?php echo $pershkrimiError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($adresaError)?'error':'';?>">
                        <label class="control-label">Adresa:</label>
                        <div class="controls">
                            <input name="adresa" type="text" placeholder="" value="<?php echo !empty($adresa)?$adresa:'';?>" required>
                            <?php if (!empty($adresaError)): ?>
                                <span class="help-inline"><?php echo $adresaError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($DataError)?'error':'';?>">
                        <label class="control-label">Data:</label>
                        <div class="controls">
                            <input name="Data" type="text" id="datepicker" readonly placeholder="Choose" required>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($OraError)?'error':'';?>">
                        <label class="control-label">Ora:</label>
                        <div class="controls">
                            <input name="Ora" type="text" id="timepicker" placeholder="Choose" required>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-primary">Save</button>
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