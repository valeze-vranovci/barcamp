<?php
    include 'parts/header.php';
    ?>
<br>
<br>
<br>
		<content id="schedule">
    <?php if(isset($_SESSION['user_session'])){ ?>
  		<div class="col-md-offset-1 col-md-10 col-md-offset-1" id="addSpeaker">
              <a class="btn btn-success" type="button" href="createSchedule.php">Add New Event</a>
        </div>
      
      <?php
        }
          $pdo = Database::connect();
          
          $sql = 'SELECT * FROM eventi where data >= Now() ORDER BY data ASC';

          foreach ($pdo->query($sql) as $row) {
              $event_id = $row['id'];
              echo '<div class="row schedule col-md-12">';
              echo '<div class="col-md-offset-2 col-md-8 col-md-offset-2">';
              echo '<h3><i class="fa fa-location-arrow"></i> <b class="orange">'.$row['name'].'</b></h3>';
              if(isset($_SESSION['user_session'])){
                echo '<a class="btn btn-info" type="button" href="createSpeaker.php?id='.$event_id.'">Add a speaker</a><a class="btn btn-primary" type="button" href="createSchedule.php?id='.$event_id.'">Edit this event</a>';
              }
              echo '<br />';
              echo '<p><b>Tema: </b> '.$row['tema'].'</p>';
              echo '<p>'.$row['description'].'</p>';
              echo '<p><b>Adresa: </b> '.$row['rruga'].'</p>';
              echo '<p><b>Data: </b>'.$row['data'].' | <b>Ora: </b>'.$row['ora'].'</p>';
              echo '</div>';
              echo '<div class="col-md-offset-1 col-md-10 col-md-offset-1 schedule-speakers">';
            // speakers  of this event are listed here:
              $sql = 'SELECT * FROM speaker where id_eventi="'.$event_id.'"';
              foreach ($pdo->query($sql) as $row) {
                echo '<div class="col-md-4">';
                echo '<div class="ih-item square effect6 from_top_and_bottom">';
                echo '<a >';
                echo '<div class="img"><img src="'.$row['photo'].'" alt="img"></div>';
                echo '<div class="info">';
                echo '<h3>'.$row['emri'].' '.$row['mbiemri'].'</h3>';
                echo '<p>'.$row['description'].'</p>';
                echo '</div></a>';
                echo '</div>';
                echo ' ';
        if (isset($_SESSION['user_session'])){
        echo '<a class="btn btn-primary" href="updateSpeaker.php?id=' . $row['id'] . '">Update</a>';
      }
        echo ' ';
        if (isset($_SESSION['user_session'])){
        echo '<a class="btn btn-danger" href="deleteSpeaker.php?id=' . $row['id'] . '">Delete</a>';
      }
                echo '</div>';
                
              }
              echo '<div style="clear:both; padding-top: 15px;">';
              echo '</div>';
              echo '<hr />';
              echo '</div>';
              echo '</div>';
          }
      ?>

            <div class="row schedule">
              <div class="col-md-12">
                <h3><i class="fa fa-location-arrow"></i></h3>
                <p></p>
              </div>
            </div>
		</div>
		</content>
<?php
  include 'parts/footer.php';
?>