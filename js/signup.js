const name = $("#name");
const surname = $("#surname");
const email = $("#email");
const password = $("#password");
const confirmPassword = $("#confirmpassword");

$("form").on("submit", validate);

function validate(event) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

    if (!emailRegex.test(email.val())) {
        email.get(0).setCustomValidity("Email address should have an @");
        event.preventDefault();
    }

    if (!passwordRegex.test(password.val())) {
        password.get(0).setCustomValidity("Password should have atleast 8 characters, contain upper and lower case letters, at least one digit and one symbol");
        event.preventDefault();
    }

    if (password.val() !== confirmPassword.val()) {
        confirmPassword.get(0).setCustomValidity("Passwords don't match");
        event.preventDefault();
    }
}
