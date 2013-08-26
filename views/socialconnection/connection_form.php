<?php /*
<span class="twitter_connection">
	<?php echo Kohana::lang('connection.socialconnection');?>:
	<?php echo date('H:i M j Y', strtotime($end_date)); ?>
</span>
<span class="google_connection">
	<?php echo Kohana::lang('connection.socialconnection');?>:
	<?php echo date('H:i M j Y', strtotime($end_date)); ?>
</span>*/ ?>
<br />
<div class="socialbuttons">
	<a href="<?php echo url::base()?>plugins/Socialconnection/libraries/identificationGoogle.php" class="signInGoogle">
	<img class="googleplus" src="<?php echo url::base() . "media/img/Red-signin_g+.png"; ?>"/>
	</a>
	<br>
	<a href="<?php echo url::base()?>plugins/Socialconnection/libraries/identificationTwitter.php?authenticate=1" class="twitterlogo">Login con Twitter</a>
</div>
					