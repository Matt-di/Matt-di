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
                    <div class="card_title" style="background-color: red;">
                        <p id="soil-v"><?php echo $language['soilMoisture'] ?></p>
                    </div>
                    <div class="card_container">
                        <div class="card_image">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="70" viewBox="0 0 512 512" width="100" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path d="m383.496 355.41c-20.599 0-39.74 10.851-50.098 28.657-12.019 20.659-35.671 44.921-80.477 44.921s-68.458-24.261-80.477-44.921c-10.358-17.805-29.499-28.657-50.098-28.657-15.842 0-30.998 6.466-41.961 17.902l-68.292 71.24v57.448h240.828 240.828v-57.447l-68.292-71.24c-10.963-11.437-26.118-17.903-41.961-17.903z" fill="#b96b57" />
                                    </g>
                                    <g>
                                        <path d="m457.856 133.826-33.022 34.802-98.416 63.384c-10.431 6.73-24.141 5.26-32.922-3.52-10.588-10.588-10.053-28.36 1.09-38.322l28.742-25.632c7.18-6.4 2.65-18.281-6.97-18.281h-48.343c-2.7 0-5.29 1.04-7.23 2.9l-65.094 62.164c-17.611 17.611-41.492 27.502-66.394 27.502-10.831 0-18.001-8.86-18.001-18.101 0-4.43 1.64-8.941 5.32-12.601l98.406-98.016c19.641-19.561 45.473-31.692 73.074-34.302l72.724-6.88 16.621-15.511z" fill="#ffdad5" />
                                    </g>
                                    <g>
                                        <circle cx="211.806" cy="288.043" fill="#eab7a2" r="22.011" />
                                    </g>
                                    <g>
                                        <circle cx="273.464" cy="345.948" fill="#eab7a2" r="22.011" />
                                    </g>
                                    <g>
                                        <path d="m370.341 46.309 92.426 92.427 37.139-37.139-91.597-91.597z" fill="#bedaff" />
                                    </g>
                                    <g>
                                        <path d="m432.677 366.392c-12.782-13.334-30.708-20.982-49.181-20.982-24.166 0-46.674 12.885-58.741 33.628-15.421 26.508-39.589 39.949-71.833 39.949s-56.412-13.441-71.833-39.949c-12.067-20.743-34.576-33.628-58.742-33.628-18.472 0-36.397 7.647-49.18 20.982l-68.292 71.24c-1.785 1.862-2.781 4.341-2.781 6.92v57.448c0 5.523 4.477 10 10 10h319.713c5.522 0 10-4.477 10-10s-4.478-10-10-10h-309.713v-43.428l65.511-68.339c9.03-9.419 21.693-14.822 34.742-14.822 17.071 0 32.956 9.075 41.455 23.685 13.241 22.761 39.45 49.893 89.121 49.893 49.67 0 75.88-27.132 89.12-49.892 8.499-14.609 24.384-23.685 41.454-23.685 13.05 0 25.713 5.403 34.743 14.822l65.51 68.339v43.427h-63.985c-5.522 0-10 4.477-10 10s4.478 10 10 10h73.985c5.522 0 10-4.477 10-10v-57.447c0-2.579-.996-5.058-2.781-6.92z" />
                                        <path d="m211.805 256.032c-17.651 0-32.011 14.36-32.011 32.011s14.36 32.011 32.011 32.011 32.011-14.36 32.011-32.011-14.36-32.011-32.011-32.011zm0 44.022c-6.623 0-12.011-5.388-12.011-12.011s5.388-12.011 12.011-12.011 12.011 5.388 12.011 12.011-5.387 12.011-12.011 12.011z" />
                                        <path d="m273.464 377.959c17.651 0 32.012-14.36 32.012-32.011s-14.36-32.011-32.012-32.011c-17.651 0-32.011 14.36-32.011 32.011s14.36 32.011 32.011 32.011zm0-44.023c6.623 0 12.012 5.388 12.012 12.011s-5.389 12.011-12.012 12.011-12.011-5.388-12.011-12.011 5.388-12.011 12.011-12.011z" />
                                        <path d="m506.977 94.525-91.596-91.596c-3.844-3.842-10.054-3.914-13.982-.156l-37.969 36.31c-3.888 3.716-4.051 10.15-.366 14.07l-6.575 6.135-69.333 6.56c-29.829 2.82-57.953 16.022-79.19 37.172l-98.4 98.01c-5.332 5.303-8.269 12.296-8.269 19.691 0 15.495 12.561 28.101 28.001 28.101 27.713 0 53.768-10.775 73.381-30.347l65.026-62.099c.08-.077.19-.119.311-.119h48.343c.237 0 .326 0 .441.303.114.3.054.354-.126.514l-28.752 25.64c-15.355 13.727-16.042 38.3-1.496 52.849 12.03 12.029 31.128 14.069 45.408 4.856l98.416-63.384c.672-.433 1.289-.944 1.839-1.524l26.352-27.773c3.734 1.795 8.461 1.005 11.398-1.932l37.139-37.139c3.905-3.904 3.905-10.236-.001-14.142zm-88.568 66.347-97.412 62.737c-6.423 4.146-15.015 3.225-20.429-2.188-6.529-6.53-6.221-17.623.674-23.789l28.741-25.63c6.396-5.701 8.557-14.557 5.506-22.563-3.051-8.008-10.561-13.183-19.131-13.183h-48.343c-5.303 0-10.328 2.018-14.137 5.668l-65.094 62.164c-.056.053-.111.106-.165.161-15.846 15.846-36.914 24.573-59.323 24.573-5.519 0-8.001-4.737-8.001-8.101 0-2.091.798-3.945 2.377-5.516l98.405-98.015c17.958-17.884 41.737-29.047 66.959-31.432l72.725-6.88c2.199-.208 4.267-1.138 5.881-2.645l9.559-8.92 66.695 66.695zm44.358-36.278-78.125-78.125 23.511-22.483 77.61 77.611z" />
                                        <path d="m385.78 498.18c-3.39-8.269-15.647-7.975-18.647.455-3.091 8.687 6.737 16.656 14.598 11.908 4.162-2.513 5.92-7.872 4.049-12.363z" />
                                    </g>
                                </g>
                            </svg>

                            <img src="assets/images/growing-seeds.svg" alt="Soil Moisture Image" />
                        </div>
                        <div class="card_detail">
                            <p>The Soil Status is : 40% wet</p>
                        </div>
                    </div>
                </div>
                <div class="card_item">
                    <div class="card_title" style="background-color:blue;">
                        <p id="humid-v"><?php echo $language['humidity'] ?></p>
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
                        <p id="temp-v"><?php echo $language['temperature'] ?></p>
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
                    <a class="btn " href="displayAll.php" type="button">See All Data</a>
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
                            <p class="text-center p-2">User</p>
                            <button type="button" class="p-2 btn btn-default m-2 " disabled value="" id="change-motor-status"><?php echo $language['motorStatus'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">User</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-soil-moisture"> <?php echo $language['soilMoistureTV'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">User</p>
                            <button type="button" class="p-2 btn btn-default m-2" value="" id="change-temperature"><?php echo $language['temperatureTV'] ?></button>

                        </div>
                        <div class=" card m-2">
                            <p class="text-center p-2">User</p>
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
        var dataTo = {
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