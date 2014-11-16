<!DOCTYPE html>

<html>
  <head>
    <title> Health Care Information Systems </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    <meta charset="utf-8">
    <style>body { padding-top: 70px; }</style>
  </head>


  <body>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            {{ link_to_route('home', 'HCIS', [], ['class' => 'navbar-brand']) }}
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse">
            <!--navbar left--->
            <ul class="nav navbar-nav">
              <li>{{ link_to_route('record.index', 'Record') }}</li>
              <li>{{ link_to_route('patient.index', 'Patient') }}</li>
              <li>{{ link_to_route('facility.index', 'Facility') }}</li>
              @if (Auth::user() != null && Auth::user()->isAdmin())
              <li>{{ link_to_route('user.index', 'User') }}</li>
              @endif


            </ul>

            <!--Search Bar-->
            {{Form::open(['route'=>'patient.search', 'class' => "navbar-form navbar-left"])}}
            <div class="form-group">
              {{Form::text('keyword', null, ['placeholder' => 'Search for Record by PHN',  'class' => 'form-control', 'size' => '25'])}}
            </div>
            {{Form::submit('Search', ['class' => 'btn btn-default'])}}
            {{Form::close()}}

            <!--navbar right-->
            <ul class="nav navbar-nav navbar-right">
              @if (Auth::check())
              <!--Profile-->
              <li><p class="navbar-text">Signed in as {{ link_to_route('user.show', Auth::user()->username, [Auth::user()->id]) }}.</p></li>
              <!--Logout-->
              <li>
                {{ Form::open(['route' => 'login.destroy', 'method' => 'DELETE']) }}
                {{ Form::submit('Logout', ['class' => 'btn btn-default navbar-btn']) }}
                {{ Form::close() }}
              </li>
              @else
              <p class="navbar-text">Login required.</p>
              @endif
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </div>


    <!-- Main content -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="container">
        <!--- Flash messages -->
        @if (Session::get('flash_message_success'))
        <div class="alert alert-success fade in" role="alert">
          <button class="close" data-dismiss="alert">×</button>
          {{ Session::get('flash_message_success') }}
        </div>
        @endif
        @if (Session::get('flash_message_info'))
        <div class="alert alert-info fade in" role="alert">
          <button class="close" data-dismiss="alert">×</button>
          {{ Session::get('flash_message_info') }}
        </div>
        @endif
        @if (Session::get('flash_message_warning'))
        <div class="alert alert-warning fade in" role="alert">
          <button class="close" data-dismiss="alert">×</button>
          {{ Session::get('flash_message_warning') }}
        </div>
        @endif
        @if (Session::get('flash_message_danger'))
        <div class="alert alert-danger fade in" role="alert">
          <button class="close" data-dismiss="alert">×</button>
          {{ Session::get('flash_message_danger') }}
        </div>
        @endif

        <!-- Content-->
        @yield('content')
      </div>
    </div>

    <!-- END HOME -->

    {{ HTML::script('js/jquery.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}

    <script>
      //Auto close alert after a set time.
      window.setTimeout(function() { $(".alert").alert('close'); }, 4000);
    </script>
  </body>
</html>

