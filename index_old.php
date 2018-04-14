<html>
  <head>
    <style>
      input.mysubmitbutton{
    font-family: 'Orator Std';
}

    </style>
  <!-- <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);
      dataset =  [['Country', 'sfsdf']];
      console.log(dataset);
      function drawRegionsMap(d = dataset) {
      console.log(d);
        var data = google.visualization.arrayToDataTable(d);

        // var options = {}; #8DEEEE
        var options = {
          backgroundColor: '#63B8FF'
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script> -->
  </head>
 <body bgcolor="#63B8FF">


  <div id="regions_div" style="width: 1470px; height: 890px;"></div>
  <div class="slidecontainer">
    <br>
  <input type="range" min="2002" max="2017" value="2002" class="slider" id="myRange" color="green">
  <output for="foo" onforminput="value = foo.valueAsNumber;"></output>
  </div>

  <p id="demo">dummy</p>

  <br>
  <form id ="lstock" action = "/Database.php" method = "get">
      <input class = "livestockSelector" type = "checkbox" name ="l1" value="04 Dairy Prods; Birds Eggs; Honey; Ed Animal Pr Nesoi"><font face="verdana" color="green">Bovine Animals, Live</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l2" value="0102 Bovine Animals, Live"><font face="verdana" color="green">Swine, Live</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l3" value="0103 Swine, Live"><font face="verdana" color="green">Chickens, Ducks, Geese, Turkeys, And Guineas, Live</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l4" value="0105 Chickens, Ducks, Geese, Turkeys, And Guineas, Live"><font face="verdana" color="green">Corn (maize)</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l5" value="1005 Corn (maize)"><font face="verdana" color="green">Corn (maize) Seed, Certified, Excluding Sweet Corn</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l6" value="100510 Corn (maize) Seed, Certified, Excluding Sweet Corn"><font face="verdana" color="green">Corn (maize), Other Than Seed Corn</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l7" value="100590 Corn (maize), Other Than Seed Corn"><font face="verdana" color="green">Corn (maize) Flour</font><br>
      <input class = "livestockSelector" type = "checkbox" name ="l8" value="110220 Corn (maize) Flour"><font face="verdana" color="green">Groats And Meal Of Corn (maize)<br>
      <input class = "livestockSelector" type = "checkbox" name ="l9" value="110423 Grains Worked (hulld Pearld Sliced Kibbld) Of Corn">Grains (Worked) Of Corn<br>
      <input class = "livestockSelector" type = "checkbox" name ="l10" value="151521 Corn (maize) Oil, Crude, Not Chemically Modified">Non- chemically modified crude Corn (maize) Oil<br>
      <input class = "livestockSelector" type = "checkbox" name ="l11" value="151529 Corn (maize) Oil, Refined, & Fractions, Not Modif">Refined and fractions Corn (maize) Oil (Not Modified)<br>
      <input class = "livestockSelector" type = "checkbox" name ="l12" value="230210 Bran Sharps & Oth Residues Derived Frm Millng Corn">Bran Sharps & Other Residues Derived From Millng Corn<br>
      <input class = "livestockSelector" type = "checkbox" name ="l13" value="230670 Corn Germ Oilcake Othr Solid Residue Wh/not Ground">Germ Oilcake<br>
      <input class = "livestockSelector" type = "checkbox" name ="l14" value="110812 Starch, Corn (maize)">Meat And Edible Meat Offal<br>
      <input class = "livestockSelector" type = "checkbox" name ="l15" value="02 Meat And Edible Meat Offal">Dairy Prods; Birds Eggs; Honey<br>
      <input class = "livestockSelector" type = "checkbox" name ="l16" value="110313 Groats And Meal Of Corn (maize)">Starch, Corn (maize)<br>
  </form>
  <br>
  <button style="font-size : 12px; font-family: 'verdana';" type="button" onclick="sendYear()">Submit</button>

  <script type="text/javascript">
  var map = new ol.Map({
    view: new ol.View({
      center: [0, 0],
      zoom: 1
    }),
    layers: [
      new ol.layer.Tile({
        source: new ol.source.OSM()
      })
    ],
    target: 'map'
  });

    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");

    function colorTrace(msg, color) {
    console.log("%c" + msg, "color:" + color + ";font-weight:bold;");
}
    colorTrace(slider.value, "green");
    //console.log(slider.value);
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
      output.innerHTML = this.value;
      // use ajax to pass values to the database.php page
    }

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
        url: 'Database.php',
        success: function(query_result){
          console.log(JSON.parse(query_result));
          dataset = JSON.parse(query_result);
          //google.charts.setOnLoadCallback(drawRegionsMap);
        }
      });
    }
    </script>
  </body>
</html>
