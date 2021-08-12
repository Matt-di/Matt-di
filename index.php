
<?php

include_once "class/Action.php";
$action = new Action();

// if(!$action->isSetSession())
// {
//     header("location:login.php",true);
// }

$selectedLanguage = $action->selectLanguage();
if (isset($_GET['lang'])) {
    $action->updateLanguage($_GET['lang']);
    $selectedLanguage = $_GET['lang'];
}
include("Lan/lang-" . $selectedLanguage . ".php");
echo "<script> var language = " . json_encode($language) . "</script/>";
?>

<!DOCTYPE html>
<html lang="<?php echo $selectedLanguage; ?>">
<?php
include "includes/header.php";
?>
<main class="container">
    <div class="row">
        <section id="list_data_section" class="col-md-4">
            <div>
                <p>The following data</p>
                <div class="card_item">
                    <div class="card_title" style="background-color:rgba(233,56,77,0.7);">
                        <p><span id="soil-v"><?php echo $language['soilMoisture'] ?></span>%</p>
                    </div>
                    <div class="card_container">
                        <div class="card_image">

                            <img src="assets/images/growing-seeds.svg" alt="Soil Moisture Image" />
                        </div>
                        <div class="card_detail">
                            <p>The Soil Status is : <span id="soil_stat"></span>40% wet</p>
                        </div>
                    </div>
                </div>
                <div class="card_item">
                    <div class="card_title" style="background-color:rgba(22,56,222,0.7);">
                        <p><span id="humid-v"><?php echo $language['humidity'] ?></span>%</p>
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
                    <div class="card_title" style="background-color:rgba(23,233,77,0.7);">
                        <p><span id="temp-v"><?php echo $language['temperature'] ?></span> &deg;c</p>
                    </div>
                    <div class="card_container">
                        <div class="card_image">
                            <img src="moisture.jpg" alt="Soil Moisture Image" />
                        </div>
                        <div class="card_detail">
                            <p>The temperature is to hot</p>
                        </div>
                    </div>
                </div>
                <div class="card_item">
                    <div class="card_title" style="background-color: aqua;">
                        <p id="water-level">Water Level</p>
                    </div>
                    <div class="card_container">
                        <div class="card_image">
                            <img src="moisture.jpg" alt="Soil Moisture Image" />
                        </div>
                        <div class="card_detail">
                            <p>Water Level is getting low</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section id="detail_data_section" class="col-md-8 table-responsive">
            <div class="row">
                <div class="col-12" height="400px">
                    <canvas id="myChart" class="table">
                    </canvas>
                    <a class="btn btn-primary" href="displayAll.php">See All Data</a>
                </div>
            </div>
            <hr style="color:red;" />
            <div class="row">
                <section id="control-section" class="col-12">
                    <p>Actions </p>
                    <div id="control-actions" class="row ">

                        <div class="card m-2">
                            <p class="text-center p-2">User</p>
                            <button type="button" class="btn btn-default" value="" id="change-control-mode"><?php echo $language['controlMode'] ?></button>

                        </div>
                        <div class="  card m-2">
                            <p class="text-center p-2">motor On/Off</p>
                            <button type="button" class="p-2 btn btn-default m-2 " disabled value="" id="change-motor-status"><?php echo $language['motorStatus'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">Soil Threshold</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-soil-moisture"> <?php echo $language['soilMoistureTV'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">Temperature Threshold</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-temperature"><?php echo $language['temperatureTV'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">Humidity Threshold</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-humidity"><?php echo $language['humidityTV'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">User</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-phone-number"><?php echo $language['phoneNumber'] ?></button>

                        </div>

                    </div>


                </section>
            </div>

        </section>


    </div>

    <div class="row">
        <section id="status-section" class="col-md-6">
            <h2>base data status</h2>
            <div id="mybasedata" class="jumbtron"></div>
            <!-- <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $language['soilMoisture'] ?>
                        <span class="badge badge-primary badge-pill">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $language['temperature'] ?>

                        <span class="badge badge-primary badge-pill">50</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $language['humidity'] ?>
                        <span class="badge">99</span>
                    </li>
                </ul> -->
        </section>
    </div>

</main>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
        <form name="modalForm" id="modalForm">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><span id="modal-title">Modal Heading</span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <span id="myAlert">

                    </span>
                    <input type="number" min=0 max=100 id="changed-input" name="changed-input" placeholder="<?php echo $language['inputPlaceholder'] ?>" class="form-control" />
                    <input type="hidden" id="changed-name" name="changed-name" value="" />
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="modal-cancel" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary" name="change-submit" id="change-submit">Change</button>
                </div>

            </div>
        </form>
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

            data: JSON.stringify({
                limit: 20,
                sort: "ASC"
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
                        res += `<li class="list-group-item d-flex justify-content-between align-items-center">
                        ${language.motorStatus}
                        `;
                        $("#change-motor-status").val(data.value);
                        if (data.value == "0") {
                            res += `<span class="badge badge-primary badge-pill">${language.motorOpened}</span></li>`;
                            $("#change-motor-status").text(language.motorStatusOff);
                        } else {
                            res += `<span class="badge badge-primary badge-pill">${language.motorClosed}</span></li>`;
                            $("#change-motor-status").text(language.motorStatusOn);

                        }
                    } else if (data.name == "control_mode") {
                        $("#change-control-mode").val(data.value);

                        res += `<li class="list-group-item d-flex justify-content-between align-items-center">${language.controlMode}`;
                        if (data.value == "0") {
                            res += `<span class="badge badge-primary badge-pill">${language.autoControl} </span></li>`;
                            $("#change-motor-status").attr("disabled", "disabled");
                        } else {
                            res += `<span class="badge badge-primary badge-pill">${language.userControl} </span></li>`;
                            $("#change-motor-status").attr("disabled", false);
                        }

                    } else {
                        if (language[data.name] != undefined) {
                            res += `<li class="list-group-item d-flex justify-content-between align-items-center">
                        ${language[data.name]}
                        <span class="badge badge-primary badge-pill text-large">${data.value}</span>
                    </li>`;
                        }
                    }

                });

                //mybasedata.append(res);
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
                    maintainsAspectRatio: false,

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

    function changeThreshold(name) {
        $("#modal-title").text(language.alertTitle);
        $("#modal-cancel").text(language.cancel);
        $("#change-submit").text(language.change);

        $("#changed-name").val(name);
        $("#myModal").modal();
    }

    function setTimer(time) {

    }

    function requestUpdateAjax(name, value) {
        let dataTo = {
            name: name,
            value: value
        };

        $.ajax({
            url: "api/base-data/update",
            type: "PUT",
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
                $("#changed-name").val("");
                $("#changed-input").val("");
                $("#myModal").modal("hide");


            },
            error: function(error) {
                console.log(error);
            }
        })
    }
    $(document).ready(function() {
        // $("#sis-brand-name").text(language.title);
        // $("#change-control-mode").text(language.controlMode);
        // $("#change-motor-status").text(language.motorStatusOn);
        // $("#change-soil-moisture").text(language.soilMoistureTV);
        // $("#change-temperature").text(language.temperatureTV);
        // $("#change-humidity").text(language.humidityTV);

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
            changeThreshold("soil_moistureTV");
        });
        $("#change-humidity").click(function() {
            changeThreshold("humidityTV");
        });
        $("#change-temperature").click(function() {
            changeThreshold("temperatureTV");
        });


        $("#modalForm").on('submit', function(event) {
            event.preventDefault();
            let changedValue = $("#changed-input").val();
            let chagedName = $("#changed-name").val();
            var message = "";
            if (isNaN(changedValue) || changedValue == "") {
                message = language.errorOnlyNumber;
            } else if (changedValue < 0 || changedValue > 100) {
                message = language.errorBetweenNumber;
            } else {
                requestUpdateAjax(chagedName, changedValue);
            }
            if (message != "") {
                //$("#myModal").modal('hide');
                $("#myAlert").html("<p  class='alert alert-warning alert-dismissable fade show'>" + message + "</p>");

                setTimeout(function() {
                    message = "";
                    $("#myAlert").html("");
                }, 3000);

            }
        });

    });
</script>




</html>