
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json; charset=UTF-8');

function responder(int $status, array $dados): void
{
    http_response_code($status);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

// Validar requisição
if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    ($_POST['form_type'] ?? '') !== 'trabalhe_conosco'
) {
    responder(400, [
        'sucesso' => false,
        'mensagem' => 'Requisição inválida.'
    ]);
}

// Carregar PHPMailer a partir da raiz
require_once __DIR__ . '/vendor/autoload.php';

// Receber dados
$nome     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telefone = trim($_POST['phone'] ?? '');
$area     = trim($_POST['position'] ?? '');
$mensagem = trim($_POST['message'] ?? '');



$arquivo = $_FILES['file'];
$limiteBytes = 5 * 1024 * 1024; // 5 MB

if ($arquivo['size'] > $limiteBytes) {
    responder(422, [
        'sucesso' => false,
        'mensagem' => 'O currículo deve ter no máximo 5 MB.'
    ]);
}

// Validar extensão e tipo real do arquivo
$extensao = strtolower(
    pathinfo($arquivo['name'], PATHINFO_EXTENSION)
);

if (!in_array($extensao, ['pdf', 'doc', 'docx'], true)) {
    responder(422, [
        'sucesso' => false,
        'mensagem' => 'Envie o currículo em formato PDF, DOC ou DOCX.'
    ]);
}

$tiposPermitidos = [
    'pdf'  => ['application/pdf'],
    'doc'  => ['application/msword'],
    'docx' => [
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ]
];

$finfo = new \finfo(FILEINFO_MIME_TYPE);
$tipoArquivo = $finfo->file($arquivo['tmp_name']);

if (!in_array($tipoArquivo, $tiposPermitidos[$extensao], true)) {
    responder(422, [
        'sucesso' => false,
        'mensagem' => 'O conteúdo do arquivo não corresponde ao formato informado.'
    ]);
}

$mail = new PHPMailer(true);

try {
    // Configuração SMTP já utilizada no projeto
    $mail->isSMTP();
    $mail->Host       = 'smtps.uhserver.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'quality@qualityltda.com.br';
    $mail->Password   = 'keGilo99';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(
        'quality@qualityltda.com.br',
        'Quality Ltda - Site'
    );

    $mail->addAddress(
        'quality@qualityltda.com.br',
        'Equipe Quality'
    );

    $mail->addReplyTo($email, $nome);

    // Escapar dados para o corpo HTML
    $nomeHtml = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    $emailHtml = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $telefoneHtml = htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8');
    $areaHtml = htmlspecialchars($area, ENT_QUOTES, 'UTF-8');
    $mensagemHtml = nl2br(
        htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8')
    );

    $mail->Subject = "Novo Currículo Recebido: $nome - $area";
    $mail->isHTML(true);

    $mail->Body = "
        <h3>Novo currículo recebido pelo Trabalhe Conosco</h3>
        <p><b>Nome:</b> {$nomeHtml}</p>
        <p><b>E-mail:</b> {$emailHtml}</p>
        <p><b>Telefone:</b> {$telefoneHtml}</p>
        <p><b>Área de atuação:</b> {$areaHtml}</p>
        <p><b>Mensagem:</b><br>{$mensagemHtml}</p>
    ";

    // Anexar currículo após validar o arquivo
    $nomeArquivo = basename($arquivo['name']);

    $mail->addAttachment(
        $arquivo['tmp_name'],
        $nomeArquivo
    );

    $mail->send();

    responder(200, [
        'sucesso' => true,
        'mensagem' => 'Currículo enviado com sucesso! Agradecemos seu interesse.'
    ]);

} catch (\Throwable $e) {
    error_log('[TRABALHE CONOSCO] ' . $e->getMessage());

    if ($e instanceof Exception) {
        error_log('[PHPMailer] ' . $mail->ErrorInfo);
    }

    responder(500, [
        'sucesso' => false,
        'mensagem' => 'Não foi possível enviar seu currículo. Tente novamente.'
    ]);
}
