<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
$page = $web->prepare("select * from donatepage");
$page->execute();
$pages=$page->fetchColumn();

$page2 = $web->prepare("select * from tospage");
$page2->execute();
$pages2=$page2->fetchColumn();
?>

<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Page Edit</h1>
            <?php flash('pageedit') ?>
            <div class="news-content">

             <form action="<?php echo url("app/module/dashboard/pageEditdonate.php")?>" method="POST" enctype="multipart/form-data" novalidate autocomplete="off" class="pure-form pure-form-stacked" >
               <fieldset>
                <label for="editor">Donate page</label>
                <textarea id="editor" name="editor" class="ckeditor"> <?php echo $pages ?></textarea>
                <button name="save" type="submit" class="pure-button button-success" style="margin-top:10px">Save</button>
            </fieldset>

        </form>

             <form action="<?php echo url("app/module/dashboard/pageEditTos.php")?>" method="POST" enctype="multipart/form-data" novalidate autocomplete="off" class="pure-form pure-form-stacked" >
               <fieldset>
                <label for="editor">Terms of service page</label>
                <textarea id="editor" name="editor2" class="ckeditor"><?php echo $pages2 ?> </textarea>
                <button name="save" type="submit" class="pure-button button-success" style="margin-top:10px">Save</button>
            </fieldset>

        </form>

    </div>


</div>

<div class="footer">
    <div class="pure-menu pure-menu-horizontal">
        <ul>
            <li class="pure-menu-item"><a href="http://purecss.io/" class="pure-menu-link">PURE CSS</a></li>
            <li class="pure-menu-item"><a href="http://fikiruretgeci.com" class="pure-menu-link">FIKIR URETGECI</a></li>
            <li class="pure-menu-item"><a href="http://pure-themes.com" class="pure-menu-link">PURE THEMES</a></li>
        </ul>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
