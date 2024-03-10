function init() {
    let menus = document.querySelectorAll('.menu');
    menus.forEach(menu => {
        let menuIcons = document.querySelectorAll('.menu-item-icon');
        menuIcons.forEach(menuIcon => {
            menuIcon.addEventListener('click', switchSubMenu);
        });
    });
}

function switchSubMenu(e) {
    let menuIcon = e.currentTarget;
    menuIcon.parentNode.classList.toggle('show');
}

module.exports = {
    init: init,
}