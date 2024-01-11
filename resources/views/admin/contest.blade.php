@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <div>Contest</div>
        <button id="new-contest" class="btn btn-success" >Create new contest</div>
        <div class="new-contest-form">
        <form id="contestForm" method="POST" action="{{ route('admin.contest.create') }}">
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
    </div>
    
    
    <script>
        
        // $("li span").toggle();
    $("#new-contest").click(function(){
        $(".new-contest-form").toggle();
    })
    </script>

@endsection

