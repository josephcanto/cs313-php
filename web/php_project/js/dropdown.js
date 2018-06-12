function toggleDropdown() {
    var element = document.getElementsByClassName('form-dropdown')[0];
    var arrow = document.getElementById('down-arrow');
    if(element.style.maxHeight == '0px') {
        element.style.overflowY = 'visible';
        element.style.maxHeight = '500px';
        element.style.padding = '5px';
        element.style.borderWidth = '0px 1px 1px 1px';
        element.style.borderStyle = 'solid';
        arrow.style.transform = 'rotate(225deg)';
    } else {
        element.style.overflowY = 'hidden';
        element.style.maxHeight = '0px';
        element.style.padding = '0px';
        element.style.borderWidth = '0px';
        element.style.borderStyle = 'hidden';
        arrow.style.transform = 'rotate(45deg)';
    }
}