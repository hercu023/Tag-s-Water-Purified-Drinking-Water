<?php
    if(isset($_SESSION['message'])){
        ?>
            <div class='message'>
                <?= $_SESSION['message']; ?>
            </div>
        <?php
        unset($_SESSION['message']);
    }
?>
<style>
    .message{
        background-color: hsl(0, 100%, 77%);
        color: #ffffff;
        border-radius: 6px;
        width:24%;
        height: 2rem;
        /* margin-left: 3.55rem; */
        letter-spacing: 0.5px;
        font-family: Helvetica, sans-serif;       
        top: 25.9%;
        padding-top: 1rem;
        /* padding-bottom: .5rem; */
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
        font-size: .6rem;
    }
</style>