document.addEventListener("DOMContentLoaded", function () {
  const form: HTMLFormElement | null = document.querySelector(".main-form");

  const phoneInput: HTMLInputElement | null = document.getElementById(
    "contact_phone"
  ) as HTMLInputElement;
  phoneInput!.addEventListener("input", function (e: Event) {
    const target = e.target as HTMLInputElement;
    let value: string = target.value.replace(/[^\d+]/g, "");

    console.log(e);

    if (value.indexOf("+") !== 0) {
      value = "+" + value;
    }

    if (value.length > 12) {
      value = value.slice(0, 12);
    }

    target.value = value;
  });

  form!.addEventListener("submit", function (event: Event) {
    let hasErrors: boolean = false;

    const sellerName: HTMLInputElement | null = document.getElementById(
      "seller_name"
    ) as HTMLInputElement;
    const nameRegex: RegExp = /^[а-яА-ЯёЁa-zA-Z\s-]+$/;

    if (!nameRegex.test(sellerName!.value)) {
      showError(
        sellerName,
        "Имя продавца может содержать только буквы и пробелы"
      );
      hasErrors = true;
    } else {
      clearError(sellerName);
    }

    const phone: HTMLInputElement | null = document.getElementById(
      "contact_phone"
    ) as HTMLInputElement;
    const phoneRegex: RegExp = /^\+\d{11}$/;

    if (!phoneRegex.test(phone!.value)) {
      showError(
        phone,
        "Телефон должен содержать 11 цифр, например: +79001002030"
      );
      hasErrors = true;
    } else {
      clearError(phone);
    }

    const email: HTMLInputElement | null = document.getElementById(
      "contact_email"
    ) as HTMLInputElement;
    const emailRegex: RegExp =
      /^[a-zA-Z0-9._%+-]+@(gmail\.com|yandex\.(ru)|mail\.ru)$/i;

    if (!emailRegex.test(email!.value)) {
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

  function showError(element: HTMLElement, message: string): void {
    clearError(element);

    const errorDiv: HTMLDivElement = document.createElement("div");
    errorDiv.className = "error-message-valid";
    errorDiv.textContent = message;
    errorDiv.style.color = "red";
    errorDiv.style.fontSize = "14px";
    errorDiv.style.fontWeight = "bold";
    errorDiv.style.marginTop = "5px";
    errorDiv.style.backgroundColor = "transparent";

    element.parentNode?.appendChild(errorDiv);
    element.style.borderColor = "none";
  }

  function clearError(element: HTMLElement): void {
    const errorDiv: HTMLDivElement | null = element.parentNode?.querySelector(
      ".error-message-valid"
    ) as HTMLDivElement | null;
    if (errorDiv) {
      element.parentNode?.removeChild(errorDiv);
    }

    element.style.borderColor = "inherit";
  }

  document
    .querySelectorAll(".message-popup-close, .message-popup-overlay")
    .forEach((element: Element) => {
      element.addEventListener("click", () => {
        const overlay = document.querySelector(
          ".message-popup-overlay"
        ) as HTMLElement;
        const popup = document.querySelector(".message-popup") as HTMLElement;
        if (overlay) overlay.style.display = "none";
        if (popup) popup.style.display = "none";
      });
    });
});
