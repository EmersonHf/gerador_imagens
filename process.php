
<?php
function addLogo($sourceImagePath, $logoImagePath, $outputImagePath)
{
    
    // Create new Imagick objects
    $anuncio = new Imagick($sourceImagePath);
    $anuncioWidth = $anuncio->getImageWidth();
    echo $anuncioWidth;
    exit;
    $logo = new Imagick($logoImagePath);
    
    // Get the dimensions of the source image and watermark
    
    $anuncioHeight = $anuncio->getImageHeight();
    
    $logokWidth = $logo->getImageWidth();
    $logokHeight = $logo->getImageHeight();

    // Calculate the position to place the watermark at the bottom right corner
    $positionX = $anuncioWidth - $logokWidth - 10;
    $positionY = $anuncioHeight - $logokHeight - 10;

    // Composite the watermark onto the source image
    $anuncio->compositeImage($logo, Imagick::COMPOSITE_OVER, $positionX, $positionY);

    // Set the image format to JPEG and quality to 90 (adjust as needed)
    $anuncio->setImageFormat('jpeg');
    $anuncio->setImageCompressionQuality(90);

    // Save the modified image to the output path
    $med = $anuncio->writeImage($outputImagePath);
    if(!$med){
        echo 'deu ruim';

    }else{
        echo 'deu';
    }
    exit;
    // Clear the memory
    $anuncio->clear();
    $anuncio->destroy();
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    
    // Retrieve the selected image and logo
    $selectedImage = __DIR__.'/images/stamp.jpg';
    $logo = $_FILES['logo'];
    
    // Process the image and add the watermark
  
    $outputImage = __DIR__.'/images/imagensGeradas.png';

    // Call the function to add the watermark
    addLogo($selectedImage, $logo, $outputImage);
    echo $outputImage;
    exit;
    // Save the modified image to a file (modify this as per your requirement)
    
    // $image->writeImage($outputImage);

    // Generate a unique ID for the modified image
    $imageID = uniqid();

    // Provide the link to download the modified image
    $downloadLink = "download.php?image=$imageID";


    // Return the modified image for the user to download
    header('Content-Type: image/png');
    header('Content-Disposition: filename="modified_image.png"');
    readfile($outputImage);
    exit;

}