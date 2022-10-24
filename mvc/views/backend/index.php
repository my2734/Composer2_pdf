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


