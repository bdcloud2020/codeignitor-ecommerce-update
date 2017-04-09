<?php include("template/header.php"); ?>
<?php if (! $this->session->has_userdata('logged_in')): ?>
<div class="col-md-8">
  <!--login form   -->
  <?php echo form_open('products/register', array('class' => 'form-horizontal')); ?>
  <!--<form action="<?php echo base_url();?>products/register" method="post" class="form-horizontal">-->
        <fieldset>
          <legend>Create Your Account</legend>

          <?php echo validation_errors(); ?>

          <?php if($msg){ ?>
           <div class="alert alert-dismissible alert-success"><strong><?php echo $msg ?></strong></div>
           <?php } ?>

          <div class="form-group">
            <label for="" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value= "<?= set_value('name'); ?>" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-lg-2 control-label">User Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="username" placeholder="Enter User Name" value= "<?= set_value('username'); ?>" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="email" placeholder="Email" value= "<?= set_value('email'); ?>" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
              <input type="password" class="form-control" name="pass" placeholder="Password" value= "<?= set_value('pass'); ?>" required="required">
              </div>
          </div>
          <div class="form-group">
            <label for="" class="col-lg-2 control-label">Mobile No.</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" name="mobno" placeholder="Enter Your Mobile No." value= "<?= set_value('mobno'); ?>" required="required">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
            <?php echo form_reset('cancel', 'Cencel', array('class' => 'btn btn-default')); ?>
            <?php echo form_submit('submit', 'Register', array('class' => 'btn btn-primary')); ?>
            </div>
          </div>
        </fieldset>
      </form>
  <!--login form end   -->

 </div>
   <?php endif; ?>

 <?php include("template/footer.php"); ?>
