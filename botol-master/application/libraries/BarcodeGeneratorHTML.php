<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarcodeGeneratorHTML
{
    const TYPE_CODE_128 = 'code128';

    public function getBarcode($text)
    {
        // Generate 10 digit random number
        $randomNumber = $this->generateRandomNumber();
        $barcodeText = $text . ' ' . $randomNumber; // Combine asset name and random number

        // Generate barcode
        $barcodeImage = $this->generateBarcode($barcodeText);

        return '<img src="data:image/png;base64,' . base64_encode($barcodeImage) . '" style="max-width: 100%; height: auto;" />'; // Return base64 image
    }

    private function generateRandomNumber()
    {
        $min = 1000000000; // Minimum 10 digit number
        $max = 9999999999; // Maximum 10 digit number
        
        // Ensure both min and max are integers
        return rand(intval($min), intval($max)); 
    }

    private function generateBarcode($text)
{
    // Set barcode image dimensions
    $width = 600; // Lebar barcode diperbesar
    $height = 300; // Tinggi barcode diperbesar

    // Create a blank image
    $barcodeImage = imagecreate($width, $height);

    // Set colors
    $white = imagecolorallocate($barcodeImage, 255, 255, 255);
    $black = imagecolorallocate($barcodeImage, 0, 0, 0);

    // Fill the background
    imagefilledrectangle($barcodeImage, 0, 0, $width, $height, $white);

    // Draw barcode (simple representation for demonstration)
    $barWidth = 4; // Width of the bars
    $barHeight = 150; // Height of the bars
    $spaceWidth = 2; // Space between bars

    // Generate barcode pattern
    $pattern = $this->generateBarcodePattern($text);
    $x = 50; // Start position

    foreach ($pattern as $bar) {
        if ($bar == '1') {
            imagefilledrectangle($barcodeImage, $x, $height - $barHeight, $x + $barWidth, $height, $black);
        }
        $x += $barWidth + $spaceWidth; // Move to the next position
    }

    // Add text below the barcode
    // $fontSize = 6; // Font size
    // $textWidth = imagefontwidth($fontSize) * strlen($text);
    // $textX = ($width - $textWidth) / 2; // Center the text
    // $textY = $height - 30; // Position text just above the bottom edge

    // // Write the text
    // imagestring($barcodeImage, $fontSize, $textX, $textY, $text, $black);

    // Output the image to the buffer
    ob_start();
    imagepng($barcodeImage); // Generate PNG image
    $imageData = ob_get_contents(); // Get output buffer
    ob_end_clean(); // Clean the buffer

    imagedestroy($barcodeImage); // Destroy the image to free memory

    return $imageData; // Return image data
}


    private function generateBarcodePattern($text)
    {
        // This function generates a simple barcode pattern based on the text
        // You can replace this logic with a real barcode generation logic

        $pattern = [];
        for ($i = 0; $i < strlen($text); $i++) {
            // Convert character to binary representation
            $binary = sprintf('%08b', ord($text[$i]));
            $pattern = array_merge($pattern, str_split($binary));
        }
        return $pattern;
    }
}
