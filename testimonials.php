<?php
   include 'parts/header.php';
?>
<br>
<br>
<br>




  <content>
  <!-- VIDEOO -->
  <!-- Feedback-->
    <div class="container">
      <section>
        <div class="page-header text-center" id="feedback">
          <h2>TESTIMONIALS</h2>
                  <?php
if (isset($_SESSION['user_session'])) {
?>
                 <p>
                    <a class="btn btn-success" type="button" href="createTestimonial.php">Add New Testimonial</a>
                </p>
<?php
} else {
}
?>
        </div>
            <?php

              $i = 0;
              $pdo = Database::connect();
               $sql = 'SELECT * FROM testimonials ORDER BY id DESC';
               foreach ($pdo->query($sql) as $row) {
                      if($i == 0){
                          echo '<div class="testimonials row animated delay5 fadeInUp" data-animation="fadeInUp" style="opacity: 1;">';
                          $closed = false;
                       }
                        echo '<div class="col-md-4">';
                        echo '<blockquote>';
                        
                        echo '<img src = "'. $row['photo'] . '" alt = "' .$row['name'] . '" />';
                        echo '<p>'. $row['paragraph'] . '</p>';
                        echo '<footer>'. $row['footer'] . '</footer>';
                        echo '<p width=250>';
                            echo ' ';
                            if (isset($_SESSION['user_session'])){
                            echo '<a class="btn btn-primary" href="updateTestimonial.php?id='.$row['id'].'">Edit</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="deleteTestimonial.php?id='.$row['id'].'">Delete</a>';
                          }
                            echo '</td>';
                        echo '</blockquote>';
                        echo '</div>';
                        $i++;
                        if($i == 3){
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
    </div><!--End Container-->
  </content>
  



  
  <br>
  <br>
<?php
   include 'parts/footer.php';
?>