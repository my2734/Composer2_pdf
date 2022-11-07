<div class="" style="margin-top: 64px;"></div>
<div class="container-fluid mb-5" style="background: #fef5ef!important;">
    <div class="jumbotron jumbotron-fluid" style="background: #fef5ef!important;" >
        <div class="container">
            <h1 class="text-center">THERANKME SHOP</h1>
            <p class="text-center">Home > Thông tin cá nhân</p>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-bottom: 200px;margin-top: 100px;">
    <div class="container-cover container-cover-cart">
        <div class="update_message_success"></div>
        <?php
            if(isset($data['message_success'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $data['message_success'] ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php }  ?>
        <form action="index.php?url=Home/update_user_info" method="POST" enctype="multipart/form-data" class="border_form">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="text-center mb-4">Thông tin cá nhân</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User name <span class="text-danger">*</span></label>
                                <input type="text" name="user_name" value="<?php echo isset($data['user_login']->user_name)?$data['user_login']->user_name:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" value="<?php echo isset($data['user_login']->full_name)?$data['user_login']->full_name:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?php echo isset($data['user_login']->email)?$data['user_login']->email:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="<?php echo isset($data['user_login']->phone)?$data['user_login']->phone:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quốc gia <span class="text-danger">*</span></label>
                                <input type="text" name="country" value="<?php echo isset($data['user_login']->country)?$data['user_login']->country:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                <input type="text" name="conscious" value="<?php echo isset($data['user_login']->conscious)?$data['user_login']->conscious:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Huyện/Quận <span class="text-danger">*</span></label>
                                <input type="text" name="district" value="<?php echo isset($data['user_login']->district)?$data['user_login']->district:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Xã/Thị xã <span class="text-danger">*</span></label>
                                <input type="text" name="commune" value="<?php echo isset($data['user_login']->commune)?$data['user_login']->commune:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <span class="text-danger" style="font-size: 14px;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ chi tiết</label>
                        <input type="text" name="address_detail" value="<?php echo isset($data['user_login']->address_detail)?$data['user_login']->address_detail:""; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <span class="text-danger" style="font-size: 14px;"></span>
                    </div>
                </div>
            
            <div class="col-sm-4">
            <div class="cover_img_user mx-auto">
                <?php
                    if(isset($data['user_login']) && $data['user_login']->image!=""){ ?>
                        <img src="./public/uploads/<?php echo $data['user_login']->image ?>">
                    <?php }else{ ?>
                        <img src="https://i.pinimg.com/280x280_RS/2e/45/66/2e4566fd829bcf9eb11ccdb5f252b02f.jpg">
                   <?php  } ?>
                <div class="input-group my-4">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                    </div>
                    <br>
                </div>
                <div class="ml-5">
                    <button type="submit" class="btn text-white">Update</button>
                </div>
            </div>
            </div>
        </div>
        </form>
    </div>
</div>