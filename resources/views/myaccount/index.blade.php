<x-app-layout>

<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body {
    color: #797979;
    background: #f1f2f7;
    font-family: 'Open Sans', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 13px;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
}

.profile-nav, .profile-info{
    margin-top:30px;   
}

.profile-nav .user-heading {
    background: #24a19c;
    color: #fff;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    padding: 30px;
    text-align: center;
}

.profile-nav .user-heading.round a  {
    color:white;
    -webkit-border-radius: 50%;
    display: inline-block;
    text-decoration:none;
}

.profile-nav .user-heading a img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}

.profile-nav .user-heading h1 {
    font-size: 22px;
    font-weight: 300;
    margin-bottom: 5px;
}

.profile-nav .user-heading p {
    font-size: 12px;
}

.profile-nav ul {
    margin-top: 1px;
}

.profile-nav ul > li {
    border-bottom: 1px solid #ebeae6;
    margin-top: 0;
    line-height: 30px;
}

.profile-nav ul > li:last-child {
    border-bottom: none;
}

.profile-nav ul > li > a {
    border-radius: 0;
    -webkit-border-radius: 0;
    color: #89817f;
    border-left: 5px solid #fff;
}

.profile-nav ul > li > a:hover, .profile-nav ul > li > a:focus, .profile-nav ul li.active  a {
    background: #f8f7f5 !important;
    border-left: 5px solid #24a19c;
    color: #89817f !important;
}

.profile-nav ul > li:last-child > a:last-child {
    border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
}

.profile-nav ul > li > a > i{
    font-size: 16px;
    padding-right: 10px;
    color: #bcb3aa;
}

.r-activity {
    margin: 6px 0 0;
    font-size: 12px;
}


.p-text-area, .p-text-area:focus {
    border: none;
    font-weight: 300;
    box-shadow: none;
    color: #c3c3c3;
    font-size: 16px;
}

.profile-info .panel-footer {
    background-color:#f8f7f5 ;
    border-top: 1px solid #e7ebee;
}

.profile-info .panel-footer ul li a {
    color: #7a7a7a;
}

.bio-graph-heading {
    background: #24a19c;
    color: #fff;
    text-align: center;
    font-style: italic;
    padding: 40px 110px;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    font-size: 16px;
    font-weight: 300;
}

.bio-graph-info {
    color: #89817e;
}

.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    margin-bottom: 10px;
    padding:0 15px;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
}

.bio-chart, .bio-desk {
    float: left;
}

.bio-chart {
    width: 40%;
}

.bio-desk {
    width: 60%;
}

.bio-desk h4 {
    font-size: 15px;
    font-weight:400;
}

.bio-desk h4.terques {
    color: #4CC5CD;
}

.bio-desk h4.red {
    color: #e26b7f;
}

.bio-desk h4.green {
    color: #97be4b;
}

.bio-desk h4.purple {
    color: #caa3da;
}

.file-pos {
    margin: 6px 0 10px 0;
}

.profile-activity h5 {
    font-weight: 300;
    margin-top: 0;
    color: #c3c3c3;
}

.summary-head {
    background: #ee7272;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #ee7272;
}

.summary-head h4 {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.summary-head p {
    color: rgba(255,255,255,0.6);
}

ul.summary-list {
    display: inline-block;
    padding-left:0 ;
    width: 100%;
    margin-bottom: 0;
}

ul.summary-list > li {
    display: inline-block;
    width: 19.5%;
    text-align: center;
}

ul.summary-list > li > a > i {
    display:block;
    font-size: 18px;
    padding-bottom: 5px;
}

ul.summary-list > li > a {
    padding: 10px 0;
    display: inline-block;
    color: #818181;
}

ul.summary-list > li  {
    border-right: 1px solid #eaeaea;
}

ul.summary-list > li:last-child  {
    border-right: none;
}

.activity {
    width: 100%;
    float: left;
    margin-bottom: 10px;
}

.activity.alt {
    width: 100%;
    float: right;
    margin-bottom: 10px;
}

.activity span {
    float: left;
}

.activity.alt span {
    float: right;
}
.activity span, .activity.alt span {
    width: 45px;
    height: 45px;
    line-height: 45px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    background: #eee;
    text-align: center;
    color: #fff;
    font-size: 16px;
}

.activity.terques span {
    background: #8dd7d6;
}

.activity.terques h4 {
    color: #8dd7d6;
}
.activity.purple span {
    background: #b984dc;
}

.activity.purple h4 {
    color: #b984dc;
}
.activity.blue span {
    background: #90b4e6;
}

.activity.blue h4 {
    color: #90b4e6;
}
.activity.green span {
    background: #aec785;
}

.activity.green h4 {
    color: #aec785;
}

.activity h4 {
    margin-top:0 ;
    font-size: 16px;
}

.activity p {
    margin-bottom: 0;
    font-size: 13px;
}

.activity .activity-desk i, .activity.alt .activity-desk i {
    float: left;
    font-size: 18px;
    margin-right: 10px;
    color: #bebebe;
}

.activity .activity-desk {
    margin-left: 70px;
    position: relative;
}

.activity.alt .activity-desk {
    margin-right: 70px;
    position: relative;
}

.activity.alt .activity-desk .panel {
    float: right;
    position: relative;
}

.activity-desk .panel {
    background: #F4F4F4 ;
    display: inline-block;
}


.activity .activity-desk .arrow {
    border-right: 8px solid #F4F4F4 !important;
}
.activity .activity-desk .arrow {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    left: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .arrow-alt {
    border-left: 8px solid #F4F4F4 !important;
}

.activity-desk .arrow-alt {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    right: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .album {
    display: inline-block;
    margin-top: 10px;
}

.activity-desk .album a{
    margin-right: 10px;
}

.activity-desk .album a:last-child{
    margin-right: 0px;
}
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
<div class="row">
<div class="profile-nav col-md-3">
<div class="panel">
<div class="user-heading round">
@if (isset($user->profile_photo_path))
<a href="#">

<img src="{{route('profile_pictures-file-path',$user->profile_photo_path)}}" alt >
</a>
@else
<a href="#">

<img src="{{ asset('profil.jpg') }}" alt >
</a>
@endif
<h1>{{auth()->user()->name}}</h1>
<div >
                        @if($user->id != auth()->id())
                            @php 
                                $following=App\Models\Following::where('followed_id',$user->id)
                                ->where('follower_id',auth()->id())->first();
                            @endphp 
                            @if(!$following)
                            <a href="{{route('followings.follow',$user->id)}}" class="no-underline inline-block px-4 py-2 font-normal text-slate-700 bg-gray-200 hover:bg-gray-300 rounded-md transition duration-300 ease-in-out">
                                Follow Account
                            </a>
                            @else
                            <a href="{{route('followings.unfollow',$user->id)}}" class="no-underline inline-block px-4 py-2 font-normal text-slate-700 bg-gray-200 hover:bg-gray-300 rounded-md transition duration-300 ease-in-out">
                                Unfollow Account
                            </a>
                            
                            @endif
                        @else
                        <a href="javascript:;" class="no-underline font-normal text-slate-700 hover:text-slate-400">
                                {{$followersCount}} Follower
                        </a>
                        @endif
                    </div>
                    <div >
                            @for ($i =1; $i <= 5; $i++)
                                <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden" />
                                <label for="star{{$i}}" title="{{$i}} star" class="cursor-pointer text-xl text-yellow-500">
                                    @if($ratingsAvg>=$i)
                                    &#9733;
                                    @else
                                    &#9734;
                                    @endif
                                </label>
                            @endfor                                         
                    </div>
                    <div class="ms-1">
                        <a class="no-underline font-normal text-slate-700 hover:text-slate-400">
                            {{number_format($ratingsAvg,2)}}
</a> 
                    </div>
                    <div class="mx-2">&#8226; </div>
                    <div>
                        <a href="{{route('ratings.index',$user->id)}}" class="no-underline font-normal text-slate-700 hover:text-slate-400">{{$ratingsCount}} reviews</a>
                    </div>
</div>
                    

<ul class="nav nav-pills nav-stacked">
<li class="active"><a href="{{ route('profile.edit') }}"> <i class="fa fa-edit"></i> Informations personnelles</a></li>

<li ><a href="{{ route('myaccount.offers') }}"> <i class="fa fa-rotate"></i>Mes trocs</a></li>
<li><a href="{{ route('moncompte/mesmessages') }}"> <i class="fa fa-envelope"></i> Mes messages</a></li>
</ul>
</div>
</div>
<div class="profile-info col-md-9">

<div class="panel">
<div class="bio-graph-heading">
{{$user->userInfo->bio}}
</div>
<div class="panel-body bio-graph-info">
<div class="row">
<div class="bio-row">
<p><span>Prénom </span>: {{$user->first_name}}</p>
</div>
<div class="bio-row">
<p><span>Nom </span>: {{$user->last_name}}</p>
</div>
<div class="bio-row">
<p><span>Pseudo </span>: {{$user->userInfo->nickname}}</p>
</div>
<div class="bio-row">
<p><span>Email </span>: {{$user->email}}</p>
</div>
<div class="bio-row">
<p><span>Téléphone </span>: {{$user->userInfo->phone}}</p>
</div>
<div class="bio-row">
<p><span>Localisation </span>: Paris, France</p>
</div>
</div>
</div>
</div>
<div>
<div class="row">
<div class="col-md-6">
<div class="panel">
<div class="panel-body">

<div class="bio-desk">
<h4 class="red">Trocs en cours</h4>

</div><div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="{{$offersInProgress}}" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>

</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">

<div class="bio-desk">
<h4 class="terques">Propositions </h4>
</div>
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="{{$offerPrepostion}}" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">

<div class="bio-desk">
<h4 class="green">Trocs realisés</h4>

</div>
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="{{$finishedOffers}}" data-fgcolor="#96be4b" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(150, 190, 75); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">


<div class="bio-desk">
<h4 class="purple">Crédibilité</h4>

</div>
<div class="bio-chart">
@forelse($user->badges as $badge)
            <div class="p-3 text-center ml-4 flex flex-wrap justify-center ">
                <img src="{{asset('images/medal-bronze.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
            </div>
            @empty       
<p  style="font-size:1.13rem;color:#caa3da">Des badges visant à renforcer la confiance des consommateurs, incluant ceux qui sont particulièrement populaires et influents.</p>
            @endforelse
            </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</x-app-layout>