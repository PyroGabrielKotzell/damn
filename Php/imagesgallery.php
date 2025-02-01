<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <style>
        .image{
            width: -webkit-fill-available;
            height: -webkit-fill-available;
        }
        .row{
            margin-top: 10px;
        }
    </style>
    <?php
    
    echo '
        <div class="container text-center" style="margin-top:10px">
            <div class="row">
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=1"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=2"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=3"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=4"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=5"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=6"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=7"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=8"/>
                </div>
                <div class="col-sm-4">
                    <img class="image" src="https://random-image-pepebigotes.vercel.app/api/random-image?id=9"/>
                </div>
            </div>
        </div>
        ';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>