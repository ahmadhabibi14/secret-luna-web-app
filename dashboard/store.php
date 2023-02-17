<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
?>


<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Item List <a class="pure-button button-small button-secondary" href="storeedit.php">Add New</a></h1>

            <?php flash('store') ?>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Duration</th>
                        <th width="150px">Single Item</th>
                        <th width="150px">Currency</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $store = $web->prepare("select * from itemmall im inner join itemcategory ic on im.itemtype = ic.id order by itemtype asc");
                    $store->execute();
                    $number = 1;
                    while($stores = $store->fetchObject())
                    {
                        ?>                  
                        <tr>
                            <td><?php echo $number++ ?></td>
                            <td><?php echo $stores->itemname ?></td>
                            <td><?php echo $stores->categoryname ?></td>
                            <td width="100px"><img width="50px" height="50px" src="<?php echo url('res/upload/'.$stores->itemimage) ?>"></td>
                             <td><?php echo $stores->itemseal == 1 ? 'True' : 'False' ?></td>
                            <td><?php echo $stores->isSet == 1 ? 'False' : 'True' ?></td>
                            <td><?php echo $stores->itempricemoon == 1 ? 'Star & Moon' : 'Star Only' ?></td>
                            <td>
                                <a class="pure-button button-small button-success" href="<?php echo "storeedit.php"."?id=$stores->itemid"?>">Edit</a>
                                <a class="pure-button button-small button-error" href="<?php echo url('app/module/dashboard/storedelete.php')."?id=$stores->itemid" ?>" onclick="return confirm('Are you sure?');">Delete</a>
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
