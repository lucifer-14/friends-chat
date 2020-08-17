<html>
<?php

include "utilities/header.php";
$title='Create Groups' ;

?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "utilities/navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-lg-8 col-12">
              <h1 class="m-0 text-dark"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Create Groups</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <hr>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Rows (Start card) -->
          <div class="rows">
            <div class="col-md-6">
              <div class="card card-primary card-outline">
                <div class="card-body">
                  <form action="creategroups_add.php" method="post" id="creategroupsForm" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Group Name</label>
                      <input type="text" class="form-control" placeholder="Group name" name="groupname" id="" value="" required autocomplete="off"/>
                    </div>
                    <div class="form-group">
                      <label>Group Photo</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="groupPhoto" name="photo">
                        <input type="hidden" id="groupPhoto_cropped" name="groupPhoto_cropped" value="">
                        <label class="custom-file-label" for="groupPhoto">Choose file</label>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-sm btn-primary float-right" id="btnSave" value="Create Group" />
                  </form>
                </div>
                    <!-- /.card -->
              </div>
            </div>
          </div>

          <!-- /.row (end card) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

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
<style type="text/css">
  .card-title{
    font-size: 16px;                        
  }
  .card-text{
    font-size: 15px;
  }
</style>
<script type="text/javascript">
  $(document).ready(function(){
        
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
        $('#groupPhoto').on('change', function(){
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
                    success:function(data) {
                       $('#uploadimageModal').modal('hide');
                        $('#groupPhoto_cropped').val(data);
                 }
                });
            })
            $('#uploadimageModal').modal('hide');
        });
    })
</script>
</html>