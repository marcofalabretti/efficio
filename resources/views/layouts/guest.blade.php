<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'EFFICIO') }}</title>

        <!-- Fonts: Inter for readability -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            :root {
                --efficio-bg: #0a0a0a;
                --efficio-surface: #161615;
                --efficio-text: #ededec;
                --efficio-muted: #a1a09a;
                --efficio-accent: #c9ff2e;
                --efficio-glow: 0 0 12px rgba(201, 255, 46, 0.7), 0 0 32px rgba(201, 255, 46, 0.35);
                --radius: 10px;
                --border: 1px solid rgba(255,255,255,0.08);
            }
            * { box-sizing: border-box; }
            html, body { height: 100%; }
            body {
                margin: 0;
                font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
                background: var(--efficio-bg);
                color: var(--efficio-text);
            }
            a { color: inherit; text-decoration: none; }
            .container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
            .card { background: var(--efficio-surface); border: var(--border); border-radius: var(--radius); padding: 32px; max-width: 400px; width: 100%; }
            .brand { text-align: center; margin-bottom: 24px; }
            .brand img { width: 48px; height: 48px; filter: drop-shadow(var(--efficio-glow)); margin: 0 auto 12px; display: block; }
            .brand h1 { margin: 0; font-size: 24px; font-weight: 600; color: var(--efficio-accent); text-shadow: 0 0 8px rgba(201,255,46,.55); }
            .brand p { margin: 4px 0 0; color: var(--efficio-muted); font-size: 14px; text-transform: uppercase; letter-spacing: 0.1em; }
            .form-group { margin-bottom: 20px; }
            .form-group label { display: block; margin-bottom: 8px; color: var(--efficio-text); font-weight: 500; }
            .form-group input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.05); border: var(--border); border-radius: 8px; color: var(--efficio-text); font-size: 16px; }
            .form-group input:focus { outline: none; border-color: var(--efficio-accent); box-shadow: var(--efficio-glow); }
            .btn { width: 100%; padding: 12px 16px; background: var(--efficio-accent); color: #000; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
            .btn:hover { box-shadow: var(--efficio-glow); transform: translateY(-1px); }
            .btn-secondary { background: transparent; border: var(--border); color: var(--efficio-text); }
            .btn-secondary:hover { background: rgba(255,255,255,0.05); border-color: var(--efficio-accent); }
            .links { text-align: center; margin-top: 20px; }
            .links a { color: var(--efficio-accent); text-decoration: none; }
            .links a:hover { text-shadow: 0 0 8px rgba(201,255,46,.55); }
            .error { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px; padding: 12px; margin-bottom: 20px; color: #fca5a5; }
            
            /* Welcome page styles */
            .welcome-content { text-align: center; }
            .welcome-title { font-size: 32px; font-weight: 700; margin-bottom: 8px; color: var(--efficio-accent); text-shadow: 0 0 20px rgba(201,255,46,.5); }
            .welcome-subtitle { font-size: 16px; color: var(--efficio-muted); margin-bottom: 24px; text-transform: uppercase; letter-spacing: 0.1em; }
            .welcome-features { display: grid; gap: 16px; margin: 24px 0; }
            .welcome-feature { padding: 16px; background: rgba(255,255,255,0.03); border: var(--border); border-radius: 8px; text-align: left; }
            .welcome-feature h3 { color: var(--efficio-accent); margin-bottom: 8px; font-size: 16px; font-weight: 600; }
            .welcome-feature p { color: var(--efficio-muted); font-size: 14px; margin: 0; }
            .welcome-cta { margin-top: 24px; }
            .welcome-cta a { display: inline-block; padding: 12px 24px; background: var(--efficio-accent); color: #000; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.2s; box-shadow: var(--efficio-glow); }
            .welcome-cta a:hover { transform: translateY(-1px); box-shadow: 0 0 24px rgba(201,255,46,.8), 0 0 48px rgba(201,255,46,.4); }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="brand">
                    <img src="/brand/efficio-logo.svg" alt="EFFICIO" />
                    <h1>EFFICIO</h1>
                    <p>successi integrati</p>
                </div>
                
                @yield('content')
            </div>
        </div>
    </body>
</html>
