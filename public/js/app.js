
// HEADER

// Header categories dropdown
const headerCategoriesButtonElement = window.document.getElementById('header-categories-button-btn')
const headerCategoriesDropdownElement = window.document.getElementById('header-categories-dropdown-menu')
let isHeaderCategoriesDropdownMenuOpen = false
headerCategoriesButtonElement.addEventListener('click', () => {
    if(isHeaderCategoriesDropdownMenuOpen){
        headerCategoriesDropdownElement.style.display = "none"
        headerCategoriesButtonElement.classList.remove('header-categories-button-button-active')
        headerCategoriesButtonElement.classList.add('header-categories-button-button')
    } else {
        headerCategoriesDropdownElement.style.display = "flex"
        headerCategoriesButtonElement.classList.remove('header-categories-button-button')
        headerCategoriesButtonElement.classList.add('header-categories-button-button-active')
    }
    isHeaderCategoriesDropdownMenuOpen = !isHeaderCategoriesDropdownMenuOpen
})
// Header filter dropdown
const headerFilterButtonElement = window.document.getElementById('header-filter-button-btn')
const headerFilterDropdownElement = window.document.getElementById('header-filter-dropdown-menu')
const headerSearchButtonElement = window.document.getElementById('header-search-icon-mobile')
const headerSearchDropdownElement = window.document.getElementById('header-search-dropdown-menu')
let isHeaderFilterDropdownMenuOpen = false
let isHeaderSearchDropdownMenuOpen = false
headerFilterButtonElement.addEventListener('click', () => {
    if(isHeaderFilterDropdownMenuOpen){
        headerFilterDropdownElement.style.display = "none"
        
    } else {
        headerFilterDropdownElement.style.display = "flex"
       
    }
    isHeaderFilterDropdownMenuOpen = !isHeaderFilterDropdownMenuOpen
})
headerSearchButtonElement.addEventListener('click', () => {
    if(isHeaderFilterDropdownMenuOpen){
        headerSearchDropdownElement.style.display = "none"
        
    } else {
        headerSearchDropdownElement.style.display = "flex"
    }
    isHeaderSearchDropdownMenuOpen = !isHeaderSearchDropdownMenuOpen
})
// header region dropdown
const headerRegionsButtonElement = window.document.getElementById('header-search-location-btn')
const headerRegionsDropdownElement = window.document.getElementById('header-regions-dropdown-menu')
let isHeaderRegionsDropdownMenuOpen = false
headerRegionsButtonElement.addEventListener('click', () => {
    console.log(isHeaderRegionsDropdownMenuOpen)

    if(isHeaderRegionsDropdownMenuOpen){
        headerRegionsDropdownElement.style.display = "none"
        headerRegionsButtonElement.classList.remove('header-regions-button-button-active')
        headerRegionsButtonElement.classList.add('header-regions-button-button')
    } else {
        headerRegionsDropdownElement.style.display = "flex"
        headerRegionsButtonElement.classList.remove('header-regions-button-button')
        headerRegionsButtonElement.classList.add('header-regions-button-button-active')
    }
    isHeaderRegionsDropdownMenuOpen = !isHeaderRegionsDropdownMenuOpen
})
// hide region dropdown when click outside
const regionIcon=window.document.getElementById("region-icon") 
document.addEventListener('click', function handleClickOutsideBox(event) {
   
   
    
  
    if (!headerRegionsDropdownElement.contains(event.target) && event.target!=headerRegionsButtonElement && event.target!=regionIcon  ) {
        headerRegionsDropdownElement.style.display = "none"
    }
  });
  
