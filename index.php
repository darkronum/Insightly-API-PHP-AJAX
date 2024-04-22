<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>API Insightly - PHP AJAX</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="card">
        <form id="api" method="post">
            <label for="firstname">Primeiro Nome:</label>
            <input type="text" id="firstname" name="firstname" required>
            <label for="lastname">Último Nome:</label>
            <input type="text" id="lastname" name="lastname" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="phone">Telefone:</label>
            <input type="tel" id="phone" name="phone" required>
            <label for="city">Cidade:</label>
            <input type="text" id="city" name="city" required>
            <label for="state">Estado:</label>
            <input type="text" id="state" name="state" required>
            <button type="button" id="submitButton" onclick="sendAPI()">Enviar</button>
        </form>
    </div>
    <script src="ajax.js"></script>
</body>
</html>
