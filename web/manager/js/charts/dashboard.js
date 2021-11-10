$(document).ready(function(){
    $.ajax({
      url: "functions/charts/dashboard.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var player = [];
        var score = [];
  
        for(var i in data) {
          player.push("Tipo: " + data[i].cat_name);
          score.push(data[i].numero);
        }
  
        var chartdata = {
          labels: player,
          datasets : [
            {
              label: 'Propiedades',
              backgroundColor: 'rgba(232, 49, 82, 0.75)',
              borderColor: 'rgba(232, 49, 82, 0.75)',
              hoverBackgroundColor: 'rgba(232, 49, 82, 1)',
              hoverBorderColor: 'rgba(232, 49, 82, 1)',
              data: score
            }
          ]
        };
  
        var ctx = $("#mycanvas");
  
        var barGraph = new Chart(ctx, {
        type: 'bar',

        options: {
          scales: {
              yAxes: [{
                  ticks: {
                      //beginAtZero: true
                      min:0
                  }
              }]
          }
      },

          data: chartdata
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
  });