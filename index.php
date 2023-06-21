<!DOCTYPE html>
<html>
<head>
    <title>Select Image</title>
    <style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
           
        }
        img{
            border-radius: 20px;
        }
        .image-item {
            margin: 10px; 
           
           
        }
    </style>
</head>
<body>
    <h1>Selecione uma imagem</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
        <div class="image-container">
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio04.png" id="anuncio04" checked>
                <label for="anuncio04">
                    <img src="/images/anuncio04.png" alt="Image 1" width="200" height="200">
                </label>
            </div>
            <div class="image-item">
                <input type="radio" name="selectedImage" value="anuncio04.jpg" id="anuncio05">
                <label for="anuncio05">
                    <img src="/images/anuncio05.jpg" alt="Image 2" width="200" height="200">
                </label>
            </div>
            <!-- Add more image items as needed -->
        </div>
        <br>
        <label for="logo">Upload Logo:</label>
        <input type="file" name="logo" id="logo" accept="image/*">
        <br><br>
        <button type="submit">Colocar a logo</button>
    </form>
</body>
</html> 