<?php
    if(isset($data['message_success'])){ ?>
        <div class="mt-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $data['message_success']; ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
<?php } ?>


<div class="row mb-5 text-white">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info px-2">
              <div class="inner text-white">
                <h3><?php echo $data['total_order'] ?></h3>
                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?url=Order" class="small-box-footer text-white btn btn-sm btn-primary text-center">More info</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success px-2">
            <div class="inner text-white">
                <h3><?php echo $data['total_user'] ?></h3>
                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?url=User" class="small-box-footer text-white btn btn-sm btn-primary text-center">More info</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning px-2">
            <div class="inner text-white">
                <h3><?php echo $data['total_product'] ?></h3>
                <p>Total Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?url=Product" class="small-box-footer text-white btn btn-sm btn-primary text-center">More info</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger px-2">
            <div class="inner text-white">
                <h3><?php echo $data['total_blog'] ?></h3>
                <p>Total Blog</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="index.php?url=Blog" class="small-box-footer text-white btn btn-sm btn-primary text-center">More info</a>
            </div>
          </div>
          <!-- ./col -->
        </div>