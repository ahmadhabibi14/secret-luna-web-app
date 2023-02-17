<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
?>


<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Log Store</h1>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Resource Code</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Final Price</th>
                        <th>Username</th>
                        <th style="text-align: center">Currency</th>
                        <th>Account Bal Before</th>
                        <th>Account Bal After</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $store = $web->prepare("select im.itemname , il.resourceid , il.itemprice , il.itemdiscount , il.itemfinalprice , clf.id_loginid ,il.qty , il.accountbalb , accountbala , currency from itemlog il inner join itemmall im on im.itemid = il.itemid inner join luna_memberdb.dbo.chr_log_info clf on il.accountid = clf.id_idx");
                    $store->execute();
                    $number = 1;
                    while($stores = $store->fetchObject())
                    {
                        ?>                  
                        <tr>
                            <td><?php echo $number++ ?></td>
                            <td><?php echo $stores->itemname ?></td>
                            <td><?php echo $stores->resourceid ?></td>
                            <td><?php echo $stores->itemprice ?></td>
                            <td><?php echo $stores->qty?></td>
                            <td><?php echo $stores->itemfinalprice?></td>
                            <td><?php echo $stores->id_loginid?></td>
                            <td style="text-align: center"><?php echo $stores->currency == "star" ? "<img src=".url('res/assets/img/blue.png').">" : "<img src=".url('res/assets/img/red.png').">" ?></td>
                            <td><?php echo $stores->accountbalb?></td>
                             <td><?php echo $stores->accountbala?></td>
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
