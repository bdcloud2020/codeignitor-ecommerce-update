<?php include("template/header.php"); ?>



 <?php if ($this->session->has_userdata('email')): ?>


   <h2><center>Welcome to Admin</center></h2>
   <?php if ($this->session->flashdata('pass_login')) : ?>
                        <div class="alert alert-success">
                            <strong><center><?php echo $this->session->flashdata('pass_login'); ?></center></strong>
                        </div>
                    <?php endif; ?>
   
   <?php else: ?>
   
  <?php $this->load->view('admin/login'); ?>
   
   <?php endif; ?>

<?php include("template/footer.php"); ?>
