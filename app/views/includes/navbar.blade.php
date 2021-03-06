<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Sayit.io</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ URL::route('article.index') }}">Articles</a></li>
        <li><a href="">Channels</a></li>
        <li><a href="">Users</a></li>

      </ul>
      <form action="{{ URL::route('article.index') }}" class="navbar-form navbar-left" role="search" method="get">
        <div class="form-group">
          <input type="text" name="q" class="form-control" placeholder="Search" value="{{{ Input::get('q') }}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">You <b class="caret"></b></a>
          <ul class="dropdown-menu">
			@if(Sentry::check())
            <li><a href="{{ URL::route('user.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ URL::route('user.edit') }}">Profile</a></li>
            <li><a href="{{ URL::route('auth.logout') }}">Logout</a></li>
			@else
			  <li><a href="{{ URL::route('user.register') }}">Register</a></li>
			  <li><a href="{{ URL::route('auth.login') }}">Login</a></li>
			@endif
            <li class="divider"></li>
            <li><a href="#">Help</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
