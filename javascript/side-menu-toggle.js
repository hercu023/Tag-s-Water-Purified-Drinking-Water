// -----------------------------SIDE MENU
$(document).ready(function(){
    //jquery for toggle sub menus
    $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
    });

    //jquery for expand and collapse the sidebar
    $('.menu-btn').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn').css("visibility", "hidden");
    });

    $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn').css("visibility", "visible");
    });
    $('.menu-btn2').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn2').css("visibility", "hidden");
    });

    $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn2').css("visibility", "visible");
    });
});

// const sideMenu = document.querySelector('#aside');
// const closeBtn = document.querySelector('#close-btn');
// const menuBtn = document.querySelector('#menu-button');
// const checkbox = document.getElementById('checkbox');
// menuBtn.addEventListener('click', () =>{
//     sideMenu.style.display = 'block';
// })

// closeBtn.addEventListener('click', () =>{
//     sideMenu.style.display = 'none';
// })

// checkbox.addEventListener( 'change', () =>{
//     document.body.classList.toggle('dark-theme');
// });