$(document).ready(function() {
    $('button').click(function (e) {
        // e.preventDefault();
        var itemId = $(this).id;
        alert(itemId);
        // $.ajax({
        //     type: "POST",
        //     url: "../add.php",
        //     data: itemId
        // });
    });
});