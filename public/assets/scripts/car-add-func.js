document.addEventListener("DOMContentLoaded", function () {
  var form = document.querySelector(".main-form");
  var phoneInput = document.getElementById("contact_phone");
  phoneInput.addEventListener("input", function (e) {
    var target = e.target;
    var value = target.value.replace(/[^\d+]/g, "");
    console.log(e);
    if (value.indexOf("+") !== 0) {
      value = "+" + value;
    }
    if (value.length > 12) {
      value = value.slice(0, 12);
    }
    target.value = value;
  });
  form.addEventListener("submit", function (event) {
    var hasErrors = false;
    var sellerName = document.getElementById("seller_name");
    var nameRegex = /^[а-яА-ЯёЁa-zA-Z\s-]+$/;
    if (!nameRegex.test(sellerName.value)) {
      showError(
        sellerName,
        "Имя продавца может содержать только буквы и пробелы"
      );
      hasErrors = true;
    } else {
      clearError(sellerName);
    }
    var phone = document.getElementById("contact_phone");
    var phoneRegex = /^\+\d{11}$/;
    if (!phoneRegex.test(phone.value)) {
      showError(
        phone,
        "Телефон должен содержать 11 цифр, например: +79001002030"
      );
      hasErrors = true;
    } else {
      clearError(phone);
    }
    var email = document.getElementById("contact_email");
    var emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail\.com|yandex\.(ru)|mail\.ru)$/i;
    if (!emailRegex.test(email.value)) {
      showError(
        email,
        "Разрешены только адреса от gmail.com, yandex.ru или mail.ru"
      );
      hasErrors = true;
    } else {
      clearError(email);
    }
    if (hasErrors) {
      event.preventDefault();
    }
  });
  function showError(element, message) {
    var _a;
    clearError(element);
    var errorDiv = document.createElement("div");
    errorDiv.className = "error-message-valid";
    errorDiv.textContent = message;
    errorDiv.style.color = "red";
    errorDiv.style.fontSize = "14px";
    errorDiv.style.fontWeight = "bold";
    errorDiv.style.marginTop = "5px";
    errorDiv.style.backgroundColor = "transparent";
    (_a = element.parentNode) === null || _a === void 0
      ? void 0
      : _a.appendChild(errorDiv);
    element.style.borderColor = "none";
  }
  function clearError(element) {
    var _a, _b;
    var errorDiv =
      (_a = element.parentNode) === null || _a === void 0
        ? void 0
        : _a.querySelector(".error-message-valid");
    if (errorDiv) {
      (_b = element.parentNode) === null || _b === void 0
        ? void 0
        : _b.removeChild(errorDiv);
    }
    element.style.borderColor = "inherit";
  }
  document
    .querySelectorAll(".message-popup-close, .message-popup-overlay")
    .forEach(function (element) {
      element.addEventListener("click", function () {
        var overlay = document.querySelector(".message-popup-overlay");
        var popup = document.querySelector(".message-popup");
        if (overlay) overlay.style.display = "none";
        if (popup) popup.style.display = "none";
      });
    });
});
