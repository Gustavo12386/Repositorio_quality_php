
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

// Validar a requisição
if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    ($_POST['form_type'] ?? '') !== 'contato_geral'
) {
    responder(400, [
        'sucesso' => false,
        'mensagem' => 'Requisição inválida.'
    ]);
}

// Carregar o PHPMailer a partir da raiz do projeto
require_once __DIR__ . '/vendor/autoload.php';

$nome     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telefone = trim($_POST['phone'] ?? '');
$horario  = trim($_POST['time'] ?? '');
$mensagem = trim($_POST['message'] ?? '');


$mail = new PHPMailer(true);

try {
    // Mantenha a configuração SMTP que já funcionava.
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    // Configure essas variáveis no ambiente do PHP.
    // Se ainda não as configurou, veja a observação abaixo.
    $mail->Username   = 'calderarogustavo@gmail.com';
    $mail->Password   = 'cpmp wneq zlee nmxh';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';

    if (!$mail->Username || !$mail->Password) {
        throw new \RuntimeException(
            'Credenciais SMTP não configuradas.'
        );
    }

    $mail->setFrom(
        'calderarogustavo@gmail.com',
        'Quality Ltda - Site'
    );

    $mail->addAddress(
        'calderarogustavo@gmail.com',
        'Equipe Quality'
    );

    $mail->addReplyTo($email, $nome);

    $mail->Subject = "Novo Contato Geral: $nome";
    $mail->isHTML(true);

    $nomeHtml = htmlspecialchars(
        $nome, ENT_QUOTES, 'UTF-8'
    );
    $emailHtml = htmlspecialchars(
        $email, ENT_QUOTES, 'UTF-8'
    );
    $telefoneHtml = htmlspecialchars(
        $telefone, ENT_QUOTES, 'UTF-8'
    );
    $horarioHtml = htmlspecialchars(
        $horario, ENT_QUOTES, 'UTF-8'
    );
    $mensagemHtml = nl2br(htmlspecialchars(
        $mensagem, ENT_QUOTES, 'UTF-8'
    ));

    $mail->Body = "
        <h3>Novo contato através do formulário</h3>
        <p><b>Nome:</b> {$nomeHtml}</p>
        <p><b>E-mail:</b> {$emailHtml}</p>
        <p><b>Telefone:</b> {$telefoneHtml}</p>
        <p><b>Melhor horário:</b> {$horarioHtml}</p>
        <p><b>Mensagem:</b><br>{$mensagemHtml}</p>
    ";

    $mail->send();

    responder(200, [
        'sucesso' => true,
        'mensagem' => 'Informações enviadas com sucesso!'
    ]);

} catch (\Throwable $e) {
    error_log(
        '[CONTATO] ' . $e->getMessage()
    );

    if ($e instanceof Exception) {
        error_log('[PHPMailer] ' . $mail->ErrorInfo);
    }

    responder(500, [
        'sucesso' => false,
        'mensagem' =>
            'Não foi possível enviar sua mensagem. Tente novamente.'
    ]);
}
