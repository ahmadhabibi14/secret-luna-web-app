<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
?>


<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Post List <a class="pure-button button-small button-secondary" href="newsedit.php">Add New</a></h1>

            <?php flash('news') ?>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $news = $web->prepare("select * from News");
                    $news->execute();
                    $number = 1;
                    while($news2 = $news->fetchObject())
                    {
                        ?>                  
                        <tr>
                            <td><?php echo $number++ ?></td>
                            <td><?php echo $news2->title ?></td>
                            <td><?php echo $news2->date ?></td>
                            <td><?php echo $news2->categoryname ?></td>
                            <td>
                                <a class="pure-button button-small button-success" href="<?php echo "newsEdit.php"."?id=$news2->id"?>">Edit</a>
                                <a class="pure-button button-small button-error" href="<?php echo url('app/module/dashboard/newsDelete.php')."?id=$news2->id" ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="navigation">
            <div class="pure-button-group">
                <a href="#" class="pure-button">Prev</a>
                <a href="#" class="pure-button">Next</a>
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
