<?php
require_once 'config/database.php';

// Busca todos os alunos cadastrados
try {
    $stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $alunos = [];
    $erro_db = "Erro ao buscar alunos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição de Alunos</title>
    <!-- Tailwind CSS via CDN para estilização rápida e moderna -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ícones Phosphor -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Fonte Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen py-10 px-4 sm:px-6 lg:px-8 relative pb-24">
    <!-- Botão Voltar -->
    <a href="../index.html" class="fixed top-6 left-6 bg-white shadow-sm border border-slate-200 text-slate-600 px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-slate-50 transition-all group z-50 text-sm font-semibold no-underline">
        <i class="ph ph-arrow-left group-hover:-translate-x-1 transition-transform"></i>
        Voltar ao Hub
    </a>

    <div class="max-w-6xl mx-auto space-y-8">

        <!-- Cabeçalho -->
        <div class="text-center">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 mb-4">
                <i class="ph-fill ph-graduation-cap text-3xl text-indigo-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">
                Gestão de Alunos (v1)
            </h1>
            <p class="mt-2 text-base text-slate-500">
                Cadastre novos alunos e gerencie as inscrições ativas da escola.
            </p>
        </div>

        <?php if (isset($erro_db)): ?>
            <div class="rounded-xl bg-red-50 p-4 border border-red-200 shadow-sm max-w-2xl mx-auto">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ph-fill ph-warning-circle text-red-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-red-800">Erro de Conexão com o Banco de Dados</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p><?= htmlspecialchars($erro_db) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Área do Formulário -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center gap-2">
                            <i class="ph-bold ph-user-plus text-indigo-500 text-lg"></i>
                            Nova Inscrição
                        </h3>
                    </div>
                    <div class="px-6 py-6">
                        <form action="actions/insert.php" method="POST" class="space-y-5">
                            <div>
                                <label for="nome" class="block text-sm font-medium leading-6 text-slate-900">Nome
                                    Completo</label>
                                <div class="mt-2 relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="ph ph-user text-slate-400 text-lg"></i>
                                    </div>
                                    <input type="text" name="nome" id="nome" required
                                        class="block w-full rounded-lg border-0 py-2.5 pl-10 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 outline-none transition-all"
                                        placeholder="Ex: Anthony">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-slate-900">Endereço
                                    de E-mail</label>
                                <div class="mt-2 relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <i class="ph ph-envelope text-slate-400 text-lg"></i>
                                    </div>
                                    <input type="email" name="email" id="email" required
                                        class="block w-full rounded-lg border-0 py-2.5 pl-10 text-slate-900 ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 outline-none transition-all"
                                        placeholder="Ex: anthony@exemplo.com">
                                </div>
                            </div>

                            <div class="pt-3">
                                <button type="submit"
                                    class="flex w-full justify-center items-center gap-2 rounded-lg bg-indigo-600 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                                    <i class="ph-bold ph-paper-plane-right text-lg"></i>
                                    Inscrever Aluno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Área da Tabela -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-2xl overflow-hidden h-full flex flex-col">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h3 class="text-base font-semibold leading-6 text-slate-900 flex items-center gap-2">
                            <i class="ph-bold ph-users text-indigo-500 text-lg"></i>
                            Alunos Cadastrados
                        </h3>
                        <span
                            class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                            <?= count($alunos) ?> registro(s)
                        </span>
                    </div>

                    <div class="overflow-x-auto grow">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col"
                                        class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-3 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Aluno</th>
                                    <th scope="col"
                                        class="px-3 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Contato</th>
                                    <th scope="col" class="relative py-4 pl-3 pr-6 text-right">
                                        <span class="sr-only">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                <?php foreach ($alunos as $aluno): ?>
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-slate-400">
                                            #<?= htmlspecialchars($aluno['id']) ?>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-slate-900">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xs ring-1 ring-indigo-100">
                                                    <?= strtoupper(substr($aluno['nome'] ?? '', 0, 2)) ?>
                                                </div>
                                                <?= htmlspecialchars($aluno['nome'] ?? '') ?>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            <div class="flex items-center gap-1.5">
                                                <i class="ph ph-envelope-simple text-slate-400"></i>
                                                <?= htmlspecialchars($aluno['email'] ?? '') ?>
                                            </div>
                                        </td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                            <a href="actions/delete.php?id=<?= $aluno['id'] ?>"
                                                class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-2 rounded-lg transition-colors inline-flex items-center gap-1.5"
                                                onclick="return confirm('Tem certeza que deseja remover o aluno <?= htmlspecialchars($aluno['nome'] ?? '') ?>?');">
                                                <i class="ph-bold ph-trash"></i>
                                                Remover
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (empty($alunos)): ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-14 text-center">
                                            <div class="flex flex-col items-center justify-center gap-3">
                                                <div
                                                    class="h-12 w-12 rounded-full bg-slate-50 flex items-center justify-center ring-1 ring-slate-100 mb-2">
                                                    <i class="ph-light ph-users-three text-2xl text-slate-400"></i>
                                                </div>
                                                <h3 class="text-sm font-medium text-slate-900">Nenhum aluno encontrado</h3>
                                                <p class="text-sm text-slate-500 max-w-sm">Os alunos que você cadastrar
                                                    usando o formulário ao lado aparecerão nesta lista.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="mt-20 text-center text-slate-400 text-sm border-t border-slate-100 pt-10">
            <p>© 2026 - Feito por <a href="../AboutMe/about.php" class="font-bold text-slate-600 hover:text-slate-900 transition-colors text-decoration-none">António Pedro</a>, todos os direitos reservados.</p>
        </footer>
    </div>
</body>

</html>