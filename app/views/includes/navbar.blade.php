<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">You <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Login</a></li>
            <li><a href="#">Join</a></li>
            <li class="divider"></li>
            <li><a href="#">Help</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
