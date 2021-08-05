<?php

include_once "Action.php";
$action = new Action();

// if(!$action->isSetSession())
// {
//     header("location:login.php",true);
// }
$lang = "or";

$selectedLanguage = $action->selectLanguage($lang);
if (isset($_GET['lang'])) {
    // $selectedLanguage = $_GET['lang'];
}
//require_once("./Language/lang-".$selectedLanguage.".php");
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>


    <title>Smart Irigation System </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/index.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/Chart.js"> </script>
    <script src="assets/js/jquery.js"> </script>
    <script src="assets/js/bootstrap.min.js"> </script>
    <?php if ($lang == "am") {
        echo '<script src="Language/lang-am.js"> </script>';
    } elseif ($lang == "or") {
        echo '<script src="Language/lang-or.js"> </script>';
    } else {
        echo '<script src="Language/lang-en.js"> </script>';
    }
    ?>

</head>

<body>
    <header>
        <div id="containerr">
            <div>
                <h2 id="sis-brand-name">$language.title</h2>
            </div>
        </div>

    </header>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Navbar</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Language</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="container">
        <div class="row">

            <section id="list_data_section" class="col-md-4">
                <div>
                    <p>The following data</p>
                    <div class="card_item">
                        <div class="card_title" style="background-color: red;">
                            <p id="soil-v">language.soilMoisture</p>
                        </div>
                        <div class="card_container">
                            <div class="card_image">
                                <img src="moisture.jpg" alt="Soil Moisture Image" />
                            </div>
                            <div class="card_detail">
                                <p>The Soil Status is : 40% wet</p>
                            </div>
                        </div>
                    </div>
                    <div class="card_item">
                        <div class="card_title" style="background-color:blue;">
                            <p id="humid-v">language.humidity</p>
                        </div>
                        <div class="card_container">
                            <div class="card_image">
                                <img src="moisture.jpg" alt="Soil Moisture Image" />
                            </div>
                            <div class="card_detail">
                                <p>The Soil Status is : 40% wet</p>
                            </div>
                        </div>
                    </div>
                    <div class="card_item">
                        <div class="card_title" style="background-color: green;">
                            <p id="temp-v">language.temperature</p>
                        </div>
                        <div class="card_container">
                            <div class="card_image">
                                <img src="moisture.jpg" alt="Soil Moisture Image" />
                            </div>
                            <div class="card_detail">
                                <p>The Soil Status is : 40% wet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="detail_data_section" class="col-md-8 table-responsive" style="height: max-content;">
                <canvas height="200px" id="myChart"  class="table">
                </canvas>

                <button class="btn "type="button">See All Data</button>
            </section>

        </div>

        <div class="row">
            <section id="status-section" class="col-md-6">
                <h2>base data status</h2>
                <div id="mybasedata" class="jumbotron"></div>
            </section>

            <section id="control-section" class="col-md-6">
                <div>
                    <p>Actions </p>
                    <div id="control-actions" class="">
                        <button type="button" class="p-2 btn btn-default flex-fill m-2" value="" id="change-control-mode">language.controlMode</button>
                        <button type="button" class="p-2 btn btn-default m-2" value="" id="change-motor-status">language.motorStatusOn</button>
                        <button type="button" class="p-2 btn btn-default m-2" value="" id="change-soil-moisture"> language.soilMoistureTV</button>
                        <button type="button" class="p-2 btn btn-default m-2" value="" id="change-temperature">language.temperatureTV</button>
                        <button type="button" class="p-2 btn btn-default m-2" value="" id="change-humidity">language.humidity</button>
                        <button type="button" class="p-2 btn btn-default m-2" value="" id="change-phone-number">language.phoneNumber</button>
                    </div>

                </div>

            </section>
        </div>








        <section id="section-shortcut">

        </section>
    </main>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><span id="modal-title">Modal Heading</span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="number" min=0 max=100 id="changed-input" class="input" />
                    <input type="hidden" id="changed-input" value="" />
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" id="change-submit">Change</button>
                </div>

            </div>
        </div>
    </div>
</body>
<script>
    var myChart = null;
    var baseOs = [];

    function getUpdate() {
        $.ajax({
            url: 'api/sensors/read',
            method: "GET",
            dataType: "json",
            
            data:JSON.stringify({
                limit:20,sort:"ASC"
            }),
                

            success: function(data, textStat) {
                console.log(data);
                let formatedData = makeXYAxis(data);
                // alert(textStat);
                if (myChart == null) plotChart(formatedData);
                else {
                    updateChart(formatedData);
                }
            },
            error: function(data, textstst, error) {
                console.log(error);
            }

        });
    }

    function getBaseData() {
        $.ajax({
            url: 'api/base-data/read',
            method: "POST",
            dataType: "json",
            data: {
                api_key: "data",
                action: "fetch",
            },
            success: function(data, textStat) {
                //console.log(data);
                // alert(textStat);
                var mybasedata = $('#mybasedata');
                var res = "";
                var actions = "";
                baseOs = data.baseDatas;
                console.log(baseOs);
                data.baseDatas.forEach(data => {
                    if (data.name == 'motor_status') {
                        $("#change-motor-status").val(data.value);

                        res += "<p >" + data.name + "=";
                        if (data.value == "0") {
                            res += "Closed </p>";
                            $("#change-motor-status").text(language.motorStatusOn);
                        } else {
                            res += "Opened</p>";
                            $("#change-motor-status").text(language.motorStatusOff);

                        }
                    } else if (data.name == "control_mode") {
                        $("#change-control-mode").val(data.value);
                        res += "<p >" + data.name + "=";
                        if (data.value == "0") {
                            res += "Automatic (Arduino) </p>";
                            $("#change-motor-status").attr("disabled", "disabled");

                            //actions += "Change Mode </button>";
                        } else {
                            res += "Manual(User)</p>";
                            $("#change-motor-status").attr("disabled", false);
                            //actions += "Change Mode </button>";
                        }
                        //res += "<p >" + data.name + "=" + `${data.value=="0"?"Automatic (Arduino) ":"Manual(User)"}` + "</p>";

                    } else {
                        res += "<p>" + data.name + "=" + data.value + "</p>";
                        //actions += "<button type='button' id='" + data.name + "'>"+data.name+"</button>";
                    }

                });


                mybasedata.html(res);
                ///controlactions.html(actions);

                /*
                    `
                    
                    <p>Motor Status = ${ data.motorStatus==0?"Closed":"Opened"}</p>
                    <p>Control Mode = ${ data.controlMode == 0 ? "Automatic":"Manual"}</p>
                    <p>Soil Moisture Threshold Value = ${ data.baseDatas[0].value}</p>
                    <p>Humidity Threshold Value = ${ data.humidityTV}</p>
                    <p>Temperature Threshold Value = ${ data.temperatureTV}</p>
                    <p>Request Time for Arduino = ${ data.requestTime}</p>
                
                    `
                )*/

            },
            error: function(data, textstst, error) {
                console.log(error);
            }
        });
    }

    function updateChart(data) {
        myChart.data.labels = data.updated_date;
        myChart.data.datasets.forEach((dataset, i) => {
            if (i == 0) {
                dataset.data = data.soilMoisture;
            } else if (i == 1) {
                dataset.data = data.temperature;
            } else if (i == 2) {
                dataset.data = data.humidity;
            }
        });
        myChart.update();
    }

    function makeXYAxis(data) {
        let lenght = data.totalData;

        let datas = data.datas.slice(lenght - 15);
        console.log(datas);
        let x = [];
        let y = [];
        let z = [];
        let w = [];


        datas.forEach((row, index) => {

            x.push(row['soilMoisture']);
            y.push(row['humidity']);
            z.push(row['temperature']);
            [n, nn] = row['updated_date'].split(":");
            w.push(row['updated_date'].split(" "));

        })

        updated = {
            "soilMoisture": x,
            "temperature": z,
            "humidity": y,
            "updated_date": w
        };
        $("#soil-v").text(x[x.length - 1]);
        $("#humid-v").text(y[y.length - 1]);
        $("#temp-v").text(z[z.length - 1]);
        return updated;
    }

    function plotChart(sensorData) {
        myChart = new Chart("myChart", {
            type: "line",
            data: {
                labels: sensorData.updated_date,
                datasets: [{
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: language.soilMoisture,
                        borderColor: "red",
                        data: sensorData.soilMoisture,
                        fill: false
                    },
                    {
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: language.temperature,
                        borderColor: "blue",
                        data: sensorData.temperature,
                        fill: false
                    },
                    {
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: language.humidity,
                        borderColor: "green",
                        data: sensorData.humidity,
                        fill: false
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: language.chartTitle,
                    responsive: true,
                    maintainsAspectRatio:false,
                    
                },
                legend: {
                    display: true,
                    labels: {
                        fontColor: "#547454"
                    }
                },
                // scales:{
                //     yAxes:[{
                //         ticks:{
                //             beginAtZero:true
                //         }
                //     }]
                // }

            },
            borderColor: "rgba(0,0,0,0)"
        });
    }



    function changeControl(mode) {
        m = mode == "0" ? "1" : "0";
        requestUpdateAjax("control_mode", m);
    }

    function changeMotor(status) {
        m = status == "0" ? "1" : "0";
        requestUpdateAjax("motor_status", m);
    }

    function changeThreshold() {
        $("#modal-title").text("Insert  New Soil Moisture Threshold");
        $("#myModal").modal();

    }

    function setTimer(time) {

    }

    function requestUpdateAjax(name, value) {
        var dataTo = {
            name: name,
            value: value
        };

        $.ajax({
            url: "api/base-data/update",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(dataTo),
            dataType: "json",
            beforeSend: function() {
                $("#change-control-mode").addClass("disabled");
                $("#change-control-mode").attr("disabled", "disabled");

            },
            success: function(data) {
                console.log(data);
                $("#change-control-mode").removeClass("disabled");
                $("#change-control-mode").attr("disabled", false);


            },
            error: function(error) {
                console.log(error);
            }
        })
    }



    $(document).ready(function() {
        $("#sis-brand-name").text(language.title);
        $("#change-control-mode").text(language.controlMode);
        $("#change-motor-status").text(language.motorStatusOn);
        $("#change-soil-moisture").text(language.soilMoistureTV);
        $("#change-temperature").text(language.temperatureTV);
        $("#change-humidity").text(language.humidityTV);

        setInterval(function() {
            getBaseData();
            getUpdate();
        }, 3000);
        $("#change-control-mode").click(function() {
            changeControl($("#change-control-mode").val());
        });

        $("#change-motor-status").click(function() {
            changeMotor($("#change-motor-status").val());
        });
        $("#change-soil-moisture").click(function() {
            changeThreshold();
        });

    });
</script>




</html>