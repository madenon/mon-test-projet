@extends('admin.template')

@section('admin-content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <div class="bg-white p-3 rounded shadow">
        <h1 class="text-lg font-semibold mb-2">Contest</h1>
        <div class="flex mb-4 justify-between items-center">
            <form action="{{ route('admin.contests') }}" method="GET">
                <div >
                    <label class="block text-sm font-medium text-gray-700">Rechercher :</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                    
                    <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>   
                
            </form>

            <div>
                <button class=" bg-lime-600 my-4 p-2 rounded text-black" onclick="reinitialize()">Remettre à zero</button>
            </div>
                
        </div>

       
        <table id="userTable" class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Prénom</th>
                    <th class="py-2 px-4 border-b cursor-pointer">
                        No d'annonce
                        <i id="upArrow" class="fa-solid fa-angle-up"></i>
                        <i id="downArrow" class="fa-solid fa-chevron-down"></i>
                    </th>

                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr class="tableRow" data-noOffer="{{ count($user->offer) }}">
                        <td class="py-2 px-4 border-b">{{ $user->first_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->last_name ?? '' }}</td>
                        <td class="py-2 px-4 border-b">{{ count($user->offer)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Liens de pagination -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
        
        
    </div>
    
    <!-- ... Votre code HTML précédent ... -->
    
@endsection
    
    
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    
    function sortTable(table, order , columnNumber){
        const rows = $(table + " tbody .tableRow").get();
        rows.sort(function (a, b) {
            const aOffers = parseInt($(a).find(`td:nth-child(${columnNumber})`).text());
            const bOffers = parseInt($(b).find(`td:nth-child(${columnNumber})`).text());
            return order * (aOffers - bOffers);
        });
        
        
        
        $(table + " tbody ").empty();

        $.each(rows, function (index, row) {
            $(table + " tbody ").append(row);
        });

        console.log({rows});
        console.log({order});
        if (order === 1) {
            $(table + " " + `th:nth-child(${columnNumber}) #upArrow`).show();
            $(table + " " + `th:nth-child(${columnNumber}) #downArrow`).hide();
        } else {
            $(table + ` th:nth-child(${columnNumber}) #upArrow`).hide();
            $(table + ` th:nth-child(${columnNumber}) #downArrow`).show();
        }
    }
    $(document).ready(function () {
        let sortOrder = 1; // 1 for ascending, -1 for descending

        sortOrder *= -1;
        sortTable("#userTable", sortOrder, 3);

        $("#userTable th:nth-child(3)").click(function () {
            sortOrder *= -1;
            sortTable("#userTable", sortOrder , 3);
            
        });
        
    });
    
    function reward(price){
        $.ajax({
            url: '/contests/reinitiliaze',
            type: 'POST', // or 'GET', 'PUT', 'DELETE', etc.
            dataType: 'json',// Change the datatype as needed
            data: {
                "price" : price,
            },
            success: function(response) {
                // Request was successful, handle response here
                console.log('Request successful');
                location.reload();
            },
            error: function(xhr, status, error) {
                // Request failed, handle error here
                console.error('Request failed:', error);
            }
        });
    }
    function reinitialize() {
        console.log("yep");
        Swal.fire({
            title: 'Remettre à zero ',
            text: 'Etes vous sur de reinitialiser',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Recompenser le gagnant',
                    text: 'Souhaiter vous recompenser le premier de cette periode?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler',
                }).then((result) => {
                    if (result.isConfirmed) {
                        reward(true);
                    }else{
                        reward(false);
                    }
                });
            }
        });
    }

    
</script>