let sortByButton = document.getElementById("sort-by-order");
let sortByInput = document.getElementById("sort-by-order-input");

changeSortByOrder = () => {
    sortByInput.value = (sortByInput.value === "DESC") ? "ASC" : "DESC";
    document.getElementById("sort-and-show").submit();
}

sortByButton.addEventListener("click", changeSortByOrder);