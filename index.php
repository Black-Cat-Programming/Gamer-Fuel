<?php
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Gamer Fuel</title>
    </head>

    <style type="text/css">
        body {
            background-color: #565656;
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
            color: white;
        }
        a:link {
            color: #ff9999;
        }
        a:visited {
            color: #996699;
        }
        a:hover {
            color: #cc6a6a;
        }
    </style>

    <body>
        <?php include('Includes/inc_header.php'); ?>

        <?php include('Includes/inc_button_nav.php'); ?>

        <?php
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'about_us':
                        include('Includes/inc_about_us.php');
                        break;
                    case 'all_recipes':
                        include('Includes/inc_all_recipes.php');
                        break;
                    case 'submit':
                        include('Includes/' .'inc_submit.php');
                        break;
                    case 'email':
                        include('Includes/' .'inc_emailrecipe.php');
                        break;
                    case 'user':
                        include('Includes/' .'inc_user.php');
                        break;
                    case 'login':
                        include('Includes/' .'inc_login.php');
                        break;
                    case 'signup':
                        include('Includes/' .'inc_create_account.php');
                        break;
                    case 'home_page':
                        default:
                            include('Includes/inc_home.php');
                            break;
                }
            }
            else
                include('Includes/inc_home.php');
        ?>

        <?php include('Includes/inc_footer.php'); ?>
        
        <!-- <?php include('Includes/inc_text_link.php'); ?> -->
    </body>

</html>