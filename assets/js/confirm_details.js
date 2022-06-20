var quantity  = sessionStorage.getItem("quantity");
var color  = sessionStorage.getItem("color");

const txtOrderDetails = document.getElementById("txtOrderDetails");
const txtTotal = document.getElementById("txtTotal");
const countySelect = document.getElementById("countySelect");
const inputFullAddress = document.getElementById("inputFullAddress");
const inputFullNames = document.getElementById("inputFullNames");
const inputPhoneNumber = document.getElementById("inputPhoneNumber");
const inputEmailAddress = document.getElementById("inputEmailAddress");
const inputOrderNotes = document.getElementById("inputOrderNotes");

let amount = 2500 * quantity;
txtOrderDetails.innerHTML = 'Top Luxury European and American Watch (' + color + ') × ' + quantity + '<span>Ksh. ' + amount + '</span></li>'
txtTotal.innerHTML = "Ksh. " + amount;

function placeOrder() {
    let county = countySelect.options[countySelect.selectedIndex].value;
    let address = inputFullAddress.value;
    let names = inputFullNames.value;
    let phone = inputPhoneNumber.value;
    let email = inputEmailAddress.value;
    let notes = inputOrderNotes.value;

    let error = false
    let errorMessage = "";

    if (address.length < 1) {
        error = true;
        errorMessage = "Enter full address";
    } else if (names.length < 1) {
        error = true;
        errorMessage = "Enter full names";
    } else if (phone.length < 1) {
        error = true;
        errorMessage = "Enter your phone number";
    } else if (email.length < 1) {
        error = true;
        errorMessage = "Enter your email address";
    }

    if (error) {
        handleError(errorMessage);
    } else {
        let formData = new FormData();
        formData.append('name', "Top Luxury European and American Watch");
        formData.append('color', color);
        formData.append('quantity', quantity);
        formData.append('county', county);
        formData.append('address', address);
        formData.append('names', names);
        formData.append('phone', phone);
        formData.append('email', email);
        formData.append('notes', notes);
        formData.append('total', "Ksh. " + amount);

        $.ajax({
            type: 'POST',
            url: "datascript?request=place_orders",
            data: {
                name: "Top Luxury European and American Watch",
                color: color,
                quantity: quantity,
                county: county,
                address: address,
                names: names,
                phone: phone,
                email: email,
                notes: notes,
                total: amount
            },
            success: response => {
                var link=document.createElement('a');
                document.body.appendChild(link);
                link.href=window.location.origin + "/swag/order_details.xls";
                link.click();
            },
            error: (err) => {
                handleError(err.statusText)
            },
        })
    }
}

function handleError(errorMessage) {
    toastr.error(errorMessage);
}
