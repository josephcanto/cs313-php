$('button').click(function (e) {
    // e.preventDefault();
    $.ajax({
        type: "POST",
        url: "add.php",
        data: this.id
    });
});