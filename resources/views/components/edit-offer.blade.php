    <div class="container">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Modifier une annonce') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Mettre à jours les informations de votre annonce.") }}
            </p>
        </header>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="">
            <form method="POST" action="{{ route($route, ['offerId' => $offer->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="border-b border-line py-4 mt-12">
                    <div class="flex gap-4 lg:gap-8 flex-wrap ">
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Type</label>
                            <select name="type" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" id="type-dropdown" onchange="changerType(this)" disabled>
            <option value="0" selected hidden>Choisir le type de troc *</option>
            @foreach($types as $type)
            <option value="{{ $type->id }}" @if($offer->type && $offer->type->id == $type->id) selected @endif>{{ $type->name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="type" id="hidden_type" value="{{ $offer->type ? $offer->type->id : '' }}">
    </div>
                        <div class="md:flex-1 w-full hidden " id="experience-dropdown">
                            <label for="" class="text-sm text-text block">Expérience du service</label>
                            <select name="experience" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
            <option value="0" selected>Choisir l'expérience</option>
            @foreach ($experienceLevels as $key => $value)
            <option value="{{ $value }}" {{ $offer->experience == $value ? 'selected' : '' }}>{{ $key }}</option>
            @endforeach
        </select>
        <input type="hidden" name="experience" id="hidden_experience" value="{{ $offer->experience }}">
    </div>
                        <div class="md:flex-1 w-full hidden" id="condition-dropdown">
                            <label for="" class="text-sm text-text block">Etat</label>
                            <select name="condition" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
            <option value="0" selected>
                {{ __('Choisir l\'état') }}
            </option>
            @foreach ($conditions as $key => $value)
            <option value="{{ $value }}" {{ $offer->condition == $value ? 'selected' : '' }}>{{ $key }}</option>
            @endforeach
        </select>
        <input type="hidden" name="condition" id="hidden_condition" value="{{ $offer->condition }}">
    </div>
                        @if($offer->type_id==3)
                        <input type="hidden" name="availability" class="notRequired" id="availability">
<div class="md:flex-1 w-full" id="calendar-container">
    <label for="calendar" class="text-sm text-text block">Disponibilités</label>
    <div id="calendar"></div>
</div>

<style>
    /* Calendar container */
    #calendar-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Calendar title */
    .fc .fc-toolbar-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2D3748; /* Dark gray color */
        text-align: center;
    }
    a{
        text-decoration: none;
    }

    /* Month grid styling */
    .fc .fc-daygrid-day {
        border: 1px solid #CBD5E0; /* Light gray border */
        padding: 5px;
    }

    /* Day number styling */
    .fc .fc-daygrid-day-number {
        color: #2D3748; /* Dark gray color */
        font-size: 1rem;
        font-weight: 500;
    }

    /* Day name styling */
    .fc .fc-daygrid-day-name {
        color: #4A5568; /* Darker gray color */
        font-size: 0.875rem;
        font-weight: 700;
    }

    /* Event styling */
    .fc .fc-daygrid-event {
        background-color: #38B2AC; /* Teal color */
        color: #FFFFFF;
        border-radius: 4px;
        padding: 2px 4px;
    }

    .fc .fc-daygrid-event:hover {
        background-color: #2C7A7B; /* Darker teal */
    }

    /* Button styling */
    .fc .fc-button-primary {
        background-color: #38B2AC; /* Teal color */
        border: none;
        color: #FFFFFF;
    }

    .fc .fc-button-primary:hover {
        background-color: #2C7A7B; /* Darker teal */
    }

    /* Hide scrollbars */
    .fc .fc-daygrid-day { 
        overflow: hidden; /* Prevent scrolling */
    }

    /* Ensure calendar shows only the current month */
    .fc .fc-daygrid-day {
        max-height: 100px; /* Set a max-height to avoid vertical scrolling */
        overflow: hidden;
    }
     .default-day-background {
        background-color: red !important;
    }
</style>
<script>
        document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr', // Set the locale to French
            selectable: true,
            select: function(info) {
                // Toggle date availability
                let event = calendar.getEventById(info.startStr);
                if (event) {
                    event.remove();
                } else {
                    calendar.addEvent({
                        id: info.startStr,
                        start: info.startStr,
                        end: info.endStr,
                        color: 'green'
                    });
                }
            },
            events: [
                // Load existing availability data
            ]
        });
        calendar.render();

        document.getElementById('submitBtn').addEventListener('click', function(e) {
            var events = calendar.getEvents();
            var dates = events.map(event => ({
                date: event.startStr,
            }));
            document.getElementById('availability').value = JSON.stringify(dates);
        });
    });
</script> @endif
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Catégorie du troc</label>
                            <select name="category" id="select_type" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
    <option value="0" selected hidden>Choisir la Catégorie *</option>
    @foreach($categories as $category)
    <option value="{{ $category->id }}" {{ $category->id == $offer->subcategory->parent_id ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
</select>

<input type="hidden" name="category" id="category_hidden" value="{{ $offer->subcategory->parent_id }}">

                        </div>
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Sous catégorie du troc</label>
                            <select name="subcategory" id="select_category" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
            <option value="0" selected hidden>Choisir la sous catégorie *</option>
            @foreach($subcategories as $subcategory)
            @if($subcategory->id == $offer->subcategory_id)
            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $offer->subcategory_id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
            @endif
            @endforeach
        </select>
        <input type="hidden" name="subcategory" id="hidden_subcategory" value="{{ $offer->subcategory_id }}">
    </div>

                    </div>
                </div>
                <div class="border-b border-line py-4 mt-4">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col  w-full mb-3">
                                <label for="" class="text-sm text-text block">Région</label>
                                <select name="region" onchange="changerDepartement(this)" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
            <option value="" selected hidden>Choisir une région *</option>
            @foreach($regions as $region)
            <option value="{{ $region->id }}" {{ $region->id == $offer->department->region_id ? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="region" id="hidden_region" value="{{ $offer->department->region_id }}">
    </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col w-full mbdropdown-3">
                                <label for="" class="text-sm text-text block">Département</label>
                                <select name="department" id="select_department" onchange="changerNumDepartement(this)" class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" disabled>
            <option value="0" selected hidden>Choisir un département *</option>
            @foreach($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id == $offer->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="department" id="hidden_department" value="{{ $offer->department_id }}">
    </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col w-full">
                                <label for="" class="text-sm text-text block">N° département</label>
                                <input type="text" 
                                    class="focus:border-primary-color w-full rounded-md border-line text-sm text-titles  focus:ring-primary-hover"
                                    readonly id="num-departement" />
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="border-b border-line py-4 mt-4">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="w-full">
                                <label for="title" class="text-sm text-text block">Titre</label>
                                <input id="title" value="{{ $offer->title}}" name="title" placeholder="Titre d’annonce ici" type="text"
                                class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div class="py-3">
                                <label for="description" class="text-sm text-text">Description</label>
                                <textarea id="description" name="description" type="text" class="w-full min-h-[200px] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                required>{{old('description', $offer->description)}}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                        <div class="flex justify-center div-image ">
                        <div id="additionalImageSelected" class="my-2 flex justify-start flex-wrap">
                                    @foreach ($images as $image)
                                        <div class="me-4">
                                            <img alt="" src="{{ route('offer-pictures-file-path',$image->offer_photo) }}" style="height:60px"><button class="w-full">
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                        <a href="{{ route('offer.offer', [$offer->id, urlencode($offer->slug)]) }}" id="goToOffer" class="inline-block rounded-md border border-primary-color bg-primary-color text-white no-underline px-4 py-2 text-center h-12 flex items-center justify-center mx-auto mt-6 mb-6">
    Modifier les images
</a>
</div>
                <div class="flex justify-end gap-2">
                    <button class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-primary-color hover:bg-primary-hover" id="submitBtn" type="submit">
                        Mettre l'annonce à jours
                    </button>
                    <button class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-gray-900  hover:bg-black">
                        <a class="no-underline font-medium text-white " href="{{route('myaccount.offers')}}">Annuler</a>
                    </button>
                </div>

            </form>
        </div>
    </div>
<script>
     // Add event listeners to show/hide additional options based on checkbox state
    let inputCount = 1;
    function addInput() {
        console.log(inputCount);
        if(inputCount<3){
            var container = document.getElementById("dynamicInputsContainer");
            var input = document.createElement("input");
            input.type = "text";
            input.name = "dynamicInputs[]";
            input.className = "form-control mt-3 notRequired";
            var pl = `${inputCount + 1} eme Troc`;
            input.placeholder = pl;
            container.appendChild(input);
            inputCount++;
        }
        else{
            appendError("Le nombre maximal de troc possible est de trois");
        }
    }
    function addTeam() {
        let checkbox = document.getElementById('partnerCheckbox');

        var container = document.getElementById("addTeamContainer");
        if(checkbox.checked){
            var input = document.createElement("input");
            input.type = "number";
            input.name = "dynamicInputs[]";
            input.className = "form-control mt-3";
            input.placeholder = "Nombre d'équipes";
            // input.setAttribute("readonly", "readonly");
            container.appendChild(input);
        }else{
            while (container && container.firstChild) {
                container.removeChild(container.firstChild);
            }
        }
    }
    // 
    const conditionDropdownElement = document.getElementById('condition-dropdown')
    const yearsOfExperienceDropdownElement = document.getElementById('experience-dropdown')

    const experienceOrLevel = (selectedValue) => {
        const hasCondition = [6,1, ,"6","1"]
        const hasExprience = 2
        if(hasCondition.includes(selectedValue)){
            // if bien, don, moment => show condition dropdown
            conditionDropdownElement.style.display = "inline-block"
            yearsOfExperienceDropdownElement.style.display = "none"

        } else if(selectedValue === 2 || selectedValue === "2") {
            // if service        => show experience dropdown
            conditionDropdownElement.style.display = "none"
            yearsOfExperienceDropdownElement.style.display = "inline-block"
        } else {
            // else              => show nothing
            conditionDropdownElement.style.display = "none"
            yearsOfExperienceDropdownElement.style.display = "none"
        }
    }
    // Type dropdown change handler
    const onTypeDropdownChanged = (e) => {
        const selectedValue = e.target.value
        experienceOrLevel(selectedValue)
    }
    const typeDropdownElement = document.getElementById('type-dropdown')
    typeDropdownElement.addEventListener("change", onTypeDropdownChanged)

    const inputElement = document.getElementById("default_image");
    const spanElement = document.getElementById("selectedFileName");
    const defaultImageSelected = document.getElementById("defaultImageSelected");
    const browse_default_text = document.getElementById("browse_default_text");
    
    
    inputElement.addEventListener("change", function () {
        const selectedFiles = inputElement.files;
        if (selectedFiles.length > 0) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                defaultImageSelected.src = e.target.result;
            }
            reader.readAsDataURL(selectedFiles[0]);
            
            spanElement.textContent = selectedFiles[0].name;
            browse_default_text.classList.add("hidden");
        } else {
            spanElement.textContent = "Aucun fichier sélectionné";
            if(browse_default_text.classList.contains("hidden"))
            browse_default_text.classList.remove("hidden");
    }
});


const additional_images = document.getElementById("additional_images");
const spanElementMultiple = document.getElementById("selectedFileNameMultiple");
const additionalImageSelected = document.getElementById("additionalImageSelected");
var selectedFilesMultiple = [];
const browse_additional_text = document.getElementById("browse_additional_text");

additional_images.addEventListener("change", function () {
    selectedFilesMultiple = selectedFilesMultiple.concat(Array.from(additional_images.files));
    if (selectedFilesMultiple.length > 0) {
        while(additionalImageSelected.firstChild){
            additionalImageSelected.removeChild(additionalImageSelected.firstChild);
        };
        browse_additional_text.classList.add("hidden");
        selectedFilesMultiple.forEach((item, index) => {
            const divElement = document.createElement('div');
            divElement.className = 'me-4';
            
            const imgElement = document.createElement('img');
            const reader = new FileReader();
            reader.onload = function (e) {
                imgElement.src = e.target.result;
                imgElement.setAttribute("style","height:30px");
            }
            reader.readAsDataURL(item);
            imgElement.alt = '';
            const buttonElement = document.createElement('button');
            const imgTrashElement = document.createElement('img');
            buttonElement.className = 'w-full';
            imgTrashElement.src = '{{asset("/images/close-icon.png")}}';
            imgTrashElement.className = 'mx-auto my-2';
            imgTrashElement.style.width = "25px";
            buttonElement.onclick = () =>{
                event.preventDefault();
                buttonElement.parentNode.remove();
                selectedFilesMultiple.splice(index, 1);
                spanElementMultiple.textContent = selectedFilesMultiple.length + " fichier(s) sélectionné(s)";
            };

            buttonElement.appendChild(imgTrashElement);
            divElement.appendChild(imgElement);
            divElement.appendChild(buttonElement);
            additionalImageSelected.appendChild(divElement);
            
            
        });
        spanElementMultiple.textContent = selectedFilesMultiple.length + " fichier(s) sélectionné(s)";
        var dataTransfer = new DataTransfer();
        selectedFilesMultiple.forEach(function(file) {
            dataTransfer.items.add(file);
        });
        additional_images.files = dataTransfer.files;
        
    } else {
        spanElementMultiple.textContent = "Aucun fichier sélectionné";
        if(browse_additional_text.classList.contains("hidden"))
        browse_additional_text.classList.remove("hidden");
    }
});

const changerCategory = (e) => {
    const subcategories = @json($subcategories);
    const selectedCategoryId = e.value;
    const subcategoryOptions = subcategories.filter(item => item.parent_id == selectedCategoryId);
    const selectCategory = document.getElementById('select_category');
    
    while (selectCategory.options.length > 1) {
        selectCategory.remove(1);
    }
    
        subcategoryOptions.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.innerHTML = item.name;
            selectCategory.append(option);
        });
    };
    
    const changerType = (e) => {
        const types = @json($types);
        const selectedTypeId = e.value;
        console.log({selectedTypeId});
        document.cookie = "selectedTypeId = " + selectedTypeId;
        var partner = document.getElementById('partner');
        var donation = document.getElementById('donation');
        var exchange = document.getElementById('exchange');
        
        const type = types.filter(item => item.id == selectedTypeId)[0];
        const categories = type["categories"];
        const selectType = document.getElementById('select_type');
        
        while (selectType.options.length > 1) {
            selectType.remove(1);
        }
    
        categories.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.innerHTML = item.name;
            selectType.append(option);
        });
        // Exchange part
        if(selectedTypeId == 7){// moment
            if (donation.classList.contains('row')){
                donation.classList.remove('row');
                donation.classList.add('hidden');
                Array.from(donation.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('row')){
                exchange.classList.remove('row');
                exchange.classList.add('hidden');
                Array.from(exchange.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (partner.classList.contains('hidden')){
                partner.classList.remove('hidden');
                partner.classList.add('row');
            }
            
        }else if(selectedTypeId == 6){ // don
            if (partner.classList.contains('row')){
                partner.classList.remove('row');
                partner.classList.add('hidden');
                Array.from(partner.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('row')){
                exchange.classList.remove('row');
                exchange.classList.add('hidden');
                Array.from(exchange.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (donation.classList.contains('hidden')){
                donation.classList.remove('hidden');
                donation.classList.add('row');
            }
        }else{ 
            if (partner.classList.contains('row')){
                partner.classList.remove('row');
                partner.classList.add('hidden');
                Array.from(partner.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (donation.classList.contains('row')){
                donation.classList.remove('row');
                donation.classList.add('hidden');
                Array.from(donation.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('hidden')){
                exchange.classList.remove('hidden');
                exchange.classList.add('row');
            }
            
        }


    };
    
    const typeDropdownElement = document.getElementById('type-dropdown')
    typeDropdownElement.addEventListener("change", onTypeDropdownChanged)
    typeDropdownElement.dispatchEvent(new Event('change'));
    console.log({typeDropdownElement});
    const selectedValue = typeDropdownElement.target.value
    console.log({selectedValue});
    if(selectedValue)    experienceOrLevel(selectedValue)



const changerDepartement = (e) => {
    const departments = @json($departments);
    console.log(e.value);
    const departmentOptions = departments.filter(item => item.region_id == e.value);
    const selectDepartment = document.getElementById('select_department');

    while (selectDepartment.options.length > 1) {
        selectDepartment.remove(1);
    }

    departmentOptions.forEach(item => {
        const option = document.createElement("option");
        option.value = item.id;
        option.innerHTML = item.name;
        selectDepartment.append(option);
    });
};

const changerNumDepartement = (e) => {
    const departmentsList = @json($departments);
    console.log('Selected value:', e.value);
    const numDepartment = document.getElementById('num-departement');
    const department = departmentsList.find(item => item.id == e.value);
    console.log('Department found:', department);
    numDepartment.value = department ? department.department_number : '';
};

$('#mySelect').change(function () {
            var selectedValue = $(this).val();});


// compte a rebours
    document.addEventListener('DOMContentLoaded', function () {
        const countdownCheckbox = document.getElementById('countdownCheckbox');
        const countdownOptions = document.getElementById('countdownOptions');
        const expirationDateInput = document.getElementById('expiration_date');

        // Show/hide countdown options based on checkbox
        countdownCheckbox.addEventListener('change', function () {
            countdownOptions.style.display = this.checked ? 'block' : 'none';
        });

        // Update the expiration date input based on the selected countdown option
        document.querySelectorAll('input[name="countdown_option"]').forEach(function (option) {
            option.addEventListener('change', function () {
                const selectedOption = document.querySelector('input[name="countdown_option"]:checked');
                const countdownValue = selectedOption ? selectedOption.value : null;

                if (countdownValue) {
                    const expirationDate = calculateExpirationDate(countdownValue);
                    expirationDateInput.value = expirationDate;
                }
            });
        });

        // Function to calculate the expiration date based on the selected countdown option
        function calculateExpirationDate(countdownOption) {
            const now = new Date();
            const expirationDate = new Date(now.getTime() + countdownOption * 60 * 60 * 1000); // Add hours

            // Format the date as 'YYYY-MM-DDTHH:mm'
            const formattedDate = expirationDate.toISOString().slice(0, 16);
            return formattedDate;
        }
        // compte a rebours
        // Add event listeners to show/hide deferred options based on user selection
        var immediatCheckbox = document.getElementById('immediatCheckbox');
            var differeCheckbox = document.getElementById('differeCheckbox');
            var differeOptions = document.getElementById('differeOptions');

            immediatCheckbox.addEventListener('change', function () {
                if (immediatCheckbox.checked) {
                    differeCheckbox.checked = false;
                    differeOptions.style.display = 'none';
                }
            });

            differeCheckbox.addEventListener('change', function () {
                if (differeCheckbox.checked) {
                    immediatCheckbox.checked = false;
                    differeOptions.style.display = 'block';
                } else {
                    differeOptions.style.display = 'none';
                }
            });
    });






</script>
