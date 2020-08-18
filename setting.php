<html>
<?php
include "utilities/header.php";
$title = 'Profile Setting';
include "utilities/updateprofilecommon.php";
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include "utilities/navbar.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3 class="m-0 text-dark"><i class="fa fa-cog"></i>&nbsp;Profile Setting</h3>
                            <hr>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <?php if(isset($_GET['message'])):?>
                        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                            <?php echo $_GET['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <form action="setting.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="redirect_url" value="setting.php">
                                        <?php if ($error != '') : ?>
                                            <div class='alert alert-danger'>
                                                <?php print_r($error) ?>
                                             </div>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="col-md-12">
                                                    <img class="img-fluid img-thumbnail" src="<?php echo $photo ?>" alt="Profile picture">
                                                </div>
                                                <div class="col-md-12  pt-3">
                                                    <div class="custom-file editField  hide ">
                                                        <input type="file" class="custom-file-input" id="upload_photo" name="photo" value='<?php echo $photo ?? "" ?>' accept="image/*">
                                                        <input type="hidden" name="photo_cropped" id="photo_cropped" value="">
                                                        <label class="custom-file-label" for="photo">Choose file</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-8">
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                        <b class="col-md-5 col-4">Username</b>
                                                        <a class="col-md-7 col-8">
                                                            <p class="dataField float-right"><?php echo $username ?></p>
                                                            <input type="text" name="username" id="" class="form-control editField  hide" placeholder="e.g. my_username00" required value="<?php echo $username ?>">
                                                        </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                        <b class="col-md-5 col-4">Gender</b>
                                                        <a class="col-md-7 col-8">
                                                            <p class="dataField float-right"><?php echo $gender ?></p>
                                                            <input type="text" name="gender" id="" class="form-control editField  hide" placeholder="e.g. Male, Female, Other" required value="<?php echo $gender ?>">
                                                        </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                        <b class="col-md-5 col-4">Email</b>
                                                        <a class="col-md-7 col-8">
                                                            <p class="dataField float-right"><?php echo $email ?></p>
                                                            <input type="text" name="email" id="" class="form-control editField  hide" placeholder="example@gmail.com" required value="<?php echo $email ?>">
                                                        </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                        <b class="col-md-5 col-4">Phone No</b>
                                                        <a class="col-md-7 col-8">
                                                            <p class="dataField float-right"><?php echo $phone ?></p>
                                                            <input type="text" name="phone" id="" class="form-control editField  hide" placeholder="+************" required value="<?php echo $phone ?>">
                                                        </a>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                        <b class="col-md-5 col-4">Is Deactivated</b>
                                                        <a class="col-md-7 col-8">
                                                            <p class="dataField float-right"><?php echo ($isDeactive==0) ? "no" : "yes"?></p>
                                                            <input type="checkbox" name="isDeactive" id="" class="form-control editField  hide"  <?php echo ($isDeactive==0) ? "" : "checked"?> value="<?php echo $isDeactive ?>">
                                                        </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <button type="button" class="btn btn-sm btn-danger editField hide" id="btnCancel">
                                                <span class="fa fa-close"></span>
                                                <span id="">Cancel</span>
                                            </button>
                                            <button type="button" class="btn btn-sm  btn-primary dataField" id="btnEdit">
                                                <span class="fa fa-edit"></span>
                                                <span>Edit</span>
                                            </button>
                                            <button type="submit" name="save" class="btn btn-sm  btn-primary editField hide">
                                                <span class="fa fa-check" id="btnIcon"></span>
                                                <span id="btnText">Save</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <p>
                                        <a id="passwordToggle" class="btn btn-sm btn-primary" data-toggle="collapse" href="#changePasswordForm" role="button" aria-expanded="false" aria-controls="changePasswordForm">
                                            <span class="fa fa-key"></span>
                                            Change Password
                                        </a>
                                    </p>
                                    <div class="collapse" id="changePasswordForm">
                                        <div class="card card-body">
                                            <?php if ($passwordError != '') : ?>
                                                <div class='alert alert-danger'>
                                                    <?php print_r($passwordError) ?>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <form action="setting.php" method="post">
                                                    <input type="hidden" name="redirect_url" value="setting.php">
                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input type="password" class="form-control" placeholder="Current Password" name="current_password" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="password" class="form-control" placeholder="New Password" name="new_password" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required />
                                                    </div>
                                                    <div class="float-right">
                                                        <button type="submit" name="changepassword" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-check"></span>
                                                            Change Password
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->

            
        <!-- /.content -->

        <?php include "utilities/footer.php" ?>
        
    </div>
    <div id="uploadimageModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crop Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" style=""></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="padding-top:30px;">
                            <button class="btn btn-success crop_image">Crop Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(function() {
        $("#btnEdit").click(function() {
            $(".dataField").hide();
            $(".editField").show();
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                  width:200,
                  height:200,
                  type:'square' //circle
                },
                boundary:{
                  width:300,
                  height:300
                }
            });
            $('#upload_photo').on('change', function(){
                var reader = new FileReader();
                reader.onload = function (event) {
                  $image_crop.croppie('bind', {
                    url: event.target.result
                  })
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });
            $('.crop_image').click(function(event){
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response){
                    $.ajax({
                        url:"utilities/upload.php",
                        type: "POST",
                        data:{"image": response},
                        success:function(data)
                        {
                            console.log('jQuery bind');
                          $('#uploadimageModal').modal('hide');
                          $('#photo_cropped').val(data);
                        }
                    });
                })
                $('#uploadimageModal').modal('hide');
            });
        })
        $("#btnCancel").click(function() {
            $(".dataField").show();
            $(".editField").hide();
        })
        var
            editState = '<?php echo $editState ?>',
            passwordChange = '<?php echo $passwordChanged ?>';
        if (editState) {
            $("#btnEdit").click();
        }
        if (passwordChange) {
            $("#passwordToggle").click();
        }
    })
</script>
</html>
