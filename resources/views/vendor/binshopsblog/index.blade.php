<x-app-layout>
    <body>
        
    
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <h2 class="text-muted"></h2>
    </div>
    <div class="row">
   
        <!-- posts -->
    <div class="col-md-8">
     @foreach($posts as $post)
            <div class="panel blog-container">
           
              <div class="panel-body">
                
        
              <div class='text-center blog-image' style="display: block;margin-left: auto;margin-right: auto;width: 70%;">
            <?=$post->image_tag("medium", true, ''); ?>
        </div>
                  
                
                
                
                <h2 style="text-align: center ;margin-top: 30px;margin-bottom: 30px;">{{$post->title}}</h2>
                <h5 style="text-align: center;margin-top: 30px;margin-bottom: 30px;">{{$post->subtitle}}</h5>

                <small class="text-muted" style="margin-top: 0px;margin-bottom: 30px;display: block;margin-left: auto;margin-right: auto;width: 50%;"><strong >par  {{$post->post->author->name}}</strong> |  Publié le {{date('d M Y ', strtotime($post->post->posted_at))}} </small>
                

                <p class="m-top-sm m-bottom-sm">
                {!! mb_strimwidth($post->post_body_output(), 0, 400, "...") !!}
                            </p>          
                <a  class="btn btn-default" href="{{$post->url($locale, $routeWithoutLocale)}}"><i class="fa fa-angle-double-right"></i> Lire la suite</a>
               
              </div>
            
            </div>  
               @endforeach               
    </div>
        
        <div class="col-md-4">
        <div class="box categories">
                @if (config('binshopsblog.search.search_enabled') )
                    @include('binshopsblog::sitewide.search_form')
                @endif
                </div>
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
                    <h4 class="headline text-muted">Articles récents
            </h4>
            <div class="box categories">
            @foreach($lang_list as $lang)                      
            <ul class="list-unstyled">
        <li >
        <a href="{{route("binshopsblog.index" , $lang->locale)}}">
        <span>{{$lang->name}}</span>
        </a>
        </li>
        </ul>   
        
        @endforeach
        </div>   
        <h4 class="headline text-muted">Commentaires récents
            </h4>
            <div class="box categories">
            @foreach($lang_list as $lang)                      
            <ul class="list-unstyled">
        <li >
        <a href="{{route("binshopsblog.index" , $lang->locale)}}">
        <span>{{$lang->name}}</span>
        </a>
        </li>
        </ul>   
        
        @endforeach
        </div>   
                    <h4 class="headline text-muted">
             Traductions 
            </h4>
            <div class="box categories">
            @foreach($lang_list as $lang)                      
            <ul class="list-unstyled">
        <li >
        <a href="{{route("binshopsblog.index" , $lang->locale)}}">
        <span>{{$lang->name}}</span>
        </a>
        </li>
        </ul>   
        
        @endforeach
        </div>   
                     
        </div>
  </div>
</div>
<style>
    a {
    color: #24a19c;
    text-decoration: none;
}
   body{
  background: #f9f9f9;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    position: relative;
}


.panel-body {
    padding: 15px;
}
.blog-container {
  color: black;
  transition: all .2s linear;
  -webkit-transition: all .2s linear;
  -moz-transition: all .2s linear;
  -ms-transition: all .2s linear;
  -o-transition: all .2s linear;
}






.headline {
  margin: 20px 0;
  padding: 5px 0 10px;
  border-bottom: 1px solid #eee;
  font-weight: 500;
}



.media, .media-body {
  overflow: hidden;
  zoom: 1;
}
</style>
</body>
</x-app-layout>    
