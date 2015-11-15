<HTML>
<HEAD>

<style>
	.box {font-family: Arial, sans-serif;background-color: #F1F1F1;border:0;width:340px;webkit-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);margin: 0 auto 25px;text-align:center;padding:10px 0px;}
	.box img{padding: 10px 0px;}
	.box a{color: #427fed;cursor: pointer;text-decoration: none;}
	.heading {text-align:center;padding:10px;font-family: 'Open Sans', arial;color: #555;font-size: 18px;font-weight: 400;}
	.circle-image{width:100px;height:100px;-webkit-border-radius: 50%;border-radius: 50%;}
	.welcome{font-size: 16px;font-weight: bold;text-align: center;margin: 10px 0 0;min-height: 1em;}
	.oauthemail{font-size: 14px;}
	.logout{font-size: 13px;text-align: right;padding: 5px;margin: 20px 5px 0px 5px;border-top: #CCCCCC 1px solid;}
	.logout a{color:#8E009C;}
</style>
</HEAD>
<BODY>
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
</BODY>
</HTML>
</HTML>
