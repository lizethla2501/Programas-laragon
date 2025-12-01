<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!--CDN para graficar
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

        <!-- Styles -->
        <style>
           body{
            display: grid;
            align-items: center;
            padding-top: 40px;
            background: #f4f4f4;
            text-align: center;
            width: 10%;
           }
           .mostrargrafico{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 60%;
            margin: auto;
            max-width: 1100px;
           }
           canvas{
            width: 100px;
            height: 200px;
            background: white;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 2);
           }

           @media(max-witdh:900px){//telefono
            .mostrargrafico{
                width: 95%;
                grid-template-columns: repeat(2,1fr);

            }
           }
            @media(max-width:600px){
                body{
                    width:100%;
                }
                .mostrargrafico{
                    width:80%;
                    grid-template-columns: repeat(1fr);
                }
                canvas{
                    height: 300px;
                }

            }  
        </style>

    </head>
    <body>

        <div class="mostrargrafico">
            <canvas id="grafico1"></canvas>
            <canvas id="grafico2"></canvas>
            <canvas id="grafico3"></canvas>
            <canvas id="grafico4"></canvas>
        </div>

        <script src="{{asset('js/chart.min.js')}}"></script>


        <script>
            let datos = @json($datos);
            let etiquetas = datos.map((_, i) => "Valor " + (i + 1));

            const chartBar = new Chart(document.getElementById('grafico1'), {
                type: 'bar',
                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'sensor1',
                        data: datos,
                        borderWidth: 2
                    }]
                },
                options:{response: false}
            });
            //grafico 2
            const chartLine = new Chart(document.getElementById('grafico2'), {
                type: 'line',
                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'sensor2',
                        data: datos,
                        borderWidth: 2
                    }]
                },
                options:{response:false}
            });
            //grafico 3
            const chartPie = new Chart(document.getElementById('grafico3'), {
                type: 'pie',
                data: {
                    
                    datasets: [{
                        //label: 'sensor1',
                        data: datos,
                        //borderWidth: 2
                    }]
                },
                options:{response: false}
            });
            //grafico 4
            const chartDona = new Chart(document.getElementById('grafico4'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        
                        data: datos,
                        //borderWidth: 2
                    }]
                },
                options:{response: false}
            });

            setInterval(async () => {
                try {
                    const resp = await fetch("/");
                    const html = await resp.text();
                    const match = html.match(/\[(.*?)\]/);
                    if (!match) return;

                    let nuevodato = JSON.parse("[" + match[1] + "]");
                    console.log(nuevodato);

                    let nuevoLabels = nuevodato.map((x, i) => "Dato " + (i + 1));

                    chartBar.data.labels = nuevoLabels;
                    chartBar.data.datasets[0].data = nuevodato;
                    chartBar.update();
                    chartLine.data.labels = nuevoLabels;
                    chartLine.data.datasets[0].data = nuevodato;
                    chartLine.update();
                    //chartLine.data.labels = nuevoLabels;
                    chartPie.data.datasets[0].data = nuevodato;
                    chartPie.update();
                    chartDona.data.datasets[0].data = nuevodato;
                    chartDona.update();

                } catch (error) {
                    console.log("error", error);
                }

            }, 3000);


            /* grafico 1
            new Chart(document.getElementById('grafico'),{
                type: 'bar',
                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'Temperatura (°C)',
                        data: datos,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive:false
                }
            });
             // grafico 2
           new Chart(document.getElementById('grafico1'), {
                type: 'pie',
                data: {
                   // labels: etiquetas,
                 datasets:[{
                    label: 'pastel',
                    data :datos
                        }]
                },
                options: {
                   responsive:false
                }
            });
             // grafico 1
          new Chart( document.getElementById('grafico2'),{
                type: 'doughnut',
                data: {
                    //labels: etiquetas,
                        datasets:[{
                            label:'Dona',
                            data:datos
                    }]
                },
                options: {
                    responsive:false
                }
            });
             // grafico 1
           new Chart( document.getElementById('grafico3'), {
                type: 'line',
                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'Humedad',
                        data: datos,
                        borderWidth:2
                    }]
                },
                options: {
                    responsive:false
                }
            });
/*

            */
            </script>




    </body>
</html>
