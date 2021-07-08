function menu_animation(e) {

    var show = document.querySelector("#" + e.active);
    //show.classList.add('active');
    setTimeout(() => window.location.href = e.url, 21);
    setTimeout(() => show.style.animation = "active-teste 0.4s linear", 20);




}