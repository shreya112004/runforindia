document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const messageBox = document.getElementById("contactMessage");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      const formData = new FormData(form);
  
      fetch("contact.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.text())
      .then(res => {
        if (res.trim() === "success") {
          messageBox.textContent = "Message sent successfully!";
          messageBox.className = "mt-4 text-green-600 text-center font-semibold";
          messageBox.classList.remove("hidden");
          form.reset();
        } else {
          showError(res);
        }
      })
      .catch(() => {
        showError("Something went wrong. Please try again later.");
      });
  
      function showError(msg) {
        messageBox.textContent = msg;
        messageBox.className = "mt-4 text-red-600 text-center font-semibold";
        messageBox.classList.remove("hidden");
      }
    });
  });
  