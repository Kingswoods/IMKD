<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include('../resources/utilities/conn.php');
    
    //Create MySQL Object
    $con = new mysqli($servername, $username, $password, 'skp__systems');
    
    //Test connection
    if ($con->connect_error)
    {
        die('Connection failed: ' . $con->connect_error);
    }
    
    $con->set_charset('UTF8');

    if (isset($_GET['query']))
    {
        if (isset($_GET['OS']))
        {
            if ($_GET['query'] == 'all')
            {
                $OS = $_GET['OS'];

                $error__query = $con->prepare('SELECT * FROM imkd__errors WHERE error__OS = ?');
                $error__query->bind_param('s', $OS);
                $error__query->execute();
                $error__result = $error__query->get_result();
            }
            else
            {
                $query = $_GET['query'];
                $OS = $_GET['OS'];

                $error__query = $con->prepare('SELECT * FROM imkd__errors WHERE error__OS = ? AND MATCH(error__title, error__message, error__description, error__tags) AGAINST (? IN BOOLEAN MODE)');
                $error__query->bind_param('ss', $OS, $query);
                $error__query->execute();
                $error__result = $error__query->get_result();
                
            }
        }
        else
        {
            if ($_GET['query'] == 'all')
            {
                $error__query = $con->prepare('SELECT * FROM imkd__errors');
                $error__query->execute();
                $error__result = $error__query->get_result();
            }
            else
            {
                
            }
        }
    }
    else
    {
        header('Location: ../search?query=all');     
    }
    
?>

<!DOCTYPE html>
<html>
    
    <head>
    
        <!-- Meta Data -->

        <title>IMKD &mdash; SKP Systems</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>

        <!-- Style Sheets -->
        
        <link rel="stylesheet" type="text/css" href="../resources/stylesheets/main.css">

        <!-- Scripts -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='resources/scripts/main.js'></script>
    
    </head>
    
    <body>
        
        <?php
        
            if ($error__result->num_rows > 0)
            {
                echo '<table class="table table__striped table__main">';
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th>Fejl</th>';
                            echo '<th>Fejlbesked</th>';
                            echo '<th>Beskrivelse</th>';
                            echo '<th>Kategori</th>';
                            echo '<th>Operativsystem</th>';
                        echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    while ($row = $error__result->fetch_assoc())
                    {
                        echo '<tr class="error__link" data-errorid="'.$row['error__id'].'">';
                            echo '<td>'.$row['error__title'].'</td>';
                            echo '<td>'.$row['error__message'].'</td>';
                            echo '<td>'.$row['error__description'].'</td>';
                            echo '<td>'.$row['error__category'].'</td>';
                            echo '<td>'.$row['error__OS'].'</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                echo '</table>';
                
                $error__result->free_result();
                
                $error__query->close();
                            
            }
            else
            {
                echo 'Dixxxx';
            }
        
        ?>
        
    </body>