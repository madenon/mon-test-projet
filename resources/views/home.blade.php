<x-app-layout>
   <div class="mt-12 d-flex align-items-center justify-content-center">
<div >
    <h1 class="title">Avez-vous un bien ou un service ?<br>cherchez, postez et troquez !</h1>
    <div class="mt-12 d-flex align-items-center justify-content-center" >
        <a class="sg-btn" href="{{route('alloffers.index')}}">Consultez nos offres <i class="pl-2 fa fa-long-arrow-right"></i></a>
    </div>
</div>
</div>
<div class="grid-container">
<!-- Top Users Column -->
<div class="s">
    <h2 class="d-flex justify-content-center">Top Users</h2>
        <ul class="mt-4">
        @foreach ($topUsers as $user)
        @foreach ($topUsers as $user)
            <li class="user-item">
                <div class="media">
                    <img src="{{ route('profile_pictures-file-path', $user->profile_photo_path) }}" class="rounded-full max-w-15 max-h-8" alt="{{ $user->name }} Avatar">
                </div>
                <div class="details">
                    <a class="sg-home-link" href="#" data-target="#LoginProfilModal104" data-toggle="modal">{{ $user->name }}</a>
                    <div class="offer-count">
                        <span>{{ $user->offer_count }} trocs publiés</span>
                    </div>
                </div>
            </li>
        @endforeach
        @endforeach
        </ul>
</div>

 <!-- Top Categories Column -->
<div class="s">
    <h2 class="d-flex justify-content-center">Top Categories</h2>
    
        <ul class="mt-4">
            @foreach($topCategories as $category)
                <li><a href="#" class="list-item-link">{{ $category->name }} ({{ $category->offer_count }})</a></li>
            @endforeach
        </ul>
    </div>


<!-- Top Regions Column -->
<div class="s">
    <h2 class="d-flex justify-content-center">Top Regions</h2>
        <ul class="mt-4">
            @foreach($topRegions as $region)
                <li><a href="#" class="list-item-link">{{ $region->name }} ({{ $region->offer_count }})</a></li>
            @endforeach
        </ul>
</div>

</div>

</x-app-layout>

<style>/* Additional styles for the new content */
.grid-container {
    margin-top: 50px;
  display: grid;
  grid-template-columns: auto auto auto  ;
  grid-row-gap: 30px;
  grid-column-gap: 30px;
  padding: 100px;
}
.s{
  border : 1px solid black;
  padding-top:15px ;
}

.title {
    color: var(--titles-color);
    
    margin-bottom: 15px;
}

.title h1 {
    color: var(--secondary-color);
}

.call-action {
    margin-top: 10px;
}

.sg-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 24px;
}

.sg-btn:hover {
    background-color: var(--primary-color-hover);
}
 .custom-section {
      
      border-color: red;
      border: solid;
    }
    
    .user-item {
    display: flex;
    margin-bottom: 15px;
}

.media {
    margin-right: 15px; /* Adjust the spacing between the avatar and user details */
}

.details {
    flex-grow: 1; /* This will make the details take up the remaining space */
}

.offer-count {
    font-size: 14px; /* Adjust the font size of the offer count */
}

</style>
