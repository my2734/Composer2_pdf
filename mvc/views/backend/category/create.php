<div class="title_left">
    <h3><?php echo isset($data['category_edit'])?"Chỉnh sửa danh mục":"Tạo mới danh mục" ?></h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <?php
            if(isset($data['message_error'])){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h5><?php echo $data['message_error']; ?></h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <h5 class="alert alert-success text-white"></h5> -->
            <?php } ?>
            <div class="x_content">
                <br>
                <form method="POST" action=<?php echo isset($data['category_edit']) ?'index.php?url=Category/update/'.$data['category_edit']->id:'index.php?url=Category/store';  ?> class="form-label-left input_mask" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <h4>Tên danh mục</h4>
                            <input type="text" name="name" class="form-control" value="<?php
                                if(isset($data['category_edit'])){
                                    echo $data['category_edit']->name;
                                }else{
                                    if(isset($data['result_old']['name'])){
                                        echo $data['result_old']['name'];
                                    }
                                }
                            ?>"  placeholder="Nhập tên danh mục">
                            <?php  
                                if(isset($data['error']['name'][0])){ ?>
                                <span class="text-danger"><?php echo $data['error']['name'][0]; ?></span>
                            <?php } ?>
                        </div>

                        <div class="col-md-12 col-sm-12 mb-2">
                            <label style="font-size: 16px" for="" class="form-label">Hình ảnh (<span class="text-danger">*</span>)</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label form-control" for="exampleInputFile">Chọn ảnh</label>
                            </div>
                            <?php
                            if(isset($data['error']['image'][0])){ ?>
                                <span class="text-danger"><?php echo $data['error']['image'][0]; ?></span>
                            <?php } ?>
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 mb-4">
                            <h4>
                                <input name="status" <?php if(isset($data['category_edit'])) echo ($data['category_edit']->status==1)?"checked":""; ?> type="checkbox"><label class="ml-3">Trạng thái</label>
                            </h4>
                        </div>
                    </div>
                   
                    <!-- <div class="ln_solid"></div> -->
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="index.php?url=Category/index"><button type="button" class="btn btn-primary">Cancel</button></a>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" name="btnStoreCategory" class="btn btn-<?php echo isset($data['category_edit'])?"danger":"success" ?>"><?php echo isset($data['category_edit'])?"Update":"Submit" ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>