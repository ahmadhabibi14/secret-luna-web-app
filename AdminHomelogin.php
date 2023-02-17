<?php
include_once('app/config/config.php');
include_once('app/module/dashboard/login.php');
if(isset($_SESSION['adminsecret']))
{
    redirect('dashboard');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Tera Luna</title>

    <link rel="stylesheet" href="res/assets/css/pure-min.css">
    <link rel="stylesheet" href="res/assets/css/pure-responsive-min.css">
    <link rel="stylesheet" href="res/assets/css/dashboard.css">
</head>
<body style="background: #FC466B;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">

<div  style="margin:0 auto;width:500px" class="content">
    <div class="header-medium">
        <?php flash('loginadmin') ?>
        <div class="items">
            <h1 style="color:white" class="subhead">Login</h1>
            <form action="<?php echo url('app/module/dashboard/login.php') ?>" method="POST" class="pure-form pure-form-stacked">
                <fieldset>

                    <label style="color:white" for="email">Username</label>
                    <input name="admin" id="email" type="text" placeholder="Username" class="pure-input-1" value="">

                    <label style="color:white" for="password">Password</label>
                    <input name="adminp" id="password" type="password" placeholder="Password" class="pure-input-1" value="">

                    <button name="login" style="width:100%" type="submit" class="pure-button button-success">Sign in</button>
                </fieldset>
            </form>
        </div>

        <div class="footer">
            <div class="pure-menu pure-menu-horizontal">
                <ul >                           
                    <li class="pure-menu-item"><a style="color:white" href="<?php echo url('index.php') ?>" class="pure-menu-link">Secret Luna</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
