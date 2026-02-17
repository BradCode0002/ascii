<?php
$imagePath = 'photo.jpg'; 
$info = getimagesize($imagePath);
$image = ($info['mime'] == 'image/png') ? imagecreatefrompng($imagePath) : imagecreatefromjpeg($imagePath);

if (!$image) die("Image failed to load.");

list($width, $height) = $info;
$text = "ILOVEYOU";
$textLength = strlen($text);
$charIndex = 0;

echo '<div style="
    background: #000; 
    font-family: monospace; 
    font-size: 7px; 
    line-height: 0.7; 
    letter-spacing: -1px; 
    white-space: pre; 
    text-align: center; 
    display: inline-block; 
    padding: 30px;">';

for ($y = 0; $y < $height; $y += 7) { 
    for ($x = 0; $x < $width; $x += 3) {
        $rgb = imagecolorat($image, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        $brightness = ($r * 0.299 + $g * 0.587 + $b * 0.114);


        if ($brightness < 230) { 
            
            $grayLevel = intval($brightness);
            $finalGray = max(80, $grayLevel); 

            echo "<span style='color: rgb($finalGray, $finalGray, $finalGray);'>" . $text[$charIndex % $textLength] . "</span>";
            $charIndex++;
        } else {
           
            echo " "; 
        }
    }
    echo "\n";
}

echo '</div>';

?>          