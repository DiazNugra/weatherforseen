<!DOCTYPE html>
<head>
    <meta charset="ugt-8">
    <title>Weather Forecast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="banner">
        Weather Forseen
    </div>
    <br>

    <?php    
    function get_client_ip()
    {
        $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
    }

                    //$ip             = get_client_ip();
                    $ip             = "Bali";
                    $apiKey         = "40248805b1184c6a95f30853210908";
                    $request        = "http://api.weatherapi.com/v1/forecast.json?key=$apiKey&q=$ip&days=2&aqi=no&alerts=no&lang=jv";
                    $json           = file_get_contents($request);
                    $respon         = json_decode($json, true); 
                    $uvLevel        = $respon["forecast"]["forecastday"][1]["day"]["uv"];
                    $lat            = $respon["location"]["lat"];
                    $lon            = $respon["location"]["lon"];
                    
    ?>
                    <!-- <iframe align="right" width="70%" height="700" src="https://maps.google.com/maps?q=<?php echo $lat; ?>,<?php echo $lon; ?>&output=embed"></iframe>    -->
                                                        
                    <table class="tabel-content">
                        <h2 align="center">Keadaan Cuaca Hari Ini</h2>
                        <tr><td>Kota<td><?php echo $respon["location"]["name"];?></td>
                        <tr><td>Suhu Saat Ini<td><?php echo $respon["current"]["temp_c"]."°C";?></td>
                        <tr><td>Tanggal<td><?php echo $respon["location"]["localtime"];?></td>     
                        <tr><td>Keadaan Cuaca<td><?php echo $respon["current"]["condition"]["text"];?></td>      
                        <tr><td>Latitude<td><?php echo $respon["location"]["lat"];?></td>
                        <tr><td>Latitude<td><?php echo $respon["location"]["lon"];?></td>                 
                    </table>    

                    <table class="tabel-content">
                        <h2 align="center">Perkiraan Cuaca Besok</h2>
                        <tr><td>Tanggal<td><?php echo $respon["forecast"]["forecastday"][1]["date"];?></td>
                        <tr><td>Suhu Rata Rata<td><?php echo $respon["forecast"]["forecastday"][1]["day"]["avgtemp_c"]."°C";?></td>
                        <tr><td>Keadaan Cuaca<td><?php echo $respon["forecast"]["forecastday"][1]["day"]["condition"]["text"];?></td>
                        <tr><td>Kelembapan Udara<td><?php echo $respon["forecast"]["forecastday"][1]["day"]["avghumidity"]."%";?></td>
                        <tr><td>Index Sinar UV<td><?php echo $respon["forecast"]["forecastday"][1]["day"]["uv"];?></td>
                        <tr><td colspan="2">
                            <?php if($uvLevel > 5 )
                            {
                                echo "Index Sinar UV Tinggi <br> 
                                      Disarankan Untuk Mengurangi <br>
                                      Kegiatan Luar Ruangan <br>
                                      Atau Pakai Sunblock";
                            }
                            else
                            {

                            }
                            
                            ?>
                        </table>
                        <div class="frame">
                        <iframe align="center" width="80%" height="500" border="0" src="https://api.maptiler.com/maps/basic/?key=sdUtGmPHGaheRGvWkMqW#10.0/<?php echo $lat; ?>/<?php echo $lon; ?>"></iframe>   
                        <iframe align="center" width="80%" height="500" src="https://maps.google.com/maps?q=<?php echo $lat; ?>,<?php echo $lon; ?>&output=embed"></iframe>   
                        </div>
                        <br>

        <div class="footer">
        Weather Forecast
        </div>            
</body>
</html>