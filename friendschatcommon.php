<html>
<?php

include "utilities/header.php";
$title='Friends Chat';
// $ticketConfirmResult=mysqli_query($conn,"select id from tripbooking where active=1 and isconfirm=1");
// $ticketCofirmCount=mysqli_num_rows($ticketConfirmResult);
//$friendMessageId=mysqli_real_escape_string($conn, $_GET['friendId']);
$friendMessageId=$_GET['friendId'];
$friendMessageId=preg_replace('/[^0-9]/', '', $friendMessageId);
$friendData=mysqli_query($conn, "select * from users where id=$friendMessageId and $friendMessageId<>$currentUser");
$friendName='';
$friendPhoto='';
if(is_numeric($friendMessageId)){
  if(mysqli_num_rows($friendData)>0){
    $friendDataExtract = mysqli_fetch_object($friendData);
    $friendName=$friendDataExtract->username;
    $friendPhoto=$friendDataExtract->photo;
  }
}

$messageData=mysqli_query($conn, "select * from (select * from messages where groupId=0 and (senderId=$friendMessageId or senderId=$currentUser) and (receiverId=$friendMessageId or receiverId=$currentUser) order by sentDate desc limit 15)var1 order by id asc");
$limitchecker=mysqli_query($conn, "select * from (select id from messages where groupId=0 and (senderId=$friendMessageId or senderId=$currentUser) and (receiverId=$friendMessageId or receiverId=$currentUser) order by sentDate desc)var1 order by id asc");
$upperlimit=mysqli_num_rows($limitchecker);

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
              <h1 class="m-0 text-dark">Friends Chat</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <hr>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <input type="hidden" id="friendId" value="<?php echo $friendMessageId ?>">
          <input type="hidden" id="friendName" value="<?php echo $friendName ?>">
          <input type="hidden" id="friendPhoto" value="<?php echo $friendPhoto ?>">
          <input type="hidden" id="upperlimit" value="<?php echo $upperlimit ?>">
          <!-- Rows (Start card) -->
          <?php if(is_numeric($friendMessageId)) : ?>
          <?php if(mysqli_num_rows($friendData)>0) : ?>
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="card card-primary cardutline direct-chat direct-chat-primary">
                <div class="card-header">
                  <h3 class="card-title"><span style="font-size: 22px;">&nbsp;&nbsp;<?php echo $friendName; $title=mysqli_real_escape_string($conn, $friendName)." | Friends Chat" ?></span></h3>
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
                      <img class="direct-chat-img" src="<?php echo $_SESSION['photo'] ?>" alt="Message User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $message['message'] ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <?php endif; ?>
                    <!-- /.direct-chat-msg -->

                    <!-- Message. Default to the left -->
                    <?php if($message['senderId']==$friendMessageId) : ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left"><?php echo $friendName?></span>
                        <span class="direct-chat-timestamp float-right"><?php echo datetimeToStr($message['sentDate']) ?></span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo $friendPhoto ?>" alt="Friend Image">
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
                  <form action="sendmessage.php?senderId=<?php echo $currentUser?>&receiverId=<?php echo $friendMessageId?>&groupId=0" method="post">
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
          </div>
          <?php else: ?>
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <h3 class="card-header"><center>No Conversations Found</center></h3>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <?php else: ?>
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <h3 class="card-header"><center>No Conversations Found</center></h3>
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
  var limitNo = 15;
  var upperlimit = $("#upperlimit").val();
  var selectorControl = document.querySelector('#messageBody');
  $(document).ready(function(){
    setInterval(function(){
      if(selectorControl.scrollTop==0 && limitNo<upperlimit){
        limitNo=limitNo+5;
      }
      $("#messageBody").load("loadmessages.php",{
        senderId: friendId,
        senderName: friendName,
        senderPhoto: friendPhoto,
        groupId: "",
        limitNo: limitNo,
        identifier: 1
      });
      if(selectorControl.scrollTop==0 && limitNo<upperlimit){
        selectorControl.scrollTop=selectorControl.clientHeight;
      }
    },1000);
  });
  selectorControl.scrollTop = selectorControl.scrollHeight - selectorControl.clientHeight;



</script>
</html>