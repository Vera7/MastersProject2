<script type="text/javascript">

    $(document).ready(function() {

      var options = {
        chart: {
          renderTo: 'container',
          type: 'column'
        },
        title: {
          text: 'Fruit Consumption'
        },
        xAxis: {
          categories: []
        },
        yAxis: {
          title: {
            text: 'Units'
          }
        },
        series: []
      };
      
      /*
       Load the data from the CSV file. This is the contents of the file:
       
        Apples,Pears,Oranges,Bananas,Plums
        John,8,4,6,5
        Jane,3,4,2,3
        Joe,86,76,79,77
        Janet,3,16,13,15
        
       */ 

      $.get('data.csv', function(data) {
        // Split the lines
        var lines = data.split('\n');
        $.each(lines, function(lineNo, line) {
          var items = line.split(',');
          
          // header line containes categories
          if (lineNo == 0) {
            $.each(items, function(itemNo, item) {
              if (itemNo > 0) options.xAxis.categories.push(item);
            });
          }
          
          // the rest of the lines contain data with their name in the first position
          else {
            var series = { 
              data: []
            };
            $.each(items, function(itemNo, item) {
              if (itemNo == 0) {
                series.name = item;
              } else {
                series.data.push(parseFloat(item));
              }
            });
            
            options.series.push(series);

          }
          
        });
        
        var chart = new Highcharts.Chart(options);
      });
      
      
    });
    </script>

  