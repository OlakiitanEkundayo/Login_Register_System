const password = document.querySelector("#password");
const confirmPassword = document.querySelector("#confirmpassword");
const message = document.querySelector("#match-message");

function checkPasswordMatch() {
  if (confirmPassword.value === "") {
    message.textContent = "";
    return;
  }

  if (password.value === confirmPassword.value) {
    message.className = "match";
    message.textContent = "Passwords Match✅";
  } else {
    message.className = "no-match";
    message.textContent = "Password do not match ❌";
  }
}

password.addEventListener("input", checkPasswordMatch);
confirmPassword.addEventListener("input", checkPasswordMatch);

// console.log("Hello");
