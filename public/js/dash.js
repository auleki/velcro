var ctx = document.getElementById('lineid');
var linechart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018],
        datasets: [{
            label: '# of Votes',
            backgroundColor: "transparent",
            fill: 'false',
            data: [100, 50, 300, 20, 189, 300, 19],
            borderColor: [
                "#19B9FD",
            ],
            borderWidth: 1
        }, ]
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
        layout: {
            padding: {
                left: 50,
                right: 0,
                top: 0,
                bottom: 0
            }
        },

        title: {
            display: true,
        },
        scales: {
            bezierCurve: false,
            yAxes: [{
                ticks: {
                    min: 0,
                },
                gridLines: {
                    display: false,
                }
            }],

            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            pointDot: false,
            bezierCurve: true,
        }


    }

});


//get the bar chart canvas
var sourceCanvas = document.querySelector('.barchart');
var myChart = new Chart(sourceCanvas, {
    type: 'bar',
    data: {
        labels: ['', 'Q1 2018', '', 'Q2 2018', '', 'Q3 2018', '', 'Q4 2018'],
        datasets: [{
                label: 'Exit',
                data: ['', 100000, '', 250000, '', 300000, '', 57000],
                backgroundColor: "#7AEF1F",
                borderWidth: 0.5
            },
            {
                label: 'Investment',
                data: ['', 800000, '', 600000, '', 400000, '', 200000],
                backgroundColor: "#19B9FD",
                borderWidth: 0.5
            }
        ]
    },
    options: {
        barValueSpacing: 1,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                },
                gridLines: {
                    display: false,
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false,
                    categoryPercentage: 1.0,
                    barPercentage: 0.5
                }
            }]
        }
    }
});

function cloneCanvas(sourceCanvas) {
    let modalInner = $('#modal-content')
    let destinationCanvas = document.createElement("canvas");
    destinationCanvas.width = sourceCanvas.width;
    destinationCanvas.height = sourceCanvas.height;
    modalInner.html(destinationCanvas)
        //grab the context from your destination canvas
    let destCtx = destinationCanvas.getContext("2d");
    //call its drawImage() function passing it the source canvas directly
    destCtx.drawImage(sourceCanvas, 0, 0);
}

// let sourceCanvas = new Chart(ctx, config)
$("#chartmodal").on("show.bs.modal", e => {
    cloneCanvas(sourceCanvas);
});
/*        var url = "{{url('stock/chart')}}";
        var Years = new Array();
        var Labels = new Array();
        var Prices = new Array();
        $(document).ready(function(){
          $.get(url, function(response){
            response.forEach(function(data){
                Years.push(data.stockYear);
                Labels.push(data.stockName);
                Prices.push(data.stockPrice);
            });
            var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels:Years,
                      datasets: [{
                          label: 'Infosys Price',
                          data: Prices,
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
          });
        });
 */







var ctx = document.getElementById('piechart');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['success'],
        datasets: [{
            label: 'Customer success',
            data: ['100'],
            backgroundColor: [
                '#19B9FD',
            ],
            borderColor: [
                '#19B9FD',
            ],
            borderWidth: 1
        }]
    }
});