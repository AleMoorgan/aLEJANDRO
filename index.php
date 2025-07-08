<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Armería RDR2</title>
<style>
  body {
    background: #3b2f2f;
    font-family: 'Georgia', serif;
    color: #f4f1e9;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
  }
  .login-container {
    background: #422f2f;
    padding: 30px 40px;
    border: 3px solid #7b5e57;
    box-shadow: 0 0 20px #7b5e57;
    width: 320px;
    border-radius: 12px;
  }
  .login-container h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
    color: #d9c4a3;
    letter-spacing: 3px;
  }
  label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #c9b799;
  }
  input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: none;
    border-radius: 6px;
    background: #5a4a42;
    color: #f4f1e9;
    font-size: 16px;
    box-sizing: border-box;
  }
  input[type="submit"] {
    width: 100%;
    background: #a97855;
    border: none;
    padding: 12px;
    font-size: 18px;
    font-weight: 700;
    color: #3b2f2f;
    cursor: pointer;
    border-radius: 6px;
    transition: background 0.3s ease;
  }
  input[type="submit"]:hover {
    background: #d9c4a3;
  }
  .footer {
    margin-top: 15px;
    font-size: 12px;
    text-align: center;
    color: #7b5e57;
  }
</style>
</head>
<body>

<div class="login-container">
  <h1>ARMS LOGIN</h1>
  <form method="POST" action="login.php">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" required autocomplete="off" />
    
    <label for="contrasena">Contraseña</label>
    <input type="password" id="contrasena" name="contrasena" required />
    
    <input type="submit" value="Entrar" />
  </form>
  <div class="footer">Armería RDR2 Edition</div>
</div>

</body>
</html>
