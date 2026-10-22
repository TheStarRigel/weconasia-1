@extends('layouts.brand')

@section('title', 'Uptech Media | Enterprise Technology & AI Intelligence | WECON Asia')
@section('meta-description', 'Uptech Media is a verified technology media company covering enterprise AI, cybersecurity, cloud architecture, fintech, and digital transformation across APAC.')
@section('active-uptech', 'active')
@section('brand-landing-url', 'https://uptech-media.com')

@section('brand-tokens')
<style>
    :root {
        --brand-primary: #0D9488;
        --brand-secondary: #0284C7;
        --brand-subtle: rgba(13, 148, 136, 0.08);
        --brand-border: rgba(13, 148, 136, 0.22);
        --brand-glow: rgba(13, 148, 136, 0.32);
        --brand-glow-subtle: rgba(13, 148, 136, 0.12);
        --brand-hero-bg: linear-gradient(135deg, #F0FDFA 0%, #FFFFFF 55%, #E0F2FE 100%);
    }

    /* 2 Columns Display for Core Technology Coverage Areas */
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
        box-shadow: 0 16px 36px -6px rgba(13, 148, 136, 0.15);
        border-color: rgba(13, 148, 136, 0.35);
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
                <span class="current">Uptech Media</span>
            </nav>

            <div class="brand-hero-badge">
                <span>Always Moving Upwards &mdash; Enterprise Tech & AI</span>
            </div>

            <h1 class="brand-hero-title">
                Navigating Enterprise <span style="color: var(--brand-primary);">Technology & AI</span> in APAC
            </h1>

            <p class="brand-hero-desc">
                Uptech Media is a verified technology news and trade publication equipping business leaders, CTOs, CIOs, and tech innovators with actionable intelligence on enterprise AI, cybersecurity, cloud infrastructure, and fintech across Asia Pacific.
            </p>

            <div class="brand-hero-actions">
                <a href="https://uptech-media.com" target="_blank" rel="noopener noreferrer" class="btn btn-brand" id="hero-uptech-link">
                    Visit Official Website &rarr;
                </a>
                <a href="#what-they-offer" class="btn btn-outline-navy">
                    Explore Offerings
                </a>
            </div>
        </div>

        <!-- Hero Right Column: Floating Brand Icon -->
        <div class="brand-hero-logo-wrap reveal" style="transition-delay: 0.15s">
            <img src="{{ asset('images/Icons/UpTech Media.png') }}" alt="Uptech Media Icon" class="brand-hero-floating-icon">
        </div>
    </div>
</section>

<!-- ===== BRIEFING DESCRIPTION: WHO WE ARE ===== -->
<section id="briefing" class="section-padding" style="background: #FFFFFF;">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Verified Intelligence for the Digital Era</h2>
            <p class="section-desc">
                In an era of rapid technological disruption, Uptech Media serves as a trusted compass for enterprises seeking sustainable digital maturity, architectural resilience, and genuine innovation.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;" class="reveal">
            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">💡</div>
                    <h3 class="briefing-card-title">Philosophy: Always Moving Upwards</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    We believe technology exists to uplift organizations and societies. Our reporting looks past fleeting hype to investigate scalable implementations delivering measurable enterprise ROI.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🛡️</div>
                    <h3 class="briefing-card-title">Enterprise Depth</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    From zero-trust network architectures to cloud-native database transitions, our editorial content is authored and vetted for IT decision-makers who manage real budgets and critical security postures.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">⚡</div>
                    <h3 class="briefing-card-title">Convening Innovators</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Uptech Media brings together chief technology officers, chief information security officers, and leading software vendors through targeted summits, roundtables, and technical webinars.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT THE BRAND DOES: CORE TECH PILLARS ===== -->
<section id="what-they-do" class="section-padding" style="background: #F8FAFC; border-top: 1px solid var(--border);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What The Brand Does</span>
            <h2 class="section-title">Core Technology Coverage Areas</h2>
            <p class="section-desc">
                Uptech Media delivers rigorous analysis across the mission-critical pillars powering modern enterprise operations throughout the Asia-Pacific region.
            </p>
        </div>

        <div class="pillars-grid reveal">
            <!-- Pillar 1 -->
            <div class="pillar-card" id="ai">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🤖</div>
                    <h3 class="pillar-title">Artificial Intelligence & Automation</h3>
                </div>
                <p class="pillar-desc">
                    Tracking real-world enterprise LLM deployments, agentic workflows, robotic process automation, and ethical AI governance across regional industries.
                </p>
                <ul class="pillar-bullets">
                    <li>Generative AI in Enterprise Software</li>
                    <li>Machine Learning Models & Data Governance</li>
                    <li>Operational AI & Workflow Orchestration</li>
                </ul>
            </div>

            <!-- Pillar 2 -->
            <div class="pillar-card" id="cybersecurity">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🔐</div>
                    <h3 class="pillar-title">Cybersecurity & Threat Defense</h3>
                </div>
                <p class="pillar-desc">
                    Deep coverage of zero-trust architectures, ransomware response strategies, cloud security postures, and regional data protection compliance.
                </p>
                <ul class="pillar-bullets">
                    <li>Zero-Trust & Identity Access Management (IAM)</li>
                    <li>Ransomware Mitigation & Incident Response</li>
                    <li>APAC Regulatory Compliance & Data Sovereignty</li>
                </ul>
            </div>

            <!-- Pillar 3 -->
            <div class="pillar-card" id="cloud">
                <div class="pillar-header">
                    <div class="pillar-icon-box">☁️</div>
                    <h3 class="pillar-title">Cloud Infrastructure & DevOps</h3>
                </div>
                <p class="pillar-desc">
                    Examining hybrid cloud migrations, Kubernetes container orchestration, edge computing nodes, and scalable serverless architectures.
                </p>
                <ul class="pillar-bullets">
                    <li>Hybrid & Multi-Cloud Optimization</li>
                    <li>Containerization & Microservices Design</li>
                    <li>FinOps: Managing Cloud Infrastructure Costs</li>
                </ul>
            </div>

            <!-- Pillar 4 -->
            <div class="pillar-card" id="fintech">
                <span id="ecommerce" style="position: absolute; top: -90px;"></span>
                <div class="pillar-header">
                    <div class="pillar-icon-box">📈</div>
                    <h3 class="pillar-title">Fintech, E-Commerce & Digital Banking</h3>
                </div>
                <p class="pillar-desc">
                    Investigating core banking modernization, digital wallets, real-time cross-border payment rails, embedded finance, and regulatory technology.
                </p>
                <ul class="pillar-bullets">
                    <li>Open Banking & API Ecosystems</li>
                    <li>Cross-Border Digital Payments Infrastructure</li>
                    <li>Fraud Prevention & AI-Powered RegTech</li>
                </ul>
            </div>

            <!-- Pillar 5 -->
            <div class="pillar-card" id="cx">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🎯</div>
                    <h3 class="pillar-title">Customer Experience (CX) Tech</h3>
                </div>
                <p class="pillar-desc">
                    Exploring AI-driven personalization engines, omnichannel contact center solutions, customer journey orchestration, and sentiment analysis tools.
                </p>
                <ul class="pillar-bullets">
                    <li>Conversational AI & Customer Virtual Agents</li>
                    <li>Real-Time CX Analytics & Feedback Loops</li>
                    <li>Digital Experience Platforms (DXP)</li>
                </ul>
            </div>

            <!-- Pillar 6 -->
            <div class="pillar-card" id="data">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🗄️</div>
                    <h3 class="pillar-title">Data Engineering & Analytics</h3>
                </div>
                <p class="pillar-desc">
                    Demystifying modern data warehouses, lakehouse architectures, real-time data streaming pipelines, and predictive business analytics.
                </p>
                <ul class="pillar-bullets">
                    <li>Data Mesh & Distributed Architectures</li>
                    <li>Real-Time Stream Processing Pipelines</li>
                    <li>Business Intelligence & Decision Support Systems</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT THEY OFFER: COMPREHENSIVE OFFERINGS ===== -->
<section id="what-they-offer" class="section-padding offerings-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What Uptech Media Offers</span>
            <h2 class="section-title">Solutions for Enterprise Tech Leaders & Vendors</h2>
            <p class="section-desc">
                Whether you are an enterprise looking to future-proof IT operations or a tech vendor seeking qualified B2B leads across APAC, explore Uptech Media's offerings.
            </p>
        </div>

        <div class="offerings-slider-wrapper reveal">
            <div class="offerings-carousel-stage">
                <!-- Left Side Arrow -->
                <button type="button" class="offerings-side-arrow prev-arrow" aria-label="Previous Slide">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <div class="offerings-slider-track">
            <!-- Offering 1: Daily Intelligence -->
            <div class="offering-card">
                <span class="offering-tag">Trade Intelligence</span>
                <h3 class="offering-title">Daily News & Technology Analysis</h3>
                <p class="offering-desc">
                    Unfiltered reporting on emerging tech innovations, software product releases, venture capital rounds, and regional IT leadership transitions.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Verified trade news across 6 core tech domains</li>
                    <li><span>•</span> Technical deep-dives & architectural guides</li>
                    <li><span>•</span> Weekly curated CTO briefings and digests</li>
                </ul>
                <a href="https://uptech-media.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Browse Latest News &rarr;
                </a>
            </div>

            <!-- Offering 2: Executive Summits -->
            <div class="offering-card">
                <span class="offering-tag">Conferences & Summits</span>
                <h3 class="offering-title">Technology Leadership Summits</h3>
                <p class="offering-desc">
                    Pan-Asian enterprise tech forums connecting CIOs, CTOs, CISOs, and architects to discuss infrastructure modernization, cybersecurity, and AI integration.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Enterprise AI & Cloud Migration Summits</li>
                    <li><span>•</span> Cybersecurity Leadership Briefings</li>
                    <li><span>•</span> Peer networking & live technology showcases</li>
                </ul>
                <a href="https://uptech-media.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    View Conference Schedule &rarr;
                </a>
            </div>

            <!-- Offering 3: CIO Roundtables -->
            <div class="offering-card">
                <span class="offering-tag">Closed-Door Sessions</span>
                <h3 class="offering-title">Curated CIO & CISO Roundtables</h3>
                <p class="offering-desc">
                    High-level, intimate peer-to-peer dialogues connecting technology vendor sponsors directly with enterprise IT decision-makers evaluating solutions.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> 10-15 senior enterprise IT executives per session</li>
                    <li><span>•</span> Pre-qualified attendees with active IT roadmaps</li>
                    <li><span>•</span> Executive whitepaper & discussion summary output</li>
                </ul>
                <a href="https://uptech-media.com/about-us/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Inquire About Roundtables &rarr;
                </a>
            </div>

            <!-- Offering 4: Thought Leadership -->
            <div class="offering-card">
                <span class="offering-tag">B2B Content Marketing</span>
                <h3 class="offering-title">Executive Thought Leadership</h3>
                <p class="offering-desc">
                    Spotlight your company's technical founders, principal architects, and leadership through sponsored interviews, case studies, and bylined articles.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> High-authority editorial placements</li>
                    <li><span>•</span> Customer success story features</li>
                    <li><span>•</span> Targeted distribution to enterprise IT audiences</li>
                </ul>
                <a href="https://uptech-media.com/about-us/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Media Kit Details &rarr;
                </a>
            </div>

            <!-- Offering 5: Technical Whitepapers -->
            <div class="offering-card">
                <span class="offering-tag">Lead Generation</span>
                <h3 class="offering-title">Whitepapers & Technical Reports</h3>
                <p class="offering-desc">
                    Data-driven surveys and technology implementation guides co-published with solution providers to generate high-intent enterprise pipeline.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Regional cloud adoption & security benchmarks</li>
                    <li><span>•</span> Gated distribution with verified lead capture</li>
                    <li><span>•</span> Comprehensive buyer intent reporting</li>
                </ul>
                <a href="https://uptech-media.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Explore Research Library &rarr;
                </a>
            </div>

            <!-- Offering 6: Brand Partnerships -->
            <div class="offering-card">
                <span class="offering-tag">Integrated Campaigns</span>
                <h3 class="offering-title">Webinars & Product Demos</h3>
                <p class="offering-desc">
                    End-to-end management of targeted live digital events, including audience recruitment, moderation, interactive polling, and follow-up nurture.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Turnkey webinar hosting & production</li>
                    <li><span>•</span> Pre-vetted IT decision-maker registrations</li>
                    <li><span>•</span> On-demand content syndication</li>
                </ul>
                <a href="{{ route('home') }}#final-cta" class="offering-cta">
                    Contact Tech Partnerships &rarr;
                </a>
            </div>
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
    // Live WordPress REST API fetch for Uptech Media
    async function loadLiveUptechPosts() {
        try {
            const res = await fetch('https://uptech-media.com/wp-json/wp/v2/posts?_embed=1&per_page=3');
            if (!res.ok) return;
            const posts = await res.json();
            if (!posts || !posts.length) return;

            const container = document.getElementById('uptech-live-articles');
            if (!container) return;

            let html = '';
            posts.forEach(post => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = post.title?.rendered || 'Uptech Media Article';
                const title = tempDiv.textContent;

                const excerptDiv = document.createElement('div');
                excerptDiv.innerHTML = post.excerpt?.rendered || '';
                const excerpt = excerptDiv.textContent.substring(0, 150) + '...';

                const link = post.link || 'https://uptech-media.com';
                const date = post.date ? new Date(post.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'Recent';
                const img = post._embedded?.['wp:featuredmedia']?.[0]?.source_url;

                html += `
                    <div class="article-card">
                        <div class="article-img-wrap" style="${!img ? 'background: linear-gradient(135deg, #0F766E, #0D9488); display: flex; align-items: center; justify-content: center; color: #FFFFFF; font-size: 2.5rem;' : ''}">
                            ${img ? `<img src="${img}" alt="${title}" class="article-img">` : `⚡`}
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
            console.log('Using static fallback for Uptech live articles');
        }
    }
    loadLiveUptechPosts();
</script>
@endsection
