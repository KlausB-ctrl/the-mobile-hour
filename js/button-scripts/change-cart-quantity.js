let quantityInput = document.getElementById("addtocart-amount");

let reduceCartQuantity = document.getElementById("reduce-addtocart");
let increaseCartQuantity = document.getElementById("increase-addtocart");

if(quantityInput.max === 1) increaseCartQuantity.disabled = true;

function changeQuantity(event) {
    quantityInput.value = (event.target.getAttribute('id') === "increase-addtocart") ? ++quantityInput.value : --quantityInput.value;
    reduceCartQuantity.disabled = (quantityInput.value === '1') ? true : false;
    increaseCartQuantity.disabled = (quantityInput.value === quantityInput.max) ? true : false;
};

reduceCartQuantity.addEventListener("click", changeQuantity);
increaseCartQuantity.addEventListener("click", changeQuantity);