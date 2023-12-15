
<?php
    $multi = 1;

    //da serveradmin kann do inepfuscha und die Multiplikatoren ändera
    $butter_multi = 1;
    $conflakes_multi = 3;
    $conflakes_grenze = 20;
    $vanillegipferl_multi = 7;
    $vanillegipferl_grenze = 30;
    $bierkeks_multi = 12;
    $bierkeks_grenze = 100;

    //Definitiv koan Datenklau passiert do
    $file="location.csv";

    //location klaua
    $new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
    //echo "Latitude:".$new_arr[0]['geoplugin_latitude']." and Longitude:".$new_arr[0]['geoplugin_longitude'];
    $lat = $new_arr[0]['geoplugin_latitude'];
    $lng = $new_arr[0]['geoplugin_longitude'];
    $contetn = $lat . ";" . $lng . "\n";

    //schoua ob des scho existiert  
    $file_to_read = fopen($file, 'r');
    if($file_to_read !== FALSE){
        //echo "<table>\n";
        while(($data = fgetcsv($file_to_read, 100, ';')) !== FALSE){
            //echo "<tr>";
            for($i = 0; $i < count($data); $i++) {
                //echo "<td>".$data[$i]."</td>";
                
            }
            //echo "</tr>\n";
        }
        echo "</table>\n";
        fclose($file_to_read);
}

    
    file_put_contents($file, $content, FILE_APPEND);

    // da coockie für an keks
    if(!isset($_COOKIE['keks'])){
        $keks = "Butterkeks";
    }else{
        $keks = $_COOKIE['keks'];
    }
    
    if(isset($_POST['sort']))
    {
        $keks = $_POST['sort'];
        if($_POST['sort'] == "Butterkeks"){
            $multi = $butter_multi;
            
        }
        if($_POST['sort'] == "cornflakes"){
            $multi = $conflakes_multi;
        }
        if($_POST['sort'] == "vanillegipflerl"){
            $multi = $vanillegipferl_multi;
        }
        if($_POST['sort'] == "bierkeks"){
            $multi = $bierkeks_multi;
        }
    }
    

    if(!isset($_COOKIE['count'])){
        $count = 0;
    }else{
        $count = $_COOKIE['count'];
    }

    

    if(array_key_exists('cookie', $_POST)) { 
        
        for ($i = 0; $i <= $multi; $i++) {
            if(isset($_POST["sort"])){
                setcookie('cookie' . $count + $i, $_POST["sort"]);
            }
            else{
                setcookie('cookie' . $count + $i, "standartkeks");
            }
            
            //echo $i;
          }
        $count += $multi;
    } 

    setcookie('count', $count);
    setcookie('keks', $keks);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="uft-8">
        <title>cookie klicker</title>
        <style>
        body{
            background-color: #f7b786;
        }
        h1{
            color: green;
        }
        .cookie{
            height: 14rem;
            width: 14rem;
            border-radius: 7rem;
            color: #FFFFFF;
            background-color: #ed7315;
        }

        .counter{
            color: #a14600;
            background-color: pink;
            border-color: black;
            border-width: 1px;
            border-radius: 5px;
            width: 10rem;
            font-size:30px;
            
        }

        </style>
    </head>
    <body>
        <h1>
            Cookie Klicker von Fabi
        </h1>
        Bitte akzeptiend cookies weil dia Sita macht viele cookies <br>
        <p class="counter">
            Cookies <?= $count ?>
        </p>
        

        <form method="post">
            
            <input type="radio" name ="sort" value="Butterkeks" id="Butterkeks" 
            <?php if ($keks == 'Butterkeks') echo 'checked'; ?>
             >
            <label for="Butterkeks">Butterkeks Multiplikator = <?= $butter_multi?> </label><br>

            <?php 
                if($count > $conflakes_grenze){ //conflakes keks
                echo "<input type='radio' name ='sort' value='cornflakes' id='cornflakes' " ;
                if ($keks == 'cornflakes') {
                    echo 'checked';
                } 
                echo "><label for='cornflakes'>cornflakes keks Multiplikator = ";
                echo $conflakes_multi;
                echo "</label> <br>";

                if($count > $vanillegipferl_grenze){ //vanillegipferl
                    echo '<input type="radio" name ="sort" value="vanillegipflerl" id="vanillegipflerl"';
                    if ($keks == 'vanillegipflerl') {
                        echo 'checked';
                    } 
                    echo '> <label for="vanillegipflerl">vanillegipflerl keks Multiplikator = ';
                    echo $vanillegipferl_multi;
                    echo '</label> <br>';
                }

                if($count > $bierkeks_grenze){ //bierkeks
                    echo '<input type="radio" name ="sort" value="bierkeks" id="bierkeks"';
                    if ($keks == 'bierkeks') {
                        echo 'checked';
                    } 
                    echo '> <label for="bierkeks">bierkeks keks Multiplikator = ';
                    echo $bierkeks_multi;
                    echo '</label> <br>';
                }
            }
            ?>


            <button type="submit" name="cookie" value="click" class="cookie">Cookie</button>
        </form>
    </body>
</html>