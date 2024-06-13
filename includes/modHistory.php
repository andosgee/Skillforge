<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Completed', 'Module Count'],
          ['Completed',     5],
          ['Incomplete',      1]
        ]);

        var options = {
          title: 'Completed Modules'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<div class="content">
    <div class="content__wrapper">
    <div class="content__history">
            <h1 class="content__history__title">Module History</h1>
            <p class="content__history__descriptor">Your history of completed modules. </p>
            <div id="piechart"></div>
            <div class="content__tiles">
                <div class="content__tiles__item">
                    <h2>Technical Skills Training</h2>
                    Hands-on training for job-specific software, tools, and technologies relevant to the employee's role
                    <p></p>
                    <img src="./assets/image/assets/sampleModules/technical.jpg" alt="Technical Skills Training Image" class="content__tiles__item__image">
                </div>
                <div class="content__tiles__item">
                    <h2>Site Induction</h2>
                    Welcome to the organisation
                    <p></p>
                    <img src="./assets/image/assets/sampleModules/induction.png" alt="Site Induction Image" class="content__tiles__item__image">
                </div>
                <div class="content__tiles__item">
                    <h2>Cybersecurity Awareness</h2>
                    Strategies for prioritising tasks, managing time effectively, and using productivity tools to maximize efficiency
                    <p></p>
                    <img src="./assets/image/assets/sampleModules/cybersecurity.jpg" alt="Cybersecurity Awareness Image" class="content__tiles__item__image">
                </div>
                <div class="content__tiles__item">
                    <h2>Time Management and Productivity</h2>
                    Modernizing the modules for today's needs.
                    <p></p>
                    <img src="./assets/image/assets/sampleModules/time.jpg" alt="Time Management and Productivity Image" class="content__tiles__item__image">
                </div>
                <div class="content__tiles__item">
                    <h2>Innovation and Creativity</h2>
                    Techniques for fostering innovation, brainstorming methods, and encouraging creative problem-solving
                    <p></p>
                    <img src="./assets/image/assets/sampleModules/innovation.jpg" alt="Innovation and Creativity Image" class="content__tiles__item__image">
                </div>
            </div>
        </div>
    </div>
</div>