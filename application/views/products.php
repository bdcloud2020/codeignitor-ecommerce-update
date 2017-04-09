<?php include("template/header.php"); ?>


<div class="col-md-8">
    <div class="row">
        <?php foreach ($getitem as $item): ?>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href="<?= base_url(); ?>products/detail/<?= $item->id; ?>" > <img src="<?php echo base_url(); ?>assets/image/items/<?php echo $item->image; ?>"  style ="width: 200px; height: 200px;" alt="..."></a>
                    <div class="caption">
                        <h3>Rs.<?php echo $item->price; ?></h3>
                        <h4><?php echo $item->name; ?></h4>
                        <h5><?php echo $item->desc; ?></h5>
                         <div class="row">
                             <div class="col-md-12">
                                 <h5><strong>Available Size:</strong> S, M, L</h5>
                             </div>
                         </div>
                        <div class="row">
                            <div class="col-md-4">
                                <br>
                                <a href="products/detail/<?= $item->id; ?>" class="btn btn-primary" role="button">Detail</a>
                            </div>
                            <div class="col-md-8">
                                <form method="post" action="<?php echo base_url(); ?>cart/add" >
                                    <input class="qty" type="hidden" name="qty" value="1" /><br>
                                    <input type="hidden" name="item_number" value="<?php echo $item->id; ?>" />
                                    <input type="hidden" name="price" value="<?php echo $item->price; ?>" />
                                    <input type="hidden" name="title" value="<?php echo $item->name; ?>" />
                                    <input type="hidden" name="size" value="medium" />

                                    <button class="btn btn-success" type="submit">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!--item ends-->
    </div>
</div>
<?php include("template/footer.php"); ?>
