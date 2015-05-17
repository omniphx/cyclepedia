<!DOCTYPE html>
<html lang="en" ng-app="cycleDB">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
    @yield('title')

    <link rel="stylesheet" href="assets/styles/styles.css">

    <script src="assets/scripts/libraries.js"></script>
    <script src="assets/scripts/modules.js"></script>
    <script src="assets/scripts/app.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
	<body>

    @yield('filter')

    @include('layouts.navbar')

    <div class="container">

      @yield('container')

      @include('layouts.footer')
      
    </div>

    @include('layouts.scripts.disqus')

	</body>

</html>