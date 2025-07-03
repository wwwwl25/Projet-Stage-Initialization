document.addEventListener('DOMContentLoaded', function () {
    new Splide('#image-slider', {
        type       : 'loop',
        autoplay   : true,
        interval   : 10000, // 10 seconds
        arrows     : true,
        pagination : true,
        pauseOnHover: false,
    }).mount();
});