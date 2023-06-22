<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Locarmais </title>
   
    <link rel="stylesheet" href="css/style.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');
</style>
</head>
<body>
    <header class="logo-bg">
        <div class="container header-img">
          <img class="nav-img" src="images/nav/LOGO.png" alt="logoLocarMais" srcset="">     
        </div>
    </div>
    </header>
    <h1>Selecione uma imagem de divulgação</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <div class="image-container">

            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio01.jpg" id="anuncio01" checked>
                <label for="anuncio01">
                    <img src="/images/anuncio01.jpg" alt="anuncio01" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio02.jpg" id="anuncio02">
                <label for="anuncio02">
                    <img src="/images/anuncio02.jpg" alt="anuncio02" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio03.jpg" id="anuncio03">
                <label for="anuncio03">
                    <img src="/images/anuncio03.jpg" alt="anuncio03" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio04.jpg" id="anuncio04">
                <label for="anuncio04">
                    <img src="/images/anuncio04.jpg" alt="anuncio04" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio05.jpg" id="anuncio05">
                <label for="anuncio05">
                    <img src="/images/anuncio05.jpg" alt="anuncio05" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio06.jpg" id="anuncio06">
                <label for="anuncio06">
                    <img src="/images/anuncio06.jpg" alt="anuncio06" width="200" height="200">
                </label>
            </div>
           
        </div>
        <h1>Selecione uma imagem para story</h1>
        <div class="image-container">

<div class="image-item">
    <input checked type="radio" name="selectedStoryImage" value="storyanuncio01.jpg" id="storyanuncio01">
    <label for="storyanuncio01">
        <img src="/images/storyImages/storyanuncio01.jpg" alt="storyanuncio01" width="150" height="250">
    </label>
</div>
<div class="image-item">
    <input type="radio" name="selectedStoryImage" value="storyanuncio02.jpg" id="storyanuncio02">
    <label for="storyanuncio02">
        <img src="/images/storyImages/storyanuncio02.jpg" alt="storyanuncio02" width="150" height="250">
    </label>
</div>
<div class="image-item">
    <input type="radio" name="selectedStoryImage" value="storyanuncio03.jpg" id="storyanuncio03">
    <label for="storyanuncio03">
        <img src="/images/storyImages/storyanuncio03.jpg" alt="storyanuncio03" width="150" height="250">
    </label>
</div>
<div class="image-item">
    <input type="radio" name="selectedStoryImage" value="storyanuncio04.jpg" id="storyanuncio04">
    <label for="storyanuncio04">
        <img src="/images/storyImages/storyanuncio04.jpg" alt="storyanuncio04" width="150" height="250">
    </label>
</div>

</div>
        <br>
        <label for="logo">Suba sua Logo:</label>
        <input type="file" name="logo" id="logo" accept="image/*">
        <br><br>
        <button type="submit">Colocar a logo</button>
    </form>
</body>
</html> 