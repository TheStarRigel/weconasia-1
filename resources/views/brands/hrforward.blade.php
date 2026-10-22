@extends('layouts.brand')

@section('title', 'HR Forward Asia | Pan-Asian Human Capital & Workplace Leadership | WECON Asia')
@section('meta-description', 'HR Forward Asia is a pan-Asian human capital publication and community empowering HR leaders, talent strategists, recruiters, and executive management.')
@section('active-hrforward', 'active')
@section('brand-landing-url', 'https://hrforwardasia.com')

@section('brand-tokens')
<style>
    :root {
        --brand-primary: #C06C44;
        --brand-secondary: #D97706;
        --brand-subtle: rgba(192, 108, 68, 0.08);
        --brand-border: rgba(192, 108, 68, 0.22);
        --brand-glow: rgba(192, 108, 68, 0.32);
        --brand-glow-subtle: rgba(192, 108, 68, 0.12);
        --brand-hero-bg: linear-gradient(135deg, #FFF8F5 0%, #FFFFFF 55%, #FEE2E2 100%);
    }

    /* 2 Columns Display for Foundational Workforce Focus Areas */
    .pillars-grid {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 2rem;
    }
    .pillar-card {
        padding: 2.25rem;
        background: #FFFFFF;
        border-radius: 20px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 18px rgba(11, 43, 85, 0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }
    .pillar-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px -6px rgba(192, 108, 68, 0.15);
        border-color: rgba(192, 108, 68, 0.35);
    }
    @media (max-width: 768px) {
        .pillars-grid {
            grid-template-columns: 1fr !important;
            gap: 1.5rem;
        }
    }
</style>
@endsection

@section('content')

<!-- ===== HERO SECTION & BRIEFING ===== -->
<section class="brand-hero">
    <div class="brand-hero-mesh"></div>
    <div class="brand-hero-inner">
        <!-- Hero Left Column -->
        <div class="reveal">
            <nav class="brand-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">WECON Asia</a>
                <span class="sep">/</span>
                <span>Our Brands</span>
                <span class="sep">/</span>
                <span class="current">HR Forward Asia</span>
            </nav>

            <div class="brand-hero-badge">
                <span>Pan-Asian Human Capital & People Leadership</span>
            </div>

            <h1 class="brand-hero-title">
                Championing the <span style="color: var(--brand-primary);">Future of Work</span> Across Asia Pacific
            </h1>

            <p class="brand-hero-desc">
                HR Forward Asia is the premier publication and professional community dedicated to chief human resources officers (CHROs), talent acquisition innovators, and modern workplace architects shaping executive leadership and organizational resilience across APAC.
            </p>

            <div class="brand-hero-actions">
                <a href="https://hrforwardasia.com" target="_blank" rel="noopener noreferrer" class="btn btn-brand" id="hero-hrforward-link">
                    Visit Official Website &rarr;
                </a>
                <a href="#what-they-offer" class="btn btn-outline-navy">
                    Explore Offerings
                </a>
            </div>
        </div>

        <!-- Hero Right Column: Floating Brand Icon -->
        <div class="brand-hero-logo-wrap reveal" style="transition-delay: 0.15s">
            <img src="{{ asset('images/Icons/HR Forward Asia.png') }}" alt="HR Forward Asia Icon" class="brand-hero-floating-icon">
        </div>
    </div>
</section>

<!-- ===== BRIEFING DESCRIPTION: WHO WE ARE ===== -->
<section id="briefing" class="section-padding" style="background: #FFFFFF;">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Elevating the Human Core of Enterprise</h2>
            <p class="section-desc">
                As technological disruption redefines workplaces, sustainable organizational growth hinges on inspired leadership, empathetic culture, and progressive human capital management.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;" class="reveal">
            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🌱</div>
                    <h3 class="briefing-card-title">Human-Centric Leadership</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Empowering C-suite executives and people leaders to build high-performance cultures anchored in empathy, continuous upskilling, and psychological safety.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🔄</div>
                    <h3 class="briefing-card-title">Workplace Evolution</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Investigating the practical nuances of hybrid workplace dynamics, agile organizational design, and employee experience (EX) across diverse Asian cultures.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🚀</div>
                    <h3 class="briefing-card-title">HR Tech Synergy</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Bridging human intuition with data-driven HR tech—from AI candidate matching and sentiment tracking to unified workforce analytics systems.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT THE BRAND DOES: CORE PILLARS ===== -->
<section id="what-they-do" class="section-padding" style="background: #F8FAFC; border-top: 1px solid var(--border);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What The Brand Does</span>
            <h2 class="section-title">Foundational Workforce Focus Areas</h2>
            <p class="section-desc">
                HR Forward Asia focuses its editorial inquiries, regional conferences, and community roundtables around six interconnected human capital priorities.
            </p>
        </div>

        <div class="pillars-grid reveal">
            <!-- Pillar 1 -->
            <div class="pillar-card" id="future-of-work">
                <span id="legal-landscape" style="position: absolute; top: -90px;"></span>
                <div class="pillar-header">
                    <div class="pillar-icon-box">🏢</div>
                    <h3 class="pillar-title">Future of Work & Hybrid Culture</h3>
                </div>
                <p class="pillar-desc">
                    Analyzing flexible work models, asynchronous productivity workflows, organizational change management, and building cohesion across distributed teams.
                </p>
                <ul class="pillar-bullets">
                    <li>Hybrid & Remote Workplace Policies</li>
                    <li>Asynchronous Collaboration & Culture Building</li>
                    <li>Workplace Design & Digital Headquarters</li>
                </ul>
            </div>

            <!-- Pillar 2 -->
            <div class="pillar-card" id="recruitment">
                <span id="total-rewards" style="position: absolute; top: -90px;"></span>
                <div class="pillar-header">
                    <div class="pillar-icon-box">🔍</div>
                    <h3 class="pillar-title">Talent Acquisition, Total Rewards & Retention</h3>
                </div>
                <p class="pillar-desc">
                    Strategies for employer branding, skills-based hiring, competitive compensation and benefits frameworks, and mitigating executive talent turnover.
                </p>
                <ul class="pillar-bullets">
                    <li>Employer Value Proposition (EVP) Strategies</li>
                    <li>Skills-First vs. Degree-First Recruitment</li>
                    <li>Executive Search & Critical Succession Planning</li>
                </ul>
            </div>

            <!-- Pillar 3 -->
            <div class="pillar-card" id="hr-tech">
                <div class="pillar-header">
                    <div class="pillar-icon-box">💻</div>
                    <h3 class="pillar-title">People Analytics & HR Tech</h3>
                </div>
                <p class="pillar-desc">
                    Navigating human resource information systems (HRIS), AI recruitment screening, predictive retention models, and employee lifecycle metrics.
                </p>
                <ul class="pillar-bullets">
                    <li>Modern HRIS & Cloud Payroll Platforms</li>
                    <li>Predictive Turnover & Performance Analytics</li>
                    <li>AI Ethical Guardrails in Candidate Sourcing</li>
                </ul>
            </div>

            <!-- Pillar 4 -->
            <div class="pillar-card" id="leadership">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🌟</div>
                    <h3 class="pillar-title">Leadership & Executive Development</h3>
                </div>
                <p class="pillar-desc">
                    Equipping emerging and senior leaders with executive coaching, adaptive change leadership tools, resilience frameworks, and mentorship networks.
                </p>
                <ul class="pillar-bullets">
                    <li>C-Suite Succession & Board Readiness</li>
                    <li>Mid-Management Upskilling & Coaching</li>
                    <li>Cross-Cultural Executive Agility in APAC</li>
                </ul>
            </div>

            <!-- Pillar 5 -->
            <div class="pillar-card" id="employee-experience">
                <div class="pillar-header">
                    <div class="pillar-icon-box">❤️</div>
                    <h3 class="pillar-title">DEI & Holistic Employee Wellness</h3>
                </div>
                <p class="pillar-desc">
                    Championing diverse hiring pipelines, workplace equity, neurodiversity, corporate mental health initiatives, and holistic well-being programs.
                </p>
                <ul class="pillar-bullets">
                    <li>Corporate Mental Health & Burnout Prevention</li>
                    <li>Inclusive Leadership & Gender Equity Benchmarks</li>
                    <li>Modern Parental & Wellness Benefits Programs</li>
                </ul>
            </div>

            <!-- Pillar 6 -->
            <div class="pillar-card" id="talent-development">
                <div class="pillar-header">
                    <div class="pillar-icon-box">📚</div>
                    <h3 class="pillar-title">Continuous Upskilling & L&D</h3>
                </div>
                <p class="pillar-desc">
                    Designing impactful learning and development curricula that prepare workforces for automation, AI literacy, and evolving industry standards.
                </p>
                <ul class="pillar-bullets">
                    <li>Enterprise Microlearning & On-Demand Platforms</li>
                    <li>Internal Mobility & Career Pathway Mapping</li>
                    <li>Workforce Reskilling for the AI Era</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT THEY OFFER: COMPREHENSIVE OFFERINGS ===== -->
<section id="what-they-offer" class="section-padding offerings-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What HR Forward Asia Offers</span>
            <h2 class="section-title">Platforms & Solutions for People Leaders</h2>
            <p class="section-desc">
                From flagship human resources summits to custom workplace whitepapers, discover the full range of opportunities available through HR Forward Asia.
            </p>
        </div>

        <div class="offerings-slider-wrapper reveal">
            <div class="offerings-carousel-stage">
                <!-- Left Side Arrow -->
                <button type="button" class="offerings-side-arrow prev-arrow" aria-label="Previous Slide">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <div class="offerings-slider-track">
            <!-- Offering 1: Conferences -->
            <div class="offering-card">
                <span class="offering-tag">Conferences & Summits</span>
                <h3 class="offering-title">People & Culture Summits</h3>
                <p class="offering-desc">
                    High-energy pan-Asian forums convening CHROs, Chief People Officers, and talent innovators for interactive panel debates, fireside chats, and roundtables.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Annual Future of Work & HR Leadership Summit</li>
                    <li><span>•</span> Pan-Asian CHRO Keynote Series</li>
                    <li><span>•</span> Interactive workshops & masterclasses</li>
                </ul>
                <a href="https://hrforwardasia.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    View Upcoming Summits &rarr;
                </a>
            </div>

            <!-- Offering 2: CHRO Roundtables -->
            <div class="offering-card">
                <span class="offering-tag">Executive Dialogues</span>
                <h3 class="offering-title">Closed-Door CHRO Roundtables</h3>
                <p class="offering-desc">
                    Confidential peer exchange sessions where top human capital heads tackle real-world organizational restructuring, compensation, and retention friction.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Chatham House rule environment</li>
                    <li><span>•</span> 12-15 verified enterprise HR executives</li>
                    <li><span>•</span> Curated discussions with actionable takeaways</li>
                </ul>
                <a href="https://hrforwardasia.com/about-us/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Join CHRO Network &rarr;
                </a>
            </div>

            <!-- Offering 3: Thought Leadership -->
            <div class="offering-card">
                <span class="offering-tag">Thought Leadership</span>
                <h3 class="offering-title">Executive Spotlights & Interviews</h3>
                <p class="offering-desc">
                    Share your organization's innovative people initiatives and employer culture through in-depth feature profiles, video podcasts, and guest columns.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Chief People Officer video interviews</li>
                    <li><span>•</span> Employer branding showcase articles</li>
                    <li><span>•</span> Pan-Asian reach across executive LinkedIn networks</li>
                </ul>
                <a href="https://hrforwardasia.com/about-us/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Submit Editorial Proposal &rarr;
                </a>
            </div>

            <!-- Offering 4: Whitepapers & Research -->
            <div class="offering-card">
                <span class="offering-tag">Workplace Research</span>
                <h3 class="offering-title">Human Capital Whitepapers</h3>
                <p class="offering-desc">
                    Rigorous benchmarking reports tracking salary bands, employee engagement metrics, hybrid work sentiment, and HR tech adoption across Asian markets.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Pan-Asian Salary & Benefits Benchmarks</li>
                    <li><span>•</span> APAC Hybrid Workplace Sentiment Surveys</li>
                    <li><span>•</span> AI in Recruitment Readiness Reports</li>
                </ul>
                <a href="https://hrforwardasia.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Explore Research Library &rarr;
                </a>
            </div>

            <!-- Offering 5: HR Tech Showcases -->
            <div class="offering-card">
                <span class="offering-tag">Vendor Solutions</span>
                <h3 class="offering-title">HR Tech Demos & Lead Generation</h3>
                <p class="offering-desc">
                    Position your HRIS, applicant tracking, or employee engagement software before pre-qualified decision-makers actively evaluating modernization options.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Live interactive product demonstration webinars</li>
                    <li><span>•</span> Gated solution comparison guides</li>
                    <li><span>•</span> High-intent B2B sales pipeline generation</li>
                </ul>
                <a href="https://hrforwardasia.com/about-us/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Partner With HR Forward &rarr;
                </a>
            </div>

            <!-- Offering 6: Recognition & Awards -->
            <div class="offering-card">
                <span class="offering-tag">Industry Awards</span>
                <h3 class="offering-title">Excellence in People Leadership</h3>
                <p class="offering-desc">
                    Celebrating visionary HR leaders, transformational people initiatives, and forward-thinking corporate workplaces setting regional standards.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Best Employer Workplace Awards</li>
                    <li><span>•</span> HR Innovator of the Year Accolades</li>
                    <li><span>•</span> Gala celebration with pan-Asian leaders</li>
                </ul>
                <a href="{{ route('home') }}#final-cta" class="offering-cta">
                    Inquire About Recognition &rarr;
                </a>
                </div>

                <!-- Right Side Arrow -->
                <button type="button" class="offerings-side-arrow next-arrow" aria-label="Next Slide">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>

            <!-- Bottom Pagination Dots -->
            <div class="offerings-pagination"></div>
        </div>
    </div>
</section>
@endsection

@section('extra-scripts')
<script>
    // Live WordPress REST API fetch for HR Forward Asia
    async function loadLiveHrforwardPosts() {
        try {
            const res = await fetch('https://hrforwardasia.com/wp-json/wp/v2/posts?_embed=1&per_page=3');
            if (!res.ok) return;
            const posts = await res.json();
            if (!posts || !posts.length) return;

            const container = document.getElementById('hrforward-live-articles');
            if (!container) return;

            let html = '';
            posts.forEach(post => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = post.title?.rendered || 'HR Forward Asia Article';
                const title = tempDiv.textContent;

                const excerptDiv = document.createElement('div');
                excerptDiv.innerHTML = post.excerpt?.rendered || '';
                const excerpt = excerptDiv.textContent.substring(0, 150) + '...';

                const link = post.link || 'https://hrforwardasia.com';
                const date = post.date ? new Date(post.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'Recent';
                const img = post._embedded?.['wp:featuredmedia']?.[0]?.source_url;

                html += `
                    <div class="article-card">
                        <div class="article-img-wrap" style="${!img ? 'background: linear-gradient(135deg, #9A3412, #C06C44); display: flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 2.5rem;' : ''}">
                            ${img ? `<img src="${img}" alt="${title}" class="article-img">` : `🌟`}
                        </div>
                        <div class="article-body">
                            <span class="article-date">${date}</span>
                            <h3 class="article-title">
                                <a href="${link}" target="_blank" rel="noopener noreferrer">${title}</a>
                            </h3>
                            <p class="article-excerpt">${excerpt}</p>
                            <a href="${link}" target="_blank" rel="noopener noreferrer" class="article-link">
                                Read Full Article &rarr;
                            </a>
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
        } catch (err) {
            console.log('Using static fallback for HR Forward live articles');
        }
    }
    loadLiveHrforwardPosts();
</script>
@endsection
