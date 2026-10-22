@extends('layouts.brand')

@section('title', 'Marketech APAC | Marketing Technology & Brand Intelligence | WECON Asia')
@section('meta-description', 'Marketech APAC is Asia-Pacific\'s premier marketing technology intelligence platform reporting on digital advertising, MarTech innovation, and brand strategy across APAC.')
@section('active-marketech', 'active')
@section('brand-landing-url', 'https://marketech-apac.com')

@section('brand-tokens')
<style>
    :root {
        --brand-primary: #DC2626;
        --brand-secondary: #EF4444;
        --brand-subtle: rgba(220, 38, 38, 0.08);
        --brand-border: rgba(220, 38, 38, 0.22);
        --brand-glow: rgba(220, 38, 38, 0.32);
        --brand-glow-subtle: rgba(220, 38, 38, 0.12);
        --brand-hero-bg: linear-gradient(135deg, #FEF2F2 0%, #FFFFFF 55%, #FEE2E2 100%);
    }

    /* 2 Columns & 2 Rows Display for Foundational Content Pillars */
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
        box-shadow: 0 16px 36px -6px rgba(220, 38, 38, 0.15);
        border-color: rgba(220, 38, 38, 0.35);
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
                <span class="current">Marketech APAC</span>
            </nav>

            <div class="brand-hero-badge">
                <span>Asia-Pacific Marketing & MarTech Intelligence</span>
            </div>

            <h1 class="brand-hero-title">
                Empowering the Future of <span style="color: var(--brand-primary);">Marketing & Tech</span> Across APAC
            </h1>

            <p class="brand-hero-desc">
                Marketech APAC is the dedicated digital media and community platform spotlighting breakthrough innovations in marketing technology, digital advertising, consumer experience, and brand strategy across Southeast Asia, East Asia, South Asia, and ANZ.
            </p>

            <div class="brand-hero-actions">
                <a href="https://marketech-apac.com" target="_blank" rel="noopener noreferrer" class="btn btn-brand" id="hero-official-link">
                    Visit Official Website &rarr;
                </a>
                <a href="#what-they-offer" class="btn btn-outline-navy">
                    Explore Offerings
                </a>
            </div>
        </div>

        <!-- Hero Right Column: Floating Brand Icon -->
        <div class="brand-hero-logo-wrap reveal" style="transition-delay: 0.15s">
            <img src="{{ asset('images/Icons/MarkeTech Apac.png') }}" alt="Marketech APAC Icon" class="brand-hero-floating-icon">
        </div>
    </div>
</section>

<!-- ===== BRIEFING DESCRIPTION: WHO WE ARE ===== -->
<section id="briefing" class="section-padding" style="background: #FFFFFF;">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="section-title">Bridging Asia-Pacific's Marketing Ecosystem</h2>
            <p class="section-desc">
                From high-growth Southeast Asian startups to multinational enterprises in Singapore, Australia, and Hong Kong, Marketech APAC delivers the actionable insights brands need to navigate digital transformation.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;" class="reveal">
            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🎯</div>
                    <h3 class="briefing-card-title">Our Mission</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    To democratize marketing technology knowledge, giving every stakeholder—from boutique regional agencies and SMEs to Fortune 500 CMOs—an equal voice and access to the tools shaping commerce.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🌐</div>
                    <h3 class="briefing-card-title">Pan-Asian Reach</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Unifying regional nuance with global best practices. Our editorial team tracks consumer behavior, data privacy compliance, retail shifts, and technological disruptions across 14 key markets in Asia Pacific.
                </p>
            </div>

            <div style="background: var(--surface-alt); border: 1px solid var(--border); border-radius: 20px; padding: 2.25rem;">
                <div class="briefing-card-header">
                    <div class="briefing-icon-box">🤝</div>
                    <h3 class="briefing-card-title">Collaborative Hub</h3>
                </div>
                <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.7; margin-top: 0.85rem;">
                    Connecting brand executives with best-of-breed software solutions, creative agencies, and data platforms through curated summits, prestigious awards, and data-backed market intelligence.
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
            <h2 class="section-title">Four Foundational Content Pillars</h2>
            <p class="section-desc">
                Marketech APAC structures its reporting, community events, and industry dialogues around four essential sectors driving business expansion across the Asia-Pacific region.
            </p>
        </div>

        <div class="pillars-grid reveal">
            <!-- Pillar 1 -->
            <div class="pillar-card">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🎯</div>
                    <h3 class="pillar-title">Marketing Strategy & Brand Leadership</h3>
                </div>
                <p class="pillar-desc">
                    Comprehensive reporting on brand campaigns, creative effectiveness, customer engagement frameworks, and strategic pivots from top marketing officers.
                </p>
                <ul class="pillar-bullets">
                    <li>Exclusive CMO & Brand Leader Interviews</li>
                    <li>Omnichannel & Social Media Case Studies</li>
                    <li>Brand Purpose, Trust & Consumer Psychology</li>
                </ul>
            </div>

            <!-- Pillar 2 -->
            <div class="pillar-card">
                <div class="pillar-header">
                    <div class="pillar-icon-box">⚡</div>
                    <h3 class="pillar-title">MarTech & AdTech Disruption</h3>
                </div>
                <p class="pillar-desc">
                    Critical evaluations of emerging software tools, generative AI in advertising, programmatic ecosystems, customer data platforms (CDPs), and cookieless tracking.
                </p>
                <ul class="pillar-bullets">
                    <li>Generative AI for Creative & Workflow Automation</li>
                    <li>First-Party Data & Identity Resolution</li>
                    <li>Programmatic Advertising & Retail Media Networks</li>
                </ul>
            </div>

            <!-- Pillar 3 -->
            <div class="pillar-card">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🌐</div>
                    <h3 class="pillar-title">Platforms & Consumer Touchpoints</h3>
                </div>
                <p class="pillar-desc">
                    Tracking dynamic shifts across e-commerce marketplaces, SuperApps, live social shopping, messaging commerce, and streaming platforms in APAC.
                </p>
                <ul class="pillar-bullets">
                    <li>Social Commerce & Live Shopping Trends</li>
                    <li>Mobile App Ecosystems & Conversational AI</li>
                    <li>Cross-Border Marketplace Expansion</li>
                </ul>
            </div>

            <!-- Pillar 4 -->
            <div class="pillar-card">
                <div class="pillar-header">
                    <div class="pillar-icon-box">🚀</div>
                    <h3 class="pillar-title">SME & Emerging Agency Spotlights</h3>
                </div>
                <p class="pillar-desc">
                    Demystifying modern marketing technology for growing enterprises and celebrating homegrown boutique creative shops making regional waves.
                </p>
                <ul class="pillar-bullets">
                    <li>Cost-Effective Tech Stacks for SMBs</li>
                    <li>Boutique Agency Success Stories</li>
                    <li>Startup Growth Marketing & Scale-up Playbooks</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHAT THEY OFFER: COMPREHENSIVE OFFERINGS ===== -->
<section id="what-they-offer" class="section-padding offerings-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What Marketech APAC Offers</span>
            <h2 class="section-title">Programs, Platforms & Solutions</h2>
            <p class="section-desc">
                From high-level executive summits and industry-standard awards to proprietary whitepapers, explore the complete portfolio offered by Marketech APAC.
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
            <div class="offering-card" id="conferences">
                <span class="offering-tag">Flagship Conferences</span>
                <h3 class="offering-title">Regional Summits & Conferences</h3>
                <p class="offering-desc">
                    Premier industry gatherings convening CMOs, enterprise brands, and technology innovators for high-impact keynotes, case studies, and networking.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> What's NEXT in Marketing Summit (PH, MY, SG)</li>
                    <li><span>•</span> Retail & E-Commerce Innovation Conference</li>
                    <li><span>•</span> Digital Experience Asia & Advertising Summit</li>
                </ul>
                <a href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    View Event Calendar &rarr;
                </a>
            </div>

            <!-- Offering 2: Awards Series -->
            <div class="offering-card" id="awards">
                <span class="offering-tag">Industry Recognition</span>
                <h3 class="offering-title">Prestigious Regional Awards</h3>
                <p class="offering-desc">
                    Honoring groundbreaking campaigns, innovative tech vendors, forward-thinking agencies, and transformational marketing leaders across the Asia Pacific.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Retail & E-Commerce Excellence Awards (REA)</li>
                    <li><span>•</span> The NEXT Awards & Marketing Tech Awards</li>
                    <li><span>•</span> Empowered Women in Tech & Leadership</li>
                </ul>
                <a href="https://marketech-apac.com/awards/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Explore Award Categories &rarr;
                </a>
            </div>

            <!-- Offering 3: Executive Roundtables -->
            <div class="offering-card">
                <span class="offering-tag">Executive Dialogues</span>
                <h3 class="offering-title">Closed-Door CXO Roundtables</h3>
                <p class="offering-desc">
                    Chatham House rule, invitation-only gatherings where senior enterprise decision-makers dissect real-world marketing technology roadblocks and shared solutions.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Intimate peer-to-peer executive dinners</li>
                    <li><span>•</span> Curated discussions with pre-qualified buyers</li>
                    <li><span>•</span> Executive summaries & post-event report briefs</li>
                </ul>
                <a href="https://marketech-apac.com/about-marketech-apac/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Request an Invitation &rarr;
                </a>
            </div>

            <!-- Offering 4: Research & Whitepapers -->
            <div class="offering-card">
                <span class="offering-tag">Market Intelligence</span>
                <h3 class="offering-title">Whitepapers & Custom Research</h3>
                <p class="offering-desc">
                    Co-developed reports in collaboration with global tech giants (such as Braze, Infobip) providing data-backed benchmarks on consumer behavior and tech adoption.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> APAC Consumer Engagement Reports</li>
                    <li><span>•</span> Cookieless Era Preparedness Guides</li>
                    <li><span>•</span> Social Commerce & Conversational AI Studies</li>
                </ul>
                <a href="https://marketech-apac.com" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Browse Research Library &rarr;
                </a>
            </div>

            <!-- Offering 5: Editorial & Sponsored Content -->
            <div class="offering-card">
                <span class="offering-tag">Brand Storytelling</span>
                <h3 class="offering-title">Editorial & Thought Leadership</h3>
                <p class="offering-desc">
                    Reach over 180,000 monthly marketing leaders through sponsored editorial features, video interviews, executive spotlights, and newsletter takeovers.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> In-depth executive Q&A interviews</li>
                    <li><span>•</span> Featured product launches & case studies</li>
                    <li><span>•</span> Targeted APAC industry newsletter distribution</li>
                </ul>
                <a href="https://marketech-apac.com/about-marketech-apac/" target="_blank" rel="noopener noreferrer" class="offering-cta">
                    Download Media Kit &rarr;
                </a>
            </div>

            <!-- Offering 6: Brand Partnerships -->
            <div class="offering-card">
                <span class="offering-tag">Integrated Partnerships</span>
                <h3 class="offering-title">Custom Webinars & Event Sponsorship</h3>
                <p class="offering-desc">
                    Full-service event sponsorships and bespoke virtual summits engineered to position your solution before qualified regional enterprise decision-makers.
                </p>
                <ul class="offering-highlights">
                    <li><span>•</span> Keynote speaker & panel placement</li>
                    <li><span>•</span> High-intent B2B lead generation</li>
                    <li><span>•</span> Multi-channel promotional campaigns across APAC</li>
                </ul>
                <a href="{{ route('home') }}#final-cta" class="offering-cta">
                    Connect With Our Partnerships Team &rarr;
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
    // Live WordPress REST API fetch for Marketech APAC
    async function loadLiveMarketechPosts() {
        try {
            const res = await fetch('https://marketech-apac.com/wp-json/wp/v2/posts?_embed=1&per_page=3');
            if (!res.ok) return;
            const posts = await res.json();
            if (!posts || !posts.length) return;

            const container = document.getElementById('marketech-live-articles');
            if (!container) return;

            let html = '';
            posts.forEach(post => {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = post.title?.rendered || 'Marketech APAC Article';
                const title = tempDiv.textContent;

                const excerptDiv = document.createElement('div');
                excerptDiv.innerHTML = post.excerpt?.rendered || '';
                const excerpt = excerptDiv.textContent.substring(0, 150) + '...';

                const link = post.link || 'https://marketech-apac.com';
                const date = post.date ? new Date(post.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'Recent';
                const img = post._embedded?.['wp:featuredmedia']?.[0]?.source_url || '{{ asset('images/events/marketech/1-whats-next-in-marketing.png') }}';

                html += `
                    <div class="article-card">
                        <div class="article-img-wrap">
                            <img src="${img}" alt="${title}" class="article-img" onerror="this.src='{{ asset('images/events/marketech/1-whats-next-in-marketing.png') }}';">
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
            console.log('Using static fallback for Marketech live articles');
        }
    }
    loadLiveMarketechPosts();
</script>
@endsection
