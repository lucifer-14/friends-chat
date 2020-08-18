<html>
<?php

include "utilities/header.php";
$title='Friends List' ;

$friendsListData = mysqli_query($conn, "select * from friendslist where (f_userId=$currentUser or s_userId=$currentUser) and active=1");

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
              <h1 class="m-0 text-dark">Friends List</h1>
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
          <?php if (mysqli_num_rows($friendsListData)>0) : ?>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped dt-table" id="tblFriendsList">
                <thead>
                  <tr>
                    <th class="no-sort"></th>
                    <th>Friend Name</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($data = mysqli_fetch_assoc($friendsListData)) : ?>
                  <tr>
                      <?php $friendRealId = ($data['s_userId']==$currentUser)? $data['f_userId'] : $data['s_userId']; $temp_query = mysqli_query($conn, "select * from users where id = $friendRealId"); $temp_queryE=mysqli_fetch_object($temp_query); ?>
                      <td><img src="<?php echo $temp_queryE->photo?>" class="img-circle elevation-3" style="width: 50px !important; height: 50px;"></td>
                      <td><?php echo $temp_queryE->username." (".$temp_queryE->gender.")"; ?></td>
                      <td><a type="submit" id="btnChat" class="btn btn-sm btn-primary" href="friendschatcommon.php?friendId=<?php echo $friendRealId ?>"><i class="fa fa-comment"> &nbsp;Chat</i></a></td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php else: ?>
          <div class="row">
            <div class="col-12">
              <div class="alert alert-dismissible fade show" role="alert" style="background-color: rgb(0,0,0,.05);">
                <div style="text-align: center;"><i class="fa fa-times-circle text-danger"></i> &nbsp;You have no friends. </div>
              </div>
            </div>
          </div>
          <?php endif;?>

          <!-- /.row (end card) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <?php include "utilities/footer.php" ?>
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
</html>