<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      var chart;  // Define chart variable in a scope accessible by both functions

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Module Category', 'Compliance', 'Required', 'Skills', 'Optional', 'Incomplete Required', 'Incomplete Compliance', 'Average'],
          ['2020',  34, 109, 67, 80, 49, 110, 74.83],
          ['2021',  24, 95, 71, 37, 133, 99, 76.5 ],
          ['2022',  51, 85, 29, 74, 62, 137, 73.0],
          ['2023',  57, 22, 134, 43, 50, 137, 73.83],
          ['2024',  14, 99, 60, 98, 124, 137, 88.67]
        ]);

        var options = {
          title: 'Modules completed Per Year by Category',
          vAxis: {title: 'Module Count'},
          hAxis: {title: 'F.Y Year'},
          seriesType: 'bars',
          series: {6: {type: 'line'}}
        };

        chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      function downloadChart() {
        var imgUri = chart.getImageURI();
        var link = document.createElement('a');
        link.href = imgUri;
        link.download = 'chart.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }
    </script>

<div class="content">
    <div class="content__wrapper">
    <div id="chart_div"></div>
    <input onclick="downloadChart()" name="form__submitInput" type="submit" value="Download As Image" class="form__submitInput">
    </div>
</div>