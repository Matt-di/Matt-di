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

<body>
    <div class="container">
    <table class="table table-responsive table-bordered" id="myTable">

    </table>
    </div>
</body>

<script>
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
                var dataa = ` <tr>
            <th>Data Id</th>
            <th>Soil Moisture</th>
            <th>Humidity</th>
            <th>Temperature</th>
            <th>Motor Status</th>
            <th>Updated Date </th>
            <th>Control Mode</th>

        </tr>`;
                let dataLength =data.totalData-1;
                data = data.datas;
                for(i = dataLength; i>=0; i--)
                {
                    dataa +=
                    `<tr>
                    <td>${data[i].data_id}</td>
                    <td>${data[i].soilMoisture}</td>
                    <td>${data[i].humidity}</td>
                    <td>${data[i].temperature}</td>
                    <td>${data[i].motorStatus}</td>
                    <td>${data[i].updated_date}</td>
                    `;
                }
                $("#myTable").html(dataa);
            },
            error: function(data, textstst, error) {
                console.log(error);
            }

        });
    }
    $(document).ready(function() {
        getUpdate();
    });
</script>