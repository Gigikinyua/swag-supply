const inputQuantity = document.getElementById("inputQuantity");

function checkout() {
    let quantity = inputQuantity.value;
    let color = $('input[name=color]:checked').val();

    sessionStorage.setItem("quantity", quantity);
    sessionStorage.setItem("color", color);
    window.location.replace("confirm-details.html")
}