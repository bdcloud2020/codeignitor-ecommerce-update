<?php include("template/header.php"); ?>

<?php if ($this->session->has_userdata('email')): ?>

<h2><center> Edit Product</center></h2>

    

<!--   add form     -->
<?php echo validation_errors(); ?>



<?php if ($msg) { ?>

    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?= $msg; ?></strong>
    </div>
<?php } ?>




<?php echo form_open_multipart('admin/updateproduct'); ?>
<div class="form-group">
    <label>Product Name:</label>
    <input type="text" class="form-control" name="prodname" placeholder="Enter product Name" value= "<?= $editsingle->name ?>">
</div>
<div class="form-group">
    <label>Product Price:</label>
    <input type="text" class="form-control" name="prodprice" placeholder="Enter product Price" value= "<?= $editsingle->price ?>">
</div>
<div class="form-group">
    <label>Description:</label>
    <textarea class="form-control" rows="3" name="desc" > <?= $editsingle->desc ?> </textarea>
</div>
<div class="form-group">
    <label>Select Image:</label>
    <img src="<?php echo base_url(); ?>assets/image/items/<?= $editsingle->image; ?>" style ="width: 100px; height: 100px;" >
    <?php echo form_hidden('oldimage', $editsingle->image); ?>
    <?php echo form_hidden('id', $editsingle->id); ?>

    <input type="file" name="userfile" size="20"  />
    <p class="help-block">.jpg, .jpeg, .png</p>
</div>
<button type="submit" class="btn btn-success">update Product</button>
</form>
<!--   add form  end   -->
 <?php else: ?>
   
  <?php $this->load->view('admin/login'); ?>

<?php endif; ?>

<?php include("template/footer.php"); ?>
