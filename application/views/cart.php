<?php include("template/header.php"); ?>
<h2>Your Cart</h2> <?php echo br(1); ?>
<div class="col-md-8">
    <div class="row">

        <?php if ($this->cart->contents()) : ?>
            <form method="post" action="<?php echo base_url(); ?>cart/process">
                <table class="table table-striped">
                    <tr>
                        <th align="left">Quanity</th>
                        <th align="left">Item Title</th>
                        <th style="text-align:right">Item Price</th>
                    </tr>
                    <?php $i = 0; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                        <tr>
                            <td align="left"><?php echo $items['qty']; ?></td>
                            <td align="left"><?php echo $items['name']; ?>-<?php echo $items['size']; ?></td>
                            <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                        </tr>
                        <?php echo '<input type="hidden" name="item_name[' . $i . ']" value="' . $items['name'] . '" />'; ?>
                        <?php echo '<input type="hidden" name="item_code[' . $i . ']" value="' . $items['id'] . '" />'; ?>
                        <?php echo '<input type="hidden" name="item_qty[' . $i . ']" value="' . $items['qty'] . '" />'; ?>
                        <?php echo '<input type="hidden" name="item_size[' . $i . ']" value="' . $items['size'] . '" />'; ?>

                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td class="right"><strong>Shipping</strong></td>
                        <td class="right" style="text-align:right"><?php echo $this->config->item('shipping'); ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="right"><strong>Tax</strong></td>
                        <td class="right" style="text-align:right"><?php echo $this->config->item('tax'); ?></td>
                    <input type="hidden" name="grandtotal" value="<?php echo $this->cart->format_number($this->cart->total() + $this->config->item('shipping') + $this->config->item('tax')); ?>" />
                    </tr>
                    <tr>
                        <td></td>
                        <td class="right"><strong>Total</strong></td>
                        <td class="right" style="text-align:right"><strong>Rs.<?php echo $this->cart->format_number($this->cart->total() + $this->config->item('shipping') + $this->config->item('tax')); ?></strong></td>
                    </tr>
                </table>
                <br>
                <?php if (!$this->session->userdata('logged_in')) : ?>
                    <p><a href="<?= base_url(); ?>products/createaccount" class="btn btn-primary">Checkout</a></p>
                    <div class="alert alert-dismissible alert-danger"><strong>
                            <p><em>You must Login in order to make purchases !</em></p>
                    </div></strong>
                <?php else : ?>
                    <h3>Shipping Info</h3>


                    <?php echo validation_errors(); ?>


                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">*Address 1:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="add1" placeholder="" value= "<?= set_value('add1'); ?>">
                        </div>
                    </div> <?php echo br(3); ?>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Address 2:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="add2" placeholder="" value= "<?= set_value('add2'); ?>">
                        </div>
                    </div><?php echo br(2); ?>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">*State:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="state" placeholder="" value= "<?= set_value('state'); ?>">
                        </div>
                    </div><?php echo br(2); ?>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">*City:</label>
                        <div class="col-lg-10">
                            <input type="" class="form-control" name="city" placeholder="" value= "<?= set_value('city'); ?>">
                        </div>
                    </div><?php echo br(2); ?>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">*Mobile No.</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="mobno" placeholder="" value= "<?= set_value('mobno'); ?>">
                        </div>
                    </div>
                     <?php echo br(2); ?>
                        <!---- paymnet   ---->
                          <div class="form-group">
  <h2>Payment Mode</h2>
  <hr>
  

    <div class="radio">
      <label><input type="radio" name="cod" value="COD">Cash On Delivery</label>
    </div>
    <div class="radio disabled">
      <label><input type="radio" name="onpay" value="ONPAY" disabled>Online Payment</label>
    </div>
                          </div>
                       
                 
                        
                         <!---- paymnet end  ---->
                        
                        
                        
                        <?php echo br(2); ?>
                    <?php echo form_reset('cancel', 'Reset', array('class' => 'btn btn-primary')); ?><?php echo nbs(2); ?>
                    <?php echo form_submit('submit', 'Checkout', array('class' => 'btn btn-success')); ?>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <div class="alert alert-dismissible alert-danger"><strong>
                    <p>There are no items in your cart !</p>
            </div></strong>
        <?php endif; ?>

    </div>
</div>
<?php include("template/footer.php"); ?>
