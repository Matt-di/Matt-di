<!DOCTYPE html>
<html>

<head>
    <title>Smart Iriigation System </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script src="js/Chart.js"> </script>
    <script src="js/jquery.js"> </script>
    <script src="js/bootstrap.min.js"> </script>
</head>

<body>
    <header>
        <div id="container">
            <div>
                <h2>Smart Irrigation System</h2>
            </div>
        </div>
    </header>

    <main>
        <section id="list_data_section">
            <div>
                <h3>The following data</h3>
                <div class="card_item">
                    <div class="card_title">
                        <p>Soil Moisture detail</p>
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
                    <div class="card_title">
                        <p>Humidity detail</p>
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
                    <div class="card_title">
                        <p>Temperature detail</p>
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

        <section id="detail_data_section">
            <canvas id="myChart" style="width: 100%; max-width:700px">
            </canvas>
        </section>

        <section id="status-section">
            <h2>base data status</h2>
            <div id="mybasedata" class="jumbotron"></div>
        </section>

        <section id="control-section" >
            <div>
                <p>Actions </p>
                <div>
                    <button type="button" class="btn btn-primary m-2" id="change-soilTV">Change SoilMoisture Threshold</button>
                    <button type="button" class="btn btn-primary m-2" id="change-tempTV">Change Temperature Threshold</button>
                    <button type="button" class="btn btn-primary m-2" id="change-humidTV">Change Humidity Threshold</button>
                </div>

            </div>
        </section>

        <section id="section-shortcut">
            <div class="shortcut-container">
                <button>
                    Motor OFF
                </button>
                <button>
                    Motor OFF
                </button>
            </div>
        </section>
    </main>
</body>
<script>
    var myChart = null;

    function getUpdate() {
        $.ajax({
            url: 'api/sensors/read',
            method: "POST",
            dataType: "json",
            
            success: function(data, textStat) {
                console.log(data.datas);
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

    function makeXYAxis(data)
    {
        let lenght  = data.totalData;
        
        let datas = data.datas.slice(15);
        let x = [];
        let y = [];
        let z = [];
        let w = [];


        datas.forEach((row ,index)=>{
            
            x.push(row['soilMoisture']);
            y.push(row['humidity']);
            z.push(row['temperature']);
            [n,nn] = row['updated_date'].split(":");
            w.push(row['updated_date']);
            
        })

        updated= {"soilMoisture":x,
                "temperature":z,
                "humidity":y,
                "updated_date":w};
        return updated;
    }
    function plotChart(sensorData) {
        myChart = new Chart("myChart", {
            type: "line",
            data: {
                labels: sensorData.updated_date,
                datasets: [{
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: "Soil",
                        borderColor: "red",
                        data: sensorData.soilMoisture,
                        fill: false
                    },
                    {
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: 'Temp',
                        borderColor: "blue",
                        data: sensorData.temperature,
                        fill: false
                    },
                    {
                        //backgroundColor: "rgba(55,43,66,0.5)",
                        label: "Humid",
                        borderColor: "green",
                        data: sensorData.humidity,
                        fill: false
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: "Sensor Data"
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

    function getBaseData(){
        $.ajax({
            url: 'api/base-data/read',
            method: "POST",
            dataType: "json",
            data: {
                api_key: "data",
                action: "fetch",
            },
            success: function(data, textStat) {
                console.log(data);
                // alert(textStat);
                var mybasedata = $('#mybasedata');
                var res="";
                data.baseDatas.forEach(data => {
                    if(data.name == 'motor_status')
                    {
                        res+="<p>"+data.name+"="+ `${data.value=="0"?"Closed":"Opened"}`+"</p>";
                    }
                    else if(data.name == "control_mode")
                    {
                        res+="<p>"+data.name+"="+ `${data.value=="0"?"Automatic (Arduino) ":"Manual(User)"}`+"</p>";

                    }else
                    res+="<p>"+data.name+"="+ data.value+"</p>";
                });
                    
                
                mybasedata.html(res);
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
    function changeControl(mode){

    }
    function changeMotor(status){

    }

    function changeThreshold(value){

    }

    function setTimer(time){

    }



    $(document).ready(function() {


        setInterval(function() {
            getBaseData();
            getUpdate();
        }, 3000);
        
        // var xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 120, 130, 140, 150, 80, 90, 100, 110, 120];
        // var yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15, 11, 14, 14, 15, 8, 9, 9, 9, 10];



    });
    // var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             //var data = JSON.parse(this.responseText);
    //             console.log(this.responseText);
    //         }
    //     };
    //     xhttp.open("POST", "actions.php", true);
    //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xhttp.send("page=data&action=fetchSoil");
</script>

</html>