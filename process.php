<?php
function addLogo($selectedImage, $logoImagePath, $outputImagePath)
{
   
    try {

        if (empty($logoImagePath)) {
            throw new ImagickException('Diretório da logo não foi configurado.');
        }
        
       
        // Create new Imagick objects for source image and logo
            $anuncio = new Imagick();
            $selectedImage =  __DIR__.'/images/'.$_POST['selectedImage'];
          
            if (file_exists($selectedImage)) {

                $anuncio->readImage($selectedImage);
                $anuncioWidth = $anuncio->getImageWidth();
                $anuncioHeight = $anuncio->getImageHeight();

            } else {
                throw new ImagickException('Imagem selecionada não existe.');
            }

        $logo = new Imagick($logoImagePath);

        // $logoWidth = $logo->getImageWidth();
        // $logoHeight = $logo->getImageHeight();
    
        $logoWidth = 200;
        $logoHeight = 200;
        
        // Resize the logo image
        $logo->scaleImage($logoWidth, $logoHeight, true);


      // Calculate the position to place the logo in the bottom right corner
      $positionX = 170; // Left margin
      $positionY = $anuncioHeight - $logoHeight - 11; // Bottom margin
      
       
 
        $anuncio->compositeImage($logo, Imagick::COMPOSITE_OVER, $positionX, $positionY);
  
  
        // Set the image format to JPEG and quality to 90 (adjust as needed)
        $anuncio->setImageFormat('png');
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
        
        $selectedImage = __DIR__.'/images/'.$_POST['selectedImage'];
        $logoTmpPath = $_FILES['logo']['tmp_name']; // caminho temporario
        $logoFileName = $_FILES['logo']['name']; // nome do arquivo original
        $logoImagePath = __DIR__.'/images/uploads/logos/' . $logoFileName; 

        $outputImagePath = __DIR__.'/images/imagensGeradas/result_image.png'; 
      
    //     echo $selectedImage;
       
    //     echo "imagem selecionada:", $selectedImage;
    //    echo "<br><br>";
    //     // exit;
    //     echo "caminho temporario da logo:", $logoTmpPath;
    //     echo "<br><br>";    
    //     echo "imagem da logo:", $logoImagePath;
    //         echo "<br><br>";    
    //     echo "caminho de saida:", $outputImagePath;
    //         echo "<br><br>";
    //     exit;
        
        // Move the uploaded logo file to the permanent location
        move_uploaded_file($logoTmpPath, $logoImagePath);
        
        // Process the image and add the watermark/logo
        addLogo($selectedImage, $logoImagePath, $outputImagePath);
        
      
        header('Content-disposition: inline');
       
        
        // Display the result and provide a download link
        
        echo '<h1>Resultado :</h1>';
        echo '<img src="data:image/png;base64,' . base64_encode(file_get_contents($outputImagePath)) . '" alt="Result Image" width="400" height="400"><br><br>';

        echo '<a href="' . $outputImagePath . '" download>Download</a>';
    } else {
        echo 'Error: Por favor, selecione uma imagem para logo.';
    }
} else {
    echo 'Error: Requisição inválida.';
}