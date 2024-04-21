<div style='max-width:500px;margin:50px auto;' class='search-form-outer'>
    <form method='get' action='{{route("binshopsblog.search", app('request')->get('locale'))}}' class='text-center'>
        <input type='text' name='s' placeholder='Rechercher...' class='form-control' value='{{\Request::get("s")}}'>
        <input type='submit' value='Rechercher' style="background-color:#24a19c" class='btn btn-primary m-2'>
    </form>
</div>