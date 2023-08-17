//  Sales chart
  $.ajax({
    type: "GET",
    url: "callData",
    success: function(result) {

        resultObj = JSON.parse(result);
        var salesChartCanvas = document.getElementById('revenue-chart-canvas1').getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');
console.log(resultObj.labels);

  var salesChartData = {


    labels  : resultObj.labels,
    datasets: [
      {
        label               : 'Total Calls',
        fill                : false,
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        borderDash          : [5, 5],
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : resultObj.totals
      },
      // {
      //   label               : 'Answered Calls',
      //   fill                : false,
      //   backgroundColor     : 'rgba(210, 214, 222, 1)',
      //   borderColor         : 'rgba(210, 214, 222, 1)',
      //   pointRadius         : false,
      //   pointColor          : 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor    : '#c1c7d1',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data                : resultObj.answered
      // },
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    title: {
          display: true,
          text: 'Calls by Extension'
        },
    legend: {
      display: true
    },
    tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )
    }
});


  // DATATABLE FUNCTION STARTS HERE 

          $(document).ready(function(){

          });
          $('#indextable').DataTable({

            lengthChange: false,

            language: {
               searchPlaceholder: "Search Extension",
               search: "",
      }
       


          });

         
   

   