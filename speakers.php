<?php
    include 'parts/header.php';
    ?>
<br>
<br>
<br>


  <content>

  <div class="container">
    <section>
      <div class="page-header text-center" id="feedback">
        <h2>Speakers</h2>
      </div>

      <?php
          $i = 0;
          $pdo = Database::connect();
           $sql = 'SELECT * FROM speaker ORDER BY id DESC';
           foreach ($pdo->query($sql) as $row) {
              if($i == 0){
                  echo '<div class="row">';
                  $closed = false;
               }
                echo '<div class="col-md-3">';
                echo '<div class="ih-item square effect6 bottom_to_top">';
                echo '<a href="#">';
                echo '<div class="img">';
                echo '<img src = "'. $row['photo'] . '" alt = "' .$row['emri'] . '" />';
                echo '</div>';
                echo '<div class="info">';
                echo '<h3>'. $row['emri'] . '</h3>';
                echo '<p>'. $row['description'] . '</p>';
                

                echo '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                $i++;
                if($i == 4){
                  $i = 0;
                  echo '</div>';
                  $closed = true;
                }
           }
           if($closed == false) {
                  echo '</div>';
              }
           Database::disconnect();
        ?>
    </section>
  </div>
  </content>





<br>
<br>
<br>
<?php
  include 'parts/footer.php'
?>
