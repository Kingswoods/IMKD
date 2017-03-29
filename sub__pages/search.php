<?php

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
        <link rel="stylesheet" type="text/css" href="../resources/stylesheets/search.css">

        <!-- Scripts -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='../resources/scripts/search.js'></script>
    
    </head>
    
    <body>
        
        <div class='page__container'>
            
            <div class='page__content'>
                
                <div class='page__inwrap'>
                    
                    <div class='top__bar'>
                    
                        <div class='search__form'>

                            <form id='search__bar' class='simple__form' action='./' method='post' accept-charset="UTF-8" novalidate="novalidate">

                                <div class='search__bar'>

                                    <div class='bar__title'>IMKD</div>

                                    <div class='sbar'>

                                        <div class='sibar'>

                                            <div class='sicbar'>

                                                <div class='sicbbar'>

                                                    <button id='search__submit' value='Søg' type='submit'>

                                                        <i class="fa fa-search search__icon" aria-hidden="true"></i>

                                                    </button>

                                                    <div class='sinputbar'>

                                                        <div class='sinputcbar'>

                                                            <div class='sinputcobar'>

                                                                <div class='inco'>

                                                                    <input id='search__query' class='form__control dark__alt' maxlength="2048" name='search__query' autocomplete="off" spellcheck="false" type='text'> 

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!--
                                    <form id="search__bar" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate='novalidate'>

                                        <div class='form__inputs'>

                                            <div class='form__item search'>

                                                <input type='text' id='search__query' name='search__query' class='form__control dark search' autofocus='autofocus' required autocomplete="off" value=''/>

                                            </div>

                                        </div>

                                    </form> -->

                                </div>

                            </form>

                        </div>
                        
                    </div>
                    
                    <div class='top__nav'>
                        
                        <div id='topbc'>
                            
                            <div id='topbco'>
                                
                                <div id='topbic'>
                                    
                                    <div id='topbic__ic'>
                                        
                                        <div id='top__nfl'>
                                            
                                            <div>
                                                
                                                <div class='main__bar'>
                                                    
                                                    <?php
                                                
                                                        if ($OS == "")
                                                        {
                                                            echo '<div class="menu__item active" id="all" data-identifier="all">Alle</div>';
                                                            echo '<div class="menu__item" id="windows" data-identifier="windows">Windows</div>';
                                                            echo '<div class="menu__item" id="linux" data-identifier="linux">Linux</div>';
                                                            echo '<div class="menu__item" id="osx" data-identifier="OSX">OS X</div>';
                                                        }
                                                        else if ($OS == "windows")
                                                        {
                                                            echo '<div class="menu__item" id="all" data-identifier="all">Alle</div>';
                                                            echo '<div class="menu__item active" id="windows" data-identifier="windows">Windows</div>';
                                                            echo '<div class="menu__item" id="linux" data-identifier="linux">Linux</div>';
                                                            echo '<div class="menu__item" id="osx" data-identifier="OSX">OS X</div>';
                                                        }
                                                        else if ($OS == "linux")
                                                        {
                                                            echo '<div class="menu__item" id="all" data-identifier="all">Alle</div>';
                                                            echo '<div class="menu__item" id="windows" data-identifier="windows">Windows</div>';
                                                            echo '<div class="menu__item active" id="linux" data-identifier="linux">Linux</div>';
                                                            echo '<div class="menu__item" id="osx" data-identifier="OSX">OS X</div>';
                                                        }
                                                        else if ($OS == "OSX")
                                                        {
                                                            echo '<div class="menu__item" id="all" data-identifier="all">Alle</div>';
                                                            echo '<div class="menu__item" id="windows" data-identifier="windows">Windows</div>';
                                                            echo '<div class="menu__item" id="linux" data-identifier="linux">Linux</div>';
                                                            echo '<div class="menu__item active" id="osx" data-identifier="OS X">OSX</div>';
                                                        }
                                                
                                                    ?>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div>
                                                
                                                <?php
                                                
                                                    if ($ware == "")
                                                    {
                                                        echo '<div class="sub__item active" id="sub__all" data-identifier="all">Alle</div>';
                                                        echo '<div class="sub__item" id="sub__software" data-identifier="software">Software</div>';
                                                        echo '<div class="sub__item" id="sub__hardware" data-identifier="hardware">Hardware</div>';
                                                        
                                                    }
                                                    else if ($ware == "SW")
                                                    {
                                                        echo '<div class="sub__item" id="sub__all" data-identifier="all">Alle</div>';
                                                        echo '<div class="sub__item active" id="sub__software" data-identifier="software">Software</div>';
                                                        echo '<div class="sub__item" id="sub__hardware" data-identifier="hardware">Hardware</div>';
                                                    }
                                                    else if ($ware == "HW")
                                                    {
                                                        echo '<div class="sub__item" id="sub__all" data-identifier="all">Alle</div>';
                                                        echo '<div class="sub__item" id="sub__software" data-identifier="software">Software</div>';
                                                        echo '<div class="sub__item active" id="sub__hardware" data-identifier="hardware">Hardware</div>';
                                                    }
                                                
                                                ?>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
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
                    
                </div>
                
            </div>
            
        </div>
        
        
        
    </body>