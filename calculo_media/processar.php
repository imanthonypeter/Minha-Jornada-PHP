<?php
// Receber os dados do formulário
$nome = $_POST['nome'] ?? 'Estudante';
$n1 = $_POST['nota1'] ?? 0;
$n2 = $_POST['nota2'] ?? 0;
$n3 = $_POST['nota3'] ?? 0;

// Calcular a média
$media = ($n1 + $n2 + $n3) / 3;
$media_formatada = number_format($media, 1);

// Definir status
if ($media >= 10) {
    $status = "APROVADO";
    $class_status = "status-approved";
} else {
    $status = "REPROVADO";
    $class_status = "status-failed";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - <?php echo $nome; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Botão Voltar -->
    <a href="../index.html" class="btn-voltar">
        <i class="ph ph-arrow-left"></i>
        Voltar ao Hub
    </a>

    <div class="container">
        <h1>Resultado Final</h1>
        <p class="subtitle">Desempenho acadêmico de <strong><?php echo $nome; ?></strong></p>

        <div class="result-card <?php echo $class_status; ?>">
            <p style="text-align: center; color: var(--text-muted); font-size: 0.9rem;">Média Calculada</p>
            <div class="result-value"><?php echo $media_formatada; ?></div>
            <p style="text-align: center; font-weight: 600; font-size: 1.1rem;">
                Status: <span
                    style="color: <?php echo ($media >= 10 ? '#10b981' : '#ef4444'); ?>"><?php echo $status; ?></span>
            </p>
        </div>

        <div style="margin-top: 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
            <p>Notas individuais:</p>
            <ul style="list-style: none; margin-top: 0.5rem; display: flex; justify-content: space-around;">
                <li><span style="color: white; font-weight: 600;"><?php echo $n1; ?></span> <small>(N1)</small></li>
                <li><span style="color: white; font-weight: 600;"><?php echo $n2; ?></span> <small>(N2)</small></li>
                <li><span style="color: white; font-weight: 600;"><?php echo $n3; ?></span> <small>(N3)</small></li>
            </ul>
        </div>

        <a href="index.html" class="back-link">← Voltar para o formulário</a>

        <!-- Footer -->
        <footer class="main-footer">
            <p>© 2026 - Feito por <a href="../AboutMe/about.php" style="color: inherit; text-decoration: none;"><b>António Pedro</b></a></p>
        </footer>
    </div>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</body>

</html>