const form = document.getElementById("register-form");
const spinner = document.getElementById("loader");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const [email, fname, lname, dob, password] = form.elements;
  spinner.style.display = "block";
  const payload = {
    email: email.value,
    firstname: fname.value,
    lastname: lname.value,
    dateofbirth: dob.value,
    password: password.value,
  };
  fetch("php/register.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(payload),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data.success === true) {
        localStorage.setItem("AUTH_TOKEN", data.data.id);
        window.location.href = "profile.html";
      }
    })
    .catch((err) => {
      alert("Something Went Wrong! Try Again");
      console.error(err);
    })
    .finally(() => {
      spinner.style.display = "none";
    });
});
