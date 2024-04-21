<x-app-layout>

    @if(config("binshopsblog.reading_progress_bar"))
    <div id="scrollbar">
        <div id="scrollbar-bg"></div>
    </div>
    @endif

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container pb50">
        <hr class="mb40" style="border: 0" >

        <div class="row">
            <div class="col-md-9 mb40" style="background-color: #abb8c31f" >
                @include("binshopsblog::partials.show_errors")
                @if(\Auth::check() && \Auth::user()->canManageBinshopsBlogPosts())
                <a href="{{$post->edit_url()}}" class="btn btn-outline-secondary btn-sm pull-right float-right">Edit
                    Post</a>
                @endif
                <article>
                <?=$post->image_tag("medium", false, 'd-block mx-auto'); ?>

                   
                    <div class="post-content">
                        <h1  style="text-align: center" >{{$post->title}}</h1>
                        <h5>{{$post->subtitle}}</h5>
                        <ul class="post-meta list-inline" style="text-align: center">
                            <li class="list-inline-item">
                                <i class="fa fa-user-circle-o"></i> {{$post->post->author->name}}
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-calendar-o"></i> <a
                                    href="#">{{$post->post->posted_at->diffForHumans()}}</a>
                            </li>

                        </ul>
                        <hr class="mb40">

                        {!! $post->post_body_output() !!}

                        {{--@if(config("binshopsblog.use_custom_view_files")  && $post->use_view_file)--}}
                        {{--                                // use a custom blade file for the output of those blog post--}}
                        {{--   @include("binshopsblog::partials.use_view_file")--}}
                        {{--@else--}}
                        {{--   {!! $post->post_body !!}        // unsafe, echoing the plain html/js--}}
                        {{--   {{ $post->post_body }} // for safe escaping --}}
                        {{--@endif--}}

                        <hr class="mb40">
                        @if(config("binshopsblog.comments.type_of_comments_to_show","built_in") !== 'disabled')
                        <h4 class="mb40 text-uppercase font500">Comments</h4>
                        @include("binshopsblog::partials.show_comments")
                        @else
                        {{--Comments are disabled--}}
                        @endif

                        <hr class="mb40">
                        <h4 class="mb40 text-uppercase font500">Post a comment</h4>
                        <form method='post'
                            action='{{route("binshopsblog.comments.add_new_comment",[app('request')->get('locale'),$post->slug])}}'>
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="John Doe">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="john@doe.com">
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea class="form-control" rows="5" placeholder="Comment"></textarea>
                            </div>
                            <div class="clearfix float-right">
                                <input type="submit" class="btn btn-primary btn-lg" value='Add Comment'>
                            </div>
                        </form>



                    </div>
                </article>
                <!-- post article-->

            </div>
            <div class="col-md-3 ">
            <div class="box categories">
                @if (config('binshopsblog.search.search_enabled') )
                    @include('binshopsblog::sitewide.search_form')
                @endif
                </div>
                <!--/col-->
                <h4 class="headline text-muted">
             Catégories
            </h4>
          
                                    @if($categories)
                        @include("binshopsblog::partials._category_partial", [
                        'category_tree' => $categories,
                        'name_chain' => $nameChain = "",
                        'routeWithoutLocale' => $routeWithoutLocale
                        ])
                    @else
                        <span>No Categories</span>
                    @endif
                <!--/col-->
                <div>
                    <h4 class="sidebar-title">Latest News</h4>
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="d-flex mr-3 img-fluid" width="64"
                                src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="#">Lorem ipsum dolor sit amet</a></h5> April 05, 2017
                            </div>
                        </li>
                        <li class="media my-4">
                            <img class="d-flex mr-3 img-fluid" width="64"
                                src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="#">Lorem ipsum dolor sit amet</a></h5> Jan 05, 2017
                            </div>
                        </li>
                        <li class="media">
                            <img class="d-flex mr-3 img-fluid" width="64"
                                src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><a href="#">Lorem ipsum dolor sit amet</a></h5> March 15, 2017
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>