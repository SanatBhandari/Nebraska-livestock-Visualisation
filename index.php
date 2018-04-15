<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Nebraska Livestock Visualisation</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/plugins/arc.js/v0.1.0/arc.js"></script>
    <style>
        #overlay {
             position: absolute;
             text-decoration: none;
              color: white;
              font-size: 11pt;
              left: 400px;
              top: 400px;
              font-weight: bold;
              text-shadow: black 0.1em 0.1em 0.2em;
             cursor: pointer; /* Add a pointer on hover */
           }
           table.controls td {
             text-align: center;
             padding: 2px 5px;
             min-width: 60px;
           }
    </style>
</head>

<body>
    <div class="container">
        <button id="overlay" type="button" class="btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#dataMenu">Data Options</button>
        <div id="dataMenu" class="collapse">
            <div class="panel-group">
                <div class="panel panel-default">
                    <form id="lstock" action="Database.php" method="get">
                        <div class="checkbox">
                            <label>
                        <input class="livestockSelector" type="checkbox" name="l1" value="04 Dairy Prods; Birds Eggs; Honey; Ed Animal Pr Nesoi">Bovine Animals, Live
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l2" value="0102 Bovine Animals, Live">Swine, Live
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l3" value="0103 Swine, Live">Chickens, Ducks, Geese, Turkeys, And Guineas, Live
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l4" value="0105 Chickens, Ducks, Geese, Turkeys, And Guineas, Live">Corn (maize)
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l5" value="1005 Corn (maize)">Corn (maize) Seed, Certified, Excluding Sweet Corn
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l6" value="100510 Corn (maize) Seed, Certified, Excluding Sweet Corn">Corn (maize), Other Than Seed Corn
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l7" value="100590 Corn (maize), Other Than Seed Corn">Corn (maize) Flour
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l8" value="110220 Corn (maize) Flour">Groats And Meal Of Corn (maize)
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l9" value="110423 Grains Worked (hulld Pearld Sliced Kibbld) Of Corn">Grains (Worked) Of Corn
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l10" value="151521 Corn (maize) Oil, Crude, Not Chemically Modified">Non- chemically modified crude Corn (maize) Oil
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l11" value="151529 Corn (maize) Oil, Refined, & Fractions, Not Modif">Refined and fractions Corn (maize) Oil (Not Modified)
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l12" value="230210 Bran Sharps & Oth Residues Derived Frm Millng Corn">Bran Sharps & Other Residues Derived From Millng Corn
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l13" value="230670 Corn Germ Oilcake Othr Solid Residue Wh/not Ground">Germ Oilcake
                        </label>
                            <br>
                            <label>  
                        <input class="livestockSelector" type = "checkbox" name ="l14" value="110812 Starch, Corn (maize)">Meat And Edible Meat Offal
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l15" value="02 Meat And Edible Meat Offal">Dairy Prods; Birds Eggs; Honey
                        </label>
                            <br>
                            <label>
                        <input class="livestockSelector" type = "checkbox" name ="l16" value="110313 Groats And Meal Of Corn (maize)">Starch, Corn (maize)<br>
                        </label>
                        </div>
                        <button type="submit" class="btn btn-default" on-click="sendYear()" data-target="#lstock">Submit</button>
                    </form>
                    <div id="overlay">
                        <button style="font-size : 12px; font-family: 'verdana';" type="button" onclick="sendYear()">Submit</button>

                        <p id="demo"></p>
                        <!-- <input type="range" min="2002" max="2017" value="2002" class="slider" id="myRange" color="green">
				 <output for="foo" onforminput="value = foo.valueAsNumber;"></output> -->
                        <tr>

                            <td>Year </td>
                            <td><input id="myRange" type="range" min="2002" max="2017" value="2002" color="black" /></td>
                            <td><output foo="foo" on forminput="value = foo.valueAsNumber;" /> </td>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="map" class="map"></div>

    <script type="text/javascript">
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
              minZoom: 1,
              maxZoom: 2
            })
          });
    
          var style = new ol.style.Style({
            stroke: new ol.style.Stroke({
              color: '#228B22',
              width: 2
            })
          });
    
          var flightsSource;
          var addLater = function(feature, timeout) {
            window.setTimeout(function() {
              feature.set('start', new Date().getTime());
              flightsSource.addFeature(feature);
            }, timeout);
          };
    
          var pointsPerMs = 0.05;
          var animateFlights = function(event) {
            var vectorContext = event.vectorContext;
            var frameState = event.frameState;
            vectorContext.setStyle(style);
    
            var features = flightsSource.getFeatures();
            for (var i = 0; i < features.length; i++) {
              var feature = features[i];
              if (!feature.get('finished')) {
                // only draw the lines for which the animation has not finished yet
                var coords = feature.getGeometry().getCoordinates();
                var elapsedTime = frameState.time - feature.get('start');
                var elapsedPoints = elapsedTime * pointsPerMs;
    
                if (elapsedPoints >= coords.length) {
                  feature.set('finished', true);
                }
    
                var maxIndex = Math.min(elapsedPoints, coords.length);
                var currentLine = new ol.geom.LineString(coords.slice(0, maxIndex));
    
                // directly draw the line with the vector context
                vectorContext.drawGeometry(currentLine);
              }
            }
            // tell OpenLayers to continue the animation
            map.render();
          };
    
          locationSource = new ol.source.Vector({
            wrapX: false,
            attributions: 'Flight data by ' +
                  '<a href="http://openflights.org/data.html">OpenFlights</a>,',
            loader: function() {
              var url = 'Database.php';
              fetch(url).then(function(response) {
                return response.json();
              }).then(function(json) {
                var locationsData = json.locations;
                for (var i = 0; i < flightsData.length; i++) {
                  var location = locationsData[i];
                  var from = locationsData[0];
                  var to = locationsData[1];
    
                  // create an arc circle between the two locations
                  var arcGenerator = new arc.GreatCircle(
                      {x: from[1], y: from[0]},
                      {x: to[1], y: to[0]});
    
                  var arcLine = arcGenerator.Arc(100, {offset: 10});
                  if (arcLine.geometries.length === 1) {
                    var line = new ol.geom.LineString(arcLine.geometries[0].coords);
                    line.transform(ol.proj.get('EPSG:4326'), ol.proj.get('EPSG:3857'));
    
                    var feature = new ol.Feature({
                      geometry: line,
                      finished: false
                    });
                    // add the feature with a delay so that the animation
                    // for all features does not start at the same time
                    addLater(feature, i * 50);
                  }
                }
                map.on('postcompose', animateFlights);
              });
            }
          });
    
          var flightsLayer = new ol.layer.Vector({
            source: flightsSource,
            style: function(feature) {
              // if the animation is still active for a feature, do not
              // render the feature with the layer style
              if (feature.get('finished')) {
                return style;
              } else {
                return null;
              }
            }
          });
          map.addLayer(flightsLayer);
    </script>

    <script>
        var slider = document.getElementById("myRange");
          var output = document.getElementById("demo");
    
          function colorTrace(msg, color) {
          console.log("%c" + msg, "color:" + color + ";font-weight:bold;");
      }
          colorTrace(slider.value, "green");
          console.log(slider.value);
          output.innerHTML = slider.value; // Display the default slider value
    
          // Update the current slider value (each time you drag the slider handle)
          slider.oninput = function() {
            output.innerHTML = this.value;
            // use ajax to pass values to the database.php page
          }
          console.log(slider.value);
    
          function sendYear(){
            var livestock_string = "(";
            var livestock_values = document.getElementsByClassName('livestockSelector');
            for (var i=0; i < livestock_values.length; i++){
              if(livestock_values[i].checked) {
                if (livestock_string.length == 1){
                  livestock_string = livestock_string + "'" + livestock_values[i].value + "'";
                } else {
                  livestock_string = livestock_string + ", '" + livestock_values[i].value + "'";
                }
              }
            }
            livestock_string = livestock_string + ")";
            $.ajax({
              type: 'POST',
              data: {'val': slider.value, 'livestock': livestock_string},
              dataType:'json',
              url: 'Database.php',
              success: function(query_result){
                console.log(JSON.parse(query_result));
                dataset = JSON.parse(query_result);
                //google.charts.setOnLoadCallback(drawRegionsMap);
                map.addLayer(flightsLayer);
              },
              error: function(request, status, error){
            alert("Error: Could not find");
          }
            });
          }
    </script>
</body>

</html>