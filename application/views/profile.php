<html>
	<head>
		<title>CodeIgniter : Login Facebook via Oauth 2.0</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="main">
			<div id="login">
				<h2> <?php echo '<a href='.$user_profile->getLink()." target='_blank' ><img class='fb_profile' src=".'https://graph.facebook.com/'.$user_profile->getId().'/picture'.'>'.'</a>'."<p class='profile_name'>Welcome ! <em>".$user_profile['name'].'</em></p>';
                echo "<a class='logout' href=".base_url('index.php/oauth_login/logout').">Logout</a>";
                ?></h2>
				<hr/>
				<h3><u>Profile</u></h3>
				<?php
                echo '<p>Nome : '.$user_profile->getName().'</p>';
				echo '<p>Cidade : '.$user_location["city"]." - ".$user_location["state"]." - ".$user_location["country"]." (".$user_location["latitude"].",".$user_location["longitude"].")</p>";
				echo '<p>Sexo : '.$user_profile->getGender().'</p>';
                echo '<p>Data de Nascimento : '.$user_profile->getBirthday()->format('m/d/Y').'</p>';
                echo "<p>Facebook URL : ".
				"<a href=\"https://www.facebook.com/{$user_profile->getId()}".
				$user_profile->getLink().
				"\" target=\"_blank\"".
				"> https://www.facebook.com/".
				$user_profile->getId().
				'</a></p>';
                ?>
			</div>
		</div>
	</body>
	<script type="text/javascript">
    if (window.location.hash && window.location.hash == '#_=_') {
        if (window.history && history.pushState) {
            window.history.pushState("", document.title, window.location.pathname);
        } else {
            // Prevent scrolling by storing the page's current scroll offset
            var scroll = {
                top: document.body.scrollTop,
                left: document.body.scrollLeft
            };
            window.location.hash = '';
            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scroll.top;
            document.body.scrollLeft = scroll.left;
        }
    }
</script>
</html>
