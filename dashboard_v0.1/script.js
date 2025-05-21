
document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"], select');
    const totalPriceElement = document.getElementById('totalPrice');
    const customPageContainer = document.getElementById('customPageContainer');
    const addCustomPageButton = document.getElementById('addCustomPage');
    const accountPagesCheckbox = document.querySelector('input[name="accountPages"]');
    const loginPopupDiv = document.getElementById('LoginPopup');
    


    let totalPrice = 0;

    inputs.forEach(input => {
        input.addEventListener("change", updateTotalPriceAndCustomPages);
    });

    addCustomPageButton.addEventListener('click', addCustomPageInput);
    
    accountPagesCheckbox.addEventListener('change', hideShowPageOptions);
    

    function updateTotalPriceAndCustomPages() {
        let total = 0;
        inputs.forEach(input => {
            if (input.checked || input.type === 'select-one') {
                const price = parseFloat(input.getAttribute("data-price")) || 0;
                const percent = parseFloat(input.getAttribute("data-percent")) || 0;
                total += price + (total * (percent / 100));
            }
        });
        customPageContainer.querySelectorAll('.custom-page-input').forEach(customPageInput => {
            const customPagePrice = parseFloat(customPageInput.getAttribute("data-price")) || 0;
            total += customPagePrice;
        });
        totalPrice = total;
        updateTotalPrice();
    }

    function updateTotalPrice() {
        totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
    }

    function addCustomPageInput() {
        const customPageInput = document.createElement('div');
        customPageInput.classList.add('custom-page-input');
        customPageInput.setAttribute("data-price", "200");
        customPageInput.innerHTML = `
            <label>
                Custom Page Name: <input type="text" name="customPageNames[]">
            </label>
            <label>
                Custom Page Description: <input type="text" name="customPageDescriptions[]">
            </label>
            <button type="button" class="remove-custom-page">X</button>
        `;
        customPageContainer.appendChild(customPageInput);
        updateTotalPriceAndCustomPages(); // Update price when a custom page is added
        const removeButton = customPageInput.querySelector('.remove-custom-page');
        removeButton.addEventListener('click', () => {
            customPageContainer.removeChild(customPageInput);
            updateTotalPriceAndCustomPages(); // Update price when a custom page is removed
        });
    }

    function hideShowPageOptions(){
        if (accountPagesCheckbox.checked) {
            loginPopupDiv.style.display = 'block';
        } else {
            loginPopupDiv.style.display = 'none';
        }
    };
    
    //To enable/disable the "Login Pop--up from homepage" checkbox

    const loginPopupCheckbox = document.querySelector('input[name="loginPopup"]');
    const loginPopupRadio = document.querySelector('input[value="login_signup_popup"]');

    function handleLoginPopupRadioChange() {
        if (loginPopupRadio.checked) {
            loginPopupCheckbox.disabled = true;
            loginPopupCheckbox.checked = false;
        } else {
            loginPopupCheckbox.disabled = false;
        }
    }

    // Add an event listener to each account option radio
    const accountOptionRadios = document.querySelectorAll('input[name="accountOption"]');
    accountOptionRadios.forEach(radio => {
        radio.addEventListener('change', handleLoginPopupRadioChange);
    });

    // Call the function initially to set the correct state
    handleLoginPopupRadioChange();

});



