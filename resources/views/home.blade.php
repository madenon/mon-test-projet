<x-app-layout>
   <div class="mt-12 d-flex align-items-center justify-content-center">
<div >
    <h1 class="title">Avez-vous un bien ou un service ?<br>cherchez, postez et troquez !</h1>
    <div class="mt-12 d-flex align-items-center justify-content-center" >
        <a class="sg-btn" href="">Consultez nos offres <i class="pl-2 fa fa-long-arrow-right"></i></a>
    </div>
</div>
</div>
<div class="grid-container">

  <!-- Top Categories Column -->
  <div class="s" >
      <h2 class="d-flex justify-content-center">Top Categories</h2>
      <div class="d-flex justify-content-center">
        <ul>
          <li><a href="#" class="list-item-link">296 Rhone-Alpes</a></li>
          <li><a href="#" class="list-item-link">123 Category 2</a></li>
          <li><a href="#" class="list-item-link">456 Category 3</a></li>
          <!-- Add more items as needed -->
        </ul>
      </div>
    </div>

    <!-- Top Regions Column -->
    <div class="s">
      <h2 class="d-flex justify-content-center">Top Regions</h2>
      <div class="d-flex justify-content-center">
        <ul>
          <li><a href="#" class="list-item-link">789 Region 1</a></li>
          <li><a href="#" class="list-item-link">101 Region 2</a></li>
          <li><a href="#" class="list-item-link">112 Region 3</a></li>
          <!-- Add more items as needed -->
        </ul>
      </div>
    </div>

    <!-- Top Users Column -->
    <div class="s" >
      <h2 class="d-flex justify-content-center">Top Users</h2>
      <div class="d-flex justify-content-center">
        <ul>
          <li><a href="#" class="list-item-link">555 User 1</a></li>
          <li><a href="#" class="list-item-link">777 User 2</a></li>
          <li><a href="#" class="list-item-link">999 User 3</a></li>
          <!-- Add more items as needed -->
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
    
    
</style>
