<?php include("template/header.php"); ?>

<?php if ($this->session->has_userdata('email')): ?>

<h2><center>Edit / Delete Products</center></h2>

        <?php if ($this->session->flashdata('deletedata')) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata('deletedata'); ?></strong>
                        </div>
                    <?php endif; ?>


   <?php if ($this->session->flashdata('updatedata')) : ?>
                        <div class="alert alert-success">
                            <strong><?php echo $this->session->flashdata('updatedata'); ?></strong>
                        </div>
                    <?php endif; ?>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Product Name</th>
      <th>Product Description</th>
      <th>Product Image</th>
      <th>Product Price</th>
       <th>Edit / Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; ?>
      <?php foreach ($selectprods as $selectprod): ?>
    <tr>
      <td><?= $i; ?></td>
      <td><?= $selectprod->name; ?></td>
      <td> <?= $selectprod->desc; ?>  </td>
      <td><img src="<?php echo base_url(); ?>assets/image/items/<?= $selectprod->image; ?>" style ="width: 100px; height: 100px;" ></td>
      <td><?= $selectprod->price; ?></td>
      <td>
          <a href="<?php echo base_url(); ?>admin/editproduct/<?= $selectprod->id; ?> " class="btn btn-primary">Edit</a>
          <a href="<?php echo base_url(); ?>admin/deleteproduct/<?= $selectprod->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
          
      </td>
    </tr>
       <?php $i++; ?>
    <?php endforeach; ?>

  </tbody>
</table> 
 <?php else: ?>
   
  <?php $this->load->view('admin/login'); ?>
<?php endif; ?>
<?php include("template/footer.php"); ?>

