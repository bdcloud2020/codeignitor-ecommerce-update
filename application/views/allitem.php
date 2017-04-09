<?php include("template/header.php"); ?>

<div class="col-md-8">
  <div class="row">
    <?php foreach ($alls as $all): ?>
      <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <a href="<?= base_url(); ?>products/detail/<?= $all->id; ?>" >  <img src="<?php echo base_url(); ?>assets/image/items/<?php echo $all->image; ?>"  style ="width: 200px; height: 200px;" alt="..."></a>
                  <div class="caption">
                      <h3>Rs.<?php echo $all->price; ?></h3>
                       <h4><?php echo $all->name; ?></h4>
                       <h5><?php echo $all->desc; ?></h5>
                        <div class="row">
                             <div class="col-md-12">
                                 <h5><strong>Available Size:</strong> S, M, L</h5>
                             </div>
                         </div>
                        <div class="row">
                          <div class="col-md-4">
                            <br>
                          <a href="<?= base_url(); ?>products/detail/<?= $all->id; ?>" class="btn btn-primary" role="button">Detail</a>
                          </div>
                          <div class="col-md-8">
                          <form method="post" action="<?php echo base_url(); ?>cart/add" >
                            <input class="qty" type="hidden" name="qty" value="1" /><br>
                            <input type="hidden" name="item_number" value="<?php echo $all->id; ?>" />
                            <input type="hidden" name="price" value="<?php echo $all->price; ?>" />
                            <input type="hidden" name="title" value="<?php echo $all->name; ?>" />
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
    <?= $this->pagination->create_links(); ?>
  </div>

<?php include("template/footer.php"); ?>
