<div class="title_left">
    <h3>Danh sách đơn hàng</h3>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Image</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address<th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($data['list_user'])){
                                foreach($data['list_user'] as $key => $user){ ?>
                                <tr>
                                    <th scope="row"><?php echo ($key+1) ?></th>
                                    <td><?php echo $user->full_name ?></td>
                                    <td>
                                        <?php 
                                            if($user->image!=""){ ?>
                                                <img height="50" width="50" style="object-fit:cover" src="./public/uploads/<?php echo $user->image ?>" alt="">
                                            <?php }else{ ?>
                                                <img height="50" width="50" style="object-fit:cover" src="https://i.pinimg.com/280x280_RS/2e/45/66/2e4566fd829bcf9eb11ccdb5f252b02f.jpg" alt="">
                                            <?php }  ?>
                                    </td>
                                    <td><?php echo $user->phone ?></td>
                                    <td>
                                        <?php echo $user->email ?>
                                    </td>
                                    <td>
                                        <?php echo (isset($user->address_detail) && $user->address_detail!="")?$user->address_detail.', ':"" ?>
                                        <?php echo $user->commune.', '.$user->district.', '.$user->conscious.', '.$user->country ?><td>
                                </tr>
                        <?php  }  } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>