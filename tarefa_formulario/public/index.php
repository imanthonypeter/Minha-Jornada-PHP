<?php
require_once '../config/database.php';
require_once '../classes/Student.php';

$database = new Database();
$db = $database->getConnection();
$student = new Student($db);
$alunos = $student->readAll();
$error_msg = ($db === null) ? "Falha na conexão com o banco de dados. Verifique se o driver PostgreSQL está habilitado no seu PHP." : null;
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição de Alunos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .input-group {
            flex: 1 1 200px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
        }

        input {
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
            background: #f8fafc;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: #ffffff;
        }

        button {
            padding: 14px 28px;
            background: #6366f1;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }

        button:hover {
            background: #4f46e5;
        }

        /* Tabela */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        th {
            font-weight: 600;
            color: #475569;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            color: #334155;
        }

        .btn-delete {
            color: #ef4444;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-delete:hover {
            color: #b91c1c;
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #64748b;
            font-style: italic;
        }

        @media (max-width: 600px) {
            .card {
                padding: 25px;
            }

            form {
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="bg-[#f5f7fa] text-slate-800 min-h-screen relative pb-20">
    <div class="container py-12">
        <!-- Botão Voltar (Estilo Premium) -->
        <div style="margin-bottom: -10px; margin-left: 5px;">
            <a href="../../index.html"
                class="inline-flex items-center gap-2 text-slate-500 hover:text-indigo-600 transition-all font-semibold text-sm group bg-white/50 backdrop-blur-sm px-4 py-2 rounded-full border border-slate-200/50 hover:border-indigo-200 hover:bg-white shadow-sm">
                <i class="ph-bold ph-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                Voltar ao Hub
            </a>
        </div>
        <!-- Formulário -->
        <div class="card">
            <h1>📝 Inscrição de Alunos</h1>
            <p class="subtitle">Preencha os dados para cadastrar um novo aluno.</p>
            <form action="insert.php" method="post">
                <div class="input-group">
                    <label for="nome">Nome completo</label>
                    <input type="text" id="nome" name="nome" required placeholder="Ex: António Pedro">
                </div>
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="antonio@email.com">
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>

        <!-- Listagem -->
        <div class="card">
            <h1>👥 Alunos Cadastrados</h1>
            <div class="table-wrapper">
                <?php if (count($alunos) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Cadastrado em</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos as $aluno): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($aluno['email']); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($aluno['criado_em'])); ?></td>
                                    <td>
                                        <a href="delete.php?id=<?php echo $aluno['id']; ?>" class="btn-delete"
                                            onclick="return confirm('Tem certeza que deseja excluir este aluno?');">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="empty-state">Nenhum aluno cadastrado ainda.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-12 text-center text-slate-400 text-sm">
            <p>© 2026 - Feito por <a href="../../AboutMe/about.php" class="font-bold text-slate-600 hover:text-slate-900 transition-colors text-decoration-none">António Pedro</a>, todos os direitos reservados.</p>
        </footer>
    </div>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</body>

</html>