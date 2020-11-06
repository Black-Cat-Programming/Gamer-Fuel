<?php 
    if(!isset($_SESSION['authenticated'])) 
        $_SESSION['authenticated'] = FALSE;
    if (!$_SESSION["authenticated"]) {
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing: 15px;">
<tr align="left">
<td></td>
<td></td>
<td>
<form method="post">
<p>Log in: <input type="text" name="username" required/></p>

<p>Password: <input type="password" name="password" required/></p>

<p>Don't have an account? Sign up <a href="index.php?page=signup">here</a>.</p>

<input type="submit" name="submit" value="Submit"/>
</form>
</td>
<td></td>
<td></td>
</tr>
</table>

<?php
}

else {
?>
<p align="left">You are already logged in.</p>
<!-- MAYBE REDIRECT TO USER PAGE -->

<?php
}

    if(isset($_POST["submit"])) {
        $DBConnect = @mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE)
                echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysql_errno() . ": " . mysql_error() . "</p>";
        else {
            $DBName = "gamer_fuel";
            mysqli_select_db($DBConnect, $DBName);
            $TableName = "users";
            $SQLstring = "SELECT * FROM users 
                WHERE name = '" . $_POST["username"] . "' 
                and password = '". $_POST["password"]."'";
            $result = @mysqli_query($DBConnect, $SQLstring);
            
            $count = mysqli_num_rows($result);
            if($count==0) 
                echo "Invalid Username or Password";
            else {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["user_id"] = $row["name"];
                $_SESSION["authenticated"] = TRUE;
                //echo "<meta http-equiv='refresh' content='0'>";
                header('Location: index.php?page=user');

            }
        }
        mysqli_close($DBConnect);
    }
?>