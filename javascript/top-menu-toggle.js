function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}
const checkbox = document.getElementById('checkbox');

checkbox.addEventListener( 'change', () =>{
    document.body.classList.toggle('dark-theme');
});