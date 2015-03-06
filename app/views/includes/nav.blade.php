 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Automation</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/screenshots-api"><span class="glyphicon glyphicon-road"></span> Screenshots API</a></li>

            @if(Auth::check())
                @if(Auth::user()->hasRole('admin'))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administration <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/users"><span></span> Users</a></li>
                        <li><a href="/browsers"><span></span> Browsers</a></li>
                    </ul>
                </li>
               @endif
                <li><a href="/profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
            @else
                <li><a href="/login">Login</a></li>
            @endif

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
