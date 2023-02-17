<?php
include(dirname(__DIR__)."/app/layout/dashboard/head.php");
$store = $web->prepare("select * from itemmall where itemid = :id");
$store->bindParam(":id" , $_GET['id']);
$store->execute();
$stores=$store->fetchObject();

?>

<div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">

        <div class="items">

            <h1 class="subhead">Post Form</h1>

            <?php flash('store') ?>
            <form action="<?php echo $store->rowCount() == 0 ? url('app/module/dashboard/store.php') : url('app/module/dashboard/store.php?id='.$stores->itemid) ?>" method="post" enctype="multipart/form-data" class="pure-form pure-form-stacked">
                <fieldset>

                    <label for="title">Item Name</label>
                    <input name="itemname" id="title" type="text" placeholder="Title" class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemname ?>">

                    <label for="status">Category</label>
                    <select name="category" id="status" class="pure-input-1">
                     <?php
                     $stmt = $web->query("select * from itemcategory");
                     while($stmts = $stmt->fetchObject())
                     {
                        ?>
                        <option value="<?php echo $stmts->id ?>" <?php echo $store->rowCount() == 0 ? '' : $stmts->id == $stores->itemtype ? 'selected' : ''  ?>   ><?php echo $stmts->categoryname ?></option>
                        <?php
                    } 
                    ?>
                </select>
                <label for="status">Red Diamond <span style="color:red;font-size:12px">enable Red Diamond currency di pembelian</span></label>
                <select name="Red Diamond" id="status" class="pure-input-1">
                    <option value="1" <?php echo $store->rowCount() == 0 ? '' : $stores->itempricemoon == 1  ? 'selected' : '' ?>>True</option>
                    <option value="0" <?php echo $store->rowCount() == 0 ? '' : $stores->itempricemoon == 0  ? 'selected' : '' ?>>False</option>

                </select>
                <label for="status">is Set <span style="color:red;font-size:12px">1 Item = false , banyak item = true</span></label>
                <select name="isSet" id="isSet" class="pure-input-1">
                    <option value="1" <?php echo $store->rowCount() == 0 ? '' : ($stores->isSet == 1 ? 'selected' : '') ?>>True</option>
                    <option value="0" <?php echo $store->rowCount() == 0 ? '' : ($stores->isSet == 0 ? 'selected' : '')?>>False</option>

                </select>
                <label for="status">Duration <span style="color:red;font-size:12px">Perma / duration does not work on set item true </span></label>
                <select name="itemseal" id="isSet" class="pure-input-1">
                    <option value="1" <?php echo $store->rowCount() == 0 ? '' : ($stores->itemseal == 1 ? 'selected' : '') ?>>True</option>
                    <option value="0" <?php echo $store->rowCount() == 0 ? '' : ($stores->itemseal == 0 ? 'selected' : '')?>>False</option>

                </select>
                <label for="content">Item Desc</label>
                <textarea name="itemdesc" id="content" class="pure-input-1" rows="10"><?php echo $store->rowCount() == 0 ? '' : $stores->itemdesc?></textarea>
                <label for="content">Item Set Opt</label>
                <textarea name="itemsetopt" id="content" class="pure-input-1" rows="10"><?php echo !empty($stores->itemsetopt) ? $stores->itemsetopt : str_replace('|',"\n",'Strength +12|Dexterity +12|Vitality +18|Intelligence +12|Wisdom +12|Physical Defense +5%|MP Recovery +8') 
                ?>
            </textarea>
            <label for="slug">Display Image</label>
            <input name="display" style="border:1px solid #ccc;padding:7px;border-radius:5px" id="imageupload" type="file" class="pure-input-1" value="">
            <div class="item-box">
                <img src="<?php echo url('res/upload/'.$stores->itemimage) ?>" id="blah">               
            </div>
            <div style="border:1px solid #ccc;padding:10px;border-radius:5px;font-size:14px">
                <p style="margin:5px">
                    Panduan Menambahkan data item
                </p>
                <p style="margin:5px;color:red">
                    " ; " adalah pembatas dan harus di tulis setelah menulis informasi item
                    <br><br>
                    Contoh : Full Set;123123;box.png;30;40;
                    <br><br>
                    123123 disini adalah kode item di resource mu
                    <br>
                    <br>
                    <img height="50px" style="border:1px solid #ccc" src="<?php echo url('res/assets/img/dashboardpanduan.png') ?>">
                    <img height="50px" style="border:1px solid #ccc" src="<?php echo url('res/assets/img/dashboardpanduan2.png') ?>">


                    <br><br>
                    Contoh 2 : Head;123123;head.png;30;40;Dexterity +3, Vitality +2
                    <br><br>
                    Kali ini dengan item option satuan ( Jika tidak ingin memberikan efek kosongkan saja )
                    <br><br>

                    <br><br>
                    <img height="50px" style="border:1px solid #ccc" src="<?php echo url('res/assets/img/dashboardpanduan3.png') ?>">
                    <br><br>
                    Upload Gambar Icon di folder res/upload
                </p>
            </div>
            <label for="item1">Item 1 </label>
            <input name="item1" id="item1" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue1 ?>">
            <label for="item2">Item 2 </label>
            <input name="item2" id="item2" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue2 ?>">
            <label for="item3">Item 3 </label>
            <input name="item3" id="item3" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue3 ?>">
            <label for="item4">Item 4 </label>
            <input name="item4" id="item4" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue4 ?>">
            <label for="item5">Item 5 </label>
            <input name="item5" id="item5" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue5 ?>">
            <label for="item6">Item 6 </label>
            <input name="item6" id="item6" type="text" placeholder="Item Name ; Resource Code (0000001) ; icon.png ; 30 ( star ) ; 40 ( moon ) ; Strength +5 ( Option Satuan ) " class="pure-input-1" value="<?php echo $store->rowCount() == 0 ? '' : $stores->itemvalue6 ?>">
            <input type="hidden" name="id" value="1">
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
<script>
    $("#isSet").change(function()
    {
        var optionSelected = $(this).find("option:selected");
        if(this.value == 0)
        {
            $('label[for="item2"]').hide();
            $('label[for="item3"]').hide();
            $('label[for="item4"]').hide();
            $('label[for="item5"]').hide();
            $('label[for="item6"]').hide();
            $('#item2').hide();
            $('#item3').hide();
            $('#item4').hide();
            $('#item5').hide();
            $('#item6').hide();
        }
        else {
            $('label[for="item2"]').show();
            $('label[for="item3"]').show();
            $('label[for="item4"]').show();
            $('label[for="item5"]').show();
            $('label[for="item6"]').show();
            $('#item2').show();
            $('#item3').show();
            $('#item4').show();
            $('#item5').show();
            $('#item6').show();
        }
    });
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

$("#imageupload").change(function() {
  readURL(this);
});
</script>
</html>
