<?php 
    if(!isset($_SESSION['authenticated'])) 
        $_SESSION['authenticated'] = FALSE;
    
    $username = ""; $username_err = "";
    $email = ""; $email_err = "";
    $password = ""; $password_err = "";
    $confirm_password = ""; $confirm_password_err = "";
    $birthdate = ""; $birthdate_err = "";
    if(isset($_POST["submit"])) {
        
        $DBConnect = @mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE)
                echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysql_errno() . ": " . mysql_error() . "</p>";
        else {

            $DBName = "gamer_fuel";
            mysqli_select_db($DBConnect, $DBName);
            $TableName = "users";

            $dupe_name_sql = "SELECT * FROM users WHERE name = '{$_POST['username']}'";
            $name_result = mysqli_query($DBConnect, $dupe_name_sql);
            $dupe_email_sql = "SELECT * FROM users WHERE email = '{$_POST['email']}'";
            $email_result = mysqli_query($DBConnect, $dupe_email_sql);
 
            if(empty(trim($_POST["username"]))) {
                $username_err = "Please enter your username.";
            }
            elseif (mysqli_num_rows($name_result) != 0) {
                $username_err = "This username is taken, please choose another.";
            }
            else {
                $username = trim($_POST['username']);
            }

            if(empty(trim($_POST["email"]))) {
                $email_err = "Please enter your email.";
            }
            elseif (mysqli_num_rows($email_result) != 0) {
                $email_err = "This email is already associated with an account.";
            }
            else {
                $email = trim($_POST["email"]);
            }
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter a password.";     
            } 
            elseif(strlen(trim($_POST["password"])) < 6){
                $password_err = "Password must have atleast 6 characters.";
            }
            else{
                $password = trim($_POST["password"]);
            }
            
            if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "Please confirm password.";     
            } 
            else{
                $confirm_password = trim($_POST["confirm_password"]);
                if(empty($password_err) && ($password != $confirm_password)){
                    $confirm_password_err = "Password did not match.";
                }
            }
            if(empty($_POST["birthdate"])) {
                $birthdate_err = "Please enter your birth date.";
            }
            else {
                $birthdate = $_POST["birthdate"];
            }
            
            // Check input errors before inserting in database
            if(empty($username_err)  && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($birthdate_err)) {                
                $SQLstring = "INSERT INTO users (name, email, password, birthdate)
                    VALUES ('$username', '$email', '$password', '$birthdate')";
                if (mysqli_query($DBConnect, $SQLstring)) {
                    echo "New record created successfully";
                    $_SESSION["user_id"] = $username;
                    $_SESSION["authenticated"] = TRUE;
                    echo "<meta http-equiv='refresh' content='0'>";
                } else {
                    echo "Error: " . $SQLstring . "<br>" . mysqli_error($DBConnect);
                }
            }
        mysqli_close($DBConnect);
    }  
}
if (!$_SESSION["authenticated"]) {     
    ?>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-spacing: 15px;">
    <tr align="left">
    <td></td>
    <td></td>
    <td>
    <div>
    <form method="post">
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
    <p>Username: <input  type="text" name="username"/></p>
    <span class="help-block"><?php echo $username_err; ?></span>
    </div>  
    
    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
    <p>Email: <input  type="email" name="email"/></p>
    <span class="help-block"><?php echo $email_err; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <p>Password: <input  type="password" name="password"/></p>
    <span class="help-block"><?php echo $password_err; ?></span>
    </div>
    
    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
    <p>Confirm password: <input  type="password" name="confirm_password"/></p>
    <span class="help-block"><?php echo $confirm_password_err; ?></span>
    </div>
    
    <div class="form-group <?php echo (!empty($birthdate_err)) ? 'has-error' : ''; ?>">
    <p>Birth date: <input  type="date" name="birthdate"/></p>
    <span class="help-block"><?php echo $birthdate_err; ?></span>
    </div>

    <input  type="submit" name="submit" value="Submit"/> 
    <input type="reset" name="reset" value="Reset"/>
    </form>
    </div>
    </td>
    <td></td>
    <td></td>
    </tr>
    </table>
    
    <?php
    }
    else {
        echo "<p>Thank you for creating an account! (:</p>";
    }
?>