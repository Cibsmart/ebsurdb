<?PHP
 
/////////////////////////////////////////////
//  send_imagever.php                      //
/////////////////////////////////////////////
 
 
session_start();
 
 
 
// set up some default values
// ~~~~~~~~~~~~~~~~~~~~~~~~~~
$sessionvar = 'imageVerHash';
$imgWidth = 96;
$imgHeight = 36;
$borderThick = 1;
$numChars = 5;
 
 
// set up blank image pallet with borders
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$image = imagecreate($imgWidth, $imgHeight);
$bgColor = imagecolorallocate ($image, 255, 255, 255);
$textColor = imagecolorallocate ($image, 0, 0, 0);
 
 
// Initialize some values
// ~~~~~~~~~~~~~~~~~~~~~~
$numString = '';                // init string of numbers
$minX = $borderThick +2;        // first x position for chars
$minY = $borderThick +2;        // lowest y position for chars
srand(make_seed());             // seed the random generator
 
 
// Loop $numChars times, generate random char/font/offset
// and render to image object
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$idx = 0;
while ($idx < $numChars):
 
    // pick a font and calculate the character size for it
    $font = rand(3,5);          // pick a font (3,4,or5) 
    $fontWidth = imagefontwidth($font);
    $fontHeight = imagefontheight($font);      
 
    // pick a random digit and add it to the string
    if ($font > 4) {
        $char = rand(0,9);          // small zeroes are confusing
    }                                       // because they look like 8's
    else {                              // so avoid them
        $char = rand(1,9);         
    }
    $numString .= $char;
 
    $xOffset = $minX + rand(3,10);  // pick new x offset
    $minX = $xOffset + $fontWidth;  // new minX is right side of new char
 
    // pick a random Y offset (within available space)
    $maxY = $imgHeight - $borderThick - $fontHeight;
    $yOffset = rand($minY, $maxY);
     
    // render the character to the image
    imagechar ($image, $font, $xOffset, $yOffset, $char, $textColor);
 
    $idx++;
     
endwhile;
 
 
// draw border;
if ($borderThick > 0) {
    imagelinethick ($image, 1,1,$imgWidth,1,$textColor,$borderThick);
    imagelinethick ($image, 1,1,1,$imgHeight,$textColor,$borderThick);
    imagelinethick ($image, $imgWidth-$borderThick,1,$imgWidth-$borderThick,$imgHeight,$textColor,$borderThick);
    imagelinethick ($image, 1,$imgHeight-$borderThick,$imgWidth,$imgHeight-$borderThick,$textColor,$borderThick);
}
 
 
// save hash of string in session var
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
$_SESSION[$sessionvar] = md5($numString);
 
 
 
// Send out enough headers so the image is NEVER cached by browsers
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 
 
// Send the image to the browser
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
header('Content-type: image/jpeg');
imagejpeg($image);
imagedestroy($image);
 
 
return;
 
 
 
///////////////////////////////////////////////////////////////////////
//  This is just a fancy function to draw the borders                //
///////////////////////////////////////////////////////////////////////
 
function imagelinethick($image, $x1, $y1, $x2, $y2, $color, $thick = 1)
{
    if ($thick == 1) {
        return imageline($image, $x1, $y1, $x2, $y2, $color);
    }
    $t = $thick / 2 - 0.5;
    if ($x1 == $x2 || $y1 == $y2) {
        return imagefilledrectangle($image, round(min($x1, $x2) - $t), round(min($y1, $y2) - $t), round(max($x1, $x2) + $t), round(max($y1, $y2) + $t), $color);
    }
    $k = ($y2 - $y1) / ($x2 - $x1); //y = kx + q
    $a = $t / sqrt(1 + pow($k, 2));
    $points = array(
        round($x1 - (1+$k)*$a), round($y1 + (1-$k)*$a),
        round($x1 - (1-$k)*$a), round($y1 - (1+$k)*$a),
        round($x2 + (1+$k)*$a), round($y2 - (1-$k)*$a),
        round($x2 + (1-$k)*$a), round($y2 + (1+$k)*$a),
    );
    imagefilledpolygon($image, $points, 4, $color);
    return imagepolygon($image, $points, 4, $color);
}
 
 
?>
 
 
 
 
<?PHP
/////////////////////////////////////////////
// stub_imgver.php                         //
/////////////////////////////////////////////
 
session_start();
 
if (    isset($_POST['submit']) &&
        isset($_POST['imagever']) &&
        isset($_SESSION['imageVerHash'])
    ) {
 
        $verstring = trim($_POST['imagever']);
        $formhash = md5($verstring);
        if ($formhash == trim($_SESSION['imageVerHash'])) {
            print "matched";
            unset($_SESSION['imageVerHash']);
        }
        else {
            unset($_SESSION['imageVerHash']);
            print "no match";
        }
 
}
else {
 
    print "
     
    <html>
        <head>
            <title>Image Verification Stub</title>
        </head>
        <body>
            <FORM ACTION=\"" . $_SERVER['PHP_SELF'] . "\" NAME=\"myform\"  METHOD=\"POST\" ENCTYPE=\"application/x-www-form-urlencoded\">
            <input type=\"text\" name=\"imagever\"><img src=\"send_imagever.php\">
            <input type=\"submit\" name=\"submit\" value=\"SUBMIT\">
            </form>
        </body>
    </html>
    ";
     
}
 
?>