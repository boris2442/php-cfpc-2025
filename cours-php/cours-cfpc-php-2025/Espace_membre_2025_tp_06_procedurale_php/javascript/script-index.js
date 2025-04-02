
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");
    console.log(togglePassword, passwordField);
        if (togglePassword && passwordField) {
            togglePassword.addEventListener("click", function () {
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
                this.classList.toggle("fa-eye-slash");
            });
        }
    });