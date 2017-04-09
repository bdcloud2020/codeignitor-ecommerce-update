<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>SundayBazar</title>

        <!-- Bootstrap core CSS -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="<?= base_url(); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?= base_url(); ?>assets/css/starter-template.css" rel="stylesheet">

        <!-- sticky footer-->
        <link href="<?= base_url(); ?>assets/css/sticky-footer.css" rel="stylesheet">


        <style>
            .carousel-inner > .item > img,
            .carousel-inner > .item > a > img {
                width: 70%;
                margin: auto;
            }
        </style>
<link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= base_url(); ?>">SundayBazar</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?= ($activetab == "home") ? "active" : "" ?>"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="<?= ($activetab == "allitem") ? "active" : "" ?>"><a href="<?= base_url(); ?>products/allitem">All Items</a></li>

                        <?php if (!$this->session->userdata('logged_in')) : ?>
                            <li class="<?= ($activetab == "createacc") ? "active" : "" ?>"><a href="<?= base_url(); ?>products/createaccount">Create Account</a></li>
                        <?php endif; ?>

                    </ul>

                    <!-- <form class="navbar-form navbar-right">-->
                    <?php if ($this->session->has_userdata('logged_in')): ?>

                        <?php echo form_open('products/logout', array('class' => 'navbar-form navbar-right')); ?>
                        <span style="color:white;">Welcome: <?php echo $this->session->userdata('username'); ?></span>
                        <?php echo nbs(3); ?>
                        <button name="submit" type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true" ></span> Log out
                        </button>
                        </form>
                    <?php else: ?>
                        <?php echo form_open('products/login', array('class' => 'navbar-form navbar-right')); ?>
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username" required="required">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password" required="required">
                        </div>
                        <button name="submit" type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-log-in"></span> Log in
                        </button>
                        </form>
                    <?php endif; ?>



                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="starter-template">

                <?php if (!$this->session->has_userdata('logged_in')): ?>

                    <?php if ($this->session->flashdata('blanklogin')) { ?>
                        <div class="alert alert-dismissible alert-danger"><strong>
                                <?php echo $this->session->flashdata('blanklogin'); ?>
                            </strong></div>
                    <?php } ?>


                    <?php if ($this->session->flashdata('register')) { ?>
                        <div class="alert alert-dismissible alert-success"><strong>
                                <?php echo $this->session->flashdata('register'); ?>
                            </strong></div>
                    <?php } ?>



                    <?php if ($this->session->flashdata('fail_login')) : ?>
                        <div class="alert alert-danger">
                            <strong><?php echo $this->session->flashdata('fail_login'); ?></strong>
                        </div>
                    <?php endif; ?>

                <?php else: ?>

                    <?php if ($this->session->flashdata('pass_login')) : ?>
                        <div class="alert alert-success">
                            <strong><?php echo $this->session->flashdata('pass_login'); ?></strong>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>



                <div class="row">
                    <div class="col-md-4">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Sell Of The Month</h3>
                            </div>
                            <div class="panel-body" style="background: lavender;">
                                <h2>Mens T-Shirts</h2>
                               
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                        <li data-target="#myCarousel" data-slide-to="3"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">

                                        <?php $i = 1; ?>
                                        <?php foreach ($sliders as $slider): ?>
                                            <?php $item_class = ($i == 1) ? 'item active' : 'item'; ?>
                                            <div class="<?php echo $item_class; ?>">


                                                <a href="<?= base_url(); ?>products/detail/<?= $slider->id; ?>" >  <img src="<?php echo base_url(); ?>assets/image/items/<?php echo $slider->image; ?>" alt="" style ="width: 350px; height: 300px;"></a>
                                                <div class="carousel-caption">
                                                    <h3>Rs.<?php echo $slider->price; ?></h3>

                                                </div>
                                            </div>
                                            <?php $i++; ?>

                                        <?php endforeach; ?>


                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div> <br><br> <br><br>


                        <!--cart -->
                        <form action="<?= base_url(); ?>cart/update" method="post">
                            <div class="form-group">
                                <table class="table table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Item QTY</th>
                                            <th>Item Description</th>
                                            <th>Item Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($this->cart->contents() as $items): ?>
                                        <input type="hidden" name="<?php echo $i . '[rowid]'; ?>" value="<?php echo $items['rowid']; ?>" />
                                        <tr>

                                            <td><input type="text" name="<?php echo $i . '[qty]'; ?>" value="<?php echo $items['qty']; ?>" maxlength="3" size="5" class="qty" /></td>
                                            <td><?php echo $items['name']; ?>-<?php echo $items['size']; ?></td>
                                            <td><?php echo $this->cart->format_number($items['price']); ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td class="right"><strong>Total</strong></td>
                                        <td class="right" style="text-align:right">Rs.<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <p><button class="btn btn-primary" type="submit">Update Cart</button>
                                <a class="btn btn-success" href="<?= base_url(); ?>cart">Go To Cart</a></p>
                        </form>
                        <!-- cart end-->


                    </div> 
                
