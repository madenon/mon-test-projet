@php
$user=App\Models\User::find(request()->id);
if ($user){
    $last_login=Carbon\Carbon::parse($user->last_login);
    $last_login=$last_login->diffForHumans();
}


@endphp
<x-app-layout>
            <div class="mx-4" >
                <h1 class="mb-5 mt-5">Mes Annonces</h1>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    @if(count($offers) > 0 && !$offers->every('deleted_at'))
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-2 py-1">
                                        Nom de l'annonce
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Image
                                    </th>
                                    <th scope="col" class="px-2 py-1 hidden md:table-cell">
                                        Date de création
                                    </th>
                                    <th scope="col" class="px-2 py-1 hidden md:table-cell">
                                        Type
                                    </th>
                                    <th scope="col" class="px-2 py-1 hidden md:table-cell">
                                        Catégorie
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Prix
                                    </th>
                                    <th scope="col" class="px-2 py-1 text-center">
                                        Action
                                    </th>
                                    <th scope="col" class="px-2 py-1 text-center">
                                        Statut
                                    </th>
                                    <th scope="col" class="px-2 py-1 text-center">
                                        Visibilité
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($offers as $offer)
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                                        {{$offer->title}}
                                        @if($offer->active_offer)
                                        <form method="post" action="{{route('myaccount.deactivate', $offer)}}">
                                            @csrf
                                            @method('POST')
                                            <button class="text-white rounded-full h-6 w-6 bg-red-700 hover:bg-red-800" type="submit">P</button>
                                        </form>
                                        @else
                                        <form method="post" action="{{route('myaccount.activate', $offer)}}">
                                            @csrf
                                            @method('POST')
                                            <button class="text-white rounded-full h-6 w-6 bg-primary-color hover:bg-primary-hover" type="submit">M</button>
                                        </form>
                                        @endif
                                    </th>
                                    <td class="px-2 py-1">
                                        <img class="h-12 w-12 rounded-full" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt="Annonce Image">
                                    </td>
                                    <td class="px-2 py-1 hidden md:table-cell">
                                        @if (!$offer->updated_at)
                                        {{$offer->created_at}}
                                        @else
                                        {{$offer->updated_at}}
                                        @endif
                                    </td>
                                    <td class="px-2 py-1 hidden md:table-cell">
                                        {{$offer->type->name}}
                                    </td>
                                    <td class="px-2 py-1 hidden md:table-cell">
                                        {{$offer->subcategory->parent->name}}
                                    </td>
                                    <td class="px-2 py-1">
                                        {{$offer->price}}
                                    </td>
                                    <td class="flex gap-1 px-2 py-1">
                                        <button class="bg-blue-700 hover:bg-blue-800 text-white font-bold h-10 w-20 rounded-full"><a class="no-underline font-medium text-white" href="{{route('offer.offer', [$offer->id, $offer->slug])}}">Voir offre</a></button>
                                        <button class="bg-green-700 hover:bg-green-800 text-white font-bold h-10 w-20 rounded-full"><a class="no-underline font-medium text-white" href="{{route('myaccount.editOffer', [$offer->id])}}">Modifier</a></button>
                                        <form class="" action="{{route('myaccount.deleteOffer', [$offer->id])}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="bg-red-700 hover:bg-red-800 text-white font-bold h-10 w-20 rounded-full">Supprimer offre</button>
                                        </form>
                                    </td>
                                    <td class="px-2 py-1">
                                        <button id="toggleOnline{{$offer->id}}" onclick="toggleActive('{{$offer->id}}')">
                                            @if ($offer->active_offer)
                                            <img src="{{ asset('images/pause.png') }}" class="h-12" />
                                            @else
                                            <img src="{{ asset('images/play.png') }}" class="h-12" />
                                            @endif
                                        </button>
                                    </td>
                                    <td class="px-2 py-1">
                                        <button class="visibility">
                                            <span id="visibility{{$offer->id}}"></span>
                                        </button>
                                        <script>
                                            {
                                                let countDownDate = new Date(@json($offer->last_top));
                                                countDownDate.setDate(countDownDate.getDate() + 2);
                                                countDownDate = countDownDate.getTime();
                                                console.log(countDownDate);
                                                console.log({distance,countDownDate,now});
                                                var now = new Date().getTime();
                                                var distance = countDownDate - now;
                                                var x = setInterval(function() {
                            
                                                    var now = new Date().getTime();
                                                    var distance = countDownDate - now;
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    document.getElementById("visibility{{$offer->id}}").innerHTML = "Temps restant: " + days + "j " + hours + "h "
                                                    + minutes + "m " + seconds + "s ";
                                                    // If the count down is finished, write some text
                                                    if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("visibility{{$offer->id}}").innerHTML = '<button class=" bg-blue-700 hover:bg-blue-800 text-white font-bold h-12 w-24 rounded-full" onclick="putOnTop(\'{{$offer->id}}\')">Mettre en tête de liste</button>';
                                                    }
                                                }, 1000);
                                            }

                                            </script>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    @else
                    <p>Vous n'avez aucune annonce.</p>
                    @endif
                </div>
                <div class="py-4">
                    {{ $offers->links() }}
                </div>
            </div>
        

    <script>
        function toogleActive(offerId){
            $.ajax({
                url: `/offres/toogleActive`,
                method: 'POST',
                data: {
                    "offerId" : offerId
                },
                success: function () {
                    location.reload();
                    alert("L'offre a été mis à jour");
                },
                error: function (error) {
                    alert("Une erreur durant le updating.");
                }
            });
        }
        function putOnTop(offerId){
            $.ajax({
                url: `/offres/putOnTop`,
                method: 'POST',
                data: {
                    "offerId" : offerId
                },
                success: function () {
                    location.reload();
                    alert("L'offre a été mis à jour");
                },
                error: function (error) {
                    alert("Une erreur durant le updating.");
                }
            });
        }
    </script>
    <div id="footer-create-add-button" >
                <a class="" href="{{ route('offer.create') }}">
                    <div class="footer-create-add-button-img">
                        <img src="{{ asset('images/plus-icon-white.svg') }}" alt="" />
                    </div>
                    <span class="footer-create-add-button-span">
                        Déposer
                        une annonce
                    </span>
                </a>
            </div>

</x-app-layout>

