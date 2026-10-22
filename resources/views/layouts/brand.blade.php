<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Brand | WECON Asia Ecosystem')</title>
    <meta name="description" content="@yield('meta-description', 'Discover the premier media, events, and business intelligence brands of WECON Asia.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #0B2B55;
            --navy-dark: #071c38;
            --navy-light: #123d75;
            --blue: #1261B5;
            --blue-light: #1d7ae4;
            --blue-subtle: #EBF4FE;
            --gold: #C8962A;
            --gold-light: #f59e0b;
            --text-heading: #0F172A;
            --text-body: #475569;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --border-light: #F1F5F9;
            --white: #FFFFFF;
            --surface-card: #FFFFFF;
            --surface-alt: #F8FAFC;
            --shadow-sm: 0 2px 8px rgba(11, 43, 85, 0.05);
            --shadow-md: 0 10px 30px -4px rgba(11, 43, 85, 0.08);
            --shadow-lg: 0 20px 45px -8px rgba(11, 43, 85, 0.14);
            --shadow-xl: 0 25px 60px -10px rgba(11, 43, 85, 0.22);
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-heading);
            background: #FFFFFF;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            zoom: 0.9;
        }

        /* ===== SCROLL PROGRESS BAR ===== */
        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, var(--brand-primary, var(--blue)) 0%, #38bdf8 50%, var(--gold) 100%);
            z-index: 1100;
            transition: width 0.1s linear;
        }

        /* ===== NAVBAR ===== */
        #navbar {
            position: fixed;
            top: 14px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 3rem);
            max-width: 1320px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 9999px;
            height: 68px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 20px -2px rgba(11, 43, 85, 0.06);
            transition: all 0.3s ease;
        }
        #navbar.scrolled {
            box-shadow: 0 10px 32px -4px rgba(11, 43, 85, 0.14), 0 2px 6px rgba(0, 0, 0, 0.04);
            background: rgba(255, 255, 255, 0.98);
            border-color: rgba(203, 213, 225, 0.95);
        }
        .nav-container {
            width: 100%;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            position: relative;
        }
        .nav-logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            flex-shrink: 0;
            height: 52px;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-logo:hover { transform: scale(1.03); }
        .nav-logo-img {
            height: 115px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: -28px 25px;
            filter: drop-shadow(0 2px 4px rgba(11, 43, 85, 0.05));
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.6rem;
            list-style: none;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        @media (min-width: 992px) {
            .nav-links {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }
        .nav-links li {
            display: flex;
            align-items: center;
            height: 100%;
        }
        .nav-links li a {
            position: relative;
            text-decoration: none;
            color: #475569;
            font-size: 0.89rem;
            font-weight: 500;
            padding: 0.45rem 0;
            transition: color 0.2s ease;
            white-space: nowrap;
        }
        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2.5px;
            background: var(--brand-primary, var(--blue));
            border-radius: 2px;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.2s ease;
            opacity: 0;
        }
        .nav-links li a:hover {
            color: var(--navy);
        }
        .nav-links li a:hover::after,
        .nav-links li a.active::after {
            transform: scaleX(1);
            opacity: 1;
        }
        .nav-links li a.active {
            color: var(--brand-primary, var(--navy));
            font-weight: 700;
        }
        .nav-cta-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .nav-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.54rem 1.35rem;
            border-radius: 9999px;
            border: 1.5px solid var(--brand-primary, var(--navy));
            color: #FFFFFF;
            background: var(--brand-primary, var(--navy));
            font-size: 0.86rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(11, 43, 85, 0.15);
        }
        .nav-cta-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(11, 43, 85, 0.25);
            filter: brightness(1.08);
            color: #FFFFFF;
        }
        .nav-toggle {
            display: none;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            flex-direction: column;
            gap: 5px;
            z-index: 1001;
        }
        .nav-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--navy);
            border-radius: 2px;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }
        .nav-toggle.active span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .nav-toggle.active span:nth-child(2) { opacity: 0; }
        .nav-toggle.active span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .nav-links li.mobile-cta { display: none !important; }

        /* ===== COMMON LAYOUT UTILITIES ===== */
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .section-padding {
            padding: 3rem 0;
        }
        .section-header {
            max-width: 620px;
            margin: 0 auto 1.85rem;
            text-align: center;
        }
        .section-tag {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--brand-primary, var(--blue));
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-bottom: 0.45rem;
            background: var(--brand-subtle, rgba(18, 97, 181, 0.08));
            padding: 0.25rem 0.8rem;
            border-radius: 9999px;
            border: 1px solid var(--brand-border, rgba(18, 97, 181, 0.2));
        }
        .section-title {
            font-size: clamp(1.5rem, 2.2vw, 1.95rem);
            font-weight: 800;
            line-height: 1.22;
            letter-spacing: -0.02em;
            color: var(--navy);
            margin-bottom: 0.45rem;
        }
        .section-desc {
            font-size: 0.88rem;
            color: #64748B;
            line-height: 1.5;
            max-width: 540px;
            margin: 0 auto;
        }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            padding: 0.85rem 1.85rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.94rem;
            text-decoration: none;
            cursor: pointer;
            border: 1.5px solid transparent;
            font-family: inherit;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            white-space: nowrap;
        }
        .btn-brand {
            background: var(--brand-primary, var(--blue));
            color: #FFFFFF;
            border-color: var(--brand-primary, var(--blue));
            box-shadow: 0 6px 20px var(--brand-glow, rgba(18, 97, 181, 0.28));
        }
        .btn-brand:hover {
            transform: translateY(-2px);
            filter: brightness(1.08);
            box-shadow: 0 10px 28px var(--brand-glow, rgba(18, 97, 181, 0.38));
            color: #FFFFFF;
        }
        .btn-outline-navy {
            background: #FFFFFF;
            color: var(--navy);
            border-color: rgba(11, 43, 85, 0.25);
        }
        .btn-outline-navy:hover {
            background: var(--navy);
            color: #FFFFFF;
            border-color: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(11, 43, 85, 0.16);
        }

        /* ===== REVEAL ANIMATIONS ===== */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== BREADCRUMB ===== */
        .brand-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }
        .brand-breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .brand-breadcrumb a:hover {
            color: var(--navy);
        }
        .brand-breadcrumb .sep { opacity: 0.5; }
        .brand-breadcrumb .current {
            color: var(--brand-primary, var(--blue));
            font-weight: 600;
        }

        /* ===== HERO SECTION ===== */
        .brand-hero {
            position: relative;
            padding: 135px 2rem 70px;
            background: var(--brand-hero-bg, linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%));
            overflow: hidden;
            border-bottom: 1px solid var(--border);
            min-height: calc(100vh / 0.9);
            min-height: calc(100dvh / 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }
        .brand-hero-mesh {
            position: absolute;
            inset: 0;
            background-image: 
                radial-gradient(circle at 10% 20%, var(--brand-glow-subtle, rgba(234, 88, 12, 0.08)) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(18, 97, 181, 0.08) 0%, transparent 45%);
            pointer-events: none;
        }
        .brand-hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.25fr 0.95fr;
            gap: 3.5rem;
            align-items: center;
        }
        .brand-hero-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 1.15rem;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(11, 43, 85, 0.04);
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--brand-primary, var(--blue));
            margin-bottom: 1.25rem;
        }
        .brand-hero-title {
            font-size: clamp(2.4rem, 4.2vw, 3.6rem);
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.03em;
            color: var(--navy);
            margin-bottom: 1.25rem;
        }
        .brand-hero-desc {
            font-size: 1.12rem;
            line-height: 1.75;
            color: var(--text-body);
            margin-bottom: 2rem;
            max-width: 620px;
        }
        .brand-hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0;
        }
        .brand-hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            padding-top: 1.75rem;
            border-top: 1px solid var(--border);
        }
        .stat-item-num {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: -0.02em;
            line-height: 1.1;
        }
        .stat-item-label {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* Hero Right Preview Card & Floating Logo/Icon */
        .brand-hero-logo-wrap {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.5rem;
            background: transparent;
        }
        .brand-hero-logo-wrap::before {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--brand-glow, rgba(18, 97, 181, 0.22)) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
            filter: blur(16px);
        }
        .brand-hero-floating-logo,
        .brand-hero-floating-icon {
            position: relative;
            z-index: 1;
            max-width: 280px;
            width: 100%;
            height: auto;
            max-height: 280px;
            object-fit: contain;
            display: block;
            background: transparent;
            filter: drop-shadow(0 20px 32px rgba(11, 43, 85, 0.16));
            animation: brandLogoFloat 5s ease-in-out infinite;
            will-change: transform;
            transition: transform 0.35s ease, filter 0.35s ease;
        }
        .brand-hero-floating-logo:hover,
        .brand-hero-floating-icon:hover {
            filter: drop-shadow(0 28px 45px rgba(11, 43, 85, 0.24));
            transform: translateY(-8px) scale(1.04);
        }
        @keyframes brandLogoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-16px);
            }
        }

        .brand-hero-card-wrap {
            position: relative;
        }
        .brand-hero-card {
            background: #FFFFFF;
            border-radius: 24px;
            padding: 2.25rem;
            box-shadow: 0 20px 50px -10px rgba(11, 43, 85, 0.12), 0 0 0 1px rgba(226, 232, 240, 0.8);
            position: relative;
            overflow: hidden;
        }
        .brand-hero-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--brand-primary, var(--blue)), var(--brand-secondary, var(--gold)));
        }
        .brand-card-logo-box {
            background: #FFFFFF;
            padding: 1.25rem 1.75rem;
            border-radius: 16px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(11, 43, 85, 0.03);
            min-height: 110px;
        }
        .brand-card-logo-img {
            max-width: 240px;
            max-height: 75px;
            object-fit: contain;
            display: block;
        }
        .brand-card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.88rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-light);
        }
        .meta-row:last-child { border-bottom: none; padding-bottom: 0; }
        .meta-label { color: var(--text-muted); font-weight: 500; }
        .meta-val { color: var(--navy); font-weight: 700; text-align: right; }
        .meta-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--brand-primary, var(--blue));
            text-decoration: none;
            font-weight: 600;
        }
        .meta-link:hover { text-decoration: underline; }

        /* ===== WHAT THE BRAND DOES (PILLARS) ===== */
        .pillars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.75rem;
        }
        .pillar-card {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .pillar-card:hover {
            transform: translateY(-5px);
            border-color: var(--brand-border, rgba(18, 97, 181, 0.3));
            box-shadow: 0 16px 36px -6px rgba(11, 43, 85, 0.1);
        }
        .pillar-header {
            display: flex;
            align-items: center;
            gap: 1.15rem;
            margin-bottom: 1.1rem;
        }
        .pillar-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--brand-subtle, #EFF6FF);
            color: var(--brand-primary, var(--blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            margin-bottom: 0;
            flex-shrink: 0;
        }
        .pillar-title {
            font-size: 1.22rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0;
            line-height: 1.3;
        }
        .briefing-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.85rem;
        }
        .briefing-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--brand-subtle, rgba(0, 0, 0, 0.04));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 0;
            flex-shrink: 0;
        }
        .briefing-card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--navy);
            margin: 0;
            line-height: 1.3;
        }
        .pillar-desc {
            font-size: 0.94rem;
            color: var(--text-body);
            line-height: 1.65;
            flex-grow: 1;
            margin-bottom: 1.25rem;
        }
        .pillar-bullets {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border-light);
            padding-top: 1rem;
        }
        .pillar-bullets li {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }
        .pillar-bullets li::before {
            content: '✓';
            color: var(--brand-primary, var(--blue));
            font-weight: 800;
        }

        /* ===== WHAT THEY OFFER (OFFERINGS SLIDER & CAROUSEL) ===== */
        .offerings-section {
            background: var(--surface-alt);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
        }
        .offerings-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.85rem;
        }
        .offerings-slider-wrapper {
            position: relative;
            width: 100%;
        }
        .offerings-slider-track {
            display: flex;
            gap: 1.85rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            -ms-overflow-style: none;
            scroll-behavior: smooth;
            padding: 0.5rem 0.25rem 1.25rem 0.25rem;
            margin: 0 -0.25rem;
        }
        .offerings-slider-track::-webkit-scrollbar {
            display: none;
        }
        .offering-card {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.25rem 2rem;
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            flex: 0 0 calc((100% - (2 * 1.85rem)) / 3);
            max-width: calc((100% - (2 * 1.85rem)) / 3);
            box-sizing: border-box;
            scroll-snap-align: start;
        }
        .offering-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px -6px rgba(11, 43, 85, 0.1);
            border-color: var(--brand-border, rgba(18, 97, 181, 0.3));
        }

        /* Offerings Carousel Stage & Side Floating Arrows */
        .offerings-carousel-stage {
            position: relative;
            width: 100%;
        }
        .offerings-side-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #FFFFFF;
            border: 1.5px solid var(--border);
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(11, 43, 85, 0.12);
            z-index: 15;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            user-select: none;
            padding: 0;
        }
        .offerings-side-arrow.prev-arrow {
            left: -24px;
        }
        .offerings-side-arrow.next-arrow {
            right: -24px;
        }
        .offerings-side-arrow:hover:not(:disabled) {
            background: var(--brand-primary, var(--blue));
            border-color: var(--brand-primary, var(--blue));
            color: #FFFFFF;
            transform: translateY(-50%) scale(1.12);
            box-shadow: 0 12px 28px var(--brand-glow, rgba(18, 97, 181, 0.32));
        }
        .offerings-side-arrow:disabled {
            opacity: 0.28;
            cursor: not-allowed;
            pointer-events: none;
            box-shadow: none !important;
            background: #F1F5F9 !important;
            border-color: var(--border) !important;
            color: var(--text-muted) !important;
        }
        .offerings-side-arrow svg {
            transition: transform 0.2s ease;
        }
        .offerings-side-arrow.prev-arrow:hover:not(:disabled) svg {
            transform: translateX(-2px);
        }
        .offerings-side-arrow.next-arrow:hover:not(:disabled) svg {
            transform: translateX(2px);
        }

        .offerings-pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            margin-top: 1.85rem;
        }
        .offerings-dot {
            width: 10px;
            height: 10px;
            border-radius: 9999px;
            background: #CBD5E1;
            border: none;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .offerings-dot:hover:not(.active) {
            background: #94A3B8;
            transform: scale(1.2);
        }
        .offerings-dot.active {
            width: 32px;
            background: var(--brand-primary, var(--blue));
            border-radius: 9999px;
            box-shadow: 0 2px 8px var(--brand-glow, rgba(18, 97, 181, 0.3));
        }

        @media (max-width: 1200px) {
            .offerings-side-arrow.prev-arrow { left: -14px; }
            .offerings-side-arrow.next-arrow { right: -14px; }
        }
        @media (max-width: 992px) {
            .offerings-slider-track {
                gap: 1.5rem;
            }
            .offering-card {
                flex: 0 0 calc((100% - 1.5rem) / 2);
                max-width: calc((100% - 1.5rem) / 2);
            }
        }
        @media (max-width: 768px) {
            .offerings-side-arrow {
                width: 40px;
                height: 40px;
            }
            .offerings-side-arrow.prev-arrow { left: -8px; }
            .offerings-side-arrow.next-arrow { right: -8px; }
        }
        @media (max-width: 640px) {
            .offerings-slider-track {
                gap: 1rem;
            }
            .offering-card {
                flex: 0 0 100%;
                max-width: 100%;
                padding: 1.85rem 1.5rem;
            }
            .offerings-side-arrow.prev-arrow { left: 4px; }
            .offerings-side-arrow.next-arrow { right: 4px; }
        }
        .offering-tag {
            align-self: flex-start;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            background: var(--brand-subtle, #EFF6FF);
            color: var(--brand-primary, var(--blue));
            margin-bottom: 1.25rem;
        }
        .offering-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }
        .offering-desc {
            font-size: 0.94rem;
            color: var(--text-body);
            line-height: 1.65;
            margin-bottom: 1.25rem;
            flex-grow: 1;
        }
        .offering-highlights {
            list-style: none;
            margin: 0 0 1.5rem 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        .offering-highlights li {
            display: flex;
            align-items: flex-start;
            gap: 0.45rem;
        }
        .offering-highlights li span {
            color: var(--brand-primary, var(--blue));
            font-weight: 700;
        }
        .offering-cta {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--brand-primary, var(--blue));
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            transition: gap 0.2s ease;
        }
        .offering-card:hover .offering-cta {
            gap: 0.65rem;
        }

        /* ===== OFFICIAL LANDING PAGE HUB SECTION ===== */
        .hub-banner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
            border-radius: 28px;
            padding: 3.5rem 3.5rem;
            color: #FFFFFF;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px -10px rgba(7, 28, 56, 0.4);
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 3rem;
            align-items: center;
        }
        .hub-banner-glow {
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--brand-glow, rgba(18, 97, 181, 0.35)) 0%, transparent 70%);
            pointer-events: none;
        }
        .hub-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--brand-secondary, #38bdf8);
            margin-bottom: 1rem;
        }
        .hub-title {
            font-size: clamp(1.85rem, 3.2vw, 2.45rem);
            font-weight: 800;
            line-height: 1.2;
            color: #FFFFFF;
            margin-bottom: 1rem;
        }
        .hub-desc {
            font-size: 1.02rem;
            color: #94A3B8;
            line-height: 1.7;
            margin-bottom: 2rem;
        }
        .hub-btn-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .btn-hub-primary {
            background: var(--brand-primary, #FFFFFF);
            color: #FFFFFF;
            border: 1.5px solid var(--brand-primary, #FFFFFF);
            padding: 0.9rem 2rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        }
        .btn-hub-primary:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            color: #FFFFFF;
        }
        .hub-quicklinks-box {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        .hub-quicklink-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.15rem;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #E2E8F0;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .hub-quicklink-item:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #FFFFFF;
            transform: translateX(4px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* ===== LIVE ARTICLES FEED ===== */
        .live-articles-section {
            background: #FFFFFF;
        }
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.75rem;
        }
        .article-card {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.28s ease;
        }
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -6px rgba(11, 43, 85, 0.1);
            border-color: var(--brand-border, rgba(18, 97, 181, 0.3));
        }
        .article-img-wrap {
            position: relative;
            width: 100%;
            height: 190px;
            background: var(--surface-alt);
            overflow: hidden;
        }
        .article-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .article-card:hover .article-img {
            transform: scale(1.05);
        }
        .article-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .article-date {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .article-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--navy);
            line-height: 1.4;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .article-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .article-title a:hover {
            color: var(--brand-primary, var(--blue));
        }
        .article-excerpt {
            font-size: 0.88rem;
            color: var(--text-body);
            line-height: 1.6;
            margin-bottom: 1.25rem;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .article-link {
            font-size: 0.86rem;
            font-weight: 700;
            color: var(--brand-primary, var(--blue));
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .article-link:hover {
            text-decoration: underline;
        }

        /* ===== SISTER BRANDS ===== */
        .sister-brands-section {
            background: var(--surface-alt);
            border-top: 1px solid var(--border);
        }
        .sister-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
        .sister-card {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .sister-card:hover {
            transform: translateY(-3px);
            border-color: var(--navy);
            box-shadow: 0 12px 30px -4px rgba(11, 43, 85, 0.1);
        }
        .sister-info h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.4rem;
        }
        .sister-info p {
            font-size: 0.9rem;
            color: var(--text-body);
            line-height: 1.5;
        }
        .sister-arrow {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--surface-alt);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: var(--navy);
            flex-shrink: 0;
            transition: all 0.2s ease;
        }
        .sister-card:hover .sister-arrow {
            background: var(--navy);
            color: #FFFFFF;
            transform: translateX(4px);
        }

        /* ===== FOOTER ===== */
        footer {
            background: #071c38;
            color: #FFFFFF;
            padding: 2.75rem 0 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1.6fr;
            gap: 3.5rem;
            margin-bottom: 3.5rem;
        }
        .footer-logo-link {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.2s ease;
            margin: 0;
            padding: 0;
            line-height: 1;
        }
        .footer-logo-link:hover {
            transform: scale(1.03);
            opacity: 1;
        }
        .footer-logo-img {
            height: 110px;
            max-width: 100%;
            width: auto;
            object-fit: contain;
            display: block;
            margin: 0;
            filter: brightness(0) invert(1);
            opacity: 1;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        .footer-brand-col p {
            font-size: 0.9rem;
            color: #94A3B8;
            line-height: 1.7;
            margin: 0.75rem 0 1.5rem;
            max-width: 340px;
        }
        .footer-contact-block {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-top: 0.5rem;
        }
        .footer-contact-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .footer-contact-label {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94A3B8;
        }
        .footer-contact-text {
            font-size: 0.88rem;
            color: #E2E8F0;
            line-height: 1.6;
            margin: 0 !important;
        }
        .footer-col-title {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #FFFFFF;
            margin-bottom: 1.35rem;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .footer-links a {
            color: #94A3B8;
            text-decoration: none;
            font-size: 0.88rem;
            transition: all 0.2s ease;
        }
        .footer-links a:hover {
            color: #FFFFFF;
            padding-left: 4px;
        }

        /* Publications Dropdowns - Clean Typography matching WECON */
        .footer-pub-dropdowns {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .footer-pub-accordion {
            border: none;
            background: transparent;
            border-radius: 0;
            overflow: visible;
        }
        .footer-pub-summary {
            list-style: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.88rem;
            font-weight: 400;
            color: #94A3B8;
            transition: all 0.2s ease;
        }
        .footer-pub-summary:hover,
        .footer-pub-accordion[open] > .footer-pub-summary {
            color: #FFFFFF;
            padding-left: 4px;
        }
        .footer-pub-summary::-webkit-details-marker {
            display: none;
        }
        .footer-pub-chevron {
            font-size: 0.68rem;
            color: #64748B;
            margin-left: 0.5rem;
            transition: transform 0.2s ease, color 0.2s ease;
        }
        .footer-pub-accordion[open] .footer-pub-chevron {
            transform: rotate(180deg);
            color: #FFFFFF;
        }
        .footer-pub-content {
            padding: 0.75rem 0 0.5rem 0.85rem;
            margin-top: 0.5rem;
            border-left: 1.5px solid rgba(255, 255, 255, 0.12);
            background: transparent;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        .pub-main-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: #FFFFFF;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }
        .pub-sub-title {
            font-size: 0.78rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .pub-sub-title.conferences,
        .pub-sub-title.awards,
        .pub-sub-title.general {
            color: #E2E8F0;
        }
        .pub-item-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }
        .pub-item-list li a,
        .pub-item-list li span {
            font-size: 0.84rem;
            color: #94A3B8;
            text-decoration: none;
            display: block;
            transition: color 0.2s ease, padding-left 0.2s ease;
            line-height: 1.45;
        }
        .pub-item-list li a:hover {
            color: #FFFFFF;
            padding-left: 4px;
        }
        .footer-bottom {
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.84rem;
            color: #64748B;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-legal-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .footer-legal-links a {
            color: #64748B;
            text-decoration: none;
        }
        .footer-legal-links a:hover { color: #FFFFFF; }

        /* ===== RESPONSIVE MEDIA QUERIES ===== */
        @media (max-width: 1024px) {
            .offerings-grid { grid-template-columns: repeat(2, 1fr); }
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
            .hub-banner { grid-template-columns: 1fr; gap: 2rem; }
            .footer-grid { grid-template-columns: 1fr repeat(2, 1fr); }
        }

        @media (max-width: 900px) {
            #navbar {
                top: 10px;
                width: calc(100% - 1.5rem);
                height: 62px;
            }
            .nav-logo { height: 46px; }
            .nav-logo-img { height: 96px; margin: -25px -6px; }
            .nav-container { padding: 0 1.25rem; }
            .nav-toggle { display: flex; }
            .nav-links {
                position: fixed;
                top: 76px;
                left: 12px;
                right: 12px;
                background: #FFFFFF;
                border-radius: 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
                height: auto;
                padding: 1.25rem 2rem 1.75rem;
                border: 1px solid var(--border);
                box-shadow: var(--shadow-xl);
                transform: translateY(-130%);
                opacity: 0;
                pointer-events: none;
                transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
            }
            .nav-links.open {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }
            .nav-links li { width: 100%; border-bottom: 1px solid var(--border-light); }
            .nav-links li:last-child { border-bottom: none; }
            .nav-links li a { width: 100%; padding: 0.85rem 0; font-size: 0.98rem; }
            .nav-links li.mobile-cta { display: block; width: 100%; margin-top: 0.75rem; }
            .nav-links li.mobile-cta .nav-cta-btn { width: 100%; justify-content: center; }
            .nav-cta-wrapper { display: none; }

            .brand-hero-inner { grid-template-columns: 1fr; gap: 2.5rem; }
            .brand-hero-logo-wrap { padding: 1.5rem 0; }
            .brand-hero-logo-wrap::before { width: 220px; height: 220px; }
            .brand-hero-floating-logo, .brand-hero-floating-icon { max-width: 200px; max-height: 200px; margin: 0 auto; }
            .sister-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .offerings-grid { grid-template-columns: 1fr; }
            .articles-grid { grid-template-columns: 1fr; }
            .brand-hero-stats { grid-template-columns: 1fr; gap: 1rem; }
            .hub-banner { padding: 2.25rem 1.75rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; align-items: flex-start; }
        }

        /* ===== CONTACT TEAM POPUP MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 43, 85, 0.72);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }
        .contact-team-modal-container {
            background: #FFFFFF;
            width: 95%;
            max-width: 1000px;
            max-height: 96vh;
            overflow-y: auto;
            border-radius: 16px;
            padding: 1.25rem 1.85rem;
            position: relative;
            box-shadow: 0 25px 60px -15px rgba(11, 43, 85, 0.3);
            transform: scale(0.95) translateY(12px);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        .contact-team-modal-container::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .modal-overlay.open .contact-team-modal-container {
            transform: scale(1) translateY(0);
        }
        .modal-close-btn {
            position: absolute;
            top: 12px;
            right: 14px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: #F8FAFC;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            line-height: 1;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }
        .modal-close-btn:hover {
            background: var(--navy);
            color: #FFFFFF;
            border-color: var(--navy);
            transform: scale(1.05);
        }
        .contact-team-modal-grid {
            display: grid;
            grid-template-columns: 310px 1fr;
            gap: 1.5rem;
            align-items: start;
        }
        .contact-team-heading {
            font-size: 1.3rem;
            font-weight: 900;
            color: #0F172A;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }
        .contact-team-subtext {
            font-size: 0.74rem;
            color: #64748B;
            line-height: 1.35;
            margin-bottom: 0.55rem;
        }
        .contact-team-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 0.5rem 0.75rem;
            margin-bottom: 0.4rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }
        .contact-team-card-header {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            margin-bottom: 0.25rem;
        }
        .contact-card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
        }
        .contact-card-icon svg {
            width: 17px;
            height: 17px;
        }
        .contact-card-title {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--navy);
        }
        .contact-card-text {
            font-size: 0.74rem;
            color: #475569;
            line-height: 1.3;
            margin-bottom: 0.25rem;
        }
        .contact-card-link {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.74rem;
            font-weight: 600;
            color: var(--brand-primary, #1261B5);
            text-decoration: none;
            transition: color 0.2s;
        }
        .contact-card-link:hover {
            text-decoration: underline;
        }
        .contact-phone-number {
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.3rem;
        }
        .contact-chat-icons {
            display: flex;
            gap: 0.45rem;
        }
        .chat-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #F1F5F9;
            color: var(--navy);
            font-size: 0.68rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .chat-icon-btn:hover {
            transform: scale(1.1);
        }
        .contact-email-dept {
            font-size: 0.73rem;
            line-height: 1.3;
            margin-bottom: 0.18rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            flex-wrap: wrap;
        }
        .dept-label {
            display: inline;
            font-weight: 700;
            color: #0F172A;
        }
        .dept-email {
            color: #475569;
            text-decoration: none;
            word-break: break-all;
            transition: color 0.2s;
        }
        .dept-email:hover {
            color: var(--brand-primary, #1261B5);
            text-decoration: underline;
        }

        /* Right Form Column */
        .contact-form-heading {
            font-size: 1.22rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 0.55rem;
            letter-spacing: -0.01em;
        }
        .contact-team-form {
            display: flex;
            flex-direction: column;
            gap: 0.42rem;
        }
        .contact-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }
        .contact-input {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #CBD5E1;
            border-radius: 6px;
            padding: 0.42rem 0.65rem;
            font-size: 0.8rem;
            font-family: inherit;
            color: #0F172A;
            background: #FFFFFF;
            transition: border-color 0.2s, box-shadow 0.2s;
            height: 34px;
        }
        .contact-input:focus {
            outline: none;
            border-color: var(--brand-primary, #1261B5);
            box-shadow: 0 0 0 3px var(--brand-glow-subtle, rgba(18, 97, 181, 0.15));
        }
        .contact-textarea {
            height: 48px;
            min-height: 44px;
            resize: none;
            padding: 0.4rem 0.65rem;
            line-height: 1.35;
        }
        .contact-consent-quote {
            font-size: 0.66rem;
            color: #64748B;
            line-height: 1.25;
            margin: 0.1rem 0;
        }
        .contact-consent-label {
            display: flex;
            align-items: flex-start;
            gap: 0.45rem;
            font-size: 0.7rem;
            color: #334155;
            line-height: 1.25;
            cursor: pointer;
        }
        .contact-consent-label input[type="checkbox"] {
            margin-top: 1px;
            width: 13px;
            height: 13px;
            cursor: pointer;
            accent-color: var(--brand-primary, #1261B5);
            flex-shrink: 0;
        }
        .contact-consent-label a {
            color: var(--brand-primary, #1261B5);
            text-decoration: none;
        }
        .contact-consent-label a:hover {
            text-decoration: underline;
        }
        .required-flag {
            color: #DC2626;
            font-weight: 600;
        }
        .btn-submit-contact-brand {
            width: 100%;
            background: var(--brand-primary, var(--navy));
            color: #FFFFFF;
            font-size: 0.86rem;
            font-weight: 700;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin-top: 0.15rem;
            box-shadow: 0 4px 14px var(--brand-glow, rgba(18, 97, 181, 0.25));
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .btn-submit-contact-brand:hover:not(:disabled) {
            background: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(11, 43, 85, 0.25);
        }
        .btn-submit-contact-brand:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        .contact-form-status {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            display: none;
            text-align: center;
        }
        .contact-form-status.success {
            display: block;
            background: rgba(16, 185, 129, 0.15);
            color: #065F46;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        .contact-form-status.error {
            display: block;
            background: rgba(239, 68, 68, 0.12);
            color: #991B1B;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        @media (max-width: 900px) {
            .contact-team-modal-grid { grid-template-columns: 1fr; gap: 1rem; }
            .contact-team-modal-container { padding: 1.25rem 1rem; }
            .contact-form-row { grid-template-columns: 1fr; }
        }
    </style>
    @yield('brand-tokens')
    @yield('extra-styles')
</head>
<body>

    <!-- Scroll Progress Indicator -->
    <div id="scroll-progress"></div>

    <!-- Header / Sticky Navbar -->
    <nav id="navbar" role="navigation" aria-label="Main Navigation">
        <div class="nav-container">
            <!-- Logo Lockup -->
            <a href="{{ route('home') }}" class="nav-logo" aria-label="WECON Home">
                <img src="{{ asset('images/WECON ASIA (2LINE)_Horizontal_Coloured.png') }}?v={{ file_exists(public_path('images/WECON ASIA (2LINE)_Horizontal_Coloured.png')) ? filemtime(public_path('images/WECON ASIA (2LINE)_Horizontal_Coloured.png')) : 1 }}" alt="WECON ASIA" class="nav-logo-img" onerror="this.style.display='none'">
            </a>

            <!-- Mobile Navigation Toggle -->
            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation menu" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Navigation Links -->
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}#about" id="nav-about">About</a></li>
                <li><a href="{{ route('brands.marketech') }}" id="nav-marketech" class="@yield('active-marketech')">Marketech APAC</a></li>
                <li><a href="{{ route('brands.uptech') }}" id="nav-uptech" class="@yield('active-uptech')">Uptech Media</a></li>
                <li><a href="{{ route('brands.hrforward') }}" id="nav-hrforward" class="@yield('active-hrforward')">HR Forward Asia</a></li>
                <li><a href="#contact" id="nav-contact" class="open-contact-modal" onclick="document.getElementById('modal-contact-team').classList.add('open'); document.body.style.overflow='hidden'; return false;">Contact</a></li>
                <li class="mobile-cta">
                    <a href="@yield('brand-landing-url', route('home'))" target="_blank" rel="noopener noreferrer" class="nav-cta-btn">
                        Visit Official Website &rarr;
                    </a>
                </li>
            </ul>

            <!-- Right Side CTA: Link to Brand's Landing Page -->
            <div class="nav-cta-wrapper">
                <a href="@yield('brand-landing-url', route('home'))" target="_blank" rel="noopener noreferrer" class="nav-cta-btn" id="nav-connected-btn">
                    Visit Official Site &rarr;
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer role="contentinfo">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-brand-col">
                    <a href="{{ route('home') }}" class="footer-logo-link" aria-label="WECON Home">
                        <img src="{{ asset('images/wecon-asia-logo-tight.png') }}?v={{ file_exists(public_path('images/wecon-asia-logo-tight.png')) ? filemtime(public_path('images/wecon-asia-logo-tight.png')) : 1 }}" alt="WECON ASIA" class="footer-logo-img" onerror="this.style.display='none';">
                    </a>
                    <p>
                        Wecon Asia Media Group, Inc. is an Asia-Pacific media, events, and business information ecosystem connecting leaders, ideas, and transformative opportunities.
                    </p>

                    <!-- Address Location & Company Number (Text Only) -->
                    <div class="footer-contact-block">
                        <div class="footer-contact-item">
                            <span class="footer-contact-label">Address Location</span>
                            <p class="footer-contact-text">
                                {{ $sections['contact']['office_address'] ?? '14i Seville Tower, Circulo Verde Phase 1, #70 Calle Industria, Brgy. Bagumbayan, Quezon City, 1100 Philippines' }}
                            </p>
                        </div>

                        <div class="footer-contact-item">
                            <span class="footer-contact-label">Company Number</span>
                            <p class="footer-contact-text">
                                {{ $sections['contact']['call_phone'] ?? '+63 917 319 5762' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Column 1: WECON -->
                <div>
                    <h4 class="footer-col-title">WECON</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}#about">About WECON</a></li>
                        <li><a href="{{ route('home') }}#why-wecon">Our values and Visions</a></li>
                        <li><a href="{{ route('home') }}#why-wecon">Our Story</a></li>
                        <li><a href="{{ route('home') }}#journey">careers</a></li>
                    </ul>
                </div>

                <!-- Column 2: PUBLICATIONS (Dropdown Features) -->
                <div>
                    <h4 class="footer-col-title">PUBLICATIONS</h4>
                    <div class="footer-pub-dropdowns">
                        <!-- Brand 1: Marketech APAC -->
                        <details class="footer-pub-accordion">
                            <summary class="footer-pub-summary">
                                <span>Marketech APAC</span>
                                <span class="footer-pub-chevron">&#9662;</span>
                            </summary>
                            <div class="footer-pub-content">
                                <div class="pub-main-title">Featured Events</div>

                                <!-- Conferences -->
                                <div>
                                    <div class="pub-sub-title conferences">Conferences</div>
                                    <ul class="pub-item-list">
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Retail & E-Commerce Innovation Series</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">What's NEXT in Marketing Series</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Digital Experience Asia Series</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Advertising Summit Asia Philippines</a></li>
                                    </ul>
                                </div>

                                <!-- Awards -->
                                <div>
                                    <div class="pub-sub-title awards">Awards</div>
                                    <ul class="pub-item-list">
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">NEXT Awards Series</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Advertising Awards Asia Pacific</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Content Marketing Awards Asia Pacific</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Marketing Technology Awards</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Retail & E-commerce Excellence Awards Asia Pacific</a></li>
                                        <li><a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer">Empowered Women Awards</a></li>
                                    </ul>
                                </div>
                            </div>
                        </details>

                        <!-- Brand 2: Uptech Media -->
                        <details class="footer-pub-accordion">
                            <summary class="footer-pub-summary">
                                <span>Uptech Media</span>
                                <span class="footer-pub-chevron">&#9662;</span>
                            </summary>
                            <div class="footer-pub-content">
                                <div>
                                    <div class="pub-main-title">Categories</div>
                                    <ul class="pub-item-list">
                                        <li><a href="https://uptech-media.com/category/ai/" target="_blank" rel="noopener noreferrer">AI</a></li>
                                        <li><a href="https://uptech-media.com/category/cx/" target="_blank" rel="noopener noreferrer">CX</a></li>
                                        <li><a href="https://uptech-media.com/category/cybersecurity/" target="_blank" rel="noopener noreferrer">Cybersecurity</a></li>
                                        <li><a href="https://uptech-media.com/category/data/" target="_blank" rel="noopener noreferrer">Data</a></li>
                                        <li><a href="https://uptech-media.com/category/e-commerce/" target="_blank" rel="noopener noreferrer">E-commerce</a></li>
                                        <li><a href="https://uptech-media.com/category/fintech/" target="_blank" rel="noopener noreferrer">Fintech</a></li>
                                    </ul>
                                </div>
                            </div>
                        </details>

                        <!-- Brand 3: HR Forward Asia -->
                        <details class="footer-pub-accordion" open>
                            <summary class="footer-pub-summary">
                                <span>HR Forward Asia</span>
                                <span class="footer-pub-chevron">&#9662;</span>
                            </summary>
                            <div class="footer-pub-content">
                                <div>
                                    <div class="pub-main-title">CONTENT PILLAR</div>
                                    <ul class="pub-item-list">
                                        <li><a href="https://hrforwardasia.com/category/talent-development/" target="_blank" rel="noopener noreferrer">Talent Development</a></li>
                                        <li><a href="https://hrforwardasia.com/category/leadership/" target="_blank" rel="noopener noreferrer">Leadership</a></li>
                                        <li><a href="https://hrforwardasia.com/category/employee-experience/" target="_blank" rel="noopener noreferrer">Employee Experience</a></li>
                                        <li><a href="https://hrforwardasia.com/category/total-rewards/" target="_blank" rel="noopener noreferrer">Total Rewards</a></li>
                                        <li><a href="https://hrforwardasia.com/category/hr-tech/" target="_blank" rel="noopener noreferrer">HR Tech</a></li>
                                        <li><a href="https://hrforwardasia.com/category/recruitment/" target="_blank" rel="noopener noreferrer">Recruitment</a></li>
                                        <li><a href="https://hrforwardasia.com/category/legal-landscape/" target="_blank" rel="noopener noreferrer">Legal Landscape</a></li>
                                    </ul>
                                </div>
                            </div>
                        </details>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom">
                <div>
                    &copy; 2025 WECON Asia Media Group, Inc. All rights reserved.
                </div>
                <div class="footer-legal-links">
                    <a href="#privacy" onclick="alert('Privacy Policy: WECON adheres strictly to international data privacy regulations including GDPR and regional personal data protection acts.'); return false;">Privacy Policy</a>
                    <a href="#terms" onclick="alert('Terms & Conditions: Content published across WECON channels is protected by copyright and intellectual property treaties.'); return false;">Terms & Conditions</a>
                    <a href="#sitemap">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Contact Our Team Modal -->
    <div class="modal-overlay" id="modal-contact-team" role="dialog" aria-modal="true" aria-labelledby="modal-contact-team-title">
        <div class="contact-team-modal-container no-scrollbar">
            <button class="modal-close-btn" id="close-contact-team-btn" aria-label="Close modal">&times;</button>
            
            <div class="contact-team-modal-grid">
                <!-- LEFT COLUMN: Get In Touch with Us -->
                <div class="contact-team-left-col">
                    <h2 class="contact-team-heading" id="modal-contact-team-title">
                        Get In Touch with Us
                    </h2>
                    <p class="contact-team-subtext">
                        Connect with us to stay up-to-date on the latest news and events, network with industry professionals, and gain access to exclusive insights and resources across the Asia-Pacific.
                    </p>

                    <!-- Office Card -->
                    <div class="contact-team-card">
                        <div class="contact-team-card-header">
                            <span class="contact-card-icon office-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M9 9h1M9 13h1M9 17h1M14 9h1M14 13h1M14 17h1"/></svg>
                            </span>
                            <h3 class="contact-card-title">Office</h3>
                        </div>
                        <p class="contact-card-text">
                            14i Seville Tower, Circulo Verde Phase 1, #70 Calle Industria, Brgy. Bagumbayan, Quezon City, 1100 Philippines
                        </p>
                        <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer" class="contact-card-link">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                            Google Map
                        </a>
                    </div>

                    <!-- Call/Message Us Card -->
                    <div class="contact-team-card">
                        <div class="contact-team-card-header">
                            <span class="contact-card-icon phone-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            </span>
                            <h3 class="contact-card-title">Call/Message Us</h3>
                        </div>
                        <div class="contact-phone-number">
                            +63 917 319 5762
                        </div>
                        <div class="contact-chat-icons">
                            <a href="tel:+639173195762" class="chat-icon-btn" title="Phone Call">&#x1F4DE;</a>
                            <a href="#" class="chat-icon-btn" title="Viber">&#x1F4AC;</a>
                            <a href="#" class="chat-icon-btn" title="WhatsApp">&#x1F4AC;</a>
                        </div>
                    </div>

                    <!-- Email Us Card -->
                    <div class="contact-team-card">
                        <div class="contact-team-card-header">
                            <span class="contact-card-icon email-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <h3 class="contact-card-title">Email Us</h3>
                        </div>
                        <div class="contact-email-dept">
                            <span class="dept-label">General:</span>
                            <a href="mailto:hello@wecon.asia" class="dept-email">hello@wecon.asia</a>
                        </div>
                        <div class="contact-email-dept">
                            <span class="dept-label">Partnerships & Sales:</span>
                            <a href="mailto:sales@wecon.asia" class="dept-email">sales@wecon.asia</a>
                        </div>
                        <div class="contact-email-dept">
                            <span class="dept-label">Editorial:</span>
                            <a href="mailto:editorial@wecon.asia" class="dept-email">editorial@wecon.asia</a>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Contact Form -->
                <div class="contact-team-right-col">
                    <h2 class="contact-form-heading">
                        @yield('brand-contact-title', 'Connect with Our Team')
                    </h2>

                    <form id="contact-team-form" class="contact-team-form">
                        @csrf
                        <!-- Row 1: First Name | Last Name -->
                        <div class="contact-form-row">
                            <input type="text" name="first_name" class="contact-input" placeholder="First Name" required>
                            <input type="text" name="last_name" class="contact-input" placeholder="Last Name" required>
                        </div>

                        <!-- Row 2: Business Email | Contact Number -->
                        <div class="contact-form-row">
                            <input type="email" name="business_email" class="contact-input" placeholder="Business Email" required>
                            <input type="tel" name="contact_number" class="contact-input" placeholder="Contact Number">
                        </div>

                        <!-- Row 3: Job Title | Company Name -->
                        <div class="contact-form-row">
                            <input type="text" name="job_title" class="contact-input" placeholder="Job Title">
                            <input type="text" name="company_name" class="contact-input" placeholder="Company Name">
                        </div>

                        <!-- Row 4: Purpose of connecting -->
                        <div class="contact-form-group">
                            <input type="text" name="purpose" class="contact-input" placeholder="Purpose of connecting">
                        </div>

                        <!-- Row 5: Please share details -->
                        <div class="contact-form-group">
                            <textarea name="details" class="contact-input contact-textarea" placeholder="Please share details"></textarea>
                        </div>

                        <!-- Consent Quote text -->
                        <p class="contact-consent-quote">
                            By submitting this form, I understand WECON Asia's Terms & Conditions and Cookies & Privacy Policy. Opt to receive marketing tips, insights, invitations, and product updates via email from WECON Asia and its brands.
                        </p>

                        <!-- Consent Checkbox -->
                        <label class="contact-consent-label">
                            <input type="checkbox" name="consent_agreed" value="1" required>
                            <span>
                                I agree to the 
                                <a href="{{ route('home') }}#final-cta" target="_blank" rel="noopener noreferrer">Terms & Conditions</a> and 
                                <a href="{{ route('home') }}#final-cta" target="_blank" rel="noopener noreferrer">Privacy Policy</a>. 
                                <span class="required-flag">(Required)</span>
                            </span>
                        </label>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit-contact-brand" id="contact-team-submit-btn">
                            Submit Form
                        </button>

                        <div id="contact-team-status" class="contact-form-status"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        // 1. Scroll Progress Bar
        const progressBar = document.getElementById('scroll-progress');
        window.addEventListener('scroll', () => {
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const percent = (scrollTop / scrollHeight) * 100;
            if (progressBar) progressBar.style.width = percent + '%';
        }, { passive: true });

        // 2. Sticky Navbar Blur
        const navbar = document.getElementById('navbar');
        const updateNavbarScroll = () => {
            if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 20);
        };
        window.addEventListener('scroll', updateNavbarScroll, { passive: true });
        updateNavbarScroll();

        // 3. Mobile Hamburger Menu Toggle
        const navToggle = document.getElementById('navToggle');
        const navLinksList = document.getElementById('navLinks');
        if (navToggle && navLinksList) {
            navToggle.addEventListener('click', () => {
                const isOpen = navToggle.classList.toggle('active');
                navLinksList.classList.toggle('open', isOpen);
            });
            navLinksList.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    navToggle.classList.remove('active');
                    navLinksList.classList.remove('open');
                });
            });
        }

        // 4. Scroll Reveal Animations
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));
        document.querySelectorAll('.brand-hero .reveal, .hero-cinematic .reveal').forEach(el => el.classList.add('visible'));

        // 5. Offerings Carousel / Slider (3 Cards per slide on desktop)
        function initOfferingsSlider() {
            const wrappers = document.querySelectorAll('.offerings-slider-wrapper');
            wrappers.forEach(wrapper => {
                const track = wrapper.querySelector('.offerings-slider-track');
                const prevBtn = wrapper.querySelector('.prev-arrow, .prev-btn');
                const nextBtn = wrapper.querySelector('.next-arrow, .next-btn');
                const pagination = wrapper.querySelector('.offerings-pagination');
                if (!track) return;

                const cards = Array.from(track.querySelectorAll('.offering-card'));
                if (!cards.length) return;

                function getCardsPerSlide() {
                    if (window.innerWidth > 992) return 3;
                    if (window.innerWidth > 640) return 2;
                    return 1;
                }

                let cardsPerSlide = getCardsPerSlide();
                let totalSlides = Math.ceil(cards.length / cardsPerSlide);
                let currentSlide = 0;

                function renderDots() {
                    if (!pagination) return;
                    pagination.innerHTML = '';
                    for (let i = 0; i < totalSlides; i++) {
                        const dot = document.createElement('button');
                        dot.className = 'offerings-dot' + (i === currentSlide ? ' active' : '');
                        dot.type = 'button';
                        dot.setAttribute('aria-label', `Go to slide ${i + 1} of ${totalSlides}`);
                        dot.addEventListener('click', () => goToSlide(i));
                        pagination.appendChild(dot);
                    }
                }

                function updateControls() {
                    if (prevBtn) {
                        prevBtn.disabled = currentSlide <= 0;
                    }
                    if (nextBtn) {
                        nextBtn.disabled = currentSlide >= totalSlides - 1;
                    }
                    if (pagination) {
                        const dots = pagination.querySelectorAll('.offerings-dot');
                        dots.forEach((dot, idx) => {
                            dot.classList.toggle('active', idx === currentSlide);
                        });
                    }
                }

                function goToSlide(index) {
                    if (index < 0) index = 0;
                    if (index >= totalSlides) index = totalSlides - 1;
                    currentSlide = index;

                    const targetCardIndex = Math.min(index * cardsPerSlide, cards.length - 1);
                    const targetCard = cards[targetCardIndex];
                    if (targetCard) {
                        const scrollLeftPos = targetCard.offsetLeft - track.offsetLeft;
                        track.scrollTo({ left: scrollLeftPos, behavior: 'smooth' });
                    }
                    updateControls();
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        if (currentSlide < totalSlides - 1) {
                            goToSlide(currentSlide + 1);
                        }
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        if (currentSlide > 0) {
                            goToSlide(currentSlide - 1);
                        }
                    });
                }

                // Sync controls on touch/wheel/trackpad scroll
                track.addEventListener('scroll', () => {
                    window.clearTimeout(track._scrollTimer);
                    track._scrollTimer = setTimeout(() => {
                        const scrollPos = track.scrollLeft;
                        const maxScroll = track.scrollWidth - track.clientWidth;
                        
                        let closestSlide = 0;
                        let minDiff = Infinity;
                        
                        for (let i = 0; i < totalSlides; i++) {
                            const cardIdx = Math.min(i * cardsPerSlide, cards.length - 1);
                            const card = cards[cardIdx];
                            if (card) {
                                const cardPos = card.offsetLeft - track.offsetLeft;
                                const diff = Math.abs(scrollPos - cardPos);
                                if (diff < minDiff) {
                                    minDiff = diff;
                                    closestSlide = i;
                                }
                            }
                        }

                        if (maxScroll - scrollPos < 15) {
                            closestSlide = totalSlides - 1;
                        } else if (scrollPos < 15) {
                            closestSlide = 0;
                        }

                        if (closestSlide !== currentSlide) {
                            currentSlide = closestSlide;
                            updateControls();
                        }
                    }, 60);
                }, { passive: true });

                window.addEventListener('resize', () => {
                    const newCardsPerSlide = getCardsPerSlide();
                    if (newCardsPerSlide !== cardsPerSlide) {
                        cardsPerSlide = newCardsPerSlide;
                        totalSlides = Math.ceil(cards.length / cardsPerSlide);
                        currentSlide = Math.min(currentSlide, totalSlides - 1);
                        renderDots();
                        goToSlide(currentSlide);
                    }
                });

                renderDots();
                updateControls();
            });
        }
        initOfferingsSlider();

        // 6. Contact Our Team Modal Toggle & Form Handler
        const contactTeamModal = document.getElementById('modal-contact-team');
        const closeContactBtn = document.getElementById('close-contact-team-btn');
        const contactTeamForm = document.getElementById('contact-team-form');
        const contactTeamStatus = document.getElementById('contact-team-status');
        const contactSubmitBtn = document.getElementById('contact-team-submit-btn');

        function checkContactHash() {
            if (window.location.hash === '#contact' || window.location.hash === '#modal-contact-team') {
                if (contactTeamModal) {
                    contactTeamModal.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            }
        }
        window.addEventListener('hashchange', checkContactHash);
        checkContactHash();

        document.querySelectorAll('.open-contact-modal, #nav-contact').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (contactTeamModal) {
                    contactTeamModal.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        function closeContactModal() {
            if (contactTeamModal) {
                contactTeamModal.classList.remove('open');
                document.body.style.overflow = '';
                if (window.location.hash === '#contact' || window.location.hash === '#modal-contact-team') {
                    history.replaceState(null, null, window.location.pathname + window.location.search);
                }
            }
        }

        if (closeContactBtn) {
            closeContactBtn.addEventListener('click', closeContactModal);
        }

        if (contactTeamModal) {
            contactTeamModal.addEventListener('click', (e) => {
                if (e.target === contactTeamModal) {
                    closeContactModal();
                }
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && contactTeamModal && contactTeamModal.classList.contains('open')) {
                closeContactModal();
            }
        });

        if (contactTeamForm) {
            contactTeamForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                if (contactSubmitBtn) {
                    contactSubmitBtn.disabled = true;
                    contactSubmitBtn.textContent = 'Submitting...';
                }
                if (contactTeamStatus) {
                    contactTeamStatus.className = 'contact-form-status';
                    contactTeamStatus.style.display = 'none';
                }

                try {
                    const formData = new FormData(contactTeamForm);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token');
                    const response = await fetch("{{ route('contact.submit') }}", {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        if (contactTeamStatus) {
                            contactTeamStatus.textContent = data.message || 'Thank you! Your information has been submitted. Our team will get in touch shortly.';
                            contactTeamStatus.className = 'contact-form-status success';
                            contactTeamStatus.style.display = 'block';
                        }
                        contactTeamForm.reset();
                        setTimeout(() => {
                            closeContactModal();
                            if (contactTeamStatus) contactTeamStatus.style.display = 'none';
                            if (contactSubmitBtn) {
                                contactSubmitBtn.disabled = false;
                                contactSubmitBtn.textContent = 'Submit Form';
                            }
                        }, 4000);
                    } else {
                        if (contactTeamStatus) {
                            contactTeamStatus.textContent = data.message || 'Please verify the form inputs and consent requirement.';
                            contactTeamStatus.className = 'contact-form-status error';
                            contactTeamStatus.style.display = 'block';
                        }
                        if (contactSubmitBtn) {
                            contactSubmitBtn.disabled = false;
                            contactSubmitBtn.textContent = 'Submit Form';
                        }
                    }
                } catch (err) {
                    if (contactTeamStatus) {
                        contactTeamStatus.textContent = 'Unable to send message. Please check your internet connection.';
                        contactTeamStatus.className = 'contact-form-status error';
                        contactTeamStatus.style.display = 'block';
                    }
                    if (contactSubmitBtn) {
                        contactSubmitBtn.disabled = false;
                        contactSubmitBtn.textContent = 'Submit Form';
                    }
                }
            });
        }

        // 7. Footer Publications Accordion Interaction (Mutual exclusivity)
        document.querySelectorAll('.footer-pub-dropdowns details').forEach(detail => {
            detail.addEventListener('toggle', function() {
                if (this.open) {
                    document.querySelectorAll('.footer-pub-dropdowns details').forEach(other => {
                        if (other !== this && other.open) {
                            other.removeAttribute('open');
                        }
                    });
                }
            });
        });
    </script>
    @yield('extra-scripts')
</body>
</html>
