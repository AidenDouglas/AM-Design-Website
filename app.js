function showMessage(message) {
    alert(message);
  }
  
  document.getElementById("subscribe-form").addEventListener("submit", function (event) {
    event.preventDefault();
    const form = this;
    if (!form.checkValidity()) {
      return;
    }

    const formData = new FormData(form);
  
    fetch("index.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error("Server response was not OK");
        }
      })
      .then((data) => {
        showMessage(data.message);
      })
      .catch((error) => {
        showMessage("Error: " + error.message);
      });
  });
  