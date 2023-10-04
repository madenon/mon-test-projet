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
