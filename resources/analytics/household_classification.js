!function (document, window, $) {
    "use strict";
  
            // Load the Visualization API and the piechart package.
            google.charts.load('current', {'packages': ['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                
                var baseURL = "http://" + window.location.host + "/hes/";
                var urlB = baseURL + "analytics/household_classification/";
                var jsonData = $.ajax({
                    url: urlB,
                    dataType: "json",
                    async: false
                }).responseText;
               var options = {
                    legend: { position: 'right', alignment: 'start' },
               title: 'Household Classification',
              is3D: 'true',
              width: 500,
              height: 300
            };
                // Create our data table out of JSON data loaded from server.
                var data = new google.visualization.DataTable(jsonData);

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }

}
(document, window, jQuery);




