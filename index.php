<?php
    include 'core.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>XI-REV</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <script src="js/jquery.min.js"></script>
        <script src="js/vue.min.js"></script>
        <script src="js/service.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            if($auth){
        ?>
        <nav class="navbar navbar-inverse bg-dark">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="."><i class="fa fa-cube" aria-hidden="true"></i>
                    XI-REV</a>
                </div>
                <div id="navbar" class="pull-right">
                    <ul class="nav navbar-nav">
                        <!--<li class="active"><a href="#">Home</a></li>-->
                        <?php
                            if($auth){
                        ?>
                            <li>
                                <a href="login" class="<?php echo $page == 'login' ? 'active' : ''; ?>">Projects</a>
                            </li>
                            <li class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="account.settings">Account Settings</a></li>
                                    <li><a href="global.help">Help</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="account.logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            }
        ?>

        <div id="content">
            <div class="container">
                <?php
                    include 'views/'.$page.'.php';
                ?>
            </div>
        </div>

        <?php
            if($auth){
        ?>
        <footer class="container">
            <b>XI-REV</b> - 2018
        </footer>
        <?php
            }
        ?>

        <script type="text/javascript">
            $(document).ready(function(){
                if(app){
                    app.init();
                }
            });
        </script>
    </body>
</html>