<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
$content = $web->prepare("select * from news where id = :id");
$content->bindParam(":id" , $_GET['id']);
$content->execute();
$content2=$content->fetchObject();

?>

<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">News<a class="pure-button button-small button-secondary" href="">Mode <?php echo $content->rowCount() == 0 ? 'Insert' : 'Edit' ?></a></h1>
            <?php flash('newsedit') ?>
            <div class="news-content">

             <form action="<?php echo $content->rowCount() == 0 ? url("app/module/dashboard/newsEdit.php") : url("app/module/dashboard/newsEdit.php?id=$content2->id")?>" method="POST" enctype="multipart/form-data" novalidate autocomplete="off" class="pure-form pure-form-stacked" >
               <fieldset>

                <label for="title">Display</label>
                <input name="display" id="title" type="text" placeholder="Text to display" class="pure-input-1" value="<?php echo $content->rowCount() == 0 ? '' : $content2->title; ?>">

                <label for="slug">Type</label>
                <input name="type" id="slug" type="text" placeholder="Update/News" class="pure-input-1" value="<?php echo $content->rowCount() == 0 ? '' : $content2->categoryname; ?>">

                <label for="editor">Content</label>
                <textarea id="editor" name="editor" class="ckeditor"> <?php echo $content->rowCount() == 0 ? '' : $content2->content; ?></textarea>
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
