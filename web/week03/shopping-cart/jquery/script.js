$('button').click(function(e) {
    alert("button with id " + this.id + " was clicked");
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../add.php",
        data: { itemId: this.id }
    });
});