function showImage(source) {
    var parent = source.parentNode;
    for (var i = 0; i < parent.children.length; i++) {
        if (parent.getElementsByTagName('div')[i].className == 'loader') {
            setTimeout(function(){source.style.display = 'block'; parent.getElementsByTagName('div')[i].style.display = 'none';}, 200);
            break;
        }
    }
}

function showNoimage(source) {
    var parent = source.parentNode;
    for (var i = 0; i < parent.children.length; i++) {
        if (parent.getElementsByTagName('div')[i].className == 'loader') {
            setTimeout(function(){source.src = 'shop/noimage.png'; source.style.display = 'block'; parent.getElementsByTagName('div')[i].style.display = 'none';}, 200);
            break;
        }
    }
}