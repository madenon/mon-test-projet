<x-app-layout>
    <style>
    .sg-btn {
        display: inline-block;
        padding: 10px 20px;
        color: black;
        text-decoration: none;
        background-color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 24px;
    }

    .sg-btn:hover {
        background-color: var(--primary-color-hover);
    }
    </style>
    <div class="container-fluid mx-2">
        <div class="{{ auth()->user() ? 'flex justify-between' : 'flex justify-center' }} flex-col md:flex-row">
            @if(auth()->user())
                <div class="mt-16 col-12 col-md-3 bg-white w-full mb-6 shadow-lg rounded-xl">
                    <x-mini-menu ></x-mini-menu>
                </div>
                @endif
                <div class="col-12 col-md-8">
                    <div class="relative max-w-md mx-auto md:max-w-2xl mt-16 pt-4 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl">
                        @if($user->statusPro == "pending")
                        <div id="timeLeft" class="bg-green-300 p-4 my-3 w-72 mx-auto text-center">Temps restant : {{Carbon\Carbon::parse($user->userInfo->updated_at)->addDays(2)->diff(Carbon\Carbon::now())->format('%H:%I:%S')}}</div>
                        <p class="mx-4 mt-4 mb-8 pb-8"> Nous sommes ravi de votre demande et nous esperons que vous serez bientôt parmi nos comptes Pro. Votre demande est cours de traitement. La durée de traimement de vos est de 48h. Merci de patienter. </p>
                        @elseif($user->statusPro == "rejected")
                        <div class ="mx-4 text-lg font-bold">Nous sommes au regret de refuser votre compte pro </div>
                        <hr class ="mx-4"/>
                        <p class="mx-4 mt-4"> {{$user->pro_reason}} </p>
                        <div class="mt-12 d-flex align-items-center justify-content-center mb-8 pb-8" >
                            <a class="sg-btn" href="{{route('becomePro')}}">Repostuler</a>
                        </div>
                        @else
                        <p class="mx-4 mt-4 mb-8 pb-8"> Félicitations ! Vous faites partis de nos  utilisateurs professionels, de nouvelles options arrivent bientôt chez vous</p>
                        @endif           
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <script>
    var countDownDate = new Date(@json($user->userInfo->updated_at));
    countDownDate.setDate(countDownDate.getDate() + 2);
    countDownDate = countDownDate.getTime();
    console.log(countDownDate);
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timeLeft").innerHTML = "Temps restant : " + days + "j " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
        clearInterval(x);
        document.getElementById("timeLeft").innerHTML = "Expirée";
        }
    }, 1000);

    </script>
</x-app-layout>