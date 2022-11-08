const form = document.getElementById("login-form");
const spinner = document.getElementById("loader");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const [email, password] = form.elements;
  spinner.style.display = "block";
  fetch(`php/login.php?email=${email.value}&password=${password.value}`)
    .then((res) => res.json())
    .then((data) => {
      if (data.success === true) {
        localStorage.setItem("AUTH_TOKEN", data.data.id);
        window.location.href = "profile.html";
      } else {
        alert("Are You Trying To Signup ?");
      }
    })
    .catch((err) => {
      alert("Something Went Wrong!! Try Again");
      console.error(err);
    })
    .finally(() => {
      spinner.style.display = "none";
      email.value = "";
      password.value = "";
    });
});
