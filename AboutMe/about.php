<?php
// Função simples para carregar o .env
function loadEnv($path)
{
    if (!file_exists($path))
        return [];
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0)
            continue;
        list($name, $value) = explode('=', $line, 2);
        $env[trim($name)] = trim($value);
    }
    return $env;
}

// Carregar variáveis do .env na raiz do projeto Business
$env = loadEnv(__DIR__ . '/../.env');
$email_antonio = $env['EMAIL_ANTONIO'] ?? 'contato@exemplo.com';

// Montar link do email
$subject = rawurlencode('Contacto via tarefas de php que fizeste no ensino médio.');
$body = rawurlencode('Olá, gostaria de entrar em contacto contigo, vi-te pelo teu repo de php do github.');
$mailto_link = "mailto:{$email_antonio}?subject={$subject}&body={$body}";

// Links Reais
$linkedin_link = "https://www.linkedin.com/in/ant%C3%B3nio-pedro-05167a293/";
$github_link = "https://github.com/imanthonypeter";
$instagram_link = "https://www.instagram.com/imanthonypeter?igsh=cXdtbWxxbnJld244";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me | António Pedro</title>
    <link rel="stylesheet" href="about_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
    <div class="about-container">
        <div class="glass-card">
            <!-- Botão Voltar (Premium) -->
            <div style="width: 100%; display: flex; justify-content: flex-start; margin-bottom: 20px;">
                <a href="../index.html" 
                   style="display: inline-flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.7); text-decoration: none; font-weight: 600; font-size: 0.8rem; padding: 6px 14px; border-radius: 100px; background: rgba(255,255,255,0.1); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;"
                   onmouseover="this.style.color='#fff'; this.style.background='rgba(255,255,255,0.2)'; this.style.borderColor='rgba(255,255,255,0.3)';"
                   onmouseout="this.style.color='rgba(255,255,255,0.7)'; this.style.background='rgba(255,255,255,0.1)'; this.style.borderColor='rgba(255,255,255,0.1)';"
                   class="group">
                    <i class="ph-bold ph-arrow-left"></i>
                    Voltar ao Portal
                </a>
            </div>

            <!-- Foto do Boss -->
            <div class="profile-pic-container">
                <div class="profile-pic">
                    <img src="assets/Boss.jpeg" alt="António Pedro">
                </div>
            </div>

            <h1>António Pedro</h1>
            <p class="title">Fullstack Developer</p>

            <p class="bio">
                Desenvolvedor <b>Fullstack</b> apaixonado por transformar desafios em soluções digitais de alto impacto. 
                Com domínio em <b>HTML, CSS, JS React, Tailwind CSS, C, Node.js, Express.js, PHP e Python</b>, 
                foco em criar sistemas robustos e interfaces que proporcionam uma experiência premium ao usuário.
            </p>

            <!-- Redes Sociais -->
            <div class="social-links">
                <a href="<?php echo $linkedin_link; ?>" target="_blank" class="social-icon linkedin">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                    </svg>
                </a>
                <a href="<?php echo $github_link; ?>" target="_blank" class="social-icon github">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12" />
                    </svg>
                </a>
                <a href="<?php echo $instagram_link; ?>" target="_blank" class="social-icon instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                    </svg>
                </a>
                <a href="<?php echo $mailto_link; ?>" class="social-icon email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</body>

</html>