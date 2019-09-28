
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
            <li><a href="#">RSS</a></li>
         </ul>
      
      </div>
      <div class="col-md-7">
         <div id="map" style="
            height: 250px;
            width: 100%;
            "></div>
         <script>
            function initMap() {
              var uluru = {lat: 42.66337, lng: 21.16267};
              var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,
                  center: uluru
              });
              var marker = new google.maps.Marker({
                  position: uluru,
                  map: map
              });
            }
         </script> 
         <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvPlRSpGRYggzVwraDejnTvUdXSzpKb44&callback=initMap"></script>
      </div>
   </div>
</footer>
<!-- <script src="jquery-3.1.1.js"></script>Latest compiled and minified JavaScript --> 
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="engine1/wowslider.js"></script>
    <script type="text/javascript" src="engine1/script.js"></script>
    <script type="text/javascript" src="js/checkData.js"></script>
</body>
</html>
