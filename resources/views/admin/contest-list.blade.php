@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h1>Contest</h1>
        <button id="new-contest" class="btn btn-success" >Create new contest</div>
        <div class="new-contest-form hidden">
            <form id="contestForm" method="POST" action="{{ route('admin.contests.create') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="w-full pt-3">
                            <label for="title" class="text-sm text-text block">Titre</label>
                            <input id="title" name="title" placeholder="Titre du contest" type="text"
                                class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div class="flex flex-col w-full pt-3">
                            <label for="type" class="text-sm text-text block">Type</label>
                            <select name='type' class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                <option value="" selected hidden>Choisir un type *</option>
                                <option value="invite_friends">Invite friends</option>
                                <option value="total_transactions">Reach a total of transactions</option>
                                <option value="total_amount">Transacte a total amount</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>
                        <div class="w-full pt-3">
                            <label for="value" class="text-sm text-text block">Value</label>
                            <input id="value" name="value" placeholder="Valeur à atteindre" type="number"
                                class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>
                        <div class="w-full pt-3 flex flex-wrap">
                            <div class="w-full text-sm text-text">Date et Heure de Debut</div>
                            <div class="w-1/2 pe-2">
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="w-1/2 ps-2">
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>
                        </div>
                        <div class="w-full pt-3 flex flex-wrap">
                            <div class="w-full text-sm text-text">Date et Heure de Fin</div>
                            <div class="w-1/2 pe-2">
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                            <div class="w-1/2 ps-2">
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="py-3">
                            <label for="description" class="text-sm text-text">Description</label>
                            <textarea id="description" name="description" type="text"
                                class="w-full min-h-[200px] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                ></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary my-4">Create Contest</button>
            </form>
        </div>
        <div class="contest-list ">
            @foreach( $contests as $contest)
            <div class="max-w-sm mx-auto bg-white shadow-md rounded-md overflow-hidden">
                <img src="contest-image.jpg" alt="Contest Image" class="w-full h-32 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $contest->title }}</h3>
                    <p class="text-gray-600">{{ $contest->description }}</p>
                    <div class="mt-4 flex items-center">
                        <svg class="w-5 h-5 fill-current text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 2C5.76 2 2 5.76 2 10s3.76 8 8 8 8-3.76 8-8-3.76-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm-1-8h2v4h-2zm0-6h2v2h-2z"/></svg>
                        <p class="text-gray-700">{{ $contest->start_datetime->format('M d, Y H:i A') }} - {{ $contest->end_datetime->format('M d, Y H:i A') }}</p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 fill-current text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 18L1 10h3V2h12v8h3l-9 8zm0-2.2l4.6-4.6-1.4-1.4L10 14V5H8v9l-3.2-3.2-1.4 1.4L10 15.8z"/></svg>
                            <p class="text-green-500">{{ $contest->value }}</p>
                        </div>
                        <a href="{{ route('admin.contests.show', $contest->id)}}" class="text-blue-500">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
    <script>
        
        // $("li span").toggle();
    $("#new-contest").click(function(){
        $(".new-contest-form").toggle();
    })
    </script>

@endsection

