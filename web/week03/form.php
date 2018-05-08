<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action='script.php' method='post'>
        <label for='name'>Name:</label>
        <input type='text' id='name' name='name'><br><br>
        <label for='email'>Email:</label>
        <input type='email' id='email' name='email'><br><br>
        <label>Major:</label><br>
        <input type='radio' name='major' value='Computer Science'>
        <label>Computer Science</label><br>
        <input type='radio' name='major' value='Web Design and Development'>
        <label>Web Design and Development</label><br>
        <input type='radio' name='major' value='Computer information Technology'>
        <label>Computer Information Technology</label><br>
        <input type='radio' name='major' value='Computer Engineering'>
        <label>Computer Engineering</label><br><br>
        <label for='comments'>Comments:</label>
        <textarea rows='4' cols='50' id='comments' name='comments'></textarea><br><br>
        <input type='submit' value='Submit'>
    </form>
</body>
</html>