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