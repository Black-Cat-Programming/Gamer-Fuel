<style>
    div.a {
        text-indent: 50px;
    }
    div.b {
        font-size: 125%;
    }
</style>

<h1><img src="Images/GF_IconKirby.png" style ="border:0; width:40px; height:auto" />  Kirby Recipes</h1>

<?php

    $DBConnect = @mysqli_connect("localhost", "root", "");
    if($DBConnect === FALSE)
        echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysql_errno() . ": " . mysqli_error() . "</p>";
    else {
        $DBName = "gamer_fuel";
        if (!@mysqli_select_db($DBConnect, $DBName)) {
            $SQLString = "CREATE DATABASE $DBName";
            $QueryResult = @mysqli_query($DBConnect, $SQLString);
            if ($QueryResult === FALSE)
                echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysql_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
            else
                echo "<p>New Database Created.</p>";
        }
        mysqli_select_db($DBConnect, $DBName);
        
        $TableName = "recipes";
        $sql = 'SELECT recipe_name, creator_name, series, src, misc, alcohol, submitted_by FROM recipes ORDER BY recipe_name';
        $QueryResult = @mysqli_query($DBConnect, $sql);

        while($row = @mysqli_fetch_assoc($QueryResult)) {
            $name = $row['recipe_name'];
            $url = $row['src'];
            if($row['series'] == 'Kirby') {
                echo "<div class='b'><a href='{$url}'>{$name}</a></div>" .
                    "<div class='a'>by {$row['creator_name']}</div>" .
                    "<div class='a'>Series: {$row['series']}</div>";
                if($row['alcohol'] == 0)
                    echo "<br>";
                else if ($row['alcohol'] == 1)
                    echo "<div class='a'>Alcoholic.</div><br>";
            }
        }

    }
    mysqli_close($DBConnect);
?>