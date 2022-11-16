
<?php require_once 'controllerUserdata.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body>
<div class="colorbg"> 
            <div class="lines">
                <section class="line2"></section>
                <section class="line1"></section>
            </div>
            <div id="container">
                <div class="content">
                    <div class="verify">
                        <svg class="verified" width="512px" height="512px" viewBox="0 0 512 512" id="_x30_1" style="enable-background:new 0 0 512 512;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M434.068,46.758L314.607,9.034C295.648,3.047,275.883,0,256,0s-39.648,3.047-58.607,9.034L77.932,46.758  C52.97,54.641,36,77.796,36,103.973v207.39c0,38.129,18.12,73.989,48.816,96.607l117.032,86.234  C217.537,505.764,236.513,512,256,512s38.463-6.236,54.152-17.796l117.032-86.234C457.88,385.352,476,349.492,476,311.363v-207.39  C476,77.796,459.03,54.641,434.068,46.758z M347.924,227.716l-98.995,98.995c-11.716,11.716-30.711,11.716-42.426,0l-42.427-42.426  c-11.716-11.716-11.716-30.711,0-42.426l0,0c11.716-11.716,30.711-11.716,42.426,0l21.213,21.213l77.782-77.782  c11.716-11.716,30.711-11.716,42.426,0h0C359.64,197.005,359.64,216,347.924,227.716z"/></svg>
                    </div>    
                    <h2>password changed</h2>
                    <p >You can now login your account with your new password.</p> 
                </div>
                <div class="pageform">
                    <form action="login.php" method="post"> 
                                <div class="loginbtn">
                                    <input type="submit" value="CONFIRM" name="login-now" id="sub">
                                </div> 
                                </div>   
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>
    <style>
             .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 48
    }   
            body{
                background: #686868;
                margin: 0;
                padding: 0;
                height: 100%;
                overflow-x: hidden;
                font-family: Arial, Helvetica, sans-serif;
                /* background-image: url("https://wallpaperaccess.com/full/562838.jpg"); */ */
                background-repeat: cover;
                background-position: center;
                background-size: cover;
                background-attachment: fixed;
            }
            .material-symbols-outlined {
                font-variation-settings:
                'FILL' 1,
                'wght' 700,
                'GRAD' 0,
                'opsz' 48
            }

            .colorbg{
                overflow-y: hidden;
                position: absolute;
                height: 100%;
                bottom: 0%;
                width: 100%;
                background: linear-gradient(270deg, transparent, white);
                display: flex;
            } 
            .pageform{
                background-color: white;
                border-radius: 0px 0px 10px 10px;
                border-top: 2px solid hsl(0, 0%, 86%);
            }
            form .loginbtn input{
                display: block;
                font-family: 'COCOGOOSE', sans-serif;
                padding: 10px;
                margin-top: 2vh;
                margin-bottom: 20px;
                margin-left: 55.5px;
                margin-right: 55.5px;
                width: 100%;
                max-height: 60px;
                outline: none;
                border: none;
                font-size: min(max(9px, 1.1vw), 11px);
                border-radius: 10px;
                color: white;
                background:  #888888;
                cursor: pointer; 
                transition: 0.5s;
            }
            form .loginbtn input:hover{
                background: #00690e; 
            }
            #container{
                position: absolute;
                top: 50%;
                left: 50%;
                max-height: 85vh;
                min-width: 300px;
                transform: translate(-50%, -50%);
                background: hsl(112, 73%, 90%);
                border-radius: 10px;
                box-shadow: 10px 20px 35px rgba(0,0,0,0.55);
            }
            .pageform{
                box-sizing: border-box;
                padding: 0 30px;
                display: flex;
            }
            #container .pageform {
                font-size: 20px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                text-align: center;
            }
            h2{
                font-family: 'PHANTOM', sans-serif;
                font-size: 30px;
                align-items: center;
                text-align: center;
                letter-spacing: 2px;
                color: black;
                margin-bottom: 5px;
            } 
            p{
                color: hsl(0, 0%, 53%);
                font-size: min(max(10px, 1.2vw), 12px);
                letter-spacing: 0.5px;
                font-family: Helvetica, sans-serif;
                align-items: center;
                text-align: center;
                margin-left: 1rem; 
                margin-right: 1rem; 
            }
            .lines{
                position: absolute;
                bottom: 0%; 
                width: 100%;
            }
            .line1{
                position: relative;
                display: flex;
                min-height: 75.6vh;
                clip-path: ellipse(83% 42% at 83% 100%);
                background: linear-gradient(290deg, transparent, #02661b);
                background-attachment: fixed;
            }
            .line2{
                position: relative;
                display: flex;
                min-height: 40vh;
                background: linear-gradient(80deg, transparent, #B22222);
                clip-path: ellipse(60% 66% at 14% 12%);
                background-attachment: fixed;
            }
            .content .verify{
                fill: rgb(0, 146, 44);
                left: 38.2%;
                padding-top: 1rem;
                margin-bottom: -.5rem;
                align-items: center;
                position: relative;
             
            }
            .verified {
                width: 85px;
                height: 85px;
            }
                
    </style>