<div class="title_left">
    <h3><?php echo isset($data['tags_edit'])?"Cập nhật Tags(Blog)":"Tạo mới Tags(Blog)" ?></h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_content">
                <br>
                <form method="POST" action=<?php echo isset($data['tags_edit'])?"index.php?url=Tags/update/".$data['tags_edit']->id:"index.php?url=Tags/store"; ?> class="form-label-left input_mask">
                    <div class="form-group">
                        <?php if(isset($data['message_error'])){ ?>
                            <h5 class="alert alert-danger"><?php echo $data['message_error']; ?></h5>
                        <?php } ?>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <h4>Tên tags</h4>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($data['tags_edit'])?$data['tags_edit']->name:""; ?>"  placeholder="Nhập tên Tags">
                            <?php if(isset($data['error'])){?>
                                <span class="text-danger"><?php echo $data['error'][0]; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 mb-4">
                            <h4>
                                <input name="status" <?php if(isset($data['tags_edit']))  echo ($data['tags_edit'])->status==1?"checked":""; ?> type="checkbox"><label class="ml-3">Trạng thái</label>
                            </h4>
                        </div>
                    </div>
                   
                    <!-- <div class="ln_solid"></div> -->
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <a href="index.php?url=Category/index"><button type="button" class="btn btn-primary">Cancel</button></a>
                            
                            <?php  
                                if(isset($data['tags_edit'])){?>
                                <button type="submit" name="btnStoreTags" class="btn btn-danger">Update</button>
                            <?php }else{ ?>
                                <button type="submit" name="btnStoreTags" class="btn btn-success">Submit</button>
                           <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>