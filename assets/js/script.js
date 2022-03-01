//menu
const btnOpenMenu = document.querySelector('.btn_mobile');
const btnCloseMenu = document.querySelector('.btn_close_menu_mobile');
const mob = document.querySelector('nav.menu');
const widthMatch = window.matchMedia('(max-width: 980px)');

if(widthMatch.matches){

    const itensMobile = document.querySelectorAll('nav.menu ul li.menu-item-has-children');
    const submenu = document.querySelector('nav.menu ul li.menu-item-has-children ul.sub-menu')

    itensMobile.forEach((item) => {
        item.addEventListener('click', () =>{
            item.querySelector('ul.sub-menu').classList.toggle('open_submenu_mobile');
        });
    });

}

btnOpenMenu.addEventListener('click',() => {
    mob.classList.add('openMenuMobile');
});
btnCloseMenu.addEventListener('click',() => {
    mob.classList.remove('openMenuMobile');
});

