
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#mdp");

    togglePassword.addEventListener("click", function () {
        // Bascule entre "password" et "text"
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Change l'icône
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
