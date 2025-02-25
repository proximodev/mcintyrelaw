<?php /* Template Name: Accident Tool */ ?>

<?php get_header(); ?>

<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/vendors/leaflet/leaflet.css"/>
<script src="<?php bloginfo( 'template_directory' ); ?>/vendors/leaflet/leaflet.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/vendors/leaflet/heatmap.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/vendors/leaflet/leaflet-heatmap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  #map { height: 500px; width: 100%; margin: auto; z-index: 0; }
  #heatmap, #heatmap-ytd { height: 500px; width: 100%; margin: auto; z-index: 0; }
  .sidebar {
    margin-top: 30px;
    background-color: #881e1c;
    border-radius: 5px;
    border: 1px solid black;
    box-shadow: 0px 0px 10px rgba(0,0,0,.25);
    padding: 40px 30px 0;
  }
  .sidebar a {
    text-decoration: underline;
  }
  .sidebar a:hover {
    text-decoration: none;
  }
  .stats {
    border-radius: 4px;
    background-color: #FFFFFF;
  }
  .stats .top {
    background-color: #E32F2F;
    border-radius: 4px 4px 0 0;
  }
  .stats .top p {
    margin:0;
    padding: 10px;
    color: #FFFFFF;
  }
  .stats .bottom {
    margin:0;
    padding:0;
    border-radius: 0 0 4px 4px;
    font-size: 24px;
  }
  .stats .bottom p {
    margin-bottom: 25px;
    padding: 10px 0;
  }
  .leaflet-bar, .leaflet-control-layers {
    border: 2px solid #881e1c !important;
  }
  .leaflet-bar a {
    border-bottom: 1px solid #881e1c;
  }
  .leaflet-control-layers-separator {
    border-top: 1px solid #881e1c;
  }
  .leaflet-control-zoom-in, .leaflet-control-zoom-out {
    color: #881e1c !important;
  }
  .logo-control {
    border: none !important;
  }
  .logo-control a {
    background: none !important;
  }
  .leaflet-container input[type=radio], .leaflet-container input[type=checkbox] {
    accent-color: #881e1c;
  }
  .leaflet-control-layers label {
    font-size: 12px;
  }
  .leaflet-popup-content {
    /* margin: 15x; */
    font-size: 11px;
  }
  .sidebar ul {
    list-style: none;
    padding-left: 5px;
    padding-top: 20px;
    padding-bottom: 20px;
  }
  ul.stats li {
    padding: 10px 15px;
  }
  @media screen and (max-width: 991px) {
    .mobile-flex {
      display: flex;
      flex-direction: column;
    }
    .mobile-flex .mobile-order-2 {
      order: 2;
    }
    .mobile-flex .mobile-order-1 {
      order: 1;
    }
    .sidebar {
      max-width: 400px;
      margin: auto;
    }
    #map {
      height: 350px;
    }
  }
  h4 {
    margin-bottom: 10px;
  }
  .bg-gray {
    background-color: #FAFAFA;
  }
  .markers > li {
    padding-left: 2em;
  }
  .markers {
    font-family: 'Libre Baskerville', serif;
    font-size: 18px;
    font-weight: 700;
    color: #7e0609;
    padding-left: 50px;
  }
  .markers p {
    font-family: 'Open Sans', sans-serif;
    color: #3e3e3e;
    font-weight: 400;
  }
  section p, .section p {
    font-size: 18px;
  }
  hr.single {
    width: 100%;
    border-top-width: 1px;
    border-top-color: #d9d9d9;
    border-top-style: single;
  }
</style>

<div class="container">
  <div class="row mobile-flex">
    <div class="sidebar col-md-3 mobile-order-2">
      <img class="img-svg img-responsive mb-40" style="min-height: 43px;" alt="McIntyre Law P.C." src="https://mcintyrelaw.com/wp-content/themes/mcintyre-law/img/logos/mcintyre-law.svg">
      <div class="stats">
        <div class="top">
          <p class="text-center text-light"><strong>Accidents in OKC today:</strong></p>
        </div>
        <div class="bottom">
          <p class="text-center" id="accidents-today"> </p>
        </div>
      </div>

      <div class="stats">
        <div class="top">
          <p class="text-center text-light"><strong>Accidents this month:</strong></p>
        </div>
        <div class="bottom">
          <p class="text-center" id="accidents-this-month"> </p>
        </div>
      </div>

      <div class="stats">
        <div class="top">
          <p class="text-center text-light"><strong>Accidents this year:</strong></p>
        </div>
        <div class="bottom">
          <p class="text-center" id="accidents-this-year"> </p>
        </div>
      </div>
      <div class="stats">
        <ul class="stats">
          <li><a href="#dangerous-roads" class="text-body">Discover Oklahoma City's most dangerous roads this month</a></li>
          <li><a href="<?php bloginfo('url') ?>/what-happens-after-an-accident/" class="text-body">What to do if you've been injured in an accident</a></li>
          <li><a href="<?php bloginfo('url') ?>/resources/avoiding-commercial-truck-accidents/" class="text-body">How to avoid truck accidents</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-8 col-md-offset-1 mobile-order-1 section">
      <h1>Oklahoma City Traffic Accidents</h1>
      <p class="mt-40">
        This is a map of traffic accidents in Oklahoma City today. Zoom in to see the exact street where the accident took place and if the crash involved injuries to motorists.
      </p>
      <div id="map"></div>
      <p class="mt-40">
        Check back often as we increase our understanding of the most dangerous roads in Oklahoma City—information that can keep you and your family safe on the road.
      </p>
    </div>
  </div>
</div>

<section class="mt-40">
  <div class="container-full bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-4">
          <h2 class="text-center">Traffic Accident Trends in Oklahoma City</h2>
          <h3 class="text-center text-secondary">Vehicle accidents this month</h3>
          <canvas id="month-chart" class="mb-40"></div>
      </div>
    </div>
  </div>
  </div>
</section>

<section class="mt-40 mb-40">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-4">
        <h2 id="dangerous-roads">Oklahoma City's Most Dangerous Roads</h2>
        <p>Our maps use data from the City of Oklahoma City on traffic accident severity and location. While the city primarily uses this information to understand how traffic flow is affected in real time, our goal is to identify patterns in accident location and severity over time. Knowing where Oklahoma City's traffic accidents happen the most can help keep you safe while on the road.</p>
        <p class="mt-40">The map below shows the accident history of roads, highways and intersections across Oklahoma City during the last month. Roads marked in red were the scene of the most accidents. Be sure to check back often to see whether any of the routes you travel are among Oklahoma City's most dangerous intersections and roads.</p>
        <hr class="single">
        <h3>Where did most Oklahoma City traffic accidents happen in December?</h3>
        <div style="height:400px; background:#444444;" id="heatmap"></div>
        
		<h4>I-240 at S. Western Ave.</h4>
        <p>The exit to S. Western Ave. was the most dangerous section of I-240 in November. Proximity to the Will Rogers Airport and an increase in November holiday travel likely contributed to this increase.</p>
		  
        <h4>Northwest Expressway at I-44</h4>
        <p>In November, the convergence of the Northwest Expressway and I-44 in north-central Oklahoma City experienced a higher-than-normal number of accidents. Traffic bound for routes 3 and 66 are funneled through this high-traffic interchange. Use caution when traveling this stretch of road in Oklahoma City.</p>
        
		<h4>I-40 at Meridian Ave. and MacArthur Ave.</h4>
        <p>This section of I-40 is a high-traffic area that consistently experiences car accidents. Vehicles entering and exiting I-40 and traffic along the parallel section of Reno Ave. make this area one of the most dangerous areas of Oklahoma City.</p>
        
		 <h4>Memorial Rd and the Kilpatrick Turnpike at N. Pennsylvania Ave</h4>
        <p>The Kilpatrick Turnpike and N. Pennsylvania Ave. intersection consistently ranks among the most dangerous in Oklahoma City. November was no exception, and given the shopping destinations that dominate the area, December will likely see an increase in traffic and accidents in the area.</p>
		  
        <hr class="single">
        <h3>What are Oklahoma City’s most dangerous roads of 2025?</h3>
        <p>Oklahoma City’s emergency services share the locations of accidents with the public in real time, which can help you determine whether travel delays are likely. However, when an accident is cleared, it disappears from their map.
        <p>Our maps save the location of each accident so you can see where the most accidents are happening today and what roads were the most dangerous last month.
        <p>Ultimately, we want to know which locations are causing the most accidents over the long term. Some road sections are impacted by seasonal or event-based traffic increases, but we’ve created the map below to show you where accidents have been more likely to happen this year.
        <div style="height:400px; background:#444444;" id="heatmap-ytd"></div>
      </div>
    </div>
  </div>
</section>


<section class="mt-40 mb-40">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-2">
        <h2>Were you involved in an accident in Oklahoma City?</h2>
        <p>
          If you’ve been injured in a traffic accident in Oklahoma City, it’s important to make sure someone is looking out for your interests. Contact our team at McIntyre Law today to see how we can help you.
        </p>
        <a class="btn btn-primary" href="<?php bloginfo('url') ?>/contact-us/">Contact Us</a>
        <a class="btn btn-secondary" href="tel:18779175250"><span class="glyphicon glyphicon-earphone text-small"></span> (877) 917-5250</a>
      </div>
      <div class="col-md-5">
        <img src="<?php bloginfo( 'template_directory' ); ?>/img/resources/car-crash-okc.jpg" alt="What to do if you have been involved in a traffic accident." class="img-responsive mt-40" style="aspect-ratio: 5/4; object-fit: cover; border-radius: 5px;"/>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>

<script>
  // Get today's date in Oklahoma City
  var today = new Date(new Date().toLocaleString("en-US", {timeZone: "America/Chicago"}));
  var year = today.toLocaleString("default", { year: "numeric" });
  var month = today.toLocaleString("default", { month: "2-digit" });
  var prettyMonth = today.toLocaleString("default", { month: "long" });
  var day = today.toLocaleString("default", { day: "2-digit" });
  var hour = today.toLocaleString("default", { hour: "2-digit" });
  var date = year + "-" + month + "-" + day;

  // Retrieve this month's accident data file
  var month_file = '<?php bloginfo( 'template_directory' ); ?>/data/' + year + "-" + month + ".json";
  fetch(month_file)
          .then((res) => res.text())
          .then((text) => {
            var stats = JSON.parse(text);
            count = stats.length;
            let target = document.getElementById('accidents-this-month');
            target.innerHTML = count;
          })
          .catch((e) => console.error(e));

  // Build month chart
  var month_stats = '<?php bloginfo( 'template_directory' ); ?>/data/stats-' + year + "-" + month + ".json";
  fetch(month_stats)
          .then((res) => res.text())
          .then((text) => {
            var stats = JSON.parse(text);
            // count = stats.length;

            var labels = stats.map(function(e) {
              return e.day;
            });
            var data = stats.map(function(e) {
              return e.count;
            });

            new Chart("month-chart", {
              type: "line",
              data: {
                labels: labels,
                datasets: [{
                  backgroundColor:"rgba(48,84,134,1.0)",
                  borderColor: "rgba(48,84,134,1.0)",
                  data: data
                }]
              },
              options: {
                borderWidth: 1.5,
                animation: false,
                plugins: {
                  legend: {
                    display: false
                  },
                  tooltip: {
                    callbacks: {
                      title: function(context) {
                        return '';
                      }
                    },
                    displayColors: false
                  }
                },
                scales: {
                  x: {
                    title: {
                      display: true,
                      text: 'Day of Month (' + prettyMonth + ')',
                      // color: 'rgba(48,84,134,1.0)',
                      font: {
                        weight: 'bold',
                        size: 16,
                        lineHeight: 2,
                        family: 'Libre Baskerville'
                      }
                    },
                    ticks: {
                      // color: 'rgba(48,84,134,1.0)',
                      font: {
                        weight: 'bold'
                      }
                    }
                  },
                  y: {
                    title: {
                      display: true,
                      text: 'Number of Accidents',
                      font: {
                        weight: 'bold',
                        size: 16,
                        lineHeight: 2,
                        family: 'Libre Baskerville'
                      }
                    },
                    ticks: {
                      font: {
                        weight: 'bold'
                      }
                    }
                  }
                }
              }
            });
          })
          .catch((e) => console.error(e));

  // Retrieve this years's accident data file
  var year_file = '<?php bloginfo( 'template_directory' ); ?>/data/' + year + ".json";
  fetch(year_file)
          .then((res) => res.text())
          .then((text) => {
            var stats = JSON.parse(text);
            count = stats.length;
            let target = document.getElementById('accidents-this-year');
            target.innerHTML = count;
          })
          .catch((e) => console.error(e));

  // Retrieve and map today's accident data file
  var data_file = '<?php bloginfo( 'template_directory' ); ?>/data/' + date + '.json';
  console.log(data_file);

  fetch(data_file)
          .then((res) => res.text())
          .then((text) => {
            var data = JSON.parse(text);

            // Place stat in sidebar
            count = data.length;
            let target = document.getElementById('accidents-today');
            target.innerHTML = count;

            const injury = L.layerGroup();
            const noninjury = L.layerGroup();

            var customIcon = L.Icon.extend({
              options: {
                iconSize:     [36, 50],
                popupAnchor:  [0, -5]
              }
            });

            var injuryIcon = new customIcon({iconUrl: '<?php bloginfo( 'template_directory' ); ?>/img/icons/ambulance-icon.png'}),
                    noninjuryIcon = new customIcon({iconUrl: '<?php bloginfo( 'template_directory' ); ?>/img/icons/car-crash-icon.png'});

            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });

            const map = L.map('map', {
              center: [35.5,-97.5],
              zoom: 10,
              layers: [osm, injury, noninjury],
              scrollWheelZoom: false //disable scroll zoom
            });

            const bases = {
              "OpenStreetMap": osm
            };

            const overlays = {
              "Injury Accident": injury,
              "Non-Injury Accident": noninjury
            };

            const layerControl = L.control.layers(bases,overlays,{collapsed:false}).addTo(map);

            L.LogoControl = L.Control.extend({
              options: {
                position: 'bottomleft'
                // control position - allowed: 'topleft', 'topright', 'bottomleft', 'bottomright'
              },

              onAdd: function (map) {
                var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control logo-control');
                var button = L.DomUtil.create('a', '', container);
                button.innerHTML = '<img width="100%" class="logo-control-img" src="<?php bloginfo( 'template_directory' ); ?>/img/logos/favicon.png">';
                L.DomEvent.disableClickPropagation(button);
                container.title = "McIntyre Law logo";

                return container;
              },
            });

            new L.LogoControl().addTo(map);

            let i;
            let icon = [];

            data.forEach( row => {

              let address = row[0];
              let timestamp = row[1];
              let category = row[2];
              let loc = row[3].split(',');
              let lat = loc[0];
              let lon = loc[1];

              if (category.startsWith('INJURY ACCIDENT')) {
                icon[i] = L.marker([lat,lon], {icon: injuryIcon}).bindPopup(address+'<br>'+timestamp+'<br>'+category).addTo(injury);
              }
              else {
                icon[i] = L.marker([lat,lon], {icon: noninjuryIcon}).bindPopup(address+'<br>'+timestamp+'<br>'+category).addTo(noninjury);
              }

              i++;

            })

            let accidents_today = data.length;

          })
          .catch((e) => console.error(e));

  // Build heatmap

  // Month heatmap
  let currentYear = new Date().getFullYear();
  let currentMonth = new Date().getMonth() + 1;
  let { year: adjustedYear, month: adjustedMonth } = getLastMonthAndYear(currentYear, currentMonth);

  let heatmapMonthFile = `<?php bloginfo('template_directory'); ?>/data/heatmap-${adjustedYear}-${adjustedMonth}.json`;
  let heatmapMonthContainerID = "heatmap";
  buildHeatMap(heatmapMonthFile, heatmapMonthContainerID);
  console.log(heatmapMonthFile);

  // Year heatmap
  var heatmapYearFile = '<?php bloginfo( 'template_directory' ); ?>/data/heatmap-' + year + '.json';
  var heatmapYearContainerID = "heatmap-ytd";
  buildHeatMap(heatmapYearFile,heatmapYearContainerID);
  console.log(heatmapYearFile);

  function buildHeatMap(heatmapfile, containerID) {

    fetch(heatmapfile)
            .then((res) => res.text())
            .then((text) => {
              var data = JSON.parse(text);
              var results = [];
              data.forEach(row => {
                let loc = row[0].split(',');
                let lat = loc[0];
                let lng = loc[1];
                let count = row[1];
                // let count = Math.random()*100;
                results.push({
                  lat,
                  lng,
                  count
                });
              });

              var myData = {
                max: 8,
                data: results
              };

              var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
              });

              var mybaseLayer = L.tileLayer(
                      'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '...',
                        maxZoom: 18
                      }
              );

              var cfg = {
                // "container": document.getElementById('heatmapContainer'),
                "radius": .005,
                "maxOpacity": .7,
                "minOpacity": 0,
                // "blur": .75,
                // scales the radius based on map zoom
                "scaleRadius": true,
                // if set to false the heatmap uses the global maximum for colorization
                // if activated: uses the data maximum within the current map boundaries
                //   (there will always be a red spot with useLocalExtremas true)
                // "useLocalExtrema": true,
                // which field name in your data represents the latitude - default "lat"
                // latField: 'lat',
                // which field name in your data represents the longitude - default "lng"
                // lngField: 'lng',
                // which field name in your data represents the data value - default "value"
                valueField: 'count',
                gradient: {
                  // enter n keys between 0 and 1 here
                  // for gradient color customization
                  // '.1': '#FFFF00',
                  // '.2': '#FFFF77',
                  // '.2': '#FFFFBB',
                  // '.2': '#FFA500',
                  // '.5': '#FF5555',
                  // '.5': '#FF4444',
                  // '.5': '#FF3333',
                  // '.8': '#FF2222',
                  // '.9': '#FF1111',
                  // '1': '#FF0000'
                  '.1': 'yellow',
                  '.6': 'orange',
                  '1': 'red'
                }
              };

              var Esri_WorldGrayCanvas = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri — Esri, DeLorme, NAVTEQ',
                maxZoom: 16
              });

              var CartoDB_Positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors © <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
              });

              var heatmapLayer = new HeatmapOverlay(cfg);

              var myHeatmap = new L.Map(containerID, {
                // center: new L.LatLng(25.6586, -80.3568),
                // zoom: 4,
                layers: [osm, heatmapLayer],
                center: [35.5, -97.5],
                zoom: 11,
                // layers: [osm, injury, noninjury],
                scrollWheelZoom: false //disable scroll zoom
              });

              heatmapLayer.setData(myData);


            });

  }

  // Get the previous month and adjust the year if needed
  function getLastMonthAndYear(year, month) {
    let num = parseInt(month);
    let last_month = num - 1;
    if (last_month === 0) {
        last_month = 12; // December
        year = year - 1; // Adjust to the previous year
    }
    let monthString = last_month.toString().padStart(2, "0"); // Ensure two-digit format
    return { year: year, month: monthString };
  }


</script>