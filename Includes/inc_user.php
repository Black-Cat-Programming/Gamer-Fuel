<?php
if(!isset($_SESSION['authenticated'])) 
    $_SESSION['authenticated'] = FALSE;
if(!$_SESSION['authenticated']) {
    echo "<h3>Please log in to access your account.</h3>";
    include('Includes/inc_login.php');
} 
else { 
    $DBConnect = @mysqli_connect("localhost", "root", "");
    if ($DBConnect === FALSE)
            echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysql_errno() . ": " . mysql_error() . "</p>";
    else {
        $DBName = "gamer_fuel";
        mysqli_select_db($DBConnect, $DBName);
        $TableName = "users";
        $SQLstring = "SELECT * FROM users 
            WHERE name = '{$_SESSION["user_id"]}'";
        $result = @mysqli_query($DBConnect, $SQLstring);
        $values = mysqli_fetch_assoc($result);
?>
<h2> <?php echo $values['name'] ?> </h2>
<h3> <?php echo $values['email'] ?> </h3>
<form method="post">
<input type="submit" name="logout" value="Log out"/>
</form>

<?php
        if(isset($_POST['logout'])) {
            $_SESSION = array();
            session_destroy();
            header('Location: index.php');
        }
    }
}
?>