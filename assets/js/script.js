//menu
const btnOpenMenu = document.querySelector('.btn_mobile');
const btnCloseMenu = document.querySelector('.btn_close_menu_mobile');
const mob = document.querySelector('nav.menu');

btnOpenMenu.addEventListener('click',() => {
    mob.classList.add('openMenuMobile');
});
btnCloseMenu.addEventListener('click',() => {
    mob.classList.remove('openMenuMobile');
});