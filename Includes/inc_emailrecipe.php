<?php
    // Initialize variables
    $adminEmail = "emma.lee.vtc@gmail.com";
    $userEmail = "";
    $subject = date("m-d-y") . " Gamer Fuel Recipe Submission";
    $message = "";

    $name = $_POST['name-submit'];
    $series = $_POST['series-submit'];
    $url = $_POST['url-submit'];
    $creator = $_POST['creator-submit'];
    $alcohol = $_POST['alcohol-submit'];

    $message = "<p>Recipe Name: \"$name\".</p><br>
                <p>Recipe Series: \"$series\".</p><br>
                <p>Recipe URL: \"$url\".</p><br>
                <p>Recipe Creator: \"$creator\".</p><br>
                <p>Recipe Alcohol: \"$alcohol\".</p><br>";

    // Email Recipe to admin
    $submission = mail($adminEmail, $subject, $message);
    if ($submission) {
        echo "<p>Thanks for sending in your recipe submission!</p>";
        echo "It will be reviewed by an admin and you'll hear from us shortly about it's posting. :)</p>";
    }
    else
        echo "<p>There was an error sending the recipe. Please try again in a few minutes, thank you!</p>";
?>

    <p>
        <a href="index.php?page=home_page">Home</a>
        <a href="index.php?page=submit">Back</a>
    </p>