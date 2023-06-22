<?php
function addLogo($selectedImage, $logoImagePath, $outputImagePath,$outputStoryImagePath)
{
   
    try {

        if (empty($logoImagePath)) {
            throw new ImagickException('Diretório da logo não foi configurado.');
        }

            if($_POST['selectedStoryImage'] && isset($_POST['selectedStoryImage']))
            {
                $story = new Imagick();
                $selectedStoryImage = __DIR__.'/images/storyImages/'.$_POST['selectedStoryImage'];


                if (file_exists($selectedStoryImage)) {

                    $story->readImage($selectedStoryImage);
                    $storyWidth = $story->getImageWidth();
                    $storyHeight = $story->getImageHeight();
    
                } else {
                    throw new ImagickException('Imagem selecionada não existe.');
                }

                $logo = new Imagick($logoImagePath);

                $logoWidth = 200;
                $logoHeight = 200;
                
                
                // Resize the logo image
                $logo->scaleImage($logoWidth, $logoHeight, true);
                // Calculate the position to place the logo in the bottom left corner
                 $positionX = 0; // Left margin
                 $positionY = $storyHeight - $logoHeight - 246; // Bottom margin

                 $story->compositeImage($logo, Imagick::COMPOSITE_OVER, $positionX, $positionY);
  
                 // Set the image format to png and quality to 90 (adjust as needed)
                 $story->setImageFormat('png');
                 $story->setImageCompressionQuality(90);
                 
                 // Save the result image to the output path
         
                 $story->writeImage($outputStoryImagePath);

                 header('Content-disposition: inline');

                 // Destroy the Imagick objects to free up memory
                 $story->destroy();
                 $logo->destroy();
                 
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
        
        $selectedImage = '/images/'.$_POST['selectedImage'];
        $selectedStoryImage = '/images/storyImages/'.$_POST['selectedStoryImage'];
        $logoTmpPath = $_FILES['logo']['tmp_name']; // caminho temporario
        $logoFileName = $_FILES['logo']['name']; // nome do arquivo original
        $logoImagePath = __DIR__.'/images/uploads/logos/' . $logoFileName; 

        $outputImagePath = __DIR__.'/images/imagensGeradas/result_image.png'; 
        $outputStoryImagePath = __DIR__.'/images/imagensGeradas/story/result_story_image.png'; 
      
    //     echo $selectedImage;
       
    //     echo "saida imagem selecionada:", $outputImagePath;
    //    echo "<br><br>";
       
    //    echo "saida imagem selecionada para story:", $outputStoryImagePath;
    //    echo "<br><br>";
    //     exit;
    //     echo "caminho temporario da logo:", $logoTmpPath;
    //     echo "<br><br>";    
    //     echo "imagem da logo:", $logoImagePath;
    //         echo "<br><br>";    
    //     echo "caminho de saida da imagem:", $outputImagePath;
    //         echo "<br><br>";
    //         echo "caminho de saida do story:", $outputStoryImagePath;
    //         echo "<br><br>";
    //     exit;
        
        // Move the uploaded logo file to the permanent location
        move_uploaded_file($logoTmpPath, $logoImagePath);
        
        // Process the image and add the watermark/logo
        addLogo($selectedImage, $logoImagePath, $outputImagePath, $outputStoryImagePath);
        
      
        header('Content-disposition: inline');
       
        
        

        if($_POST['selectedStoryImage'] && isset($_POST['selectedStoryImage']))
        {
            header('Content-disposition: inline');
               
        echo '<h1>Resultado Imagem de Story :</h1>';
        echo '<img src="data:image/png;base64,' . base64_encode(file_get_contents($outputStoryImagePath)) . '" alt="Result Image" width="200" height="300"><br><br>';

        echo '<a href="' . $outputStoryImagePath . '" download>Download</a>';
      
        }
            // Display the result and provide a download link
        
        echo '<h1>Resultado Imagem :</h1>';
        echo '<img src="data:image/png;base64,' . base64_encode(file_get_contents($outputImagePath)) . '" alt="Result Image" width="400" height="400"><br><br>';

        echo '<a href="' . $outputImagePath . '" download>Download</a>';
        
        exit;
    } else {
        echo 'Error: Por favor, selecione uma imagem para logo.';
    }
} else {
    echo 'Error: Requisição inválida.';
}