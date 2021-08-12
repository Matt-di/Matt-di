<?php
include "../class/WeatherApi.php";
include "../class/Action.php";
$action = new Action();
$location = $action->getLocation();
$weatherApiData = new WeatherAPI($location);


$selectedLanguage = $action->selectLanguage();
if (isset($_GET['lang'])) {
    $action->updateLanguage($_GET['lang']);
    $selectedLanguage = $_GET['lang'];
}
include("../Lan/lang-" . $selectedLanguage . ".php");
echo "<script> var language = " . json_encode($language) . "</script/>";
?>

<!DOCTYPE html>
<html lang="<?php echo $selectedLanguage; ?>">
<?php
include "../includes/header.php";
?>

<body>
    <main class="container">

        <div class="row">
            <div class="col-md-6">
                <div>
                    <h3 style="color:#66fafa">Your Field Location is set to</h3>
                    <b>latitude </b>=<?php echo $location['lat'] ?>
                    <b>Longitude</b>=<?php echo $location['lon'] ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <span id="message"></span>
                <form class="form-inline" id="update-location-form">
                    <input type="text" class="form-control m-2" id="latitude" name="latitude" placeholder="Latitude" />
                    <input type="text" class="form-control m-2" id="longitude" name="longitude" placeholder="longitude" />
                    <input type="submit" class="btn btn-secondary form-control m-2" value="Update" />
                </form>
            </div>
        </div>

        <div class="row">
            <div class="card col-md-6 m-1">
                <div class="card-title">
                    <h3>Hello</h3>
                </div>
                <div class="card-body">
                    <p>Today</p>
                    <img src="../assets/back.gif" />
                    <p>What it feels</p>
                    <p>Humidity</p>
                    <p>Temperature</p>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="d-flex flex-row list-group bg-secondary">
                <div class="card  m-1">
                    <div class="card-title">
                        <h3>Hello</h3>
                    </div>
                    <div class="card-body">
                        <p>Today</p>
                        <img src="../assets/back.gif" />
                        <p>What it feels</p>
                        <p>Humidity</p>
                        <p>Temperature</p>
                    </div>
                </div>
                <div class="d-flex flex-row ">
                    <div class="card  m-1">
                        <div class="card-title">
                            <h3>Hello</h3>
                        </div>
                        <div class="card-body">
                            <p>Today</p>
                            <img src="../assets/back.gif" />
                            <p>What it feels</p>
                            <p>Humidity</p>
                            <p>Temperature</p>
                        </div>
                    </div>
                    <div class="card  m-1">
                        <div class="card-title">
                            <h3>Hello</h3>
                        </div>
                        <div class="card-body">
                            <p>Today</p>
                            <img src="../assets/back.gif" />
                            <p>What it feels</p>
                            <p>Humidity</p>
                            <p>Temperature</p>
                        </div>
                    </div>
                    <div class="card  m-1">
                        <div class="card-title">
                            <h3>Hello</h3>
                        </div>
                        <div class="card-body">
                            <p>Today</p>
                            <img src="../assets/back.gif" />
                            <p>What it feels</p>
                            <p>Humidity</p>
                            <p>Temperature</p>
                        </div>
                    </div>

                </div>
            </div>
    </main>
</body>

<script>
    function checkInput() {
        if ($("#latitude").val() == "" || $("#longitude").val() == "") return false;
        else if (Number.isNaN($("#latitude").val())) {
            return false;
        } else if (Number.isNaN($("#longitude").val())) {
            return false;
        } else {

            if ($("#latitude").val() < 0 || $("#latitude").val() > 100 || $("#longitude").val() < 0 || $("#longitude").val() > 100)
                return false;
            return true;
        }
    }
    $(document).ready(function() {
        $("#update-location-form").on("submit", function(event) {
            event.preventDefault();
            if (checkInput()) {
                $.ajax({
                    method: "POST",
                    url: "api/user/updateLocation",
                    data: {
                        "latitude": $("#latitude").val(),
                        "longitude": $("#longitude").val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#message").html("<span class='alert alert-info'>" + data.message + "</span>");
                    },
                    error: function(error) {
                        console.log(error);

                    }

                });
            }
        });
    });
</script>

</html>