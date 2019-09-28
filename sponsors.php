<?php
    include 'parts/header.php';
    ?>
<br>
<br>
<br>

	<main class="sponsors">
		<div class="container benefits">
				<div class="row">
					<div class="col-md-5 col-md-offset-1" style="background-color: #f8f8f8">
						<h2>Why Sponsor</h2>
						<p><b class="orange">Barcamp</b> – Connecting, inspiring and activating event professionals around the power of events. This one-day conference is designed so that sponsors will enjoy a seamless inclusion in event programming to facilitate maximum connectivity with potential clients. Elevate features; interactive workshops, renowned industry speakers, networking luncheons, sponsor hours, cocktail parties, and most importantly, creative collaboration.</p>
					</div>
					<div class="col-md-4 col-md-offset-1" style="background-color: #f8f8f8">
						<h2>Benefits of Sponsorship</h2>
						<ul class="benefits">
						<li>Benefit from the exposure and goodwill of our conference </li>
						<li>Help create the premier professional development event</li>
						<li>Engage corporate leaders as speakers</li>
						<li>Gain visibility for your leaders and brand</li>
						<li>Showcase your corporate support for diversity and inclusion initiatives</li>
						<li>Enhance community outreach and recruitment</li>
						</ul>
					</div>
				</div>
		</div>
		<div class="sponsorList">
				<h2>Sponsors</h2>
				<?php if (isset($_SESSION['user_session'])){ ?>
				<a class="btn btn-success" type="button" href="createSponsor.php">Add New Sponsor</a>
				
				
					<?php }
                                    $i = 0;
                   $pdo = Database::connect();
  
                   $sql = 'SELECT * FROM sponsors ORDER BY id ASC';
                   foreach ($pdo->query($sql) as $row) {
                   			if($i == 0){
                   				echo '<div class="row sponsorat">';
                   				$closed = false;
                            }
                            echo '<div class = "col-md-3 kolonat">';
                            echo '<div class="logo">';
                            if (isset($_SESSION['user_session'])){
                            echo '<div class= "buttons">
							 <a class="btn btn-danger"  
							 style="width:60px" 
							 type="button" 
							 href="deleteSponsor.php?id='.$row['id'].'">Delete</a>
							 <a class="btn btn-primary"  style="width:60px" type="button" href="editSponsor.php?id='.$row['id'].'">Edit</a>
							</div>';
							}
                            echo '<a href = "'. $row['website'] . '" target="_blank">';
                            echo '<img src = "'. $row['photo'] . '" alt = "' .$row['name'] . '" />';
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
				
		</div>

	</main>

<?php
   include 'parts/footer.php';
?>