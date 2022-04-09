
<?php wp_head(); ?>
<style>
  .marker-board{
      width: 200px !important;
      height: auto;
      background: #0e1626;
      color: #fff;
      padding: 10px;
  }
</style>

    <div id="map"></div>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-lg btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Find a Project</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                
                <!-- sidebar-header  -->
                <div class="sidebar-search">
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="header-menu">
                          <div class="xsidebar-menu">
                              <h5 class="project-title">Global Overview</h5>
                              <ul class="global-overview heading-text">
                                  <li>Total Projects<br><b>1263</b></li>
                                  <li>Active Projects<br><b>563</b></li>
                                  <li>Total Countries<br><b>123</b></li>
                              </ul>

                              <h5 class="project-title">100% Sport Related</h5>
                              <?php
                              $terms = get_terms( '100-sr' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="sportrelated[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>
                              
                              <h5 class="project-title">Modality of Assistance</h5>
                              <?php
                              $terms = get_terms( 'financial' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="modalitystore[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>
                             
                              <h5 class="project-title">Project Status</h5>
                              <?php
                              $terms = get_terms( 'status' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="projectstore[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>
                              
                              <h5 class="project-title">Year of Investment</h5>
                              <?php
                              $terms = get_terms( 'yoi' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="Investment[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>
                               

                              <h5 class="project-title">Sectors</h5>
                               <?php
                                $terms = get_terms( 'sector' );
                                  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                      echo '<ul id="yoi" class="global-overview status-list">';
                                      foreach ( $terms as $term ) {
                                          echo '<li><input type="checkbox" onchange="initMap()" name="sectorstore[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                      }
                                      echo '</ul>';
                                  }                              
                                ?> 
                                  
                              <h5 class="project-title">Nature of Sport-based investment</h5>
                              <?php
                              $terms = get_terms( 'tosp' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="typeSportstore[]" value="' . $term->term_id . '">' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?> 

                              <h5 class="project-title">Size Range</h5>
                              <?php
                              $terms = get_terms( 'size' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="sizestore[]" value="' . $term->term_id . '"> ' . $term->name . '</li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>                        

                              <h5 class="project-title">Locations</h5>
                              <?php
                              $terms = get_terms( 'countries' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="countrystore[]" value="' . $term->term_id . '"><a href="#"> ' . $term->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>

                              <h5 class="project-title">Keywords</h5>
                              <?php
                              $terms = get_terms( 'key-terms' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    echo '<ul id="yoi" class="global-overview status-list">';
                                    foreach ( $terms as $term ) {
                                        echo '<li><input type="checkbox" onchange="initMap()" name="keywordstore[]" value="' . $term->term_id . '"><a href="#"> ' . $term->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                }                              
                              ?>

                          </div>
                        </li>
                        
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>
    </div>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxHRBU_I-JXkZRv1HLG3uoaEV_Pa_HC14&callback=initMap"
      
    ></script>


  

    <script type="text/javascript">

    function initMap(){

      //100% sport related projects items  get here 
      var checkboxes = document.getElementsByName('sportrelated[]');
      var sportrelated = "";
      for (var i=0, n=checkboxes.length;i<n;i++) 
      {
          if (checkboxes[i].checked) 
          {
              sportrelated += ","+checkboxes[i].value;
          }
      }
      if (sportrelated) sportrelated = sportrelated.substring(1);

      //Country list projects items  get here
      var checkboxes2 = document.getElementsByName('countrystore[]');
      var countrystore = "";
      for (var i=0, n=checkboxes2.length;i<n;i++) 
      {
          if (checkboxes2[i].checked) 
          {
              countrystore += ","+checkboxes2[i].value;
          }
      }
      if (countrystore) countrystore = countrystore.substring(1);

      //MODALITY OF ASSISTANCE projects items get here
      var checkboxes3 = document.getElementsByName('modalitystore[]');
      var modalitystore = "";
      for (var i=0, n=checkboxes3.length;i<n;i++) 
      {
          if (checkboxes3[i].checked) 
          {
              modalitystore += ","+checkboxes3[i].value;
          }
      }
      if (modalitystore) modalitystore = modalitystore.substring(1);

      //PROJECT STATUS projects items get here
      var checkboxes4 = document.getElementsByName('projectstore[]');
      var projectstore = "";
      for (var i=0, n=checkboxes4.length;i<n;i++) 
      {
          if (checkboxes4[i].checked) 
          {
              projectstore += ","+checkboxes4[i].value;
          }
      }
      if (projectstore) projectstore = projectstore.substring(1);

      //Year of Investment projects items get here
      var checkboxes5 = document.getElementsByName('Investment[]');
      var Investment = "";
      for (var i=0, n=checkboxes5.length;i<n;i++) 
      {
          if (checkboxes5[i].checked) 
          {
              Investment += ","+checkboxes5[i].value;
          }
      }
      if (Investment) Investment = Investment.substring(1);

      //Sector store projects items get here
      var checkboxes6 = document.getElementsByName('sectorstore[]');
      var sectorstore = "";
      for (var i=0, n=checkboxes6.length;i<n;i++) 
      {
          if (checkboxes6[i].checked) 
          {
              sectorstore += ","+checkboxes6[i].value;
          }
      }
      if (sectorstore) sectorstore = sectorstore.substring(1);

      //Size of projects items get here
      var checkboxes8 = document.getElementsByName('sizestore[]');
      var sizestore = "";
      for (var i=0, n=checkboxes8.length;i<n;i++) 
      {
          if (checkboxes8[i].checked) 
          {
              sizestore += ","+checkboxes8[i].value;
          }
      }
      if (sizestore) sizestore = sizestore.substring(1);

      //Keyword of projects items get here
      var checkboxes9 = document.getElementsByName('keywordstore[]');
      var keywordstore = "";
      for (var i=0, n=checkboxes9.length;i<n;i++) 
      {
          if (checkboxes9[i].checked) 
          {
              keywordstore += ","+checkboxes9[i].value;
          }
      }
      if (keywordstore) keywordstore = keywordstore.substring(1);
      
     //check empty value of sportrelated
      if( sportrelated != ""){
        var newSport = '100-sr=' + sportrelated;
      }else{
        var newSport = "";
      }
     //check empty value of countrystore
      if( countrystore != ""){
        var newCountry = '&countries=' + countrystore;
      }else{
        var newCountry = "";
      }
      //check empty value of modalitystore
      if( modalitystore != ""){
        var newModality = '&financial=' + modalitystore;
      }else{
        var newModality = "";
      }
      //check empty value of projectstore
      if( projectstore != ""){
        var newProject = '&status=' + projectstore;
      }else{
        var newProject = "";
      }
      //check empty value of Investment
      if( Investment != ""){
        var newInvestment = '&yoi=' + Investment;
      }else{
        var newInvestment = "";
      }
      //check empty value of sectorstore
      if( sectorstore != ""){
        var newSector = '&sector=' + sectorstore;
      }else{
        var newSector = "";
      }
      //check empty value of sizestore
      if( sizestore != ""){
        var newSize = '&size=' + sizestore;
      }else{
        var newSize = "";
      }
      //check empty value of keywordstore
      if( keywordstore != ""){
        var newKey = '&key-terms=' + keywordstore;
      }else{
        var newKey = "";
      }


      let endpoint = 'http://localhost:8080/wp-tester/wp-json/wp/v2/gooproject?'+ newSport + newCountry + newModality + newProject + newInvestment + newSector + newSize + newKey +'&_embed=1';

      console.log(endpoint);

        $.ajax({
            url: endpoint,
            contentType: "application/json",
            dataType: 'json',
            success: function(result){
              
              console.log(result);

              //console.log(result.length)
              

              var myLocation = [];

              for(i = 0; i < result.length; i++){
                myLocation.push(['<div style="color:#fff;background:#0e1626;width:300px;padding:10px;" class"marker-board"><b>Countries</b>:- '+result[i]._embedded['wp:term'][0][0].name+'</br><b>Status</b>:- '+result[i]._embedded['wp:term'][2][0].name+'</br><b>Years</b>:- 2010,2011<br><b>Sport</b>:- postTitle<br><b>Sector</b>:- Healty, Energy<br><b>Type of Sport:- </b>Capacity building <br><b>Size:- </b>Large size > $1m <br><b>Keywords:- </b> Disability<br><b>Modality:- </b> Loans<br></div>',
                  23.7225118, 90.3193431, 4])
              }

              var locations = myLocation;
              
              //console.log(myLocation.toString())
              console.log(locations);

              //console.log(result);

               // console.log(countries.toString());

                // var locations = [
                //   ['<div style="color:#fff;background:#0e1626;width:300px;padding:10px;" class"marker-board"><b>Countries</b>:- India, USA</br><b>Status</b>:- Active</br><b>Years</b>:- 2010,2011<br><b>Sport</b>:- postTitle<br><b>Sector</b>:- Healty, Energy<br><b>Type of Sport:- </b>Capacity building <br><b>Size:- </b>Large size > $1m <br><b>Keywords:- </b> Disability<br><b>Modality:- </b> Loans<br></div>',
                //   23.7225118, 90.3193431, 4],
                //   ['Coogee Beach', -33.923036, 151.259052, 5],
                //   ['Cronulla Beach', -34.028249, 151.157507, 3],
                //   ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                //   ['Maroubra Beach', -33.950198, 151.259302, 1]
                // ];

                //Google map custom style with custom style from here.
                const styledMapType = new google.maps.StyledMapType(
                    [
                      {
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#1d2c4d"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#8ec3b9"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#1a3646"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.country",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#4b6878"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.land_parcel",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#64779e"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.neighborhood",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.province",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#4b6878"
                          }
                        ]
                      },
                      {
                        "featureType": "landscape.man_made",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#334e87"
                          }
                        ]
                      },
                      {
                        "featureType": "landscape.natural",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#023e58"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#283d6a"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#6f9ba5"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#1d2c4d"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                          {
                            "color": "#023e58"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#3C7680"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#304a7d"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#98a5be"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#1d2c4d"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#2c6675"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#255763"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#b0d5ce"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#023e58"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#98a5be"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#1d2c4d"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.line",
                        "elementType": "geometry.fill",
                        "stylers": [
                          {
                            "color": "#283d6a"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#3a4762"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#0e1626"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#4e6d70"
                          }
                        ]
                      }
                    ],
                    { name: "Styled Map" }
                  );


                //Google map initial settings from here.
                  var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 3,
                    center: new google.maps.LatLng(-33.92, 151.25),
                    mapTypeControlOptions: {
                      mapTypeId: ["terrain", "styled_map"],
                    },
                  });

                  //Associate the styled map with the MapTypeId and set it to display.
                  map.mapTypes.set("styled_map", styledMapType);
                  map.setMapTypeId("styled_map");
                  
                  var infowindow = new google.maps.InfoWindow();

                  var marker, i;
                  var icon = {
                      url: "http://localhost:8080/wp-tester/wp-content/uploads/2022/03/green-red.png", 
                      scaledSize: new google.maps.Size(50, 50), 
                  };
                  for (i = 0; i < locations.length; i++) {  
                    marker = new google.maps.Marker({
                      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                      icon: icon,
                      map: map
                    });
                    
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                      return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                      }
                    })(marker, i));

                    console.log(marker);
                  }

            }
        });
    }

    
  </script>
    