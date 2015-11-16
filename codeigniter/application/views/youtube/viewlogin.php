<div class="heading">PHP Google OAuth 2.0 Login</div>
<div class="box">
  <div>
	<!-- Show Login if the OAuth Request URL is set -->
    <?php if (isset($authUrl)): ?>
	  <img src='<?php echo "$base/public/img/user.png"  ?>' width="100px" size="100px" /><br/>
      <a class='login' href='<?php echo $authUrl; ?>'><img class='login' src='<?php echo "$base/public/img/sign-in-with-google.png" ?>' width="250px" size="54px" /></a>
	<!-- Show User Profile otherwise-->
    
    <?php else: ?>
	<!--
	  <img class="circle-image" src="<?php echo $userData["picture"]; ?>" width="100px" size="100px" /><br/>
	  <p class="welcome">Welcome <a href="<?php echo $userData["link"]; ?>" /><?php echo $userData["name"]; ?></a>.</p>
	  <p class="oauthemail"><?php echo $userData["email"]; ?></p>
	  -->
	  <div class='logout'><a href=<?php echo $logout   ?> >Logout</a></div>
    <?php endif ?>
  </div>
</div>

