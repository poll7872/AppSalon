document.addEventListener('DOMContentLoaded', function() {
    menuDesplegable();
});

function menuDesplegable() {

    menuUsuario(); //Menu de usuario, cerrar sesiòn perfil, historial

}

function menuUsuario(){
    const userMenu = document.getElementById("user-menu");
    const menuContent = document.getElementById("user-menu-content");

    userMenu.addEventListener('click', function() {
        menuContent.style.display = (menuContent.style.display === "block") ? "none" : "block";
    })
    
}