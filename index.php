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
        
        <link rel="stylesheet" type="text/css" href="resources/stylesheets/main.css">

        <!-- Scripts -->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src='resources/scripts/main.js'></script>
    
    </head>
    
    <body>
        
        <div class="page__container">
            
            <?php include 'resources/includes/header.php'; ?>
            
            <div class="page__content">
                
                <div class="page__inwrap">
                    
                    <div class="search__container">
                        
                        <div class="search__title">SKP SYSTEMS</div>
                        <div class="search__sub">Information Management & Knowledge Discovery</div>
                        
                        <form id="search" class="simple__form" action="./" method="post" accept-charset="UTF-8" novalidate='novalidate'>
                            
                            <div class='form__inputs'>
                                
                                <div class='form__item search'>
                                    
                                    <input type='text' id='search__query' name='search__query' class='form__control dark' autofocus='autofocus' required autocomplete="off" value=''/>
                                    
                                </div>
                                
                            </div>
                            
                            <div class='form__button'>
                                
                                <a class='button button__form' id='browse__submit' href='search?query=all'>Browse fejl</a>
                                <button id='search__submit' class='button button__form'>Søg i fejl</button>
                                
                            </div>
                            
                        </form>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </body>
    
</html>