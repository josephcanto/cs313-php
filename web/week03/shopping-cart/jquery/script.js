$(document).ready(function() {
    $('button').click(function (e) {
        e.preventDefault();
        var itemId = $(this).id;
        $.ajax({
            type: "POST",
            url: "../add.php",
            data: itemId
        });
    });
});