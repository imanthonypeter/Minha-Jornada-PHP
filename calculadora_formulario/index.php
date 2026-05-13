<?php
$resultado = null;
$erro = "";
$numero1 = "";
$numero2 = "";
$operacao = "+";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero1 = $_POST["numero1"] ?? "";
    $numero2 = $_POST["numero2"] ?? "";
    $operacao = $_POST["operacao"] ?? "+";

    if (!is_numeric($numero1) || !is_numeric($numero2)) {
        $erro = "Introduz valores numericos validos.";
    } else {
        $n1 = (float) $numero1;
        $n2 = (float) $numero2;

        switch ($operacao) {
            case "+":
                $resultado = $n1 + $n2;
                break;
            case "-":
                $resultado = $n1 - $n2;
                break;
            case "*":
                $resultado = $n1 * $n2;
                break;
            case "/":
                if ($n2 == 0.0) {
                    $erro = "Nao e permitido dividir por zero.";
                } else {
                    $resultado = $n1 / $n2;
                }
                break;
            default:
                $erro = "Operacao invalida.";
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora com Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light min-h-screen relative pb-5">
    <!-- Botão Voltar -->
    <a href="../index.html" class="btn btn-light shadow-sm border rounded-pill position-fixed top-0 start-0 m-4 z-3 flex align-items-center gap-2 px-3 py-2" style="font-weight: 600; font-size: 0.85rem;">
        ← Voltar ao Hub
    </a>

    <div class="container py-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="h4 mb-1 fw-bold text-dark">Calculadora Simples</h2>
                            <p class="text-muted small">Realize operações matemáticas básicas</p>
                        </div>

                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Primeiro número</label>
                                <input class="form-control form-control-lg border-light-subtle bg-light" type="text" name="numero1"
                                    value="<?php echo htmlspecialchars($numero1); ?>" required placeholder="0">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold">Segundo número</label>
                                <input class="form-control form-control-lg border-light-subtle bg-light" type="text" name="numero2"
                                    value="<?php echo htmlspecialchars($numero2); ?>" required placeholder="0">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold">Operação</label>
                                <select class="form-select form-select-lg border-light-subtle bg-light" name="operacao">
                                    <option value="+" <?php echo $operacao === "+" ? "selected" : ""; ?>>Soma (+)</option>
                                    <option value="-" <?php echo $operacao === "-" ? "selected" : ""; ?>>Subtração (-)</option>
                                    <option value="*" <?php echo $operacao === "*" ? "selected" : ""; ?>>Multiplicação (*)</option>
                                    <option value="/" <?php echo $operacao === "/" ? "selected" : ""; ?>>Divisão (/)</option>
                                </select>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 shadow-sm mt-2" type="submit">Calcular</button>
                        </form>

                        <?php if ($erro !== ""): ?>
                            <div class="alert alert-danger border-0 shadow-sm mt-4 mb-0"><?php echo $erro; ?></div>
                        <?php elseif ($resultado !== null): ?>
                            <div class="alert alert-success border-0 shadow-sm mt-4 mb-0 py-3">
                                <div class="small text-success-emphasis opacity-75">Resultado Final</div>
                                <div class="h3 mb-0 fw-bold"><?php echo $resultado; ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Footer -->
                <footer class="mt-5 text-center text-secondary small">
                    <p>© 2026 - Feito por <a href="../AboutMe/about.php" class="fw-bold text-dark text-decoration-none hover:text-primary transition-colors">António Pedro</a>, todos os direitos reservados.</p>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>