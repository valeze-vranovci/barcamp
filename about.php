<?php
    include 'parts/header.php';
    ?>
<br>
<br>
<br>

    <content class="about">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <?php

                  $pdo = Database::connect();
                  $sql = $pdo->prepare('SELECT * FROM Abouttext WHERE id=1 LIMIT 1');
                  $sql->execute(); 
                  $row = $sql->fetch();
                  Database::disconnect();
            
          echo '<h1>'.$row['heading'].'</h1>
            <p id="paragrafi1">'.$row['paragrafi'].'</p>';
            if (isset($_SESSION['user_session'])) {
            echo'
            <a class="btn btn-primary"  style="width:60px" type="button" href="editAboutContent.php?id='.$row['id'].'">Edit</a>';
          }
            echo'
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4">';
                  $pdo = Database::connect();
                  $sql = $pdo->prepare('SELECT * FROM Abouttext WHERE id=2 LIMIT 1');
                  $sql->execute(); 
                  $row = $sql->fetch();
                  Database::disconnect();
            
          echo '<h2>'.$row['heading'].'</h2>
            <p>'.$row['paragrafi'].'</p>';
            if (isset($_SESSION['user_session'])) {
              echo'
            <a class="btn btn-primary" style="width:60px" type="button" href="editAboutContent.php?id='.$row['id'].'">Edit</a>';
          }  
          echo'


          </div>
          <div class="col-md-8 starters" >
            <h2>Who started BarCamp?</h2>
            <div class="col-md-6">';
                  $pdo = Database::connect();
                  $sql = $pdo->prepare('SELECT * FROM Abouttext WHERE id=3 LIMIT 1');
                  $sql->execute(); 
                  $row = $sql->fetch();
                  Database::disconnect();

            echo '<h4>'.$row['heading'].'</h4>
              <img src="'.$row['photo'].'">
              <p>'.$row['paragrafi'].'</p>';
              if (isset($_SESSION['user_session'])) {
                echo '
              <a class="btn btn-primary"  style="width:60px" type="button" href="editAboutContent.php?id='.$row['id'].'">Edit</a>';
            }
              echo'
            </div>
            <div class="col-md-6">';
                  $pdo = Database::connect();
                  $sql = $pdo->prepare('SELECT * FROM Abouttext WHERE id=4 LIMIT 1');
                  $sql->execute(); 
                  $row = $sql->fetch();
                  Database::disconnect();

            echo '<h4>'.$row['heading'].'</h4>
              <img src="'.$row['photo'].'">
              <p>'.$row['paragrafi'].'</p>';
              if (isset($_SESSION['user_session'])) {
                echo'
              <a class="btn btn-primary"  style="width:60px" type="button" href="editAboutContent.php?id='.$row['id'].'">Edit</a>';
            }
            echo'
            </div> '; ?>
          </div>
        </div>
      </div>

      
      <br>
      <br>
      <?php
      if (isset($_SESSION['user_session'])) {
      
			echo '<a id="newSlCnt" class="btn btn-success" type="button" href="createNewSliderContent.php">Add New Slider Content</a>';
      }
      ?>
      <br>
			<br>
				<div id="owl-demo" class="owl-carousel">
        <?php 
          $pdo = Database::connect();
                   $sql = 'SELECT * FROM aboutSlider ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
        
          echo 
          '<div class="item"><img src="'.$row['image'].'">
              <div class="clearfix"></div>
              <div class="photo-title texti-left2">
                <p class="texti-theme">'.$row['data'].'</p>
                <p>'.$row['texti'].'</p>';

                if(isset($_SESSION['user_session'])){
                echo '<a class="btn btn-primary"  style="width:60px" type="button" href="editAboutSlider.php?id='.$row['id'].'">Edit</a>
                <a class="btn btn-danger"  style="width:60px" type="button" href="deleteAboutSlider.php?id='.$row['id'].'">Delete</a>';
                }
                echo'
             </div>
           </div>';
           }
           Database::disconnect();
        ?>
        </div>

		</content>

<?php
  include 'parts/footer.php'
?>
