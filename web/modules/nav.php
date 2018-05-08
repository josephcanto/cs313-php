<nav>
    <ul class='main-nav'>
        <?php var_dump($_SERVER['PHP_SELF']); ?>
        <li><a href='index.php' title='Go to the home page' class="<?php if($_SERVER['PHP_SELF'] == 'index.php') echo 'active'; ?>">Home</a></li>
        <li><a href='assignments.php' title='Go to the assignments page' class="<?php if($_SERVER['PHP_SELF'] == 'assignments.php') echo 'active'; ?>">Assignments</a></li>
    </ul>
</nav>