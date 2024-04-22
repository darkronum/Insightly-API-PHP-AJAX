async function sendAPI() {
    const form = document.getElementById("api");
    const formData = new FormData(form);
    const submitButton = document.getElementById("submitButton");

    try {
        const response = await fetch("insightly.php", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        });

        if (response.ok) {
            console.log(await response.text());
            submitButton.textContent = "Enviado!";
            submitButton.disabled = true;
        } else {
            console.error("Erro ao enviar requisição: " + response.status);
            submitButton.textContent = "Erro! Ver console";
            submitButton.disabled = true;
        }
    } catch (error) {
        console.error("Erro ao enviar requisição:", error);
        submitButton.textContent = "Erro! Ver console";
        submitButton.disabled = true;
    }
}
