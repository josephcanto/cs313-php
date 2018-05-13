$("button").click(function(e) {
    // e.preventDefault();
    var itemId = e.target.id;
    alert(itemId);
    // $.ajax({
    //     type: "POST",
    //     url: "../add.php",
    //     data: itemId
    // });
});