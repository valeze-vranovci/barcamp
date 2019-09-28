<?php 
	include 'parts/header.php'

 ?>
<br>
<br>
		<content>
				<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
<div class="ws_images"><ul>
		<li><a href="http://wowslider.com"><img src="data1/images/slider1.jpg" alt="bootstrap slider" title="slider1" id="wows1_0"/></a></li>
		<li><img src="data1/images/slider2.jpg" alt="slider2" title="slider2" id="wows1_1"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="slider1"><span><img src="data1/tooltips/slider1.jpg" alt="slider1"/>1</span></a>
		<a href="#" title="slider2"><span><img src="data1/tooltips/slider2.jpg" alt="slider2"/>2</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"></div>
<div class="ws_shadow"></div>
</div>	
<!-- End WOWSlider.com BODY section -->






	<div class="intro" ">

	<div class="container eventet">
			<h2>Next Events</h2>
			<?php
				$pdo = Database::connect();
				$i=0;
				$sql = 'SELECT * FROM eventi where data >= Now() ORDER BY data ASC LIMIT 3';
				foreach ($pdo->query($sql) as $row) {

					if($i==0){
						echo '<div class="row">';
						$closed = false;
					}
					echo '<div class="col-md-4">';
					echo '<h4>'.$row['name'].'</h4>';
					$idqyteti = $row['id_qyteti'];
					$sqlqyteti = 'SELECT * FROM qyteti where id ='.$idqyteti;
					foreach ($pdo->query($sqlqyteti) as $key) {
						echo '<a href="schedule.php"><img src = "'. $key['photo'] . '" alt = "' .$key['emri'] . '" /></a>';
						// echo '<img src="images/events.jpg">';
					}
					
					echo '<p>'.$row['data'].'</p>';
					echo '<p>'.$row['description'].'</p>';
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
				<br>
				<br>
				<button type="button" onclick="window.location.href='schedule.php'" class="btn btn-primary">see other events </button>
			</div>
		<br>
		<br>
			<div class=" speaker">
				<?php
					$i= 0;
					$pdo = Database::connect();
					$sql = 'SELECT * FROM speaker ORDER BY id ASC LIMIT 3';
					foreach ($pdo->query($sql) as $row) {
						if($i==0){
							echo '<div class="row speakers">';
							$closed = false;
						}
						
						echo '<div class="col-md-4">';
						echo '<h3>Barcamp Speakers</h3>';
						echo '<a href="speakers.php"><img src = "'.$row['photo']. '" alt = "'.$row['emri'] . '" /></a>';
						echo '<h4>'.$row['emri'].' '.$row['mbiemri'].'</h4>';
						echo '<p>'.$row['description'].'</p>';
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
			</div>


	<div class="container content">
	    <?php 
	    	$pdo = Database::connect();
	           $sql = 'SELECT * FROM testimonials ORDER BY id ASC LIMIT 3';
	        foreach ($pdo->query($sql) as $row) {
	        	
	        	echo '<div class="row">';
	        	echo '<div class="col-md-4 col-md-offset-3">';
	        	echo '<h3>TESTIMONIALS</h3>';
	        	echo '<div class="testimonials">';
	        	echo '<div class="active item">';
	        	echo '<blockquote><p>'. $row['footer'].'</p></blockquote>';
	        	echo '<div class="carousel-info">';
	        	echo '<a href="testimonials.php"><img src = "'. $row['photo']. '" alt = "'.$row['name']. '" class="pull-left" /></a>';
	        	echo '<div class="pull-left">';
	        	echo '<span class="testimonials-name">'.$row['name'].'</span>';
	        	echo '<span class="testimonials-post">'.$row['paragraph'].'</span>';
	        	echo '</div>';
	        	echo '</div>';
	        	echo '</div>';
	        	echo '</div>';
	        	echo '</div>';
	        	echo '</div>';
	        }
			Database::disconnect();
	     ?>
    </div>
</div>


</content>


<?php 
	include 'parts/footer.php'

 ?>