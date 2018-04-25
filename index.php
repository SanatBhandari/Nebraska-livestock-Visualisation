<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/plugins/arc.js/v0.1.0/arc.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Nebraska Livestock Visualisation
    </title>
  </head>
  <body>
    <div id="map" class="map"></div>

	<div>
      <button id="optionsOverlay" type="button" class="btn btn-primary" onclick="openNav()">Data Options
      </button>
    </div>
    <div id="dataNav" class="overlay">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;
      </a>
      <div class="overlay-content">
        <!-- <form id="lstock" action="Database.php" method="get"> -->
        <form id="lstock">
          <div class="checkbox">
            
              <input class="livestockSelector" type="checkbox" id="l1" value="04 Dairy Prods; Birds Eggs; Honey; Ed Animal Pr Nesoi">
              <label>Bovine Animals, Live</label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l2" value="0102 Bovine Animals, Live"><label>Swine, Live</label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l3" value="0103 Swine, Live"><label>Chickens, Ducks, Geese, Turkeys, And Guineas, Live
            </label>
            <br>
           
              <input class="livestockSelector" type = "checkbox" id ="l4" value="0105 Chickens, Ducks, Geese, Turkeys, And Guineas, Live"><label>Corn (maize)
            </label>
            <br>

              <input class="livestockSelector" type = "checkbox" id ="l5" value="1005 Corn (maize)"><label>Corn (maize) Seed, Certified, Excluding Sweet Corn
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l6" value="100510 Corn (maize) Seed, Certified, Excluding Sweet Corn"><label>Corn (maize), Other Than Seed Corn
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l7" value="100590 Corn (maize), Other Than Seed Corn"><label>Corn (maize) Flour
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l8" value="110220 Corn (maize) Flour"><label>Groats And Meal Of Corn (maize)
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l9" value="110423 Grains Worked (hulld Pearld Sliced Kibbld) Of Corn"><label>Grains (Worked) Of Corn
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l10" value="151521 Corn (maize) Oil, Crude, Not Chemically Modified"><label>Non- chemically modified crude Corn (maize) Oil
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l11" value="151529 Corn (maize) Oil, Refined, & Fractions, Not Modif"><label>Refined and fractions Corn (maize) Oil (Not Modified)
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l12" value="230210 Bran Sharps & Oth Residues Derived Frm Millng Corn"><label>Bran Sharps & Other Residues Derived From Millng Corn
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l13" value="230670 Corn Germ Oilcake Othr Solid Residue Wh/not Ground"><label>Germ Oilcake
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l14" value="110812 Starch, Corn (maize)"><label>Meat And Edible Meat Offal
            </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l15" value="02 Meat And Edible Meat Offal"><label >Dairy Prods; Birds Eggs; Honey </label>
            <br>
            
              <input class="livestockSelector" type = "checkbox" id ="l16" value="110313 Groats And Meal Of Corn (maize)"><label>Starch, Corn (maize)</label>
              <br>
            
          </div>
          <div class="slider navOptionSlider">
            <input id="yearRange" type="range" min="2002" max="2017" value="2002" color="white"/>
            <output foo="foo" on forminput="value = foo.valueAsNumber;" />
            <p id="yearValue" class="navOptionSlider">
            </p>
          </div>
          <button id="navOptionSubmit" type="submit" onclick="sendYear();">Submit
          </button>
          </div>
        </form>
    </div>
    </div>

  <script>
    function openNav() {
      document.getElementById("dataNav").style.width = "40%";
    }
    function closeNav() {
      document.getElementById("dataNav").style.width = "0%";
    }
  </script>
  <script>
      var map = new ol.Map({
        layers: [
          new ol.layer.Tile({
			source: new ol.source.OSM()
          })
        ],
        target: 'map',
        view: new ol.View({
          center: [0, 0],
		  zoom: 2,
		  maxZoom: 3,
		  minZoom: 1
        })
      });

      var style = new ol.style.Style({
        stroke: new ol.style.Stroke({
			color: '#228B22',
			width: 2
		})
      });

      //TRY WITH A SIMPLE VERSION OF MAP, NO STYLING


      //
      // var flightsSource;
      // var addLater = function(feature, timeout) {
      //   window.setTimeout(function() {
      //     feature.set('start', new Date().getTime());
      //     flightsSource.addFeature(feature);
      //   }, timeout);
      // };
      //
      // var pointsPerMs = 0.1;
      // var animateFlights = function(event) {
      //   var vectorContext = event.vectorContext;
      //   var frameState = event.frameState;
      //   vectorContext.setStyle(style);
      //
      //   var features = flightsSource.getFeatures();
      //   for (var i = 0; i < features.length; i++) {
      //     var feature = features[i];
      //     if (!feature.get('finished')) {
      //       // only draw the lines for which the animation has not finished yet
      //       var coords = feature.getGeometry().getCoordinates();
      //       var elapsedTime = frameState.time - feature.get('start');
      //       var elapsedPoints = elapsedTime * pointsPerMs;
      //
      //       if (elapsedPoints >= coords.length) {
      //         feature.set('finished', true);
      //       }
      //
      //       var maxIndex = Math.min(elapsedPoints, coords.length);
      //       var currentLine = new ol.geom.LineString(coords.slice(0, maxIndex));
      //
      //       // directly draw the line with the vector context
      //       vectorContext.drawGeometry(currentLine);
      //     }
      //   }
      //   // tell OpenLayers to continue the animation
      //   map.render();
      // };

      // flightsSource = new ol.source.Vector({
      //   wrapX: false,
      //   attributions: 'Flight data by ' +
      //         '<a href="http://openflights.org/data.html">OpenFlights</a>,',
      //   loader: function() {
      //     var url = 'https://openlayers.org/en/v4.6.5/examples/data/openflights/flights.json';
      //     fetch(url).then(function(response) {
      //       return response.json();
      //     }).then(function(json) {
      //       var flightsData = json.flights;
      //       for (var i = 0; i < flightsData.length; i++) {
      //         var flight = flightsData[i];
      //         var from = flight[0];
      //         var to = flight[1];
      //
      //         // create an arc circle between the two locations
      //         var arcGenerator = new arc.GreatCircle(
      //             {x: from[1], y: from[0]},
      //             {x: to[1], y: to[0]});
      //
      //         var arcLine = arcGenerator.Arc(100, {offset: 10});
      //         if (arcLine.geometries.length === 1) {
      //           var line = new ol.geom.LineString(arcLine.geometries[0].coords);
      //           line.transform(ol.proj.get('EPSG:4326'), ol.proj.get('EPSG:3857'));
      //
      //           var feature = new ol.Feature({
      //             geometry: line,
      //             finished: false
      //           });
      //           // add the feature with a delay so that the animation
      //           // for all features does not start at the same time
      //           addLater(feature, i * 50);
      //         }
      //       }
      //       map.on('postcompose', animateFlights);
      //     });
      //   }
      // });

      // var flightsLayer = new ol.layer.Vector({
      //   source: flightsSource,
      //   style: function(feature) {
      //     // if the animation is still active for a feature, do not
      //     // render the feature with the layer style
      //     if (feature.get('finished')) {
      //       return style;
      //     } else {
      //       return null;
      //     }
      //   }
      // });
      // map.addLayer(flightsLayer);
    </script>
 <script type="text/javascript">
    var slider = document.getElementById("yearRange");
    var output = document.getElementById("yearValue");
    console.log(slider.value);
    output.innerHTML = slider.value;
    // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
	slider.oninput = function() {
      output.innerHTML = this.value;
    }

	// use ajax to pass values to the database.php page
	function sendYear(){
		console.log(slider.value);
      var livestock_string = "(";
      var livestock_values = document.getElementsByClassName('livestockSelector');
      for (var i=0; i < livestock_values.length; i++){
        if(livestock_values[i].checked) {
          if (livestock_string.length == 1){
            livestock_string = livestock_string + "'" + livestock_values[i].value + "'";
          }
          else {
            livestock_string = livestock_string + ", '" + livestock_values[i].value + "'";
          }
        }
      }
      livestock_string = livestock_string + ")";
      console.log(livestock_string);
       $.ajax({
        type: 'POST',
        data: {'val': slider.value, 'livestock': livestock_string},
        dataType:'json',
        url: 'Database.php',
        success: function(query_result){
		  // alert("Success!");
          console.log(JSON.parse(query_result));
          dataset = JSON.parse(query_result);
          // map.addLayer(dataLayer);
        },

      })
   }

  </script>
  </body>
</html>
