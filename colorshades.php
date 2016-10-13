<html>
    <head>
        <link rel="stylesheet" type="text/css" href="cssfile.css">
        <title>Color Shader -- PHP Project</title>
    </head>
    <body>
    <form method="POST" action="colorshades.php">
    <input id="textbox" type="text" name="rgb" placeholder="write rgb values(separated by comma)" autocomplete="off" pattern="(\d+)(,\d+)(,\d+)"/>
    <input type="submit" value="Give me Shades" />
    </form>
  <?php

    if(isset($_POST['rgb']))
    {
        if($_POST["rgb"] != "0,0,0")
        {
        getHSL($_POST["rgb"]);            
        }
    }

    if(isset($_POST['addred']))
    {
        $red = $_COOKIE["red"] + 15;
        $colorRGB = $red . ",".$_COOKIE["green"] ."," . $_COOKIE["blue"];
        getHSL($colorRGB);
    }

    else if(isset($_POST['addgreen']))
    {
        $green = $_COOKIE["green"] + 15;
        $colorRGB = $_COOKIE["red"] . ",". $green ."," . $_COOKIE["blue"];
        getHSL($colorRGB);
    }

    else if(isset($_POST['addblue']))
    {
        $blue = $_COOKIE["blue"] + 15;
        $colorRGB = $_COOKIE["red"] . ",".$_COOKIE["green"] ."," . $blue;
        getHSL($colorRGB);
    }


   ?>
   </tr>
</table>

<?php

function getHSL($colorInRGB)
{
    $color_rgb = explode(",", $colorInRGB);
 
   // step 1 is to conver RGB colors in range of 0 to 1. 
    $color_rgb_01[0] = $color_rgb[0]/255;
    $color_rgb_01[1] = $color_rgb[1]/255;
    $color_rgb_01[2] = $color_rgb[2]/255;

    //finding max and min.
    $max = max($color_rgb_01); 
    $min = min($color_rgb_01);

    // finding luminace which is in percentage.
    $luminace = ($min + $max) / 2;

    // calculate saturation
    if($luminace <= 0.5)
    {
        $saturation = ($max-$min)/($max+$min); 
    }
    else
    {
        $saturation = ($max-$min)/(2.0-$max-$min);
    }

    // calculating hue
    if($max-$min == 0)
    {
        $hue = 0;
    }

else{
    if($color_rgb_01[0] >= $max)
    {
        $hue = (($color_rgb_01[1] - $color_rgb_01[2])/($max-$min));
    }
    else if($color_rgb_01[1] >= $max)
    {
        $hue = 2.0 + (($color_rgb_01[2] - $color_rgb_01[0])/($max-$min));
    }
    else
    {
        $hue = 4.0 + (($color_rgb_01[0] - $color_rgb_01[1])/($max-$min));
    }
}

    // converting hue to degrees.
    $hue *= 60;
    if($hue < 0)
    {
        $hue += 360;
    }
// converting SL to percentages.
    $saturation *= 100;
    $luminace *= 100;

    setcookie("red", $color_rgb[0]);
    setcookie("green", $color_rgb[1]);
    setcookie("blue", $color_rgb[2]);

    $_SESSION["red"] = $color_rgb[0]; 
    $_SESSION["green"] = $color_rgb[1];
    $_SESSION["blue"] = $color_rgb[2];
    $_SESSION["hue"] = $hue; 
    $_SESSION["saturation"] = $saturation; 
    $_SESSION["luminace"] = $luminace; 
    
    echo "<br/><br/>";
    echo "<p>rgb(".$color_rgb[0].",".$color_rgb[1].",".$color_rgb[2].") = hsl(" . (int)$hue . ", ". (int)$saturation . "%, ". (int)$luminace . "%)";
    echo "<div class=\"dropdown\"><button class=\"button\" style=\"background-color:rgb(".$color_rgb[0].",".$color_rgb[1].",".$color_rgb[2].")\"></button>";
    echo "<div class=\"dropdown-content\"><form method=\"POST\" action=\"colorshades.php\"><button type=\"submit\" name=\"addred\">Add Red</button><button type=\"submit\" name=\"addgreen\">Add Green</button><button type=\"submit\" name=\"addblue\">Add Blue</button></form></div></div>";
    echo "</p><br/><br/><table>";
    echo "<caption>Number indicates the Luminosity Percentage</caption>    <tr>";   
    

    for($i = 10; $i <100; $i = $i + 5)
    {
        if($i<50){
        echo "<td style=\"color:white;background-color:hsl(" .$hue.",".$saturation."%,".$i."%)\">".$i."</td>";            
        }
        else{
        echo "<td style=\"background-color:hsl(" .$hue.",".$saturation."%,".$i."%)\">".$i."</td>";
        }
    }
}

?>

<?php 
if(isset($_POST['addred']))
{
    
}
if(isset($_POST['addgreen']))
{
    
}
if(isset($_POST['addblue']))
{
    
}
?>

</body>

</html>