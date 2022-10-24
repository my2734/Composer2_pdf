<div class="title_left">
    <h3></h3>
</div>
<div class="row">
    <div class="offset-sm-2 col-md-8 col-sm-8">
        <div class="x_panel">
            <?php
            if(isset($data['message_error'])){ ?>
                <h5 class="alert alert-danger text-white"><?php echo $data['message_error'] ?></h5>
            <?php } ?>
            <div class="x_title">
                <h2>Tạo mới</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form action="index.php?url=Slider/store" method="POST" class="form-label-left input_mask" enctype="multipart/form-data">

                    <div class="col-md-12 col-sm-12  form-group">
                        <div class="form-group">
                            <label style="font-size: 16px" for="exampleInputFile">Hình ảnh (<span class="text-danger">*</span>)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>

                                </div>

                            </div>
                            <span class="text-danger"><?php echo isset($data['error_image'])?$data['error_image']:""; ?></span>
                        </div>
                        <div class="col-md-12 col-sm-12 ">
                            <div class="checkbox">
                                <label style="font-size: 16px">
                                    <input name="status" value="1" type="checkbox" value=""> Trạng thái
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9  offset-md-3">
                                <a href=""><button type="button" class="btn btn-primary">Cancel</button></a>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                </form>

            </div>
        </div>
    </div>
</div>