const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    
    burger.addEventListener('click', () => {
        nav.classList.toggle('.nav-active');
    });
    
    // navLinks.forEach((link, index) => {
    //     link.style.animation = 'navLinkFade 0.5s ease forwards ${index / 7}s';
    //     console.log(index/5);
    // });
}

navSlide();

function post_redirect(id){
    window.location.href = "./post.php?id=" + id;
}

function redirect(url){
    window.location.href = url;
}