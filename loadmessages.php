<?php 
include "utilities/config.php";
include "utilities/helper.php";
$senderId=$_POST['senderId']?? "";
$senderName=$_POST['senderName']??"";
$senderPhoto=$_POST['senderPhoto']??"";
$groupId=$_POST['groupId']??"";
$limitNo = $_POST['limitNo'];
$identifier = $_POST['identifier'];
$messageData;
if($identifier==1)
  $messageData=mysqli_query($conn, "select * from (select * from messages where groupId=0 and (senderId=$senderId or senderId=$currentUser) and (receiverId=$senderId or receiverId=$currentUser) order by sentDate desc limit $limitNo)var1 order by id asc");
else
  $messageData=mysqli_query($conn, "select * from (select * from messages where groupId=$groupId order by sentDate desc limit 5)var1 order by id asc");


?>

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
  <?php if($message['senderId']==$senderId) : ?>
  <div class="direct-chat-msg">
    <div class="direct-chat-infos clearfix">
      <span class="direct-chat-name float-left"><?php echo $senderName?></span>
      <span class="direct-chat-timestamp float-right"><?php echo datetimeToStr($message['sentDate']) ?></span>
    </div>
    <!-- /.direct-chat-infos -->
    <img class="direct-chat-img" src="<?php echo $senderPhoto ?>" alt="Friend Image">
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
