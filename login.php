
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/login.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <script src="scripts.js"></script>
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body> 

    <div class="colorbg"> 
        <div class="lines">
            <section class="line2"></section>
            <section class="line1"></section>
        </div>
        <div class="container">  
            
                <div class="logo">
                    <img class="tagslogo" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" >
                    <h1 id="title">PURIFIED DRINKING WATER</h1>            
                </div>
                    <div class="pageform">
                        <form action="Dashboard.php" method="post">    
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error-error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>  
                                <div class="txt_field">    
                                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M10 9.979q-1.417 0-2.375-.958-.958-.959-.958-2.375 0-1.417.958-2.375.958-.959 2.375-.959t2.375.959q.958.958.958 2.375 0 1.416-.958 2.375-.958.958-2.375.958Zm-6.729 6.688v-2.396q0-.729.375-1.313.375-.583.979-.875 1.271-.604 2.635-.927 1.365-.323 2.74-.323 1.375 0 2.75.323t2.625.927q.604.292.979.875.375.584.375 1.313v2.396Z"/></svg>
                                    <input type="text" id="email" name="email" required>
                                    <span></span>
                                    <label for="email">Email</label>
                                </div>                      
                                <div class="txt_field">
                                    <svg  class="pass-icon" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M6 12.5q-1.042 0-1.771-.729Q3.5 11.042 3.5 10q0-1.042.729-1.771Q4.958 7.5 6 7.5q1.042 0 1.771.729Q8.5 8.958 8.5 10q0 1.042-.729 1.771Q7.042 12.5 6 12.5ZM6 15q1.625 0 2.938-.969 1.312-.969 1.812-2.531h.75L13 13l1.5-1.5 1.75 1.812L19 10l-1.5-1.5h-6.75q-.521-1.562-1.823-2.531Q7.625 5 6 5 3.917 5 2.458 6.458 1 7.917 1 10q0 2.083 1.458 3.542Q3.917 15 6 15Z"/></svg>
                                    <span class="eye" onclick="myFunction()">
                                        <svg id="unhide" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="M10 13.354q1.583 0 2.688-1.104 1.104-1.104 1.104-2.688 0-1.583-1.104-2.687Q11.583 5.771 10 5.771q-1.583 0-2.688 1.104-1.104 1.104-1.104 2.687 0 1.605 1.104 2.698Q8.417 13.354 10 13.354Zm0-1.542q-.938 0-1.594-.656-.656-.656-.656-1.594 0-.937.656-1.593.656-.657 1.594-.657.938 0 1.594.657.656.656.656 1.593 0 .938-.656 1.594-.656.656-1.594.656Zm0 4.021q-3.062 0-5.552-1.708-2.49-1.708-3.615-4.563Q1.958 6.708 4.458 5.01 6.958 3.312 10 3.312t5.542 1.698q2.5 1.698 3.625 4.552-1.125 2.855-3.615 4.563-2.49 1.708-5.552 1.708Z"/></svg>
                                        <svg id="hide" xmlns="http://www.w3.org/2000/svg" height="15" width="15"><path d="m16.396 18.854-3.458-3.458q-.73.229-1.459.333-.729.104-1.479.104-3.167 0-5.625-1.739-2.458-1.74-3.542-4.532.417-1.083 1.084-2.01.666-.927 1.5-1.677L1.125 3.562l1.25-1.208 15.25 15.271ZM10 13.354q.208 0 .417-.021.208-.021.395-.062l-4.5-4.5q-.041.208-.072.396-.032.187-.032.395 0 1.584 1.104 2.688Q8.417 13.354 10 13.354Zm6.167.292-2.646-2.625q.125-.292.198-.667.073-.375.073-.792 0-1.583-1.104-2.687Q11.583 5.771 10 5.771q-.375 0-.74.073-.364.073-.718.198L6.5 4q.854-.354 1.708-.51.854-.157 1.792-.157 3.146 0 5.615 1.719 2.468 1.719 3.552 4.51-.479 1.23-1.25 2.261-.771 1.031-1.75 1.823ZM12.25 9.75 9.812 7.312q.542-.041 1.011.146.469.188.781.542.354.396.521.833.167.438.125.917Z"/></svg>
                                    </span>
                                    <input type="password" id="pass" name="password" required>
                                    
                                    <span></span>
                                    <label for="password">Password</label>       
                                </div>
                                <div class="forgotpass"> 
                                    <a href="forgot.php" id="forgot">Forgot Password?</a>
                                </div>
                                <div class="loginbtn">
                                    <input type="submit" value="LOG IN" name="submit" id="sub">
                                </div>   
                        </form>
                    </div>    
        </div>
        
    </div>
</body>
                        
</html>

