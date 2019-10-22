<?php
/*UTILITY PER LA CREAZIONE DELLE IMMAGINI FLAG*/
function imageandtext($country,$count){
	
$im = imagecreatefrompng($country);
imagealphablending($im, true);
imageSaveAlpha($im, true);
$text_color = imagecolorallocate($im, 255, 255, 255);

/*if($count < 10){
imagestring($im, 5, 44, 11,$count, $text_color);
}
elseif($count < 100){
	imagestring($im, 5, 39, 11,$count, $text_color);
}
else
{
	imagestring($im, 5, 35, 11,$count, $text_color);
}*/
imagestring($im, 5, 35, 11,$count, $text_color);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/png');
// Enable output buffering
ob_start();
// Capture the output
// Output the image
imagepng($im);

$imagedata = ob_get_contents();
// Clear the output buffer
ob_end_clean();
$data = 'data:image/png;base64,'.base64_encode($imagedata);
//print '<p><img src="'.$data.'" alt="image 1"/></p>';

$image = base64_to_jpeg( $data,$country.'_text.png' );


// Free up memory
imagedestroy($im);
	
	
	
}
function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}
?>