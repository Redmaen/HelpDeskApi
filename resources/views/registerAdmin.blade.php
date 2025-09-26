<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            background-color: #dcdcdc;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form-titulo {
        width: 100%;
        text-align: center;
        color: #000000;
        background-color: #ffd768c1;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
        padding: 15px 0;
        border-radius: 15px 15px 0 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-sizing: border-box;
        }

        .form-contenedor {
            background-color: #dfdfdf;
            width: 900px;
            margin: 80px auto;
            border-radius: 30px;
            gap: 20px;
        }

        .campos-group{
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
        }

        .form-group {
        display: flex;
        flex-direction: column;
        padding: 30px;
        flex: 1 1 30%; 
        min-width: 280px;
        box-sizing: border-box;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        input {
            width: 40ch;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #fff8e7;
        }

        button {
            display: block;
            background-color: #ffa500;
            padding: 10px 20px;
            color: white;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border: 2px solid #cc8400;
            font-weight: bold;
        }
        .button-submit{
            margin: 40px 50px;
        }

        button:hover {
            background-color: #e69500;
        }

        .error-message {
            margin-top: 15px;
            padding: 10px;
            background-color: #fdd;
            border: 1px solid #f99;
            border-radius: 8px;
            color: #900;
        }
    </style>
</head>
<body>
    <div class="form-contenedor">
        <h2 class="form-titulo">Registrar Administrador</h2>
        <form action="{{ url('/api/register') }}" method="POST">
            @csrf
            <div class="campos-group">
                <input type="hidden" name="rol" value="admin">
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" placeholder="Nombre del usuario" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Correo" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                </div>
                <br>
            </div>
            <div class="button-submit">
                <button type="submit">Registrar</button>
            </div>
        </form>

        @if (isset($error))
            <div class="error-message">
                {{ $error }}
            </div>
        @endif
    </div>
</body>
</html>
