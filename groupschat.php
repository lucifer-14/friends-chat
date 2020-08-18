<html>
<?php

include "utilities/header.php";
$title='Groups List' ;

$groupsListData = mysqli_query($conn, "select *, groups.id as gId from groups, groupmembers where groups.id=groupmembers.groupId and groupmembers.userId=$currentUser and approved=1 and groups.active=1");

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
              <h1 class="m-0 text-dark">Groups List</h1>
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
          <?php if (mysqli_num_rows($groupsListData)>0) : ?>
          <div class="row">
            <div class="table-responsive">
              <table class="table table-striped dt-table" id="tblFriendsList">
                <thead>
                  <tr>
                    <th class="no-sort"></th>
                    <th>Group Name</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($data = mysqli_fetch_assoc($groupsListData)) : ?>
                  <tr>
                      <td><img src="<?php echo $data['photo']?>" class="img-circle elevation-3" style="width: 50px !important; height: 50px;"></td>
                      <td><?php echo $data['name']; ?></td>
                      <td><a type="submit" id="btnChat" class="btn btn-sm btn-primary" href="groupschatcommon.php?groupId=<?php echo $data['gId'] ?>"><i class="fa fa-comment"> &nbsp;Chat</i></a></td>
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
                <div style="text-align: center;"><i class="fa fa-times-circle text-danger"></i> &nbsp;You are not added to any group chats.</div>
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