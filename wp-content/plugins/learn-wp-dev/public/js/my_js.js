function changeColor() {
    var color = 'blue';
    if (document.getElementById("our_demo").style.color === 'blue')
        color = 'red';

    document.getElementById("our_demo").style.color = color;
    document.getElementById("our_demo").style.borderColor = color;
}


