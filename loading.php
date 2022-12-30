<!DOCTYPE html>
<html>
<head>
    <title>loading</title>

    <!-- Include the heartcode canvasloader js file -->


    <style type="text/css">
        body, html {
            margin:0;
            padding:0;
            overflow:hidden;
            background-color:#ffffff;
        }
        .wrapper {
            position:absolute;
            top:50%;
            left:50%;
        }
    </style>
</head>
<body>

    <div id="canvasloader-container" class="wrapper"></div>


    <script type="text/javascript">
        var cl = new CanvasLoader('canvasloader-container');
        cl.setColor('#0c0d0c'); 
        cl.setDiameter(60); 
        cl.setDensity(65); 
        cl.setFPS(45); 
        cl.show(); 

        var loaderObj = document.getElementById("canvasLoader");
        loaderObj.style.position = "absolute";
        loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
        loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
    </script>
</body>
</html>