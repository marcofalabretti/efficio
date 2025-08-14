<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'EFFICIO') }}</title>

        <!-- Fonts: Inter for readability -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                    --efficio-bg: #0a0a0a;
                    --efficio-surface: #161615;
                    --efficio-text: #ededec;
                    --efficio-muted: #a1a09a;
                    --efficio-accent: #c9ff2e;
                    --efficio-glow: 0 0 12px rgba(201, 255, 46, 0.7), 0 0 32px rgba(201, 255, 46, 0.35);
                    --sidebar-w: 240px;
                    --sidebar-w-collapsed: 76px;
                    --topbar-h: 56px;
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
                .layout { display: grid; grid-template-columns: var(--sidebar-w) 1fr; min-height: 100dvh; transition: grid-template-columns .2s ease; }
                body.sidebar-collapsed .layout { grid-template-columns: var(--sidebar-w-collapsed) 1fr; }
                /* Topbar */
                .topbar { position: sticky; top: 0; z-index: 30; height: var(--topbar-h); display: flex; align-items: center; gap: 12px; padding: 0 16px; background: color-mix(in oklab, var(--efficio-surface) 92%, transparent); backdrop-filter: blur(8px); border-bottom: var(--border); }
                .brand { display: flex; align-items: center; gap: 10px; font-weight: 600; }
                .brand img { width: 26px; height: 26px; filter: drop-shadow(var(--efficio-glow)); }
                .brand .accent { color: var(--efficio-accent); text-shadow: 0 0 8px rgba(201,255,46,.55); }
                .grow { flex: 1; }
                .icon-btn { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius: 999px; background: transparent; border: var(--border); color: var(--efficio-text); cursor: pointer; }
                .icon-btn:hover { outline: 1px solid var(--efficio-accent); box-shadow: var(--efficio-glow); }
                .avatar { width: 36px; height: 36px; border-radius: 999px; overflow: hidden; border: var(--border); }
                .avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }
                .dropdown { position: relative; }
                .menu { position: absolute; right: 0; top: calc(100% + 8px); background: var(--efficio-surface); border: var(--border); border-radius: var(--radius); min-width: 200px; padding: 8px; display: none; box-shadow: 0 12px 32px rgba(0,0,0,.45); }
                .menu a, .menu button { display: flex; gap: 10px; align-items: center; padding: 8px 10px; border-radius: 8px; color: var(--efficio-text); background: transparent; border: none; cursor: pointer; width: 100%; text-align: left; }
                .menu a:hover, .menu button:hover { background: rgba(255,255,255,0.05); }
                .dropdown.open .menu { display: block; }
                /* Sidebar */
                .sidebar { position: sticky; top: 0; align-self: start; height: 100dvh; background: var(--efficio-surface); border-right: var(--border); display: flex; flex-direction: column; transition: width .2s ease; }
                .nav { padding: 12px 8px; display: grid; gap: 6px; }
                .item { display:flex; align-items:center; gap: 12px; color: var(--efficio-text); padding: 10px 12px; border-radius: 10px; border: 1px solid transparent; cursor: pointer; }
                .item:hover { border-color: rgba(255,255,255,0.08); background: rgba(255,255,255,0.04); }
                .item.active { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.1); }
                .nav a.item { text-decoration: none; }
                .nav svg { width: 20px; height: 20px; opacity: .92; flex: 0 0 auto; }
                .label { white-space: nowrap; opacity: .92; }
                .badge { margin-left: auto; background: rgba(255,255,255,0.08); padding: 0 8px; border-radius: 999px; font-size: 12px; line-height: 20px; height: 20px; display: inline-flex; align-items:center; }
                .dot { width: 8px; height: 8px; border-radius: 999px; display:inline-block; }
                .dot.purple { background: #a855f7; }
                .dot.blue { background: #60a5fa; }
                .dot.red { background: #f87171; }
                .icon { display:flex; align-items:center; justify-content:center; width: 20px; height: 20px; }
                .icon-box { display:flex; align-items:center; justify-content:center; width: 28px; height: 28px; border-radius: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); }
                .chevron { margin-left: auto; transition: transform .15s ease; }
                .open > .item .chevron { transform: rotate(180deg); }
                .subnav { display: none; padding: 6px 0 8px; margin-left: 40px; gap: 4px; }
                .subnav a { display:flex; align-items:center; gap: 10px; padding: 8px 10px; border-radius: 8px; color: var(--efficio-text); border: 1px solid transparent; }
                .subnav a:hover { background: rgba(255,255,255,0.04); border-color: rgba(255,255,255,0.08); }
                .open > .subnav { display: grid; }
                /* Flyout for collapsed */
                .subnav-flyout { display: none; position: absolute; left: calc(100% + 8px); top: 0; background: var(--efficio-surface); border: var(--border); border-radius: 10px; padding: 8px; min-width: 200px; box-shadow: 0 12px 32px rgba(0,0,0,.45); }
                body.sidebar-collapsed .has-children:hover .subnav-flyout { display: block; }
                .has-children { position: relative; }
                .group-trigger { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.1); }
                .group-trigger:hover { background: rgba(255,255,255,0.08); }
                .section-title { font-size: 12px; color: var(--efficio-muted); padding: 10px 14px; letter-spacing: .08em; text-transform: uppercase; }
                .collapse-toggle { margin-top: auto; padding: 10px; display:flex; justify-content: center; }
                .tooltip { position: relative; }
                .tooltip:hover::after { content: attr(aria-label); position: absolute; left: 100%; top: 50%; transform: translate(10px, -50%); background: #111; color: #fff; padding: 6px 8px; border-radius: 6px; font-size: 12px; white-space: nowrap; border: 1px solid rgba(255,255,255,0.12); }
                /* Collapsed state */
                body.sidebar-collapsed .label, body.sidebar-collapsed .section-title { display: none; }
                body.sidebar-collapsed .nav a { justify-content: center; }
                body.sidebar-collapsed .icon { display:none; }
                body.sidebar-collapsed .icon-box { display:flex; width: 36px; height: 36px; }
                /* Content */
                .content { padding: 16px; }
                .card { background: var(--efficio-surface); border: var(--border); border-radius: var(--radius); }
                .card-body { padding: 16px; }
                
                /* Buttons */
                .btn-primary { 
                    display: inline-flex; align-items: center; padding: 8px 16px; 
                    background: var(--efficio-accent); color: var(--efficio-bg); 
                    border-radius: var(--radius); font-weight: 500; font-size: 14px;
                    border: none; cursor: pointer; transition: all 0.2s ease;
                    text-decoration: none;
                }
                .btn-primary:hover { 
                    background: color-mix(in oklab, var(--efficio-accent) 85%, transparent); 
                    box-shadow: var(--efficio-glow);
                }
                
                .btn-secondary { 
                    display: inline-flex; align-items: center; padding: 8px 16px; 
                    background: rgba(255,255,255,0.08); color: var(--efficio-text); 
                    border: var(--border); border-radius: var(--radius); font-weight: 500; font-size: 14px;
                    cursor: pointer; transition: all 0.2s ease; text-decoration: none;
                }
                .btn-secondary:hover { 
                    background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.2);
                }
                
                .btn-danger { 
                    display: inline-flex; align-items: center; padding: 8px 16px; 
                    background: rgba(239, 68, 68, 0.2); color: #f87171; 
                    border: 1px solid rgba(239, 68, 68, 0.3); border-radius: var(--radius); 
                    font-weight: 500; font-size: 14px; cursor: pointer; transition: all 0.2s ease;
                }
                .btn-danger:hover { 
                    background: rgba(239, 68, 68, 0.3); border-color: rgba(239, 68, 68, 0.5);
                }
                
                .btn-sm { 
                    padding: 6px 12px; font-size: 13px; 
                }
                
                /* Form Elements */
                .form-label { 
                    display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; 
                    color: var(--efficio-text); 
                }
                
                .form-input, .form-select { 
                    width: 100%; padding: 8px 12px; background: rgba(255,255,255,0.05); 
                    border: var(--border); border-radius: 6px; color: var(--efficio-text); 
                    font-size: 14px; transition: border-color 0.2s ease;
                }
                .form-input:focus, .form-select:focus { 
                    outline: none; border-color: var(--efficio-accent); 
                    box-shadow: 0 0 0 3px rgba(201, 255, 46, 0.1);
                }
                
                /* Text Utilities */
                .text-brand { color: var(--efficio-accent); }
                .muted { color: var(--efficio-muted); }
                
                /* Badges */
                .badge-success { 
                    display: inline-flex; align-items: center; padding: 4px 8px; 
                    background: rgba(34, 197, 94, 0.2); color: #22c55e; 
                    border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 999px; 
                    font-size: 12px; font-weight: 500;
                }
                .badge-danger { 
                    display: inline-flex; align-items: center; padding: 4px 8px; 
                    background: rgba(239, 68, 68, 0.2); color: #f87171; 
                    border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 999px; 
                    font-size: 12px; font-weight: 500;
                }
                
                .badge-blue { 
                    display: inline-flex; align-items: center; padding: 4px 8px; 
                    background: rgba(59, 130, 246, 0.2); color: #60a5fa; 
                    border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 999px; 
                    font-size: 12px; font-weight: 500;
                }
                
                .badge-green { 
                    display: inline-flex; align-items: center; padding: 4px 8px; 
                    background: rgba(34, 197, 94, 0.2); color: #22c55e; 
                    border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 999px; 
                    font-size: 12px; font-weight: 500;
                }
                
                .badge-purple { 
                    display: inline-flex; align-items: center; padding: 4px 8px; 
                    background: rgba(168, 85, 247, 0.2); color: #a855f7; 
                    border: 1px solid rgba(168, 85, 247, 0.3); border-radius: 999px; 
                    font-size: 12px; font-weight: 500;
                }
                
                /* Modal */
                .modal { 
                    position: fixed; inset: 0; background: rgba(0,0,0,0.5); 
                    display: flex; align-items: center; justify-content: center; z-index: 50;
                }
                .modal.hidden { display: none; }
                .modal-content { 
                    background: var(--efficio-surface); border: var(--border); border-radius: var(--radius); 
                    max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;
                }
                .modal-header { 
                    padding: 20px 24px 16px; border-bottom: var(--border); 
                    display: flex; justify-between; align-items: center;
                }
                .modal-body { padding: 20px 24px; }
                .modal-footer { 
                    padding: 16px 24px 20px; border-top: var(--border); 
                    display: flex; gap: 12px; justify-content: flex-end;
                }
                .modal-close { 
                    background: none; border: none; color: var(--efficio-muted); 
                    cursor: pointer; padding: 4px; border-radius: 4px; transition: all 0.2s ease;
                }
                .modal-close:hover { 
                    background: rgba(255,255,255,0.1); color: var(--efficio-text);
                }
                /* Mobile */
                @media (max-width: 1024px) {
                    .layout { grid-template-columns: 1fr; }
                    .sidebar { position: fixed; left: 0; top: 0; width: var(--sidebar-w); transform: translateX(-100%); transition: transform .2s ease; z-index: 40; }
                    body.sidebar-open .sidebar { transform: translateX(0); }
                    body.sidebar-collapsed .sidebar { width: var(--sidebar-w-collapsed); }
                    .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 35; }
                    body.sidebar-open .overlay { display: block; }
                }
            </style>
    </head>
    <body>
        <div class="topbar">
            <button class="icon-btn" id="btnHamburger" title="Menu" aria-label="Menu">
                <!-- hamburger -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7h18M3 12h14M3 17h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <div class="brand">
                <img src="/brand/efficio-logo.svg" alt="EFFICIO" style="border-radius: 50%;"/>
                <span class="accent">EFFICIO</span>
                <span style="color:var(--efficio-muted); font-weight:500;">— {{ $companyName ?? config('app.name', 'EFFICIO') }}</span>
            </div>
            <div class="grow"></div>
            <div class="dropdown" id="profileDropdown">
                <button class="avatar" id="btnAvatar" aria-haspopup="menu" aria-expanded="false">
                    <img src="https://i.pravatar.cc/80?img=12" alt="User" />
                </button>
                <div class="menu" role="menu" aria-label="User menu">
                    <a href="#" role="menuitem">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12a5 5 0 100-10 5 5 0 000 10zM3 22a9 9 0 1118 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Profilo
                    </a>
                    <a href="#" role="menuitem">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3v18M3 12h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Impostazioni
                    </a>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" role="menuitem">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M12 21H6a3 3 0 01-3-3V6a3 3 0 013-3h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="layout">
            <aside class="sidebar" id="sidebar">
                <div class="section-title">Navigazione</div>
                <nav class="nav">
                                               <a href="{{ route('dashboard') }}" class="item tooltip" aria-label="Home">
                               <span class="icon"><span class="icon-box"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12l9-9 9 9M5 10v10h5V14h4v6h5V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span></span>
                               <span class="label">Home</span>
                           </a>

                           <a href="{{ route('customers.index') }}" class="item tooltip" aria-label="Clienti">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                               <span class="label">Clienti</span>
                           </a>

                           <a href="{{ route('commesse.index') }}" class="item tooltip" aria-label="Commesse">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                               <span class="label">Commesse</span>
                           </a>

                           <a href="{{ route('preventivi.index') }}" class="item tooltip" aria-label="Preventivi">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 12l2 2 4-4M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                               <span class="label">Preventivi</span>
                           </a>

                           <a href="{{ route('fatture.index') }}" class="item tooltip" aria-label="Fatture">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16" y1="13" x2="8" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><line x1="16" y1="17" x2="8" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="10,9 9,9 8,9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                               <span class="label">Fatture</span>
                           </a>

                           <a href="{{ route('pagamenti.index') }}" class="item tooltip" aria-label="Pagamenti">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                               <span class="label">Pagamenti</span>
                           </a>

                           <a href="{{ route('projects.index') }}" class="item tooltip" aria-label="Progetti">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 22h16M7 18V8m5 10V4m5 14v-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                               <span class="label">Progetti</span>
                           </a>

                           <!-- Menu Materiali -->
                           <div class="has-children">
                               <div class="item group-trigger" aria-haspopup="true" aria-expanded="false">
                                   <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 7L10 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                   <span class="label">Materiali</span>
                                   <svg class="chevron" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                               </div>
                               <div class="subnav">
                                   <a href="{{ route('articoli.index') }}" class="item tooltip" aria-label="Articoli">
                                       <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 7L10 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                       <span class="label">Articoli</span>
                                   </a>
                                   <a href="{{ route('movimenti-magazzino.index') }}" class="item tooltip" aria-label="Magazzino">
                                       <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3h18v4H3zM7 7v14M12 7v14M17 7v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                       <span class="label">Magazzino</span>
                                   </a>
                                   <a href="{{ route('categoria-articoli.index') }}" class="item tooltip" aria-label="Categorie Articoli">
                                       <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                       <span class="label">Categorie Articoli</span>
                                   </a>
                                   <a href="{{ route('fornitori.index') }}" class="item tooltip" aria-label="Fornitori">
                                       <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M23 21v-2a4 4 0 00-3-3.87" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                                       <span class="label">Fornitori</span>
                                   </a>
                               </div>
                           </div>

                    <a href="#" class="item tooltip" aria-label="Tasks">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span class="label">Attività</span>
                    </a>
                    <a href="#" class="item tooltip" aria-label="Reporting">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3h18v4H3zM7 7v14M12 7v14M17 7v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span class="label">Report</span>
                    </a>
                                               <a href="{{ route('admin.users.index') }}" class="item tooltip" aria-label="Utenti">
                               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 11c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4zM8 11c1.657 0 3-1.79 3-4S9.657 3 8 3 5 4.79 5 7s1.343 4 3 4zm0 2c-2.761 0-5 2.239-5 5v1h10v-1c0-2.761-2.239-5-5-5zm8 0c-.7 0-1.368.121-2 .343 1.779 1.049 3 2.826 3 4.657v1h6v-1c0-2.761-2.239-5-5-5z" stroke="currentColor" stroke-width="1.5"/></svg>
                               <span class="label">Utenti</span>
                               <span class="badge">3</span>
                           </a>
                </nav>
                <div class="section-title">Altro</div>
                <nav class="nav">
                    <a href="{{ route('company-identity.index') }}" class="item tooltip" aria-label="Identità Aziendale">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span class="label">Identità Aziendale</span>
                    </a>
                    <a href="#" class="item tooltip" aria-label="Help">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 9a3 3 0 116 0c0 2-3 2-3 4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="17" r="1" fill="currentColor"/></svg>
                        <span class="label">Aiuto</span>
                    </a>
                    <a href="#" class="item tooltip" aria-label="Settings">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" stroke="currentColor" stroke-width="2"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06A2 2 0 014.94 3.3l.06.06a1.65 1.65 0 001.82.33H7a1.65 1.65 0 001-1.51V2a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span class="label">Impostazioni</span>
                    </a>
                </nav>
                <div class="collapse-toggle">
                    <button class="icon-btn" id="btnCollapse" title="Comprimi/espandi" aria-label="Comprimi o espandi sidebar">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </aside>

            <main class="content">
                @yield('content')
            </main>
        </div>

        <div class="overlay" id="overlay"></div>

        <script>
            (function() {
                const body = document.body;
                const dropdown = document.getElementById('profileDropdown');
                const btnAvatar = document.getElementById('btnAvatar');
                const btnCollapse = document.getElementById('btnCollapse');
                const btnHamburger = document.getElementById('btnHamburger');
                const overlay = document.getElementById('overlay');

                // Restore sidebar collapsed state
                try {
                    const collapsed = localStorage.getItem('efficio.sidebarCollapsed');
                    if (collapsed === '1') body.classList.add('sidebar-collapsed');
                } catch (e) {}

                btnCollapse?.addEventListener('click', function() {
                    body.classList.toggle('sidebar-collapsed');
                    try { localStorage.setItem('efficio.sidebarCollapsed', body.classList.contains('sidebar-collapsed') ? '1' : '0'); } catch(e) {}
                });

                btnHamburger?.addEventListener('click', function() {
                    body.classList.toggle('sidebar-open');
                });
                overlay?.addEventListener('click', function(){ body.classList.remove('sidebar-open'); });

                // Profile dropdown
                btnAvatar?.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('open');
                    btnAvatar.setAttribute('aria-expanded', dropdown.classList.contains('open'));
                });
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target)) dropdown.classList.remove('open');
                });

                // Collapsible groups - handle all groups dynamically
                (function(){
                    const groups = document.querySelectorAll('.has-children');
                    groups.forEach(function(group) {
                        const trigger = group.querySelector('.item');
                        const children = group.querySelectorAll('.subnav a');
                        
                        // Auto-expand if any child is active
                        const hasActiveChild = Array.from(children).some(child => 
                            child.classList.contains('active')
                        );
                        if (hasActiveChild) {
                            group.classList.add('open');
                            trigger.setAttribute('aria-expanded', 'true');
                        }
                        
                        trigger.addEventListener('click', function(){
                            group.classList.toggle('open');
                            trigger.setAttribute('aria-expanded', group.classList.contains('open'));
                        });
                    });
                })();
            })();
        </script>
    </body>
    </html>


