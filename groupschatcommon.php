<html>
<?php

include "utilities/header.php";
$title='Groups Chat';
// $ticketConfirmResult=mysqli_query($conn,"select id from tripbooking where active=1 and isconfirm=1");
// $ticketCofirmCount=mysqli_num_rows($ticketConfirmResult);
$groupId=$_GET['groupId'];
$groupId=preg_replace('/[^0-9]/', '', $groupId);

$groupData=mysqli_query($conn, "select * from groups, groupmembers where groups.id=$groupId and groups.active=1 and groupmembers.userId=$currentUser and groupmembers.approved=1");
$groupName='';
$groupPhoto='';
if(is_numeric($groupId)) {
  if(mysqli_num_rows($groupData)>0){

    $groupDataExtract = mysqli_fetch_object($groupData);
    $groupName=$groupDataExtract->name;
    $groupPhoto=$groupDataExtract->photo;
  }
}
$limitchecker=mysqli_query($conn, "select * from (select id from messages where groupId=$groupId order by sentDate desc)var1 order by id");
$upperlimit=mysqli_num_rows($limitchecker);


$messageData=mysqli_query($conn, "select * from (select * from messages where groupId=$groupId order by sentDate desc limit 30)var1 order by id");

$extraMessage='';
$groupmembersArray=array();

$currentUserAdminCheckData = mysqli_query($conn, "select * from groupmembers where groupId=$groupId and userId=$currentUser");
$currentUserAdminCheckDataExtract = mysqli_fetch_object($currentUserAdminCheckData);
$currentUserAdminChecker = $currentUserAdminCheckDataExtract->isAdmin;

if(isset($_POST['groupsetting'])){
  $groupName=mysqli_real_escape_string($conn, $_POST['groupname']);
  $groupPhoto='';
  if (!$_POST['groupPhoto_cropped'] == "") {
    $groupPhoto = $_POST['groupPhoto_cropped'];
  }
  $queryUpdate = "update groups set name='$groupName', photo='$groupPhoto' where id=$groupId";
  mysqli_query($conn, $queryUpdate);
  
  if(isset($_POST['addgroupmembers'])){
    foreach($_POST['addgroupmembers'] as $addgroupmembersId) {
      if($currentUserAdminChecker==1) {
        $queryAdd = "insert into groupmembers (groupId, userId, isAdmin, approved) values ($groupId, $addgroupmembersId, 0, 1)";
        mysqli_query($conn, $queryAdd);
        $counterT=count($groupmembersArray);
        $groupmembersArray[$counterT]=$addgroupmembersId;
      }
      else
      {
        $queryAdd = "insert into groupmembers (groupId, userId, isAdmin, approved) values ($groupId, $addgroupmembersId, 0, 0)";
        mysqli_query($conn, $queryAdd);
        $counterT=count($groupmembersArray);
        $groupmembersArray[$counterT]=$addgroupmembersId;
      }
    }
  }
  $groupName=$_POST['groupname'];
}
$friendlistData = mysqli_query($conn, "select * from friendslist where (s_userId=$currentUser or f_userId=$currentUser) and active=1");

$groupmembersData = mysqli_query($conn, "select *, users.id as uId, groupmembers.id as mId from users, groupmembers where groupmembers.userId=users.id and groupmembers.groupId=$groupId order by isAdmin desc, users.username");


?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "utilities/navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <input type="hidden" id="upperlimit" value="<?php echo $upperlimit ?>">
          <div class="row mb-2">
            <div class="col-lg-8 col-12">
              <h1 class="m-0 text-dark">Groups Chat</h1>
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
          <?php if(is_numeric($groupId)) : ?>
          <?php if(mysqli_num_rows($groupData)>0) : ?>
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="card card-primary cardutline direct-chat direct-chat-primary">
                <div class="card-header">
                  <input type="hidden" id="groupId" value="<?php echo $groupId ?>">
                  <h3 class="card-title"><img class="img-circle elevation-2" src="<?php echo $groupPhoto ?>" alt="Group Image" style="width: 30px !important; height: 30px;"><span style="font-size: 22px;">&nbsp;&nbsp;<?php echo $groupName; $title=mysqli_real_escape_string($conn, $groupName)." | Groups Chat" ?></span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" id="messageBody">
                  <?php while ($message = mysqli_fetch_assoc($messageData)) :?>
                    <!-- Message to the right -->
                    <?php if ($message['senderId']==$currentUser) : ?>
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right"><?php echo $_SESSION['username']?></span>
                        <span class="direct-chat-timestamp float-left"><?php echo datetimeToStr($message['sentDate']) ?></span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo $_SESSION['photo'] ?>" alt="User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $message['message'] ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <?php else : ?>
                    <!-- /.direct-chat-msg -->

                    <!-- Message. Default to the left -->
                    <?php
                      $senderId=$message['senderId'];
                      $query = mysqli_query($conn, "select * from users where id=$senderId");
                      $queryExtract = mysqli_fetch_object($query);
                      $senderName = $queryExtract->username;
                      $senderPhoto = $queryExtract->photo;

                    ?>
                    <input type="hidden" id="friendId" value="<?php echo $senderId ?>">
                    <input type="hidden" id="friendName" value="<?php echo $senderName ?>">
                    <input type="hidden" id="friendPhoto" value="<?php echo $senderPhoto ?>">
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left"><?php echo $senderName?></span>
                        <span class="direct-chat-timestamp float-right"><?php echo datetimeToStr($message['sentDate']) ?></span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo $senderPhoto ?>" alt="User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $message['message'] ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <?php endif; ?>
                    <!-- /.direct-chat-msg -->

                    
                  <?php endwhile; ?>
                  <?php if(mysqli_num_rows($messageData)==0): ?>
                    <div class="no-message text-muted"> - No Messages - </div>
                  <?php endif; ?>
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <form action="sendmessage.php?senderId=<?php echo $currentUser?>&receiverId=0&groupId=<?php echo $groupId?>" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </span>
                    </div>
                  </form>
                </div>
                <!-- /.card-footer-->
              </div>
            </div>

            <div class="col-md-6 col-12">
              <div class="card card-primary card-outline">
                <div class="card-body">
                  <p>
                    <a id="settingToggle" class="btn btn-sm btn-primary" data-toggle="collapse" href="#settingForm" role="button" aria-expanded="false" aria-controls="settingForm">
                      <span class="fa fa-cog"></span>
                      Change Group Setting
                    </a>
                  </p>
                  <div class="collapse" id="settingForm">
                    <div class="card card-body">
                      <?php if ($extraMessage != '') : ?>
                        <div class='alert alert-danger'>
                          <?php print_r($extraMessage) ?>
                        </div>
                      <?php endif; ?> 
                      <div>
                        <form action="groupschatcommon.php?groupId=<?php echo $groupId ?>" method="post" id="groupsettingform">
                          <div class="form-group">
                            <label>Group Name</label>
                            <input type="text" class="form-control" placeholder="Group Name" name="groupname" value="<?php echo $groupName; ?>"required />
                          </div>
                          <div class="form-group">
                            <label>Photo</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="groupPhoto" name="photo">
                              <input type="hidden" id="groupPhoto_cropped" name="groupPhoto_cropped" value="<?php echo $groupPhoto ?? '' ?>">
                              <label class="custom-file-label" for="animePhoto">Choose file</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="card card-light">
                              <h6 class="card-header"><strong>Group Members List</strong></h6>
                              <div class="card-body">
                                <!-- <ul style="list-style: none;"> -->
                                  <?php while ($groupmemberslist=mysqli_fetch_assoc($groupmembersData)) : ?>
                                  <li style="list-style: none; margin-bottom: 10px;">
                                    <div class="row">
                                      <div class="col-md-10 col-10"><?php if($groupmemberslist['approved']==1){ echo $groupmemberslist['username']." (". (($groupmemberslist['isAdmin']==1) ? "Admin" : "Member").")";}else{echo $groupmemberslist['username']." (Require Approval)";} ?></div>
                                      <div class="col-md-2 col-2">
                                        <div class="btn-group btn-group-sm">
                                          <?php if ($currentUserAdminChecker==1 && $groupmemberslist['approved']==0) : ?>
                                          <button type="button" id="btnApprove" data-id="<?php echo $groupmemberslist["mId"] ?>" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#approvemodal"><i class="fa fa-plus"></i>
                                          </button>
                                          <?php endif; ?>
                                          <button type="button" id="btnDelete" data-id="<?php echo $groupmemberslist["mId"] ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodel"><i class="fa fa-trash"></i>
                                          </button>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <?php $counter=count($groupmembersArray); $groupmembersArray[$counter]=$groupmemberslist['userId'];?>
                                  <?php endwhile; ?>
                                <!-- </ul> -->
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Add Group Members</label>
                            <select class="select2" multiple="multiple" data-placeholder="- Select Friends -" name="addgroupmembers[]">
                              <?php while($selectList=mysqli_fetch_assoc($friendlistData)) : ?>
                                <?php $selectId = ($selectList['s_userId']==$currentUser) ? $selectList['f_userId'] : $selectList['s_userId'] ?>
                                <?php if(!getDisabledTextArray($selectId, $groupmembersArray)) : ?>
                                <option value="<?php echo $selectId ?>">
                                  <?php $temp_userId = ($selectList['s_userId']==$currentUser) ? $selectList['f_userId'] : $selectList['s_userId']; 
                                  $temp_query = mysqli_query($conn, "select * from users where id=$temp_userId");
                                  $temp_queryExtract = mysqli_fetch_object($temp_query);
                                  echo $temp_queryExtract->username;
                                  ?>
                                </option>
                                <?php endif; ?>
                              <?php endwhile; ?>
                            </select>
                          </div>
                          <div class="float-right">
                            <button type="submit" name="groupsetting" class="btn btn-sm btn-primary">
                              <span class="fa fa-check"></span>
                              Save Changes
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
          <?php else : ?>
            <div class="row">
              <div class="col-12">
                <div class="card card-primary">
                  <h3 class="card-header"><center>No Groups Found</center></h3>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php else : ?>
            <div class="row">
              <div class="col-12">
                <div class="card card-primary">
                  <h3 class="card-header"><center>No Groups Found</center></h3>
                </div>
              </div>
            </div>
          <?php endif; ?>




          <!-- /.row (end card) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <?php include "utilities/footer.php" ?>
  </div>
  <div class="modal fade" id="approvemodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="groupparticipant_add.php?groupId=<?php echo $groupId?>" method="post">
                <div class="modal-body">
                    <p class="text-danger">Add to group?</p>
                    <input type="hidden" name="id" id="approveId">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="deletemodel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="groupparticipant_delete.php?groupId=<?php echo $groupId?>" method="post">
                <div class="modal-body">
                    <p class="text-danger">Remove from group?</p>
                    <input type="hidden" name="id" id="deletedId">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
  .no-message{
    text-align: center;
  }
</style>
<script type="text/javascript">
  var friendId = $("#friendId").val();
  var friendName = $("#friendName").val();
  var friendPhoto = $("#friendPhoto").val();
  var groupId = $("#groupId").val();
  var limitNo = 30;
  var upperlimit = $("#upperlimit").val();
  var selectorControl = document.querySelector('#messageBody');
  $(document).ready(function(){
    setInterval(function(){
      if(selectorControl.scrollTop==0 && limitNo<upperlimit){
        limitNo=limitNo+10;
      }
      $("#messageBody").load("loadmessages.php",{
        senderId: friendId,
        senderName: friendName,
        senderPhoto: friendPhoto,
        groupId: groupId,
        limitNo: limitNo,
        identifier: 2
      });
      if(selectorControl.scrollTop==0 && limitNo < upperlimit){
        selectorControl.scrollTop=selectorControl.clientHeight;
      }
    },1000);
  });
selectorControl.scrollTop = selectorControl.scrollHeight - selectorControl.clientHeight;

</script>
<script type="text/javascript">
  
  $("#groupsettingform").on("click", "#btnDelete", function () {
    $("#deletedId").val($(this).data('id'));
        //  var tableData = $(this).closest('tr')
        //   .find('td')
        //   .map(function () {
        //     return $(this).text();
        //   });
        // $("#deletemodel .modal-body p").text("Remove "+ tableData[1]+" from Watch History?")
  });
  $("#groupsettingform").on("click", "#btnApprove", function () {
    $("#approveId").val($(this).data('id'));
        //  var tableData = $(this).closest('tr')
        //   .find('td')
        //   .map(function () {
        //     return $(this).text();
        //   });
        // $("#deletemodel .modal-body p").text("Remove "+ tableData[1]+" from Watch History?")
  });

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