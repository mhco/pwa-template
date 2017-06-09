<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<title>Progressive Web App Template</title>
		<meta name='description' content='PWA Template'>
		<meta name='author' content='Mark Hewitt www.mh1.co'>
		<meta name='robot' content='noindex, nofollow' />
		<meta name='theme-color' content='#2e3135'>

		<!-- Add to home screen for Safari on iOS -->
		<meta name='apple-mobile-web-app-capable' content='yes'>
		<meta name='apple-mobile-web-app-status-bar-style' content='black'>
		<meta name='apple-mobile-web-app-title' content='PWA Template'>
		<link rel='apple-touch-icon' href='/assets/images/launcher-icon-3x.png'>
		<meta name='msapplication-TileImage' content='/assets/images/launcher-icon-3x.png'>
		<meta name='msapplication-TileColor' content='#2e3135'>

		<link rel='manifest' href='/manifest.json'>

		<link rel='stylesheet' type='text/css' href='/assets/css/style.css'>
	</head>
	<body>
		<div class='logo'>
			<div class='beginning'>SMS</div>
			<div class='loader'>
				<div class='blue'>
					<div class='red'></div>
				</div>
			</div>
			<div class='ending'>group</div>
		</div><br>

		<?=time()?>

		<div class='offline-banner'>You are currently offline. While you can view your data, you cannot edit it. Please reconnect to a network in order to proceed.</div>
		<script>
			/* SERVICE WORKER - REQUIRED */
				if ('serviceWorker' in navigator)
				{
					navigator.serviceWorker
					.register('./sw.js')
					.then(function(e)
					{
						//console.log('Service Worker Registered');
					});
				}

			/* OFFLINE BANNER */
				function updateOnlineStatus()
				{
					var d = document.body;
					d.className = d.className.replace(/\ offline\b/,'');

					if (!navigator.onLine)
					{
						d.className += " offline";
					}
				}

				updateOnlineStatus();
				window.addEventListener
				(
					'load',
					function()
					{

						window.addEventListener('online',  updateOnlineStatus);
						window.addEventListener('offline', updateOnlineStatus);
					}
				);

			/* CHANGE PAGE TITLE BASED ON PAGE VISIBILITY */
				function handleVisibilityChange()
				{
					if (document.visibilityState == "hidden")
					{
						document.title = "Hey! Come back!";
					}
					else
					{
						document.title = original_title;
					}
				}
				var original_title = document.title;
				document.addEventListener('visibilitychange', handleVisibilityChange, false);

			/* NOTIFICATIONS */
				window.addEventListener('load', function ()
				{
					// At first, let's check if we have permission for notification
					// If not, let's ask for it
					if (window.Notification && Notification.permission !== "granted")
					{
						Notification.requestPermission(function (status)
						{
							if (Notification.permission !== status)
							{
								Notification.permission = status;
							}
						});
					}
				});
				function notifyMe(alert_title, alert_body)
				{
					var options =
					{
						body: alert_body,
						icon: 'assets/images/launcher-icon-4x.png',
					}

					// Let's check if the browser supports notifications
					if (!("Notification" in window))
					{
						alert("This browser does not support system notifications");
						return false;
					}

					// Let's check whether notification permissions have already been granted
					else if (Notification.permission === "granted")
					{
						// If it's okay let's create a notification
						var notification = new Notification(alert_title,options);
						return true;
					}

					// Otherwise, we need to ask the user for permission
					else if (Notification.permission !== 'denied')
					{
						Notification.requestPermission(function (permission)
						{
							// If the user accepts, let's create a notification
							if (permission === "granted")
							{
								var notification = new Notification(alert_title,options);
								return true;
							}
						});
					}

					// Finally, if the user has denied notifications and you 
					// want to be respectful there is no need to bother them any more.
					console.log("Notifications denied");
					return false;
				}
				//Usage:
				//notifyMe("Title goes here", "Body text goes here");
		</script>
	</body>
</html>