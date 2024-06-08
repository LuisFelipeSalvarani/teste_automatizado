<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/drop-bold.svg" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/comum.css" />
    <link rel="stylesheet" href="/assets/css/fonts/style.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="assets/css/menssagem.css">
    <script src="/assets/js/app.js" defer></script>
    <title>HydroFlow</title>
</head>
<body>
    <div class="login-container">
        <div class="login">
            <h1 class="nav-title">Hydr<i class="ph-bold ph-drop"></i>Flow</h1>
            <h2>Entrar</h2>
            <?php include(TEMPLATE_PATH . '/messages.php') ?>
            <form action="#" method="post" class="form">
                <div class="form-group">
                    <input class="form-input <?= !empty($errors) || isset($message['message']) ? 'invalid' : '' ?>" type="text" name="usuario" id="usuario" placeholder="Usuário" value="<?= !empty($usuario) ? $usuario : '' ?>">
                    <!-- <label class="form-label" for="usuario" autofocus>Usuário</label> -->
                    <div class="invalid-feedback">
                        <?= $errors['usuario'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-input <?= !empty($errors['senha']) || isset($message['message']) ? 'invalid' : '' ?>" type="password" name="senha" id="senha" placeholder="Senha">
                    <!-- <label class="form-label" for="senha">Senha</label> -->
                    <div class="invalid-feedback">
                        <?= $errors['senha'] ?>
                    </div>
                </div>
                <button class="btn-submit">Entrar</button>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</body>
</html>