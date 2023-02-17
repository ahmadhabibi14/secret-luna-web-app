<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
$store = $web->prepare("select * from itemmall where itemid = :id");
$store->bindParam(":id" , $_GET['id']);
$store->execute();
$stores=$store->fetchObject();
if(isset($_POST['submit']))
{
    if(!empty($_FILES['display']['name']))
    {
        $insert = $web->prepare("insert into media(mediaimage) values(:display)");
        $insert->bindParam(":display" , $_FILES['display']['name']);
        $insert->execute();
        move_uploaded_file($_FILES['display']['tmp_name'], dirname(__DIR__).'/res/upload/'.$_FILES['display']['name']);
    }
}
?>

<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">
            <h1 class="subhead">Media</h1>
            <table class="pure-table pure-table-bordered">
                <thead>
                    <tr>
                        <th width="30px">#</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $store = $web->prepare("select * from media");
                    $store->execute();
                    $number = 1;
                    while($stores = $store->fetchObject())
                    {
                        ?>                  
                        <tr>
                            <td><?php echo $number++ ?></td>

                            <td style="text-align: center;width:100px"><?php echo "<img WIDTH='100px' src=".url('res/upload/'.$stores->mediaimage).">" ?></td>
                             <td width=30px>
                              
                                <a class="pure-button button-small button-error" href="<?php echo url('app/module/dashboard/mediadelete.php')."?id=$stores->id" ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <h1 class="subhead">Media</h1>

            <?php flash('media') ?>
            <form action="" method="post" enctype="multipart/form-data" class="pure-form pure-form-stacked">
                <fieldset>


                    <label for="slug">Add Image</label>
                    <input name="display" style="border:1px solid #ccc;padding:7px;border-radius:5px" id="imageupload" type="file" class="pure-input-1" value="">



                    <button name="submit" type="submit" class="pure-button button-success">Save</button>
                </fieldset>
            </form>
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
