@extends('layouts.app')

@section('content')
    <div class="container pozadina">
        <div class="card ">
            <div class="card-header">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                Pregled svih konsultacija
            </div>




            <div id="calendar_basic" style="width: 100%; min-height: 350px; overflow-x:scroll;overflow-y:hidden ; "></div>
            <input hidden id="konsultacije"
                value='<?php echo json_encode($konsultacije); ?>'>

        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            const konsultacije = JSON.parse(document.getElementById("konsultacije").value);
            let obradjenNiz = konsultacije.map((konsultacija) => {
                console.log(konsultacija.datum.split(" ")[0])

                return [new Date(konsultacija.datum.split(" ")[0]), 0, "<p> Ime predavaca: <br> <b>" + konsultacija
                    .name +
                    "</b> <br> Kliknite za detalje.</p>"
                ]
            })


            google.charts.load("current", {
                packages: ["calendar"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({
                    type: 'date',
                    id: 'Date',
                });
                dataTable.addColumn({
                    type: 'number',
                    id: 'Won/Loss',

                });

                dataTable.addColumn({
                    type: 'string',
                    role: 'tooltip',
                    'tooltip': {
                        html: true,
                        trigger: 'selection'
                    },

                });
                dataTable.addRows([
                    ...obradjenNiz
                ]);

                var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));


                var options = {
                    title: "Konsultacije",
                    height: 350,

                    tooltip: {
                        isHtml: true,
                        trigger: 'selection'
                    }
                };

                chart.draw(dataTable, options);
                google.visualization.events.addListener(chart, 'select', selectHandler);

                function selectHandler() {

                    konsultacije.forEach(k => {
                        console.log(chart.getSelection())
                        if (chart.getSelection()[0].date === new Date(k.datum.split(" ")[0]).getTime())
                            window.location.replace("http://127.0.0.1:8000/konsultacija/" + k.id);


                    })
                }

            }

        </script>
    @endsection
