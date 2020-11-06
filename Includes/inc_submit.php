<?php
    if(!isset($_SESSION['authenticated'])) 
        $_SESSION['authenticated'] = FALSE;

    // Initialize variables
    $name = "";
    $series = "";
    $url = "";
    $creator = "";
    $alcohol = "F";

    // Make sure user is logged in before submitting recipe
    if(!$_SESSION['authenticated']) {
        echo "<h3>Please log in to submit a recipe.</h3>";
        include('Includes/inc_login.php');
    } else { ?>

        <h3>Want to see another recipe on this site? Please let us know!</h3>
        <form action="index.php?page=email" method="post">
            <p>Recipe Name <input type="text" name="name-submit" value="<?php echo $name; ?>" required/></p>
            <p>Series
            <select name="series-submit">
                <option value="misc">Misc.</option>
                <option value="mario">Mario</option>
                <option value="zelda">Zelda</option>
                <option value="metroid">Metroid</option>
                <option value="kirby">Kirby</option>
                <option value="pokemon">Pokemon</option>
                <option value="undertale">Undertale</option>
            </select></p>
            <p>URL <input type="text" name="url-submit" value="<?php echo $url; ?>" required/></p>
            <p>Creator <input type="text" name="creator-submit" value="<?php echo $creator; ?>" required/></p>
            <p>
                Alcohol
                <input type="radio" name="alcohol-submit" value="T" />True
                <input type="radio" name="alcohol-submit" value="F" checked="checked"/>False
            </p>
            <p>
            <input type="submit" value="Submit" />
            
            <input type="reset" value="Reset" />
            </p>
        </form>
        
    <?php }

        // Email info to admin afterwards.
        // Thanks "name" for submitting the recipe! It will be reviewed by an admin and may be put up shortly :)
        

?>