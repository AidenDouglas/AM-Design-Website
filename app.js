function showMessage(message) {
    alert(message);
  }
  
  document.getElementById("subscribe-button").addEventListener("click", function () {
    const email = document.getElementById("email").value;
    const formData = new FormData();
    formData.append("email", email);
  
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
  