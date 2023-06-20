<?php
function addLogo($sourceImagePath, $logoImagePath, $outputImagePath)
{
    try {

        if (empty($logoPath)) {
            throw new ImagickException('Diretório da logo não foi configurado.');
        }
        // Create new Imagick objects for source image and logo
        $anuncio = new Imagick($sourceImagePath);
        $logo = new Imagick($logoImagePath);


        $anuncioWidth = $anuncio->getImageWidth();
        $anuncioHeight = $anuncio->getImageHeight();

        $logoWidth = $logo->getImageWidth();
        $logoHeight = $logo->getImageHeight();

      // Calculate the position to place the logo at the bottom right corner
      $positionX = $anuncioWidth - $logoWidth - 10;
      $positionY = $anuncioHeight - $logoHeight - 10;

        // Add watermark/logo to the source image
        // Modify the code below according to your desired watermarking logic
        $anuncio->compositeImage($logo, Imagick::COMPOSITE_OVER, $positionX, $positionY);
  
  
        // Set the image format to JPEG and quality to 90 (adjust as needed)
        $anuncio->setImageFormat('jpeg');
        $anuncio->setImageCompressionQuality(90);

        // Save the result image to the output path

        $anuncio->writeImage($outputImagePath);

        // Destroy the Imagick objects to free up memory
        $anuncio->destroy();
        $logo->destroy();
    } catch (ImagickException $e) {
        // Handle any exceptions that occur during the process
        echo 'Error: ' . $e->getMessage();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        // Set the paths for the source image, logo, and output image
        $selectedImage = $_POST['selectedImage'];
        $logoTmpPath = $_FILES['logo']['tmp_name']; // Temporary path
        $logoFileName = $_FILES['logo']['name']; // Original file name
        $logoImagePath = __DIR__.'/images/uploads/logos/' . $logoFileName; 

        $outputImagePath = __DIR__.'/imagensGeradas/result_image.png'; 
      
        // echo $selectedImage;
        // exit;
        // echo "imagem selecionada(anuncio0x.png):", $selectedImage ;
        // echo "<br><br>";
        // echo "caminho temporario da logo:", $logoTmpPath;
        // echo "<br><br>";    
        // echo "imagem da logo:", $logoImagePath;
        //     echo "<br><br>";    
        echo "caminho de saida:", $outputImagePath;
            echo "<br><br>";
        // exit;
        
        // Move the uploaded logo file to the permanent location
        move_uploaded_file($logoTmpPath, $logoImagePath);
        
        // Process the image and add the watermark/logo
        addLogo($selectedImage, $logoImagePath, $outputImagePath);
        
        header('Content-Type: image/png');
        header('Content-Length: ' . filesize($outputImagePath));

        
        
        // Display the result and provide a download link
        
        echo '<h1>Image Processing Result</h1>';
        echo '<img src="' . $outputImagePath . '" alt="Result Image" width="400" height="400"><br><br>';
        echo '<a href="' . $outputImagePath . '" download>Download Result Image</a>';
    } else {
        echo 'Error: Please select a logo image.';
    }
} else {
    echo 'Error: Invalid request.';
}