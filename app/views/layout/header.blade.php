@if(Auth::check())
@if(Request::url()==URL::route('dashboard'))
<div class="top-bar">
    <div class="container">
        <ul class="pull-right lang-Nav">
            <li><a href="" title="">EN</a></li>
            <li><a class="active"  href="" title="">AR</a> | </li>
        </ul>

        <ul class="pull-left topbar-Nav">
            <li><a href="{{URL::route('home')}}" title="">{{Lang::get('messages.home')}}</a></li>
            <li><a href="{{URL::route('home').'#beatqy'}}" title="">{{Lang::get('messages.beatQyas')}}</a></li>
            <li><a href="{{URL::route('home').'#howWork'}}" title="">{{Lang::get('messages.howItWorks')}}</a></li>
            <li><a href="{{URL::route('home').'#learnwhat'}}" title="">{{Lang::get('messages.learnWhatYouNeed')}}</a></li>
            <li><a href="{{URL::route('home').'#learwith'}}" title="">{{Lang::get('messages.learWithYourPeer')}}</a></li>

        </ul>

    </div><!--/container-->
</div><!--/Top Bar-->
@endif


<header class="navbar navbar-inverse navbar-static-top bs-docs-nav container-fluid">
    <div class="container row-fluid">
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
            <ul class="nav navbar-nav">
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
                    <ul role="menu" class="dropdown-menu">
			    <li><a href="{{URL::to(Config::get("app.locale") . '/users/' . Auth::user()->id . '/edit')}}">{{Lang::get('messages.myProfile')  }} <strong class="text-danger">
						    @if(Auth::user()->package=="free")
					<em class="text-danger">{{Lang::get('messages.free')}} </em>
				   @elseif(Auth::user()->package=="basic")
				   <em class="text-warning">{{Lang::get('messages.basic')}} </em> 
			           @elseif(Auth::user()->package=="full")
					<em class="text-success">{{Lang::get('messages.full')}} </em>
				   @elseif(Auth::user()->package=='limited')
					<em class="text-success">{{Lang::get('messages.limited')}}</em>
				   @endif	
					    </strong></a></li>
			<?php	
			$trans= Transaction::where('user_id',Auth::user()->id)->where('is_group',true)
		    ->where('status','completed')->orderBy('created_at','dsc')->first();
	if(empty($trans)){
		 $trans= Transaction::where('user_id',Auth::user()->id)->where('is_group',true)
		    ->where('type','BankTransfer')
		    ->where('status','pending')->orderBy('created_at','dsc')->first();     
	     }
	
			?>
			@if(!empty($trans))
			<li>
			 <a href="{{ URL::route( 'groupbuyuser' ) }}" >{{ trans('messages.groupbuyuserform') }}</a></li>
                        @endif					    
                        <li><a href="{{URL::to(Config::get('app.locale').'/reset_password')}}">{{Lang::get('messages.changePassword')}}</a></li>
                        <li><a href="{{URL::to(Config::get('app.locale').'/quizzes')}}">
                                @if (Cache::get('answeruser'.Auth::user()->id))
                                    <div class="new_answer">
                                        <span class="new_entry" style="color:red">{{Lang::get('messages.notificationforanswer')}}</span>
                                    </div>
                                @endif
                                {{Lang::get('messages.myPages')}}</a></li>



                        <li><a href="{{URL::to(Config::get('app.locale') . '/diagnostics/' )}}">{{Lang::get('messages.diagnosticMenu')}}</a></li>
                        <li><a href="{{URL::route('blog')}}">{{Lang::get('messages.blogMenu')}}</a></li>
                        @if(Request::is('*/dashboard*'))
                        <li><a href="{{URL::route('showWizard')}}">{{Lang::get('messages.showDashboardWizard')}}</a></li>
                        @endif
                        
                        @if(Request::is('*/practice/*')&& !empty($topic))
                            <li>
                                <a href="{{URL::route('showpracticeresultwizard',$topic->id)}}">{{Lang::get('messages.showPracticeWizard')}}</a>
                            </li>
                        @endif

                        
                        @if(Request::is('*/videoPremiere*'))
                            <li>
                                <a href="{{URL::route('showpremiumvideowizard')}}">{{Lang::get('messages.showVideoWizard')}}</a>
                            </li>
                        @endif
                        
                        @if(Request::is('*/videos/*') && !empty($topic))
                            <li>
                                <a href="{{URL::route('showfreevideowizard',$topic->id)}}">{{Lang::get('messages.showVideoWizard')}}</a>
                            </li>
                        @endif

                         @if(Request::is('*/diagnostics*'))
                            <li>
                                <a href="" class="show-diagnostics-wizard">{{Lang::get('messages.showDiagnosticsWizard')}}</a>
                            </li>
                        @endif
                        
                        <li><a href="{{URL::route('logout')}}"><span class="glyphicon glyphicon-off"></span> {{' '.Lang::get('messages.logout')}}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="pull-right nav navbar-nav custom-rNav">
                @if(Request::url()==URL::route('dashboard'))
                <li><a class="stpre" href="{{URL::to(Config::get('app.locale').'/practice/'.$practiceId)}}" title="">{{Lang::get('messages.start')}} <span>{{Lang::get('messages.practice')}}</span><i></i></a>  </li>
                <li><a class="stvid" @if( Auth::user()->package == 'full' )href="{{URL::route('videoPremiere')}}" @else href="{{URL::to(Config::get('app.locale').'/videos/'.$practiceId)}}" @endif title=""><span>{{Lang::get('messages.Videos')}}</span><i></i> </a></li>
                <li><a class="stpre" href="#mock-test" title=""><span>{{Lang::get('messages.mocktestStart')}}</span><i></i> </a></li>
                @endif
                <li><a  class="stcomp" href="{{URL::route('dashboard')}}" title="">&nbsp; <i></i></a></li>
            </ul>
        </nav><!--/navigation-->
    </div><!--container-->
</header><!--/Header-->
@else
<div class="top-bar">
    <div class="container">
        <ul class="pull-right lang-Nav">
            <li><a @if(Request::segment(1) == "en")class="active"@endif href="{{URL::to('/en')}}" title="">EN</a></li>
            <li><a @if(Request::segment(1) == "ar")class="active"@endif href="{{URL::to('/ar')}}" title="">AR</a> | </li>
        </ul>

        <ul class="pull-left topbar-Nav">
            <li><a href="{{URL::route('blog')}}" title="">{{Lang::get('messages.blog')}}</a></li>
            <li><a href="{{URL::route('aboutus')}}" title="">{{Lang::get('messages.aboutUs')}}</a></li>
            <li><a href="{{URL::route('ourteam')}}" title="">{{Lang::get('messages.ourTeam')}}</a></li>
            <li><a href="{{URL::route('noonwall')}}" title="">{{Lang::get('messages.knoonWall')}}</a></li>
            <li><a href="{{URL::route('job')}}" title="">{{Lang::get('messages.jobs')}}</a></li>
            <li><a href="{{URL::route('faq')}}" title="">{{Lang::get('messages.faq')}}</a></li>
            <li><a href="{{URL::route('pricing')}}" title="">{{Lang::get('messages.pricing')}}</a></li>

        </ul>

    </div><!--/container-->
</div><!--/Top Bar-->
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
            <ul class="nav navbar-nav home-nav">
                <li><a href="{{URL::route('signup')}}"><button  type="button"  class="btn btn-default btn-enroll">{{Lang::get('messages.enrollNow')}}</button></a></li>

                <li class="dropdown" id="loginDiv" >
                    <button type="button" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="#loginDiv">{{Lang::get('messages.SignIn')}}</button>
                    <div class="dropdown-menu">
                        {{ Form::open(array('url' => URL::route('login'), 'method' => 'post')) }}
                        {{ Form::token() }}

                        {{ Form::text('email', Input::old('email'),array('placeholder'=>Lang::get('messages.email'),'dir'=>"rtl",'class'=>'form-control','style'=>"margin-bottom: 15px;")) }}
                        {{ Form::password('password',array('placeholder'=>Lang::get('messages.password'),'dir'=>"rtl",'class'=>'form-control','style'=>"margin-bottom: 15px;")) }}
                        {{ HTML::linkRoute('forgot_password',Lang::get('messages.forgotPassword'))}}

                        <input class="btn btn-primary btn-block" style="margin-top:5px" type="submit" id="sign-in" value="{{ Lang::get('messages.login') }}">
<!--                        <label style="text-align:center;margin-top:5px">{{Lang::get('messages.or')}}</label>
                        <a href="" class="btn  btn-primary btn-block" onclick="fblogin();
                            return false;">{{Lang::get('messages.facebook')}}</a>-->
                        {{ Form::close() }}
                        <a href="{{URL::route('fb_login')}}"><button class="btn" style="margin-right:10px; color:#fff; background-color:#3B5998; width:45.5%;">{{ Lang::get('messages.facebookLogin') }}</button></a>
                        <a href="{{URL::route('google_login')}}"><button class="btn" style="margin-left:2.5%; width:45.5%; color:#fff; background-color: #D64335;">{{ Lang::get('messages.googleLogin') }}</button></a>
                        
                    </div>
                </li>
            </ul>
        </nav><!--/navigation-->
    </div><!--container-->
</header><!--/Header-->
@endif