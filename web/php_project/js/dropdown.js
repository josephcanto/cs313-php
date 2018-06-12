function toggleDropdown() {
    var element = document.getElementById('form-dropdown');
    if(element.style.height == '0px') {
        element.style.overflowY = 'visible';
        element.style.height = '232px';
        element.style.padding = '2px 5px';
        element.style.borderWidth = '0px 1px 1px 1px';
        element.style.borderStyle = 'solid';
    } else {
        element.style.overflowY = 'hidden';
        element.style.height = '0px';
        element.style.padding = '0px';
        element.style.borderWidth = '0px';
        element.style.borderStyle = 'hidden';
    }
}