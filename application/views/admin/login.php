<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?= base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url(); ?>assets/css/signin.css" rel="stylesheet">


  </head>

  <body>

    <div class="container">
      
        
         <?php echo form_open('admin/login_valid', array('class' => 'form-signin')); ?>
     
        <h2 class="form-signin-heading"><center>Admin</center></h2>
         <?php if ($this->session->flashdata('blanklogin')) { ?>
                        <div class="alert alert-dismissible alert-danger"><strong>
                                <?php echo $this->session->flashdata('blanklogin'); ?>
                            </strong></div>
                    <?php } ?>
        
        
         <?php if ($this->session->flashdata('fail_login')) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata('fail_login'); ?></strong>
                        </div>
                    <?php endif; ?>
        
        <label for="inputEmail" class="sr-only">Email address</label>
        
        <input type="email" name="email" class="form-control" placeholder="Email address" required>
        
        <label for="inputPassword" class="sr-only">Password</label>
        
        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= base_url(); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
