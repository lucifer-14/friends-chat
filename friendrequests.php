<html>
<?php

include "utilities/header.php";
$title='Friend Requests' ;
$friendRequestsData='';
if(isset($_GET['friendrequestId'])){
  $friendrequestId=$_GET['friendrequestId'];
  $friendRequestsData = mysqli_query($conn, "select *, friendslist.id as frId from users, friendslist where f_userId=users.id and s_userId=$currentUser and users.active=1 and users.isDeactive=0 and friendslist.active=0 and friendslist.id=$friendrequestId");
}
else
  $friendRequestsData = mysqli_query($conn, "select * from friendslist where s_userId=$currentUser and active=0")
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
              <h1 class="m-0 text-dark"><i class="fa fa-users"></i>&nbsp;&nbsp;Friend Requests</h1>
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
          <div class="card card-primary card-outline">
            <?php if (isset($_GET['friendrequestId'])) : ?>
            <div class="card-body">
              <div class="row">
                <?php while ($user=mysqli_fetch_assoc($friendRequestsData)) : ?>
                <div class="col-lg-4 col-sm-6 col-12">
                  <!-- small box -->
                  <div class="card card-light">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <img src="<?php echo $user['photo'] ?>" alt="User Photo" class="img-circle elevation-3" style="width: 60px; height: 60px;">
                        </div>
                        <div class="col-8">
                          <div class="card-text"><strong>Username: </strong><?php echo $user['username'] ?></div>
                          <div class="card-text"><strong>Gender: </strong><?php echo $user['gender'] ?></div>
                        </div>
                      </div>
                      
                    </div>
                    <a href="confirmrequest.php?friendrequestId=<?php echo $user['frId']?>" class="small-box-footer">
                      <div class="card-footer">
                        <div style="text-align: center"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Accept Request</div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- ./col -->
                <?php endwhile;?>

              </div>
            </div>
            <?php endif; ?>
            <?php if(!isset($_GET['friendrequestId'])) : ?>
              <div class="card-footer text-center"><i class="fa fa-times-circle text-danger"></i>&nbsp;No Friend Requests Found.</div>
            <?php endif; ?>
          </div>

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