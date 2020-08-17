<html>
<?php

include "header.php";
$title='Search Results' ;

$searchData=$_POST['search'];
$data=mysqli_query($conn, "select * from animes where active=1 and (name1 LIKE '%$searchData%' or name2 LIKE '%searchData%' or name3 LIKE '%searchData%')order by name1, season");
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-lg-8 col-12">
              <h1 class="m-0 text-dark">Search</h1>
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
            <h5 class="card-header">Search Results for '<?php echo $searchData; ?>'</h5>
            <div class="card-body">
              <?php if (mysqli_num_rows($data)==0 || $searchData=='') : ?>
                  <div class="card-footer text-center"><i class="fa fa-times-circle text-danger"></i>&nbsp;No Animes Found.</div>
              <?php endif;?>
              <?php if($searchData!='') : ?>
              <div class="row">
                <?php while ($animes = mysqli_fetch_assoc($data)) : ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                  <?php $photoUrl=substr($animes['photo'], 3)?>
                  <a href="watch.php?episodeId=<?php echo $animes['eId'] ?>">
                  <div class="card bg-light">
                    <img class="card-img-top" src="<?php echo $photoUrl ?>">
                    <div class="card-body">
                      <div class="card-title" style="height: 70px;"><?php echo $animes['name1']?></div>
                      <div class="card-text"><?php echo 'Anime '.$animes['animeType'] ?> </div>
                      <?php if ($animes['season']!=0) :?>
                      <div class="card-text"><?php echo 'Season-'.$animes['season']?></div>                      
                      <?php endif; ?>
                      <div class="card-text"><?php $tempId=$animes['id'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query); echo 'Episode-'.$epCount; ?></div>  
                    </div>
                  </div>
                  </a>
                </div>
                <?php endwhile; ?>
              </div>
              <?php endif ?>
            </div>
          </div>

          <!-- /.row (end card) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <?php include "footer.php" ?>
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