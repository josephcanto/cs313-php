<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Form</title>
</head>
<body>
    <form action='script.php' method='post'>
        <label for='name'>Name:</label>
        <input type='text' id='name' name='name'><br><br>
        <label for='email'>Email:</label>
        <input type='email' id='email' name='email'><br><br>
        <label>Major:</label><br>
        <?php
            $majors = [
                'Computer Science (CS)',
                'Web Design and Development (WDD)',
                'Computer Information Technology (CIT)',
                'Computer Engineering (CE)'
            ];
            foreach($majors as $major) {
                echo "<input type='radio' name='major' value='$major'>
                <label>$major</label><br>";
            }
        ?>
        <br><label for='comments'>Comments:</label>
        <textarea rows='4' cols='30' id='comments' name='comments'></textarea><br><br>
        <label>Which continents have you visited?</label><br>
        <input type='checkbox' name='continents[]' value='na'><label>North America</label><br>
        <input type='checkbox' name='continents[]' value='sa'><label>South America</label><br>
        <input type='checkbox' name='continents[]' value='eu'><label>Europe</label><br>
        <input type='checkbox' name='continents[]' value='as'><label>Asia</label><br>
        <input type='checkbox' name='continents[]' value='au'><label>Australia</label><br>
        <input type='checkbox' name='continents[]' value='af'><label>Africa</label><br>
        <input type='checkbox' name='continents[]' value='an'><label>Antarctica</label><br><br>
        <input type='submit' value='Submit'>
    </form>
</body>
</html>