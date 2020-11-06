<?php

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'mario_recipes':
                include('Includes/RecipePages/mario_recipes.php');
                break;
            case 'zelda_recipes':
                include('Includes/RecipePages/zelda_recipes.php');
                break;
            case 'metroid_recipes':
                include('Includes/RecipePages/metroid_recipes.php');
                break;
            case 'kirby_recipes':
                include('Includes/RecipePages/kirby_recipes.php');
                break;
            case 'sonic_recipes':
                include('Includes/RecipePages/sonic_recipes.php');
                break;
            case 'undertale_recipes':
                include('Includes/RecipePages/undertale_recipes.php');
                break;
            case 'pokemon_recipes':
                include('Includes/RecipePages/pokemon_recipes.php');
                break;
            case 'misc_recipes':
                include('Includes/RecipePages/misc_recipes.php');
                break;
            default:
                include('inc_game_buttons.php');
                break;
        }
    }
    else
        include('inc_game_buttons.php');


?>