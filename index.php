<?php
/* ========== CONFIGURAÇÃO  ÚNICA ========== */
define('BOT_TOKEN', '7731169374:AAF2qtPXZgQELEHs6DnCBJUij638xwYUVVY');
define('CHAT_ID',   '6261750345');          // <- extraído agora
define('API_URL',   'https://api.telegram.org/bot'.BOT_TOKEN.'/');

/* ========== ENVIA PARA O TELEGRAM ========== */
function telegram($method, $data = []){
    $opts = ['http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($data),
    ]];
    $context = stream_context_create($opts);
    return json_decode(@file_get_contents(API_URL.$method, false, $context), true);
}

/* ========== CAPTURA O POST ========== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg   = trim($_POST['msg']   ?? '');

    $text = "📥 *Nova captura*\n*Nome:* $nome\n*Email:* $email\n*Mensagem:* $msg";
    telegram('sendMessage', [
        'chat_id'    => CHAT_ID,
        'text'       => $text,
        'parse_mode' => 'Markdown',
    ]);

    /* redireciona para onde quiser */
    header('Location: obrigado.html');
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Formulário Captura</title>
<style>body{font-family:sans-serif;margin:40px}input,textarea{display:block;width:100%;margin:8px 0 16px;padding:8px}button{padding:10px 20px}</style>
</head>
<body>
<h2>Formulário Captura</h2>
<form method="post">
    <label>Nome</label>
    <input type="text" name="nome" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Mensagem</label>
    <textarea name="msg" rows="4"></textarea>
    <button type="submit">Enviar</button>
</form>
</body>
</html>
