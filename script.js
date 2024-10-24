const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");
const container = document.getElementById("container");

// Event listener untuk tombol Register
signUpButton.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

// Event listener untuk tombol Login
signInButton.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});