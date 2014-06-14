<!DOCTYPE html>
<html>
    <head>
        <title>@if(!empty($title)){{$title}}@else{{Lang::get('messages.title')}}@endif</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Archivo+Narrow:400,700|Montserrat:400,700|Lato:400,300,700,100' rel='stylesheet' type='text/css'>
        {{HTML::style('css/knoon/bootstrap.css',array('media'=>'screen'))}}
        {{HTML::style('css/knoon/bootstrap-modal.css',array('media'=>'screen'))}}
        {{HTML::style('css/knoon/app.css',array('media'=>'screen'))}}
        {{HTML::style('css/knoon/hopscotch-0.1.2.css',array('media'=>'screen'))}}



        {{HTML::style('css/style.css')}}
        {{HTML::style('css/chosen_ar.css')}}


        @yield('style')
        {{HTML::style('css/icon/font-awesome.css')}}

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
             {{HTML::script('js/knoon/html5shiv.js')}}
             {{HTML::script('js/knoon/respond.min.js')}}
        <![endif]-->
        <!--[if gte IE 9]>
              <style type="text/css">
                .gradient {
                   filter: none;
                }
              </style>
            <![endif]-->

        <meta name="keywords" content="@if(!empty($metaKeywords)){{$metaKeywords}}@endif">
        <meta name="description" content="@if(!empty($metaDecription)){{$metaDecription}}@endif">
        <link rel="icon" type="image/png" href="{{URL::to('images/knoon/website-icon.png')}}" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js"></script>


    </head>
    <body class="cloppse-sidebar question-page">

@include('layout.headeradmin')

        <header class="navbar navbar-inverse navbar-static-top bs-docs-nav">
            <div class="container">
                <a class="navbar-brand pull-right" href="{{URL::to('/')}}">{{Lang::get('messages.knoon')}}</a>
                <div class="navbar-header">
                    <button data-target=".both-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div><!--/navbar-header-->
                <nav role="navigation" class="collapse navbar-collapse bs-navbar-collapse both-collapse">
                    <ul class="nav navbar-nav" >
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle logedIn" href="#">
                                <span class="authorImg">
                                    <img src="@if(Auth::user()->profile_pic){{URL::to(Auth::user()->profile_pic)}}@else {{URL::to('images/knoon/user.png')}} @endif" alt="">
                                </span>
                                <span class="authorDes">
                                    <span class="autName">{{Auth::user()->firstname}}</span>
                                    <span class="autInfoIcon">
                                        <i class="icon1">1</i>
                                        <i class="icon2">2</i>
                                        <i class="icon3">3</i>
                                        <i class="icon4">4</i>
                                    </span>
                                </span>
                                <span class="authorCrown">
                                    <img src="{{URL::to('images/knoon/crown.png')}}" alt="">
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul role="menu" class="dropdown-menu" style="z-index:1001">
                                <li><a href="{{URL::to(Config::get("app.locale") . '/users/' . Auth::user()->id . '/edit')}}">{{Lang::get('messages.myProfile')  }}</a></li>
                                <li><a href="{{URL::to(Config::get('app.locale').'/reset_password')}}">{{Lang::get('messages.changePassword')}}</a></li>
                        	@if(Auth::user()->role_id==UserType::$admin)<li><a href="{{URL::to('admin/translations')}}"> {{Lang::get('messages.translations')}}</a></li>@endif
                                <li><a href="{{URL::route('logout')}}"><span class="glyphicon glyphicon-off"></span> {{' '.Lang::get('messages.logout')}}</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="pull-right nav navbar-nav custom-rNav">
                        <li><a  class="stcomp" href="{{URL::route('admin')}}" title="">&nbsp; <i></i></a></li>
                    </ul>
                </nav><!--/navigation-->
            </div><!--container-->
        </header><!--/Header-->

        
        <div style="min-height: 400px">
            <div id="main" >
                <div id="response" style="text-align: center;" class=" alert-block col-lg-12"></div>
                <div id="response2" style="text-align: center;" >
                    @if ($message = Session::get('success'))
                    <div class="alert alert-info alert-block">
                        {{{ $message }}}
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        {{{ $message }}}
                    </div>
                    @endif
                </div>
                <div class="block">
                    <div class="clearfix"></div>

                    <!--page title-->

                    <div class="container">

                        <!--page title end-->

                        <div class="span12">
                            <ul class="inline">
                                @yield('additional-menu')
                            </ul>
                        </div>
                        @yield('content')
                    </div>
                </div><!--end .block-->
            </div>
        </div>

        @include('layout.footer')



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        {{HTML::script('js/knoon/jquery-1.7.2.min.js')}}
        {{HTML::script('js/knoon/jquery-ui.min.js')}}
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        {{HTML::script('js/knoon/bootstrap.min.js')}}
        {{HTML::script('js/knoon/jquery.slimscroll.min.js')}}
        {{HTML::script('js/knoon/bootstrap-modal.js')}}
        {{HTML::script('js/knoon/bootstrap-modalmanager.js')}}
        {{HTML::script('js/knoon/tinynav.min.js')}}
        {{HTML::script('js/knoon/jquery.knob.js')}}
        {{HTML::script('js/knoon/app.js')}}
        <!-- Boostrap tour -->
        {{HTML::script('js/knoon/hopscotch-0.1.2.js')}}
        <!-- ClickDesk Live Chat Service for websites --><script type='text/javascript'>var _glc = _glc || [];
            _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyDgsSBXVzZXJzGOyB4ioM');
            var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 'http://my.clickdesk.com/clickdesk-ui/browser/');
            var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
            var glcspt = document.createElement('script');
            glcspt.type = 'text/javascript';
            glcspt.async = true;
            glcspt.src = glcpath + 'livechat-new.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(glcspt, s);</script><!-- End of ClickDesk -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
        <script>
            $(function() {
                setTimeout(function() {
                    $("#response").hide('blind', {}, 500)
                }, 3000);
            });
            $(function() {
                setTimeout(function() {
                    $("#response2").hide('blind', {}, 500)
                }, 3000);
            });
        </script>


        @yield('scripts')
    </body>
</html>
