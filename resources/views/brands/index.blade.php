@extends('layouts.brand')

@section('title', 'Our Brands | WECON Asia Media Ecosystem')
@section('meta-description', 'Introducing WECON Asia\'s three specialized media brands: Marketech APAC, Uptech Media, and HR Forward Asia.')
@section('active-brands', 'active')
@section('brand-landing-url', route('home'))

@section('brand-tokens')
<style>
    /* ===== COMPLETE & CLEAN BRANDS DIRECTORY ===== */
    :root {
        --c-marketech: #DC2626;
        --c-marketech-light: #FEF2F2;
        --c-marketech-border: rgba(220, 38, 38, 0.22);
        --c-marketech-glow: rgba(220, 38, 38, 0.2);

        --c-uptech: #0D9488;
        --c-uptech-light: #F0FDFA;
        --c-uptech-border: rgba(13, 148, 136, 0.22);
        --c-uptech-glow: rgba(13, 148, 136, 0.2);

        --c-hrforward: #C06C44;
        --c-hrforward-light: #FFF8F5;
        --c-hrforward-border: rgba(192, 108, 68, 0.22);
        --c-hrforward-glow: rgba(192, 108, 68, 0.2);
    }

    /* Page Hero */
    .brands-simple-hero {
        padding: 135px 2rem 45px;
        text-align: center;
        background: linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);
        border-bottom: 1px solid var(--border-light);
        min-height: calc(100vh / 0.9);
        min-height: calc(100dvh / 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        box-sizing: border-box;
    }
    .brands-simple-hero .container {
        max-width: 900px;
        margin: 0 auto;
    }
    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--blue);
        background: rgba(18, 97, 181, 0.08);
        border: 1px solid rgba(18, 97, 181, 0.18);
        padding: 0.35rem 0.95rem;
        border-radius: 9999px;
        margin-bottom: 1rem;
    }
    .hero-heading {
        font-size: clamp(2.2rem, 4vw, 3.2rem);
        font-weight: 900;
        color: var(--navy);
        line-height: 1.18;
        letter-spacing: -0.025em;
        margin-bottom: 0.85rem;
    }
    .hero-subheading {
        font-size: 1.05rem;
        color: var(--text-body);
        line-height: 1.65;
        margin: 0 auto;
    }

    /* 3 Brands Grid */
    .brands-showcase-section {
        padding: 3.5rem 2rem 5.5rem;
        background: #F8FAFC;
    }
    .brands-showcase-container {
        max-width: 1280px;
        margin: 0 auto;
    }
    .brands-grid-detailed {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        align-items: stretch;
    }

    /* Card Styling */
    .brand-col-card {
        background: #FFFFFF;
        border-radius: 22px;
        border: 1.5px solid var(--border);
        box-shadow: 0 8px 24px -4px rgba(11, 43, 85, 0.06);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease, border-color 0.3s ease;
    }
    .brand-col-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 42px -8px var(--card-glow, rgba(11, 43, 85, 0.14));
        border-color: var(--card-color);
    }
    .brand-col-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--card-color);
    }

    .card-theme-marketech {
        --card-color: var(--c-marketech);
        --card-light: var(--c-marketech-light);
        --card-border: var(--c-marketech-border);
        --card-glow: var(--c-marketech-glow);
    }
    .card-theme-uptech {
        --card-color: var(--c-uptech);
        --card-light: var(--c-uptech-light);
        --card-border: var(--c-uptech-border);
        --card-glow: var(--c-uptech-glow);
    }
    .card-theme-hrforward {
        --card-color: var(--c-hrforward);
        --card-light: var(--c-hrforward-light);
        --card-border: var(--c-hrforward-border);
        --card-glow: var(--c-hrforward-glow);
    }

    /* Card Header */
    .card-head-area {
        padding: 2rem 2rem 1.4rem;
        text-align: center;
        background: var(--card-light);
        border-bottom: 1px solid var(--card-border);
    }
    .brand-logo-holder {
        height: 68px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .brand-logo-holder img {
        max-height: 52px;
        max-width: 210px;
        width: auto;
        object-fit: contain;
    }
    .brand-designated-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 0.85rem;
        border-radius: 9999px;
        font-size: 0.74rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--card-color);
        background: #FFFFFF;
        border: 1px solid var(--card-border);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }
    .brand-designated-tag .tag-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--card-color);
    }

    /* Card Body */
    .card-body-area {
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        gap: 1.35rem;
    }
    .card-short-desc {
        font-size: 0.92rem;
        color: var(--text-body);
        line-height: 1.6;
        margin: 0;
        text-align: left;
    }

    /* Audience Badge Box */
    .audience-box {
        background: var(--card-light);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 0.85rem 1rem;
        text-align: left;
    }
    .section-mini-title {
        font-size: 0.74rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--navy);
        margin-bottom: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .section-mini-title .icon-accent {
        color: var(--card-color);
    }
    .audience-text {
        font-size: 0.84rem;
        color: var(--navy);
        font-weight: 600;
        line-height: 1.45;
        margin: 0;
    }
    .audience-metric {
        font-size: 0.76rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-top: 0.25rem;
    }

    /* Structured Section Lists */
    .feature-group {
        text-align: left;
    }
    .item-pill-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }
    .item-pill {
        font-size: 0.84rem;
        color: var(--text-heading);
        display: flex;
        align-items: flex-start;
        gap: 0.45rem;
        line-height: 1.4;
    }
    .bullet-accent {
        color: var(--card-color);
        font-size: 0.85rem;
        line-height: 1.2;
        flex-shrink: 0;
    }

    /* Card Action Area */
    .card-action-area {
        margin-top: auto;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border-light);
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }
    .btn-landing-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.45rem;
        padding: 0.8rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #FFFFFF;
        background: var(--card-color);
        border: 1.5px solid var(--card-color);
        text-decoration: none;
        transition: all 0.22s ease;
        box-shadow: 0 4px 12px var(--card-glow);
    }
    .btn-landing-primary:hover {
        transform: translateY(-2px);
        filter: brightness(1.08);
        box-shadow: 0 6px 18px var(--card-glow);
        color: #FFFFFF;
    }
    .btn-brand-details {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--text-muted);
        text-decoration: none;
        padding: 0.35rem;
        transition: color 0.2s ease;
    }
    .btn-brand-details:hover {
        color: var(--navy);
    }

    @media (max-width: 1024px) {
        .brands-grid-detailed {
            grid-template-columns: 1fr;
            max-width: 620px;
            margin: 0 auto;
        }
    }
</style>
@endsection

@section('content')

<!-- ===== SIMPLE & CLEAN HERO ===== -->
<section class="brands-simple-hero">
    <div class="container reveal">
        <span class="hero-kicker">WECON Asia Ecosystem</span>
        <h1 class="hero-heading">Introducing Our Three Media Brands</h1>
        <p class="hero-subheading">
            WECON Asia operates three specialized publications connecting marketing, technology, and human capital leaders across the Asia-Pacific region.
        </p>
    </div>
</section>

<!-- ===== 3 BRANDS SHOWCASE SECTION ===== -->
<section class="brands-showcase-section">
    <div class="brands-showcase-container">
        <div class="brands-grid-detailed">

            <!-- ============================================== -->
            <!-- BRAND 1: MARKETECH APAC (Orange Feature)       -->
            <!-- ============================================== -->
            <div class="brand-col-card card-theme-marketech reveal" style="transition-delay: 0.05s;">
                <!-- Header with Logo and Designated Color Tag -->
                <div class="card-head-area">
                    <div class="brand-logo-holder">
                        <img src="{{ asset('images/marketech-logo.png') }}" alt="Marketech APAC Logo">
                    </div>
                    <span class="brand-designated-tag">
                        <span class="tag-dot"></span>
                        Marketing & MarTech
                    </span>
                </div>

                <!-- Body Area -->
                <div class="card-body-area">
                    <!-- Brand Description -->
                    <p class="card-short-desc">
                        Asia-Pacific's premier marketing technology intelligence publication reporting on digital advertising, MarTech innovation, retail media, and brand strategy across 14 APAC markets.
                    </p>

                    <!-- Current Audiences (for future reference) -->
                    <div class="audience-box">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9679;</span> Current Audiences (Reference)
                        </div>
                        <p class="audience-text">
                            Chief Marketing Officers (CMOs), Heads of Marketing, Digital Ad Buyers, Media Agencies, and E-Commerce Directors.
                        </p>
                        <div class="audience-metric">180,000+ monthly APAC readership</div>
                    </div>

                    <!-- List of Awards Programs -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9733;</span> Awards Programs
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Retail & E-Commerce Excellence Awards (REA)</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> The NEXT Awards (Marketing Innovation)</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Empowered Women in Tech & Marketing Awards</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Marketing Technology Awards APAC</li>
                        </ul>
                    </div>

                    <!-- Conferences -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9632;</span> Conferences & Summits
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> What's NEXT in Marketing Summit (PH, MY, SG)</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Retail & E-Commerce Innovation Conference</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Digital Experience Asia & Advertising Summit</li>
                        </ul>
                    </div>

                    <!-- Interviews -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9656;</span> Executive Interviews
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Regional CMO Fireside Q&A Video Series</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Brand Strategist & Creative Founder Dialogues</li>
                        </ul>
                    </div>

                    <!-- Contents Indication / Reports -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9881;</span> Contents Indication & Reports
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> APAC Consumer Engagement & Loyalty Reports</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Cookieless Era & First-Party Data Benchmark Studies</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Daily Marketing, MarTech, Platforms & SME Insights</li>
                        </ul>
                    </div>

                    <!-- Actions / Links -->
                    <div class="card-action-area">
                        <a href="https://marketech-apac.com" target="_blank" rel="noopener noreferrer" class="btn-landing-primary" id="btn-visit-marketech">
                            Visit Official Landing Page &rarr;
                        </a>
                        <a href="{{ route('brands.marketech') }}" class="btn-brand-details">
                            View Dedicated Profile Page &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- BRAND 2: UPTECH MEDIA (Teal Feature)           -->
            <!-- ============================================== -->
            <div class="brand-col-card card-theme-uptech reveal" style="transition-delay: 0.15s;">
                <!-- Header with Logo and Designated Color Tag -->
                <div class="card-head-area">
                    <div class="brand-logo-holder">
                        <img src="{{ asset('images/uptech-logo.png') }}" alt="Uptech Media Logo">
                    </div>
                    <span class="brand-designated-tag">
                        <span class="tag-dot"></span>
                        Enterprise Tech & AI
                    </span>
                </div>

                <!-- Body Area -->
                <div class="card-body-area">
                    <!-- Brand Description -->
                    <p class="card-short-desc">
                        Always moving upwards — verified enterprise technology publication covering enterprise AI, zero-trust cybersecurity, multi-cloud architecture, and fintech across Asia Pacific.
                    </p>

                    <!-- Current Audiences (for future reference) -->
                    <div class="audience-box">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9679;</span> Current Audiences (Reference)
                        </div>
                        <p class="audience-text">
                            Chief Technology Officers (CTOs), CIOs, CISOs, VP Engineering, IT Directors, and Enterprise Software Architects.
                        </p>
                        <div class="audience-metric">140,000+ monthly APAC tech leaders</div>
                    </div>

                    <!-- List of Awards Programs -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9733;</span> Awards Programs
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Enterprise Technology Innovation Awards APAC</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Cloud & Infrastructure Excellence Recognition</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Cybersecurity Trailblazer Accolades</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Emerging Enterprise Software Showcases</li>
                        </ul>
                    </div>

                    <!-- Conferences -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9632;</span> Conferences & Summits
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Enterprise Tech Leadership Summit APAC</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Enterprise AI & Operational Automation Forum</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Cybersecurity & Zero-Trust Defense Briefings</li>
                        </ul>
                    </div>

                    <!-- Interviews -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9656;</span> Executive Interviews
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> CTO & CIO Architectural Deep-Dive Interviews</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Technical Founder & CISO Security Perspectives</li>
                        </ul>
                    </div>

                    <!-- Contents Indication / Reports -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9881;</span> Contents Indication & Reports
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> State of Enterprise AI Adoption in APAC Report</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Zero-Trust Security & Ransomware Defense Benchmarks</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Daily Verified Coverage: Cloud, Fintech, CX & Data</li>
                        </ul>
                    </div>

                    <!-- Actions / Links -->
                    <div class="card-action-area">
                        <a href="https://uptech-media.com" target="_blank" rel="noopener noreferrer" class="btn-landing-primary" id="btn-visit-uptech">
                            Visit Official Landing Page &rarr;
                        </a>
                        <a href="{{ route('brands.uptech') }}" class="btn-brand-details">
                            View Dedicated Profile Page &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- BRAND 3: HR FORWARD ASIA (Coral Feature)       -->
            <!-- ============================================== -->
            <div class="brand-col-card card-theme-hrforward reveal" style="transition-delay: 0.25s;">
                <!-- Header with Logo and Designated Color Tag -->
                <div class="card-head-area">
                    <div class="brand-logo-holder">
                        <img src="{{ asset('images/hrforward-logo.png') }}" alt="HR Forward Asia Logo">
                    </div>
                    <span class="brand-designated-tag">
                        <span class="tag-dot"></span>
                        Human Capital & Leadership
                    </span>
                </div>

                <!-- Body Area -->
                <div class="card-body-area">
                    <!-- Brand Description -->
                    <p class="card-short-desc">
                        Pan-Asian human capital publication and executive community dedicated to empowering CHROs, talent strategists, recruiters, and executive management shaping the future of work.
                    </p>

                    <!-- Current Audiences (for future reference) -->
                    <div class="audience-box">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9679;</span> Current Audiences (Reference)
                        </div>
                        <p class="audience-text">
                            Chief Human Resources Officers (CHROs), Chief People Officers, Heads of Talent, HR Directors, and People Strategists.
                        </p>
                        <div class="audience-metric">120,000+ monthly APAC HR practitioners</div>
                    </div>

                    <!-- List of Awards Programs -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9733;</span> Awards Programs
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Excellence in People Leadership Awards</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Best Workplace Culture & Employee Experience Awards</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> HR Tech Innovation of the Year Accolades</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Diversity, Equity & Inclusion (DEI) Champion Awards</li>
                        </ul>
                    </div>

                    <!-- Conferences -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9632;</span> Conferences & Summits
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Annual Future of Work & People Leadership Summit</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Pan-Asian CHRO Masterclasses & Forum</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Workplace Culture & Employee Well-being Summit</li>
                        </ul>
                    </div>

                    <!-- Interviews -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9656;</span> Executive Interviews
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> CHRO Executive Perspective Video Interviews</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> People Strategist Leadership Case Study Series</li>
                        </ul>
                    </div>

                    <!-- Contents Indication / Reports -->
                    <div class="feature-group">
                        <div class="section-mini-title">
                            <span class="icon-accent">&#9881;</span> Contents Indication & Reports
                        </div>
                        <ul class="item-pill-list">
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Pan-Asian Salary, Compensation & Benefits Benchmarks</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> APAC Hybrid Workplace Sentiment & Productivity Surveys</li>
                            <li class="item-pill"><span class="bullet-accent">&#8226;</span> Daily Reporting on Talent, HRIS Tech & Leadership</li>
                        </ul>
                    </div>

                    <!-- Actions / Links -->
                    <div class="card-action-area">
                        <a href="https://hrforwardasia.com" target="_blank" rel="noopener noreferrer" class="btn-landing-primary" id="btn-visit-hrforward">
                            Visit Official Landing Page &rarr;
                        </a>
                        <a href="{{ route('brands.hrforward') }}" class="btn-brand-details">
                            View Dedicated Profile Page &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== SIMPLE FOOTER RIBBON ===== -->
<section style="background: #FFFFFF; border-top: 1px solid var(--border); padding: 3rem 2rem; text-align: center;">
    <div style="max-width: 760px; margin: 0 auto;" class="reveal">
        <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--navy); margin-bottom: 0.5rem;">
            Part of the WECON Asia Media Group
        </h3>
        <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.6; margin-bottom: 1.25rem;">
            Empowering modern business organizations across marketing, technology, and workforce strategy.
        </p>
        <a href="{{ route('home') }}#final-cta" style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.65rem 1.65rem; border-radius: 9999px; font-size: 0.88rem; font-weight: 600; color: var(--navy); background: #FFFFFF; border: 1.5px solid var(--border); text-decoration: none;">
            Contact WECON Team &rarr;
        </a>
    </div>
</section>

@endsection
