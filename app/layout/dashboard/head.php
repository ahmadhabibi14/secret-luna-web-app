<?php
session_start();
include(dirname(dirname(__DIR__))."/config/config.php");
if(empty($_SESSION['adminsecret']))
{
    redirect("index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a blog page with a list of posts.">
    <title>Secret Luna Admin Panel</title>

    <script src="<?php echo url('res/vendor/ckeditor/ckeditor.js') ?>"></script>
    <script src="<?php echo url('res/vendor/jquery.min.js')?>"></script>
    <link rel="stylesheet" href="<?php echo url('res/assets/css/pure-min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('res/assets/css/pure-responsive-min.css') ?>">
    <link rel="stylesheet" href="<?php echo url('res/assets/css/dashboard.css') ?>">
</head>
<body>
    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-3-24">
            <div id="menu">
                <div class="pure-menu">
                    <p style="text-transform: none;" class="pure-menu-heading">
                     <strong>Secret</strong>Luna         
                 </p>
                 <ul class="pure-menu-list">
                    <li class="pure-menu-item">
                        <a href="<?php echo url('dashboard/index.php') ?>" class="pure-menu-link">Dashboard</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="<?php echo url('dashboard/news.php') ?>" class="pure-menu-link">News</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="pageedit.php" class="pure-menu-link">Terms & Donate</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="media.php" class="pure-menu-link">Media</a>
                    </li>
                    <li class="pure-menu-item menu-item-divided">
                        <a href="store.php" class="pure-menu-link">Store</a>
                    </li>
                     <li class="pure-menu-item">
                        <a href="storelog.php" class="pure-menu-link">Store Log</a>
                    </li>
                    <li class="pure-menu-item menu-item-divided ">
                        <a href="senditem.php" class="pure-menu-link">Send Item</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="coin.php" class="pure-menu-link">Send Coin</a>
                    </li>
                     <li class="pure-menu-item">
                        <a href="<?php echo url('app/module/logout.php') ?>" class="pure-menu-link">Logout</a>
                    </li>
                </ul>
                <script>
                    $('.pure-menu-list li').each(function() {
                        if (window.location.href.indexOf($(this).find('a:first').attr('href')) > -1) {
                            $(this).addClass('pure-menu-selected').siblings().removeClass('pure-menu-selected');
                        }
                    });

                </script>
            </div>
        </div>
    </div>