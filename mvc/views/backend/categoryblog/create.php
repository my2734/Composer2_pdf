<div class="title_left">
    <h3><?php echo isset($data['categoryblog_edit'])?"Cập nhật danh mục (Blog)":"Tạo mới danh mục (BLOG)" ?></h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <br>
                
                <form method="POST" action=<?php echo isset($data['categoryblog_edit'])?"index.php?url=CategoryBlog/update/".$data['categoryblog_edit']->id:"index.php?url=CategoryBlog/store"; ?> class="form-label-left input_mask">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <h4>Tên danh mục (blog)</h4>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($data['categoryblog_edit'])?$data['categoryblog_edit']->name:""; ?>"  placeholder="Nhập tên danh mục">
                            <span class="text-danger"><?php 
                                echo isset($data['error'])?$data['error'][0]:"";
                            ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 mb-4">
                            <h4>
                                <input name="status" <?php if(isset($data['categoryblog_edit'])) echo ($data['categoryblog_edit']->status==1)?"checked":""; ?> type="checkbox"><label class="ml-3">Trạng thái</label>
                            </h4>
                        </div>
                    </div>
                   
                    <!-- <div class="ln_solid"></div> -->
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="index.php?url=CategoryBlog/index"><button type="button" class="btn btn-primary">Cancel</button></a>
                            <?php 
                                if(isset($data['categoryblog_edit'])){ ?>
                                <button type="submit" name="btnUpdateCategoryBlog" class="btn btn-danger">Update</button>
                            <?php }else{?>
                                <button type="submit" name="btnStoreCategoryBlog" class="btn btn-success">Submit</button>
                           <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>