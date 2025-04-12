document.addEventListener('DOMContentLoaded', function () {
  const minusBtn = document.getElementById('minus-btn');
  const plusBtn = document.getElementById('plus-btn');
  const quantityInput = document.getElementById('quantity-input');
  const hiddenInput = document.getElementById('hidden-input');

  function updateHiddenInput() {
    hiddenInput.value = quantityInput.value;
  }

  minusBtn.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
      updateHiddenInput();
    }
  });

  plusBtn.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateHiddenInput();
  });

  quantityInput.addEventListener('input', function () {
    let currentValue = parseInt(quantityInput.value);
    if (isNaN(currentValue) || currentValue < 1) {
      quantityInput.value = 1;
    }
    updateHiddenInput();
  });

  // Initialize hidden input value
  updateHiddenInput();
});