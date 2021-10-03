<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layouts.head')
	</head>

	<body class="main-body app sidebar-mini dark-theme">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
        @include('layouts.footer')
				@include('layouts.footer-scripts')

		{{-- <script>
      var notificationsWrapper   = $('.main-header-notification');
      var notificationsToggle    = $('#notification-toggle');
      var notificationsCountElem = $('#notification-count');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = $('#unreadNotifications');

      if (notificationsCount <= 0) {
        notificationsWrapper.hide();
      }

      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;


			var pusher = new Pusher('7efb4ddcddef088f1dba', {
      	cluster: 'eu'
    	});

      // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('invoice-created');

      // Bind a function to a Event (the full Laravel class)
      channel.bind('App\\Events\\InvoiceCreated', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
          <a class="d-flex p-3 border-bottom" href="{{ route('invoices.show', data['invoice_id']) }}">
									<div class="notifyimg bg-pink">
										<i class="la la-file-alt text-white"></i>
									</div>
									<div class="ml-3">
										<h5 class="notification-label mb-1">{{ data['title'] }}</h5>
										<div class="notification-subtext">Created at {{ data['created_at']->format('d-M-Y') }}</div>
									</div>
									<div class="ml-auto">
										<i class="las la-angle-right text-right text-muted"></i>
									</div>
								</a>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        $('#notification-count').text(notificationsCount);
        notificationsWrapper.show();
      });
    </script> --}}
	</body>

</html>
	<script>
		setInterval(function() {
			$("#unreadNotifications").load(window.location.href + " #unreadNotifications");
		}, 5000);
	</script>
