<?php


$recentFriendsData = mysqli_query($conn, "select max(messages.id) as msId, susers.id as uSId, susers.username as sUsername, rusers.id as uRId, rusers.username as rUsername, combinedId, max(sentDate) as latestSentDate from messages left join users susers on messages.senderId=susers.id left join users rusers on messages.receiverId=rusers.id where messages.receiverId<>0 and (messages.receiverId=$currentUser or messages.senderId=$currentUser) and messages.groupId=0 group by combinedId order by latestSentDate desc limit 5");
$recentGroupsData = mysqli_query($conn, "select groups.name, groups.id as gId, max(messages.id) as mId, max(sentDate) as latestSentDate from messages, groups, groupmembers where groupmembers.groupId=groups.id and groupmembers.userId=$currentUser and groupmembers.approved=1 and groups.active=1 and messages.groupId=groups.id group by groups.id order by latestSentDate desc limit 5" );
$friendsData = mysqli_query($conn,"select * from friendslist where (f_userId='$currentUser' or s_userId='$currentUser') and active=1");
$groupsData = mysqli_query($conn, "select *, groups.id as gId, groupmembers.userId as mId from groupmembers, groups where groups.id=groupmembers.groupId and groupmembers.userId='$currentUser' and groupmembers.approved=1");
$friendRequestData = mysqli_query($conn, "select *, friendslist.id as frId from users, friendslist where f_userId=users.id and s_userId=$currentUser and users.active=1 and users.isDeactive=0 and friendslist.active=0");
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light sticky-top" style="box-shadow: 0 4px 4px 0.1px grey;">
  <!-- Left navbar links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- <span class="nav-text">
    <form action="search.php" method="post" id="searchForm" enctype="multipart/form-data">
      <input class="form-control" type="search" placeholder="Search friends and groups here ... " name="searchFriend" style="width: 280px;margin-top: 10px;">
    </form>
  </span>
  &nbsp;&nbsp; -->
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="images/savage_logo.png" alt="Savage Anime Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Friends-Chat</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $_SESSION['photo'] ?? "" ?>" class="img-circle elevation-2" alt="User Image" style="width: 34px !important; height: 34px;">
      </div>
      <div class="info">
        <a href="setting.php" class="d-block"><?php echo $_SESSION['username'] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header" style="padding-left: 20px;">ADD & CREATE</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-plus fa-fw"></i>
            <p>
              Add & Create
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="addfriends.php" class="nav-link">
                <i class="fa fa-user-plus nav-icon"></i>
                <p>Add Friends</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="creategroups.php" class="nav-link">
                <i class="fa fa-plus-circle nav-icon"></i>
                <p>Create Groups</p>
              </a>
            </li>
          </ul>
        </li>


		<li class="nav-header" style="padding-left: 20px;">ALL CHATS</li>    
		<li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-comment fa-fw"></i>
            <p>
              All Chats
           	  <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="friendschat.php" class="nav-link">
                <i class="fa fa-user-friends nav-icon"></i>
                <p>All Friends</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="groupschat.php" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>All Groups</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-header" style="padding-left: 20px;">RECENT CHATS</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user fa-fw"></i>
            <p>
              Friends - (<?php echo "n" ?>)
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php while($data = mysqli_fetch_assoc($recentFriendsData)) : ?>
            <li class="nav-item">
              <a href="friendschatcommon.php?friendId=<?php echo ($data['uSId']==$currentUser) ? $data['uRId'] : $data['uSId'] ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>
                <?php
                  echo ($data['uSId']==$currentUser) ? $data['rUsername'] : $data['sUsername'];
                ?>  
                </p>
              </a>
            </li>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($friendsData)==0) : ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>- No Recent Friends Chat -</p>
              </a>
            </li>
            <?php endif;?>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users fa-fw"></i>
            <p>
              Groups - (<?php echo "n" ?>)
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php while($data = mysqli_fetch_assoc($recentGroupsData)) : ?>
            <li class="nav-item">
              <a href="groupschatcommon.php?groupId=<?php echo $data['gId'] ?>" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p> <?php echo $data['name'];?>  </p>
              </a>
            </li>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($groupsData)==0) : ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>- No Recent Groups Chat -</p>
              </a>
            </li>
            <?php endif;?>
          </ul>
        </li>

        <li class="nav-header" style="padding-left: 20px;">REQUESTS</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users fa-fw"></i>
            <p>
              Friend Requests - (<?php echo mysqli_num_rows($friendRequestData)?>)
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php while($data = mysqli_fetch_assoc($friendRequestData)) : ?>
            <li class="nav-item">
              <a href="friendrequests.php?friendrequestId=<?php echo $data['frId'] ?>" class="nav-link">
                <i class="fa fa-user-plus nav-icon"></i>
                <p> <?php echo $data['username'];?>  </p>
              </a>
            </li>
            <?php endwhile; ?>
            <?php if(mysqli_num_rows($friendRequestData)==0) : ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>- No Friend Requests -</p>
              </a>
            </li>
            <?php endif;?>
          </ul>
        </li>



        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fa fa-sign-out text-danger"></i>
            <p class="text">Log Out</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
