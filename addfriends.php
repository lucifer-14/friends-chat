<html>
<?php

include "utilities/header.php";
$title='Add Friends' ;

$searchName="";
$searchQuery="";
if(isset($_GET['search'])){
  $searchName=mysqli_real_escape_string($conn, $_GET['search']);
  $searchQuery = mysqli_query($conn, "select * from users where username LIKE '%$searchName%' and active=1 and isDeactive=0 limit 10");
    $searchName=$_GET['search'];
}

?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "utilities/navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-lg-8 col-6">
              <h1 class="m-0 text-dark"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Add Friends</h1>
            </div><!-- /.col -->
            <div class="col-lg-4 col-6">
              <form action="addfriends.php" method="get">
                <input type="search" class="form-control" name="search" placeholder="Search" autocomplete="off">
              </form>
            </div>
          </div><!-- /.row -->
          <hr>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Rows (Start card) -->
          <?php if(isset($_GET['search']) && $searchName!='') : ?>
          <div class="card card-primary card-outline">
            <h5 class="card-header">Search Results for '<?php echo $searchName; ?>'</h5>
            <div class="card-body">
              <div class="row">
                <?php while ($user=mysqli_fetch_assoc($searchQuery)) : ?>
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
                    <?php $userId=$user['id']; $checkQuery=mysqli_query($conn, "select * from friendslist where f_userId=$currentUser and s_userId=$userId and active=0"); ?>
                    <?php if (mysqli_num_rows($checkQuery)==1) : ?>
                    <div class="card-footer">
                      <div style="text-align: center;"> Resquest Pending ... </div>
                    </div>
                    <?php endif; ?>
                    <?php $userId=$user['id']; $checkQuery=mysqli_query($conn, "select * from friendslist where s_userId=$currentUser and f_userId=$userId and active=0"); $checkQueryExtract=mysqli_fetch_object($checkQuery); ?>
                    <?php if (mysqli_num_rows($checkQuery)==1) : ?>
                    <a href="confirmrequest.php?friendrequestId=<?php echo $checkQueryExtract->id ?>&userId=<?php echo $userId ?>">
                      <div class="card-footer">
                        <div style="text-align: center;"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Accept Request </div>
                      </div>
                    </a>
                    <?php endif; ?>
                    <?php $userId=$user['id']; $checkQuery=mysqli_query($conn, "select * from friendslist where (f_userId=$currentUser or f_userId=$userId) and (s_userId=$userId or s_userId=$currentUser) and active=1") ?>
                    <?php if (mysqli_num_rows($checkQuery)==1) : ?>
                    <a href="addfriends_remove.php?userId=<?php echo $user['id'] ?>" class="small-box-footer">
                      <div class="card-footer">
                        <div style="text-align: center"><i class="fas fa-user-times"></i>&nbsp;&nbsp;Remove Friend</div>
                      </div>
                    </a>
                    <?php endif; ?>
                    <?php $userId=$user['id']; $checkQuery=mysqli_query($conn, "select * from friendslist where (f_userId=$currentUser or f_userId=$userId) and (s_userId=$userId or s_userId=$currentUser)") ?>
                    <?php if (mysqli_num_rows($checkQuery)==0 && $userId!=$currentUser) : ?>
                    <a href="addfriends_add.php?userId=<?php echo $user['id'] ?>" class="small-box-footer">
                      <div class="card-footer">
                        <div style="text-align: center"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add Friend</div>
                      </div>
                    </a>
                    <?php endif; ?>
                    <?php if ($user['id']==$currentUser) : ?>
                    <a href="setting.php" class="small-box-footer">
                      <div class="card-footer">
                        <div style="text-align: center"><i class="fas fa-arrow-circle-right"></i>&nbsp;&nbsp;More Info</div>
                      </div>
                    </a>
                    <?php endif; ?>
                  </div>
                </div>
                <!-- ./col -->
                <?php endwhile;?>

              </div>
            </div>
            <?php if(mysqli_num_rows($searchQuery)==0) : ?>
              <div class="card-footer text-center"><i class="fa fa-times-circle text-danger"></i>&nbsp;No Users Found.</div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
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