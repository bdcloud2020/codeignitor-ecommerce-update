<?php include("template/header.php"); ?>



<!-- items -->
<div class="col-sm-6 col-md-4 col-md-offset-2" >
  <div class="thumbnail">
    <img src="<?= base_url();?>assets/image/items/<?= $det->image; ?>" style ="width: 900px; height: 350px;" alt="...">
    <div class="caption">
      <h3>Rs.<?= $det->price; ?></h3>
      <h4><?= $det->name; ?></h4>
      <p><?= $det->desc; ?></p>

      <form method="post" action="<?php echo base_url(); ?>cart/add" >
        <input class="qty" type="hidden" name="qty" value="1" /><br>
        <input type="hidden" name="item_number" value="<?php echo $det->id; ?>" />
        <input type="hidden" name="price" value="<?php echo $det->price; ?>" />
        <input type="hidden" name="title" value="<?php echo $det->name; ?>" />
        <div class="row">
            <div class="col-md-6"><?= br(1);?>
        <button class="btn btn-success" type="submit">Add To Cart</button>
            </div>
            <div class="col-md-6">
                 <label for="select" class="col-lg-2 control-label">Size:</label>
              <select class="form-control" name="size">
                  
                   <option>small</option>
                   <option selected>medium</option>
                   <option>large</option>
             </select>
            </div>
          </div>
      </form>
    </div>
  </div>


</div>
<!-- items ends -->




<?php include("template/footer.php"); ?>
