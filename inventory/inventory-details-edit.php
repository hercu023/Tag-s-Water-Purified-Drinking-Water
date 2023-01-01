<?php
require_once '../service/edit-inventory-item.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-ITEM')) {
    header("Location: ../common/error-page.php?error=You are not authorized to access this page.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/inventory-details-edit.css"> -->
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="../index.js"></script>
</head>
<style>
    :root{
    --color-main: rgb(2, 80, 2);
    --color-main-2: rgb(2, 80, 2);
    --color-main-3: rgb(2, 80, 2);
    --color-white: white;
    --color-white-secondary: white;
    --color-tertiary: hsl(0, 0%, 57%);
    --color-black: rgb(49, 49, 49);
    --color-maroon: rgb(136, 0, 0);
    --color-secondary-main: rgb(244, 255, 246);
    --color-background: rgb(235, 235, 235);
    --color-solid-gray: rgb(126, 126, 126);
    --color-td:rgb(100, 100, 100);
    --color-button: rgb(117, 117, 117);
    --color-table-shadow: rgb(244, 255, 246);
    --color-shadow-shadow: rgb(116, 116, 116);
    --color-table-hover: rgb(244, 255, 246);
    --color-aside-mobile-focus: rgb(78, 150, 78);
    --color-aside-mobile-text: hsl(0, 0%, 57%);
    --color-mainbutton: rgb(117, 117, 117);
    --color-button-hover: rgb(39, 170, 63);
    --color-border-bottom: rgb(219, 219, 219);
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-main-2: rgb(60, 128, 60);
    --color-main-3: rgb(93, 163, 93);
    --color-border-bottom: rgb(104, 104, 104);
    --color-black: white;
    --color-shadow-shadow: rgb(32, 32, 32);
    --color-aside-mobile-focus: rgb(244, 255, 246);
    --color-table-shadow: rgb(131, 131, 131);
    --color-maroon: rgb(255, 130, 130);
    --color-white-secondary: rgb(235, 235, 235);
    --color-main: rgb(244, 255, 246);
    --color-secondary-main: rgb(97, 172, 111);
    --color-background: rgb(80, 80, 80);
    --color-solid-gray: rgb(231, 231, 231);
    --color-td: rgb(231, 231, 231);
    --color-button: rgb(202, 202, 202);
    --color-table-hover: rgb(112, 112, 112);
    --color-aside-mobile-text:hsl(0, 0%, 88%);
}


body{
    background: var(--color-background);
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    font-family: Arial, Helvetica, sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}  

.container1{
width: 100%;
max-width: 600px;
padding: 20px;
margin: 0 28px;
border-radius:  0px 0px 20px 20px;
background-color: var(--color-white);
box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
border-top: 10px solid var(--color-solid-gray);
}

    
.form-title{
font-size: 26px;
font-weight: 600;
text-align: center;
padding-bottom: 6px;
color: white;
text-shadow: 2px 2px 2px black;
border-bottom: solid 1px white;
}

.main-user-info{
display: flex;
flex-wrap: wrap;
justify-content: space-between;
padding: 20px 0;
}
.usertype-dropdown{
            width: 48%;
            margin-top: 1.6rem;
            display: flex;
            flex-wrap: wrap;
        }
        .select{
            background: var(--color-solid-gray);
            color: var(--color-white);
            align-items: center;
            border-radius: 13px;
            padding: 8px 12px;
            height: 40px;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }
        .action-dropdown{
            position: relative;
            margin-top: .5rem;
            /* left: 10%; */
            margin-bottom: .5rem
        }
.user-input-box:nth-child(2n){
justify-content: end;
}


.user-input-box{
display: flex;
flex-wrap: wrap;

width: 48%;
padding-bottom: 15px;
}

.user-input-box label{
width: 95%;
color: var(--color-solid-gray);
font-size: 16px;
/* margin-left: .2rem; */
margin-bottom: 0.5rem;
font-family: 'Malberg Trial', sans-serif;
font-weight: 550;
/* margin: 5px 0; */
}
.user-input-box label:focus{
border: 2px solid var(--color-main-3);
font-size: 17px;
font-weight: 600;
}
.user-input-box input::placeholder{
font-size: .8em;
color:var(--color-solid-gray);
}
/* ::placeholder:focus{
border: 2px solid var(--color-main-3);
} */
.user-input-box input:focus{
border: 2px solid var(--color-main-3);
background: var(--color-white);
}

.user-input-box input{
height: 40px;
width: 100%;
border: 2px solid var(--color-solid-gray);
border-radius: 15px;
outline: none;
font-size: 1em;
background: var(--color-white);
color: var(--color-black);
padding: 0 10px;
}
.line{
width:100%;
margin-top: 1rem;
margin-bottom: 1rem;
border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: center;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
 }   
   
.choose-profile{
    /* position: relative; */
    width: 100%;
    height: 1.32rem;
    padding: 10px;
    margin-top: 1rem;
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 10px;
    transition: 0.5s;
    font-family: 'COCOGOOSE', sans-serif;
    cursor: pointer;
}

#image-profile{
    cursor: pointer;
    text-align: center;
    align-items: center;
}
.gender-title{
margin-top: 1rem;
font-family: 'Calibri', sans-serif;
color: var(--color-solid-gray);
width: 100%;
font-size: 20px;
margin-left: .2rem;
font-family: 'Malberg Trial', sans-serif;
font-weight: 550;
/* border-bottom: 2px solid var(--color-solid-gray); */
}

.gender-category{
margin: 15px 0;
color:  var(--color-solid-gray);
}

.gender-category label{
padding: 0 20px 0 5px;
}

.gender-category label,
.gender-category input,
.form-submit-btn input{
cursor: pointer;
}

.form-submit-btn{
margin-top: 40px;
}

.form-submit-btn input{
display: block;
width: 100%;
margin-top: 10px;
font-size: 20px;
padding: 10px;
border:none;
border-radius: 3px;
color: rgb(209, 209, 209);
background: rgba(63, 114, 76, 0.7);
}

.form-submit-btn input:hover{
background: rgba(56, 204, 93, 0.7);
color: rgb(255, 255, 255);
}
.addnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: 1rem;
    justify-content: center;
    border-bottom: 2px solid var(--color-solid-gray);
    width: 100%;
    padding-bottom: 2px;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    display: inline-block;
    margin-top: 1.3rem;
}
.AddButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 15rem;
    max-height: 60px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton); 
    cursor: pointer; 
    transition: 0.5s;
    margin-left: 1rem;
}
.AddButton button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    display: inline-block;
}
.AddButton{
    display: inline-block;
    
}
/* .CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
} */
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 60px;
    padding-right: 60px;
    text-align: center;
    width: 10rem;
    max-height: 70px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background: #c44242;
    cursor: pointer; 
    transition: 0.5s;
}
#cancel:hover{
    background-color: rgb(158, 0, 0);
    transition: 0.5s; 
}

@media(max-width: 600px){
.container1{
    min-width: 280px;
}
.user-input-box .cost{
position: absolute;
display: none;
left: 10.65%;
}
.user-input-box .srp{
position: absolute;
display: none;
left: 10.65%;
}
.user-input-box{
    margin-bottom: 12px;
    width: 100%;
}

.user-input-box:nth-child(2n){
    justify-content: space-between;
}
.usertype-dropdown{
            width: 99%;
            margin-bottom: 1rem;
            margin-top: -.3rem;
        }
.gender-category{
    display: flex;
    /* justify-content: space-between; */
    width: 100%;
}

.main-user-info{
    max-height: 380px;
    overflow: auto;
}

.main-user-info::-webkit-scrollbar{
    width: 0;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    margin-top: 1.3rem;
}
.AddButton button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    position: relative;
    margin-top: 3rem;
}
.AddButton{
    position: relative;
    margin-top: -4rem;
    margin-left: -1em;

}
/* .CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
} */
#cancel{
    width: 100%;
}

}
.block{
    width: 5rem;
    height: 2rem;
    background-color: var(--color-background);
    position: fixed;
    display: flex;
    top: 0;
}
  /* -----------------------------------------------Side Menu---------------------------------------- */
  .side-bar{
    background: var(--color-table-hover);
    backdrop-filter: blur(15px);
    width: 15.5rem;
    height: 100vh;
    position: fixed;
    top: 0;
    /* left: -100%; */
    overflow-y: auto;
    transition: 0.6s ease;
    transition-property: left;
}
.side-bar .title{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: -1.9rem;
    }
    .side-bar .titlelogo{
        display: flex;
        gap: 0.8rem;
    }
    .side-bar .titlelogo img{
        width: 5rem;
        margin-top: -1rem;
        margin-bottom: 1rem;
        margin-left: 5.5rem;
    }
    .side-bar .close{
        display: none;
        font-size: 1rem;
    }
.side-bar.active{
    left: 0;
}

.side-bar .menu{
    width: 100%;
    margin-top: 80px;
}

.side-bar .menu .item{
    position: relative;
    cursor: pointer;
}

.side-bar .menu .item a{
    color: var(--color-tertiary);
    font-size: 13px;
    text-decoration: none;
    display: flex;
    fill: var(--color-tertiary);
    margin-left: .5rem;
    gap: 1rem;
    align-items: center;
    position: relative;
    padding: 0px 20px;
    line-height: 60px;
    height: 3.7rem;
    transition: all 300ms ease;
}
.side-bar .menu .item .sub-item{
    height: 2.9rem;

}
.side-bar .menu .item a:hover{
    background: var(--color-table-hover);
    transition: 0.6s;
    margin-left: 0rem;
    border-radius: 0 10px 10px 0 ;
    box-shadow: 2px 2px 2px rgb(224, 224, 224);
}
#inventory{
    background: var(--color-white);
    box-shadow: 2px 2px 2px rgb(224, 224, 224);
    border-radius: 0 10px 10px 0;
}
.side-bar .menu .item a .dropdown{
    position: absolute;
    right: 0;
    margin: 20px;
    transition: 0.3s ease;
}

.side-bar .menu .item .sub-menu{
    background: var(--color-background);
    display: none;
    
}

.side-bar .menu .item .sub-menu a{
    padding-left: 90px;
    font-size: 13px;
    font-weight: 500;
    font-family: 'switzer', sans-serif;
    box-shadow: 0px 1px 1px rgb(224, 224, 224);

}

.rotate{
    transform: rotate(90deg);
}

.close-btn{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 14px;
    right: 0;
    margin: 25px;
    margin-top: 50px;
    display: none;
    cursor: pointer;
}

.menu-btn{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 20px;
    margin: 25px;
    cursor: pointer;
}
.menu-btn:hover{
    color: var(--color-main);
}
.menu-btn2{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 20px;
    margin: 25px;
    display: none;
    left: 0;
    cursor: pointer;
}
.menu-btn2:hover{
    /* position: absolute; */
    color: var(--color-main);
    /* font-size: 25px;
    margin: 30px;
    cursor: pointer; */
}
/* -----------------------------------------Adduserform------------------------------------------ */
.bg-actionDropdown{
    height: 100%; 
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
    display: flex;
    align-items: center; 
    justify-content: center;
    display: none;
}
        .action{ 
            position: absolute;
            top: 50%;
            align-items: center;
            text-align: center;
            /* display: none; */
            left: 50%;
            height: 13.5rem;
            min-width: 17rem;
            
            transform: translate(-50%, -50%);
            background-color: var(--color-white);
            box-shadow: 5px 7px 30px 0px var(--color-shadow-shadow);
            border-radius: 20px;  
         }
         #close-action{
            position: absolute;
            margin-top: -5.5rem;
            left:87%;
            fill: var(--color-solid-gray);
         }
         #close-action:hover{
            position: absolute;
            margin-top: -5.5rem;
            left:87%;
            fill: #8b0000;
            transition: .2s;
         }
         .action h2{
            padding-bottom: .5rem;
            margin-top: .5rem;
            font-size: min(max(1.9rem, 1.1vw), 2rem);
            color: var(--color-solid-gray);
            font-family: 'Malberg Trial', sans-serif;
            border-bottom:  2px solid var(--color-solid-gray);
            margin-bottom: 1rem;
         }
         .action button{
            padding-left:1rem;
            font-family: 'arial', sans-serif;
            cursor: pointer;
            transition: .5s;
            font-size: 12px;
            display: flex;
            gap: .8rem;
            width: 100%;
            border: none;
            background: var(--color-white);
            align-items: center;
            color: var(--color-solid-gray);
            fill: var(--color-solid-gray);
            border-radius: 20px;  
        }
        .action button:last-child{
            border-top:  2px solid var(--color-solid-gray);
        }
        
        .action button:hover{
            background: linear-gradient(270deg, transparent, var(--color-secondary-main));
            color: var(--color-main);
            fill: var(--color-main);
        }

.bg-editDropdown{
    height: 100%; 
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
    display: flex;
    align-items: center; 
    justify-content: center;
    display: flex;
}
#form-registered{
    position: absolute;
    top: 50%;
    display: none;
    left: 50%;
    max-height: 95vh;
    min-width: 400px;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    border-top: 10px solid var(--color-main-3);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-radius:  0px 0px 20px 20px;  
       
}
        .pageform{
            background-color: var(--color-white);
            border-radius: 0px 0px 10px 10px;
            border-top: 2px solid var(--color-solid-gray);
            box-sizing: border-box;
            padding: 0 30px;
            display: flex;
        }
        #container-registered .pageform {
            font-size: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
        .register h2 {
            font-family: 'Calibri', sans-serif;
            font-size: 25px;
            align-items: center;
            text-align: center;
            letter-spacing: 2px;
            color: var(--color-black);
            margin-bottom: 5px;
        } 
        .content .verify {
            left: 38.2%;
            padding-top: 1rem;
            margin-bottom: -.5rem;
            align-items: center;
            position: relative;
         
        }
        .verified {
            fill: rgb(39, 170, 63);
            width: 80px;
            height: 80px;
        }
        #registered{
            font-family: 'COCOGOOSE', sans-serif;
            padding: 10px;
            padding-left: 60px;
            padding-right: 60px;
            text-align: center;
            max-height: 70px;
            outline: none;
            border: none;
            font-size: min(max(9px, 1.1vw), 11px);
            border-radius: 20px;
            color: white;
            background: var(--color-mainbutton); 
            cursor: pointer; 
            transition: 0.5s;
            display: block;
            margin-top: 2vh;
            margin-bottom: 20px;
            margin-left: 65.5px;
            margin-right: 65.5px;
            width: 5rem;
        }
        #registered:hover{
            background-color: var(--color-button-hover);
            transition: 0.5s; 
        }
.form-adduser1{
    width: 500px;
    height: 100%;
    max-height: 480px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.edit-container{
    width: 500px;
    height: 100%;
    max-height: 520px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
        .edit-container2{
            display: flex;
            font-size: .7rem;
            flex-direction: column;
            font-family: 'Malberg Trial', sans-serif;
            gap: 30px;
            min-height: 20vh;
        }
        .edit-container .EditButton button{
            font-family: 'COCOGOOSE', sans-serif;
            padding: 10px;
            margin-top: .5vh;
            margin-bottom: 20px;
            margin-left: 20em;
            text-align: center;
            width: 15rem;
            max-height: 60px;
            outline: none;
            border: none;
            font-size: min(max(9px, 1.1vw), 11px);
            border-radius: 20px;
            color: white;
            background:  var(--color-mainbutton); 
            cursor: pointer; 
            transition: 0.5s;
        }
        .edit-container .EditButton button:hover{
            background: var(--color-button-hover);
        }
        .form-adduser2{
            display: flex;
            font-size: .7rem;
            flex-direction: column;
            font-family: 'Malberg Trial', sans-serif;
            gap: 30px;
            min-height: 20vh;
        }
        .error-error{
            background-color: hsl(0, 100%, 77%);
            color: #ffffff;
            display: relative;
            padding: 11px;
            width: 70%;
            border-radius: 6px;
            align-items: center; 
            text-align: center;
            margin-left: 3.55rem;
            font-size: min(max(9px, 1.2vw), 11px);
            letter-spacing: 0.5px;
            font-family: Helvetica, sans-serif;
        }
        .form1{
            position: relative;
            width: 205px;
            margin-left: 2rem;
            margin-top: -1.0rem;
            top: 15px;
        }
        .form1 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form1 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color:var(--color-solid-gray);
        }
        .form1 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form1 input:valid ~ span,
        .form1 input:focus ~ span{
            color: var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form2{
            position: relative;
            width: 205px;
            height: 17px;
            margin-left: 16rem;
            margin-top: .395rem;
            top: -7.1rem;
        }
        .form2 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form2 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size:  1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form2 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form2 input:valid ~ span,
        .form2 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form4{
            position: relative;
            width: 205px;
            margin-left: 2rem;
            margin-top: -.895rem;
            top: -5.6rem;
        }
        .form4 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form4 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form4 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form4 input:valid ~ span,
        .form4 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form5{
            position: relative;
            width: 205px;
            margin-left: 15.9rem;
            margin-top: 1rem;
            top: -10.93rem;
            margin-bottom: -5rem;
        }
        .form5 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form5 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: .1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form5 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form5 input:valid ~ span,
        .form5 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        
        /* --------------------------------------DROP DOWN ACTION------------------------------------- */
        .actionBtn{
            background: var(--color-solid-gray);
            color: var(--color-white);
            font-size: 18px;
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 501;
            border-radius: 50px;
            padding: 10px;
            height: 2.5em;
            width: 4rem;
            cursor: pointer;
            transition: 0.3s;
        }
        .fa{
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 501;
            font-size: 14px;
        }
        .actionicon{
            fill:  var(--color-white);
        }
      
        /* --------------------------------------DROP DOWN------------------------------------- */
     
        #edit-action{
            background: hsl(0, 0%, 37%);
            color: var(--color-white);
            align-items: center;
            position: relative;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            margin: 1px;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 2px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #edit-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
        #cpass-action{
            background:#00aa09;
            position: relative;
            color: var(--color-white);
            align-items: center;
            text-align: center;
            margin: 1px;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 5px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #cpass-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
        #archive-action{
            background: hsl(0, 51%, 44%);
            color: var(--color-white);
            align-items: center;
            position: relative;
            margin: 1px;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 5px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #archive-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
     
.checker {
    text-align: right;
    align-items: right;
    margin-right: 3rem;
    margin-top: -7.5rem;
    margin-bottom: 5rem;
}
.checker span {
    text-decoration: none;
    color: var(--color-solid-gray);
    top: 0;
    font-size: min(max(10px, 1.2vw), 12px);
    font-family: 'Switzer', sans-serif;
}
/* ------------------------------------------------------------------------------------ */
.message{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    border-radius: 6px;
    width: 25%;
    height: 1.87rem;
    /* margin-left: 3.55rem; */
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;       
    top: 16.9%;
    font-size: .7rem;
    padding: 5px 10px;
    padding-top: 1rem;
    position: absolute;
    align-items: center;
    text-align: center;
    /* justify-content: space-between; */
    gap:3.5rem;
    z-index: 1000;
    display: none;
}

.message span{
    color:var(--white);
    font-size: .9rem;
}

.message p{
    color:var(--red);
    font-size: .9rem;
    margin: 0 auto;
    cursor: pointer;
}

.choose-profile:hover{
    background: var(--color-main-2);
    transition: 0.5s;
}

#action_btn {
    font-family: 'calibri', sans-serif;
    /* padding: 10px;
    
    margin-bottom: 20px;
    margin-left: 20em; */
    text-align: center;
    margin-top: .5vh;
    margin-bottom: .5vh;
    width: 3rem;
    height: 40px;
    outline: none;
    border: none;
    font-size: min(max(10px, 1.2vw), 12px);
    border-radius: 20px;
    background: var(--color-solid-gray);
    cursor: pointer; 
    transition: 0.5s;
}
#action_btn:hover{
    background: var(--color-button-hover);
}

 /* ----------------------------------------Top bar menu----------------------------------------  */
.top-menu{
    margin-top: .7rem;
    position: absolute;
    right: 3%;
}
.top-menu .menu-bar{
    display: flex;
    justify-content: end;
    gap: 2rem;
}
.top-menu .menu-bar button{
    display: none;
}
.top-menu .menu-bar .user1{
    gap: 2rem;
    align-items: right;
    text-align: right;
}
.top-menu .menu-bar .user2{
    display: flex;
    gap: 2rem;
    align-items: right;
    text-align: right;
}
.top-menu .menu-bar .accTitle-top{
    font-size: min(max(1.2rem, 0.4vw), 1.3rem);
    color: var(--color-main); 
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    display: none;
    text-align: center;
    align-items: center;
}

.user-type{
    font-family: 'switzer', sans-serif;
    font-size: 7.5px;
    color: var(--color-black); 
    letter-spacing: 1px;
    border-top: 2px solid var(--color-main); 
    margin-top: -0.97rem;
    width: 7vw;
    text-transform: uppercase;
}
h1{
    margin-top: 6px;     
}
.welcome{
    font-family: 'Calibri', sans-serif;
    font-size: 11px;
    /* margin-right: -7.3rem;*/
    margin-top: -0.6rem; 
    letter-spacing: 1px;
    color: var(--color-main); 
}
.user-name{
    font-family: 'Switzer', sans-serif;
    font-size: 12px;
    margin-top: -1rem; 
    text-transform: uppercase;
    margin-bottom: 0;
    color: var(--color-maroon);
}
.profile img{
    background: var(--color-white); 
    border-radius: 30%;
    width: 50px;
    padding: 4px;
    margin-top: .3rem;
}
.profile-pic{
    align-items: center;
    text-align: center;
    justify-content: center;
    margin-top: 1rem;
}
.profile-pic img{
    background: var(--color-solid-gray); 
    border-radius: 50%;
    width: 70px;
    padding: 3px;
}
.editnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: .5rem;
    justify-content: center;
    border-bottom: 2px solid var(--color-solid-gray);
    margin: 15px;
    padding-bottom: 10px;
}

#menu-button{
    border: none;
    background: none;
}
/* .bg-shadow{
    position: absolute;
    bottom: 0%; 
    width: 100%;
 }
#shadow{
    background: rgb(219, 219, 219);
    opacity: .2;
    display: flex;
    display: none;
    overflow-y: hidden;
    position: relative;
    height: 100%;
    background-attachment: fixed;
    bottom: 0%;
    width: 100%;
} */
/* .user{
    text-align: right;
    align-items: right;
} */
a{
    text-decoration:none;
    font-family: 'COCOGOOSE', sans-serif;
}
.user2 a{
    font-family: 'Malberg Trial', sans-serif;
    color: rgb(68, 68, 68);
}
.notifs-section{

}
.todeliver{
    margin-bottom: -2.2rem;
    margin-top: 2rem;
    color: rgb(117, 117, 117);
    font-size: 1.3rem;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
}
h3{
    font-size: 0.87rem;
}
.user2 .profile{
    position: relative;
    cursor: pointer;
}
.user2 .drop-menu{
    position: absolute; 
    top: 120px;
    right: 10px;
    padding: 10px 20px;
    background: var(--color-white);
    width: 110px;
    box-sizing: 0 5px 25px rgba(0,0,0,0.1);
    border-radius: 7px;
    transition: 0.5s;
    visibility: hidden;
    opacity: 0;
}
.user2 .drop-menu.user2{
    top: 80px;
    visibility: visible;
    opacity: 1;
}
.user2 .drop-menu::before{
    content:'';
    position: absolute;
    top: -5px;
    right: 15px;
    width: 15px;
    height: 20px;
    background: var(--color-white);
    transform: rotate(45deg);
    transition: 0.5s;
}
.drop-menu .ul .user-type3{
    font-family: 'Calibri', sans-serif;
    font-size: 7.5px;
    color: var(--color-main); 
    letter-spacing: .2rem;
    display: none;
    text-transform: uppercase;
}

.drop-menu .ul{
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    height: 9vh;
    position: relative;
    margin-bottom: 0.5rem;
}
.drop-menu h4{
    font-weight: 400;
    font-size: 12px;
}
.drop-menu .ul a{
    display: flex;
    color: hsl(0, 0%, 69%);
    fill: hsl(0, 0%, 69%); 
    margin-left: -1.26rem;
    padding-left: 1rem;
    gap: 1rem;
    height: 1rem;
    width: 8.5rem;
    align-items: center;
    position: relative;
    height: 1.7rem;
    transition: all 300ms ease;
}
.drop-menu .ul a:hover {
    background:  rgb(190, 190, 190);
    transition: 0.6s;
    color: var(--color-white);
    fill: var(--color-white);
    padding-left: .9rem;
    content: "";
    margin-bottom: 6px;
    font-size: 15px;
    border-radius: 0px 0px 10px 10px;
    cursor: pointer;
}
.checkbox{
    opacity: 0;
    position: absolute;
}
.checkbox:checked + .theme-dark .ball{
    transform: translateX(28px);
}
.drop-menu .theme-dark{
    background: hsl(0, 0%, 69%);
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 14.5px;
    width: 42.5px;
    cursor: pointer;
    border-radius: 50px;
    position: relative;
    padding: 5px;
    margin-top: -30px;
    margin-bottom: 8px;
    margin-left: 2rem;
}
.sun{
    fill: yellow;
}
.moon{
    fill: white;
}
.ball{
    background: white;
    position: absolute;
    border-radius: 50%;
    top: 2px;
    left: 2px;
    height: 21px;
    width: 21px;
    transition: transform 0.2s linear;
}
/* ----------------------------------------MAIN---------------------------------------- */
.main-account{
    width:100%;
    position: relative;
}
.accTitle{
    margin-top: 2rem;
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    border-bottom: 2px solid var(--color-main);
    width: 78%;
}

/* ----------------------------------------Sub TAB---------------------------------------- */
.user-title{
    position: relative;
    display: inline-block;
    margin-left: 3rem;
    width: 15%;
}
main  h2{
    margin-top: 1rem;
    color: var(--color-solid-gray);
    font-size: 1.3rem;
    margin-left: 3%;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
}
main .sub-tab{
    margin-bottom: 2rem;
}
    /* ----------------------------------------Search BAR---------------------------------------- */
    .search{
        position: relative;
        gap: 2rem;
        float: right;
    
    }
    .search-bar{
        width: 18rem;
        background: var(--color-white);
        display: flex;
        position: relative;
        align-items: center;
        border-radius: 60px;
        padding: 10px 20px;
        height: 1.8rem;
        backdrop-filter: blur(4px) saturate(180%);
    }
    .search-bar input{
        background: transparent;
        flex: 1;
        border: 0;
        outline: none;
        padding: 24px 20px;
        font-size: .8rem;
        color: var(--color-black); 
        margin-left: -0.95rem;
    }
    ::placeholder{
        color: var(--color-solid-gray);
        
    }
    .search-bar button svg{
        width: 20px;
        fill: var(--color-white); 
    }
    .search-bar button{
        border: 0;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        background: var(--color-main); 
        margin-right: -0.55rem;
    }
    /* ----------------------------------------Add Button---------------------------------------- */
    .newUser-button{
        position: relative;
        display: inline-block;
    }
    .add-account{
        display: flex;
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 11rem;
        max-height: 46px;
        border-radius: 20px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        cursor: pointer; 
        gap: 1rem;
        height: 3.9rem;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
    }
    .add-account h3{
        font-size: .8rem;
    }
    .add-account:hover{
        background-color: var(--color-main); 
        color: var(--color-white);
        fill: var(--color-white);
        padding-top: -.2px;
        transition: 0.7s;
        border-bottom: 4px solid var(--color-maroon);
    }
     /* ----------------------------------------Account Table---------------------------------------- */
            .pagination{
                background-color: var(--color-white);
                display: flex;
                position: relative;
                overflow: hidden;
                border-radius: 50px;
                width: 40rem;
                align-items: center;
                text-align: center;
                margin: auto;
            }

            .pagination a{
                width: 80px;
                height: 60px;
                line-height: 60px;
                text-align: center;
                color: #333;
                font-size: 12px;
                font-weight: 700;
                transition: .3s linear;
                font-family: 'Poppins', sans-serif;

            }

            .pagination a:hover{
                color: #fff;
                background-color: #5271e9;
            }

            .bottom_bar{
                position: absolute;
                width: 80px;
                height: 4px;
                background-color: #000;
                bottom: 0;
                left: -100px;
                transition: .4s;
            }

main .account-container{
    margin-top: -1rem;
    max-height: 650px;
    overflow:auto;
    width: 100%;
    margin-bottom: 20px;
    /* position: absolute; */
    box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
    /* border-top: 8px solid var(--color-table-hover); */
    border-radius: 20px;
    
}
 main .account-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%; 
    font-size: 1rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    padding-bottom: 2.5rem;
    text-align: center; 
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}

main .account-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

main table tbody td{
    height: 3.3rem;
    border-bottom: 1px solid var(--color-border-bottom);
    color: var(--color-td); 
    font-size: .8rem;
}
 th{
    height: 3.3rem;
    color: var(--color-black); 
    margin:1rem;
    font-size: 1rem;
    letter-spacing: 0.02rem;
}  
tr:hover td{
    color: var(--color-main); 
    cursor: pointer;
    background-color: var(--color-table-hover);
 }
/* ----------------------------------------ASIDE---------------------------------------- */
.container{
    display: grid;
    width: 96%;
    /* margin: 0 auto; */
    background: var(--color-background);
    gap: 1.8rem;
    grid-template-columns: 16rem auto;
}
#menu-button{
    display: none;
}

  /* ----------------------------------------SIDEBAR 2---------------------------------------- */
  @media screen and (max-width: 1600px){
    .container{
        width: 94%;
        grid-template-columns: 16rem auto;
    }
    .top-menu{
        width: 370px;
    }
    main .account-container{
        margin-top: 6rem;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
}
@media screen and (max-width: 1400px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .side-bar{
        z-index: 3;
        position: fixed;
        left: -100%;
    }
    .close-btn{
        display: flex;
    }

    .top-menu{
        width: 370px;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main .account-container{
        width: 105%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 2.5%;
    }
    .search{
        right: -5%;
    }
    .search-bar{
        width: 18vw;
    }
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .accTitle{
        width: 74%;
    }
    .top-menu{
        width: 370px;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .search-bar{
        width: 20vw;
    }
    .user2 .drop-menu{
        right: 13px;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 25px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul a{
        width: 8.5rem;
    }
}

@media screen and (max-width: 768px){
    .containter{
        width: 100%;
    }
    .menu-btn2{
        display: flex;
    }
    .top-menu{
        width: 94%;
        margin: 0 auto 4rem;
    }
    .top-menu .menu-bar{
        position: fixed;
        top: 0;
        left: 0;
        align-items: center;
        padding: 0 0.8rem;
        height: 4rem;
        background: var(--color-white);
        width: 100%;
        margin: 0;
        z-index: 2;
        box-shadow: 0px 1px 14px var(--color-shadow-shadow);
    }
    .top-menu .menu-bar .accTitle-top{
        display: block;
        left: 0;
        margin-left: 4rem;
        position: absolute;
    }
     .profile{
        margin-right: 1.4rem;
    }
    .top-menu .menu-bar .user1{
        display: none;
    }
    .drop-menu .ul .user-type3{
        display: block;
        left:22.5%;
        position: absolute; 
        margin-top: -2.3rem;
        margin-bottom: 1.9rem;
    }
    .accTitle{
        display:none;
    }
    .user2 .drop-menu{
        right: 40px;
        height: 9.3rem;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 17px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul .theme-dark{
        margin-top: -.3rem;
    }
    
    .drop-menu .ul a{
        width: 8.5rem;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        display:none;
        left: 0;
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 80vw;
        padding-left:30px;
        padding-right:30px;
    }
    main  h2{
        margin-left: 10%;
        display:none;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 137%;
        display:none;
    }
    .search{
        left: 77%;
        display:none;
    }
    .search-bar{
        width: 20vw;
    }
}

.menu-tab p{
    font-size: 20px;
    font-weight: lighter;
    margin-left: 10px;
}

.menu-tab img{
    width: 15px;
    margin-right: 10px;
    margin-left: 20px;
}
/* .menu-tab a:hover{
    background:  rgb(250, 255, 251);
    transition: 0.6s;
    margin-left: 0rem;
    color: rgb(187, 187, 187);
    fill: rgb(187, 187, 187);
    font-weight: bold;
    padding-left: 1rem;
    content: "";
    margin-bottom: 6px;
    font-size: 9px;
    border-radius: 0 10px 10px 0 ;
    box-shadow: 1px 1px 1px rgb(224, 224, 224);
} */
</style>
<body>

<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-account">
            <h1 class="accTitle">INVENTORY</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> INVENTORY ITEM </h2>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>Add New Item</h3>
                    </button>
                </div>
                <div class="search">
                    <div class="search-bar">
                        <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                        <button type="submit" >
                            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="account-container">
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Type</th>
                        <th>POS</th>
                        <th>Reorder Level</th>
                        <th>SRP</th>
                        <th>Alkaline Price</th>
                        <th>Mineral Price</th>
                        <th>Image</th>
                        <th>Date/Time Added</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
<?php
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT inventory_item.id,
                                                inventory_item.item_name,
                                                category_type.name,
                                                inventory_item.pos_item_id,
                                                inventory_item.reorder_level,
                                                inventory_item.selling_price_item,
                                                inventory_item.alkaline_price,
                                                inventory_item.mineral_price,
                                                inventory_item.image, 
                                                inventory_item.created_at,
                                                inventory_item.created_by 
                                                FROM inventory_item 
                                                INNER JOIN category_type  
                                                ON inventory_item.category_by_id = category_type.id
                                                INNER JOIN pos_item  
                                                ON inventory_item.pos_item_id = pos_item.id  
                                                INNER JOIN status_archive 
                                                ON inventory_item.status_archive_id = status_archive.id
                                                WHERE inventory_item.id='$id'");

    if (mysqli_num_rows($result) > 0) {
        $inventory_item = mysqli_fetch_assoc($result); ?>
        <form name="edit" action="" method="post" enctype="multipart/form-data"  id="edituserFrm">
            <div class="bg-editDropdown" id="edit-bgdrop">
                <div class="container1" id="container1">
                    <div class="profile-pic">
                        <img src="../uploaded_image/<?=$inventory_item['image'];?>" alt="">
                    </div>

                    <h1 class="editnew-title">EDIT ITEM</h1>
                    <form action="#">
                        <span class="gender-title">POS ITEM</span>
                        <div class="gender-category" >
                            <input <?php if($inventory_item['pos_item_id'] === '1') echo "checked"; ?>
                                    type="radio" value="1" name="pos_item" id="Yes" required="required" onclick="mainForm1()">
                            <label for="Yes" >Yes</label>
                            <input <?php if($inventory_item['pos_item_id'] === '2') echo "checked"; ?>
                                    type="radio" value="2" name="pos_item" id="No" onclick="mainForm2()">
                            <label for="No" >No</label>
                        </div>
                        <div class="line"></div>
                        <div class="main-user-info">
                            <input type="hidden" required="required" name="id" value="<?=$inventory_item['id'];?>">

                            <div class="user-input-box">
                                <label for="itemname">Item Name</label>
                                <input type="text"
                                       id="itemname"
                                       name="item_name"
                                       required="required"
                                       placeholder="Enter Item Name" value="<?=$inventory_item['item_name'];?>"/>
                            </div>
                            <div class="usertype-dropdown">
                                <?php
                                $dropdown_query = "SELECT * FROM category_type";
                                $result_category = mysqli_query($con, $dropdown_query);
                                ?>
                                <select class="select" name="category_type" required="" value="hello">
                                    <option selected disabled value="">TYPE</option>
                                    <?php while($category = mysqli_fetch_array($result_category)):;?>
                                        <option value="<?php echo $category['id']?>"
                                            <?php
                                            if($inventory_item['name'] === $category['name'])
                                            {
                                                echo 'selected';
                                            }
                                            ?>>
                                            <?php echo $category['name'];?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>

                            <div class="user-input-box">
                                <label for="reorder">Reorder Level</label>
                                <input type="number" min='0' onkeypress='return isNumberKey(event)'
                                       id="reorder"
                                       name="re_order"
                                       placeholder='0'
                                       required="required" value="<?=$inventory_item['reorder_level'];?>"/>
                            </div>

                            <div class="user-input-box" id="srpprice_box">
                                <label for="sellingprice">SRP</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="sellingprice"
                                       class="sellingprice"
                                       name="selling_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['selling_price_item'];?>"/>
                            </div>
                            <div class="user-input-box" id="alkalineprice_box">
                                <label for="alkalineprice">Alkaline Price</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="alkalineprice"
                                       class="alkalineprice"
                                       name="alkaline_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['alkaline_price'];?>"/>
                            </div>
                            <div class="user-input-box" id="mineralprice_box">
                                <label for="mineralprice">Mineral Price</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="mineralprice"
                                       class="mineralprice"
                                       name="mineral_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['mineral_price'];?>"/>
                            </div>
                            <div class="line"></div>
                            <span class="gender-title">Image</span>
                            <div class="choose-profile">
                                <input type="file" id="image-profile" name="image_item" accept="image/jpg, image/png, image/jpeg" value="<?php echo "uploaded_image/".$inventory_item['image']; ?>">
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../inventory/inventory-details.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="submit">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </form>
        <?php if($inventory_item['pos_item_id'] === '2') {
            echo '<script type="text/javascript"> 
                    const mainform = document.querySelector(".main-user-info");
                    const srp = document.querySelector("#srpprice_box");
                    const alkaline = document.querySelector("#alkalineprice_box");
                    const mineral = document.querySelector("#mineralprice_box");
                    mainform.style.display = "flex";
                    srp.style.display = "none";
                    alkaline.style.display = "none";
                    mineral.style.display = "none";
                                      </script>';
        }
        ?>
    <?php }}else{
           echo '<script> location.replace("../inventory/inventory-details.php"); </script>';
    } ?>
</body>
</html>
<script>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../javascript/inventory-details-edit.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->