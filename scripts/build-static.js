import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname, '..');

const distDir = path.join(rootDir, 'dist');
const publicDir = path.join(rootDir, 'public');
const viewsDir = path.join(rootDir, 'resources', 'views');

// Clean or create dist directory
if (fs.existsSync(distDir)) {
    fs.rmSync(distDir, { recursive: true, force: true });
}
fs.mkdirSync(distDir, { recursive: true });

// Copy public/images to dist/images if exists
const imagesSrc = path.join(publicDir, 'images');
const imagesDest = path.join(distDir, 'images');
if (fs.existsSync(imagesSrc)) {
    fs.cpSync(imagesSrc, imagesDest, { recursive: true });
    console.log('✓ Copied images to dist/images');
}

// Copy public/favicon.ico and robots.txt
for (const file of ['favicon.ico', 'robots.txt']) {
    const srcFile = path.join(publicDir, file);
    if (fs.existsSync(srcFile)) {
        fs.copyFileSync(srcFile, path.join(distDir, file));
        console.log(`✓ Copied ${file} to dist/`);
    }
}

// Copy public/build/assets to dist/assets
const buildAssetsSrc = path.join(publicDir, 'build', 'assets');
const distAssetsDest = path.join(distDir, 'assets');
if (fs.existsSync(buildAssetsSrc)) {
    fs.cpSync(buildAssetsSrc, distAssetsDest, { recursive: true });
    console.log('✓ Copied compiled assets to dist/assets');
}

// Find CSS and JS entry files from manifest
const manifestPath = path.join(publicDir, 'build', 'manifest.json');
let cssFilename = '';
let jsFilename = '';

if (fs.existsSync(manifestPath)) {
    const manifest = JSON.parse(fs.readFileSync(manifestPath, 'utf8'));
    if (manifest['resources/css/app.css']?.file) {
        cssFilename = path.basename(manifest['resources/css/app.css'].file);
    }
    if (manifest['resources/js/app.js']?.file) {
        jsFilename = path.basename(manifest['resources/js/app.js'].file);
    }
}

// Read welcome.blade.php
const bladePath = path.join(viewsDir, 'welcome.blade.php');
let html = fs.readFileSync(bladePath, 'utf8');

// 1. Replace html lang tag
html = html.replace(/<html\s+lang="\{\{[^}]+\}\}">/i, '<html lang="en">');

// 2. Replace @vite directive with actual links
let assetTags = '';
if (cssFilename) {
    assetTags += `<link rel="stylesheet" href="./assets/${cssFilename}">\n    `;
}
if (jsFilename) {
    assetTags += `<script type="module" src="./assets/${jsFilename}"></script>`;
}
html = html.replace(/@vite\(\[[^\]]+\]\)/g, assetTags.trim());

// 3. Replace background url asset helper
html = html.replace(/url\(['"]\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}['"]\)/g, "url('$1')");

// 4. Replace img src asset helper with query versions: {{ asset('...') }}?v={{ ... }}
html = html.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}\?v=\{\{[^}]+\}\}"/g, 'src="$1"');
html = html.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="$1"');

// 5. Replace auth/route blocks with static explore button
const authRegex = /@if\s*\(Route::has\('login'\)\)[\s\S]*?@endif/g;
html = html.replace(authRegex, (match) => {
    if (match.includes('id="nav-explore-btn"')) {
        return '<a href="insights.html" class="nav-cta-btn" id="nav-explore-btn">Explore WECON <span class="cta-arrow">&rarr;</span></a>';
    }
    return '<a href="insights.html" class="nav-cta-btn">Explore WECON <span class="cta-arrow">&rarr;</span></a>';
});

// 6. Replace route and URL helpers
html = html.replace(/href="\{\{\s*url\('\/insights'\)\s*\}\}"/g, 'href="#insights"');
html = html.replace(/href="\{\{\s*url\('\/events'\)\s*\}\}"/g, 'href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer"');
html = html.replace(/href="\{\{\s*url\('\/'\)\s*\}\}"/g, 'href="index.html"');
html = html.replace(/\{\{\s*route\(['"]([^'"]+)['"]\)\s*\}\}/g, '/$1');

// 7. Strip CSRF tokens and meta tags
html = html.replace(/<meta name="csrf-token" content="\{\{[^}]+\}\}">/gi, '<meta name="csrf-token" content="">');
html = html.replace(/@csrf/gi, '');

// 8. Remove Blade session flash messages
html = html.replace(/@if\s*\(\s*session\([^)]+\)\s*\)[\s\S]*?@endif/gi, '');

// 9. Clean up complex image assets with PHP functions: {{ asset($sections[...] ?? '...') }}?v={{ ... }}
html = html.replace(/src="\{\{\s*asset\([^?]+?\?\?\s*['"]([^'"]+)['"]\)\s*\}\}\?v=\{\{[^}]+\}\}"/g, 'src="$1"');
html = html.replace(/src="\{\{\s*asset\([^)]+\?\?\s*['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="$1"');

// 10. Replace {!! $sections[...] ?? 'fallback' !!} or {!! $sections[...] ?? "fallback" !!}
html = html.replace(/\{!!\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*!!\}/g, '$2');

// 11. Replace {{ $sections[...] ?? 'fallback' }} or {{ $sections[...] ?? "fallback" }}
html = html.replace(/\{\{\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*\}\}/g, '$2');

// 12. Replace the careers PHP block & foreach with clean static cards
const careersStaticBlock = `
                <div style="padding: 1.15rem; border: 1px solid var(--border); border-radius: 12px; background: var(--section-alt); display: flex; flex-direction: column; justify-content: flex-start; gap: 0.35rem; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem;">
                        <div style="font-weight: 700; color: var(--navy); font-size: 1rem; line-height: 1.35;">Senior Tech & Business Journalist</div>
                        <span style="font-size: 0.7rem; font-weight: 700; background: rgba(18, 97, 181, 0.1); color: var(--blue); padding: 0.2rem 0.55rem; border-radius: 9999px; white-space: nowrap; flex-shrink: 0;">Full-time</span>
                    </div>
                    <div style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.4;">Singapore / Remote • Editorial Team</div>
                    <div style="font-size: 0.84rem; color: var(--text-body); line-height: 1.5; margin-top: 0.35rem; padding-top: 0.5rem; border-top: 1px dashed rgba(0,0,0,0.08);">
                        Produce in-depth coverage, executive interviews, and investigative features across Asia-Pacific enterprise technology and digital markets.
                    </div>
                </div>
                <div style="padding: 1.15rem; border: 1px solid var(--border); border-radius: 12px; background: var(--section-alt); display: flex; flex-direction: column; justify-content: flex-start; gap: 0.35rem; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem;">
                        <div style="font-weight: 700; color: var(--navy); font-size: 1rem; line-height: 1.35;">Conference Program Producer</div>
                        <span style="font-size: 0.7rem; font-weight: 700; background: rgba(18, 97, 181, 0.1); color: var(--blue); padding: 0.2rem 0.55rem; border-radius: 9999px; white-space: nowrap; flex-shrink: 0;">Full-time</span>
                    </div>
                    <div style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.4;">Manila / Hybrid • Events Division</div>
                    <div style="font-size: 0.84rem; color: var(--text-body); line-height: 1.5; margin-top: 0.35rem; padding-top: 0.5rem; border-top: 1px dashed rgba(0,0,0,0.08);">
                        Curate thought leadership agendas, recruit high-profile keynote speakers, and collaborate with marketing teams to deliver world-class business summits.
                    </div>
                </div>
                <div style="padding: 1.15rem; border: 1px solid var(--border); border-radius: 12px; background: var(--section-alt); display: flex; flex-direction: column; justify-content: flex-start; gap: 0.35rem; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem;">
                        <div style="font-weight: 700; color: var(--navy); font-size: 1rem; line-height: 1.35;">Enterprise Sponsorship Director</div>
                        <span style="font-size: 0.7rem; font-weight: 700; background: rgba(18, 97, 181, 0.1); color: var(--blue); padding: 0.2rem 0.55rem; border-radius: 9999px; white-space: nowrap; flex-shrink: 0;">Full-time</span>
                    </div>
                    <div style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.4;">Regional • Commercial Partnerships</div>
                    <div style="font-size: 0.84rem; color: var(--text-body); line-height: 1.5; margin-top: 0.35rem; padding-top: 0.5rem; border-top: 1px dashed rgba(0,0,0,0.08);">
                        Develop and secure strategic multi-market sponsorship and media alliances with top technology brands and enterprise vendors across APAC.
                    </div>
                </div>`;
html = html.replace(/@php[\s\S]*?\$careersList[\s\S]*?@endphp\s*@foreach\(\$careersList\s+as\s+\$job\)[\s\S]*?@endforeach/, careersStaticBlock.trim());

// Write to dist/index.html
const indexHtmlPath = path.join(distDir, 'index.html');
fs.writeFileSync(indexHtmlPath, html, 'utf8');
console.log('✓ Successfully generated dist/index.html');

// Generate static login.html for Netlify
const loginBladePath = path.join(viewsDir, 'auth', 'login.blade.php');
if (fs.existsSync(loginBladePath)) {
    let loginHtml = fs.readFileSync(loginBladePath, 'utf8');
    loginHtml = loginHtml.replace(/@csrf/gi, '');
    loginHtml = loginHtml.replace(/<meta name="csrf-token" content="\{\{[^}]+\}\}">/gi, '<meta name="csrf-token" content="">');
    loginHtml = loginHtml.replace(/href="\{\{\s*url\('\/'\)\s*\}\}"/g, 'href="index.html"');
    loginHtml = loginHtml.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="$1"');
    loginHtml = loginHtml.replace(/\{\{\s*route\('login\.post'\)\s*\}\}/g, '/admin/login');
    loginHtml = loginHtml.replace(/\{\{\s*route\('admin\.dashboard'\)\s*\}\}/g, '/admin/dashboard');
    fs.writeFileSync(path.join(distDir, 'login.html'), loginHtml, 'utf8');
    console.log('✓ Successfully generated dist/login.html');
}

// Generate static dashboard.html for Netlify preview
const dashboardBladePath = path.join(viewsDir, 'admin', 'dashboard.blade.php');
if (fs.existsSync(dashboardBladePath)) {
    const adminDir = path.join(distDir, 'admin');
    if (!fs.existsSync(adminDir)) {
        fs.mkdirSync(adminDir, { recursive: true });
    }

    let dashHtml = fs.readFileSync(dashboardBladePath, 'utf8');

    // 1. Clean basic blade directives
    dashHtml = dashHtml.replace(/@csrf/gi, '');
    dashHtml = dashHtml.replace(/@method\([^)]+\)/gi, '');
    dashHtml = dashHtml.replace(/<meta name="csrf-token" content="\{\{[^}]+\}\}">/gi, '<meta name="csrf-token" content="">');
    dashHtml = dashHtml.replace(/\{\{\s*Auth::user\(\)->name[^}]*\}\}/gi, 'WECON Administrator');
    dashHtml = dashHtml.replace(/\{\{\s*route\('home'\)\s*\}\}/g, 'index.html');
    dashHtml = dashHtml.replace(/\{\{\s*route\('logout'\)\s*\}\}/g, '/login');
    dashHtml = dashHtml.replace(/\{\{\s*count\(\$inquiries\)\s*\}\}/g, '0');
    dashHtml = dashHtml.replace(/\{\{\s*count\(\$subscribers\)\s*\}\}/g, '0');
    dashHtml = dashHtml.replace(/@if\s*\(\s*session\([^)]+\)\s*\)[\s\S]*?@endif/gi, '');
    dashHtml = dashHtml.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="$1"');

    // 2. Clean inquiries panel
    dashHtml = dashHtml.replace(/<div class="section-panel" id="tab-inquiries">[\s\S]*?<!-- ============================================== -->\s*<!-- SUBSCRIBERS INBOX -->/i, `
            <div class="section-panel" id="tab-inquiries">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Contact Inquiries Inbox</h2>
                        <p class="panel-desc">Direct inquiries submitted by corporate partners, attendees, and organizations.</p>
                    </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; padding: 2rem 0; text-align: center;">No contact inquiries recorded yet.</p>
            </div>

            <!-- ============================================== -->
            <!-- SUBSCRIBERS INBOX -->`);

    // 3. Clean subscribers panel
    dashHtml = dashHtml.replace(/<div class="section-panel" id="tab-subscribers">[\s\S]*?<\/main>/i, `
            <div class="section-panel" id="tab-subscribers">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Newsletter Subscribers</h2>
                        <p class="panel-desc">All subscribers registered through Section 7 "Stay Connected".</p>
                    </div>
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; padding: 2rem 0; text-align: center;">No newsletter subscribers recorded yet.</p>
            </div>
        </main>`);

    // 4. Fix tab-switching script (remove blade @if conditionals that caused syntax error)
    dashHtml = dashHtml.replace(/\/\/ Check if tab query param or hash exists on load[\s\S]*?@endif/i, `
        // Check if hash exists on load
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            if (document.getElementById(hash)) {
                switchTab(hash);
            }
        }
    `);

    // 5. Populate default values for common inputs instead of leaving them empty
    const defaults = {
        section_1_hero: {
            tag: "Asia-Pacific Media & Business Ecosystem",
            title: "Connecting Ideas, <span class=\"highlight\">People</span>, and Opportunities",
            description: "WECON brings together industry leaders, organizations, professionals, and communities through events, awards, media, and meaningful business experiences.",
            primary_cta_text: "See Articles",
            primary_cta_link: "#insights",
            secondary_cta_text: "View Upcoming Events",
            secondary_cta_link: "#events",
            hero_image: "images/hero-visual.png"
        },
        section_2_about: {
            tag: "Who We Are",
            title: "More Than Media.<br><span class=\"accent-red\">A Connected Business Ecosystem.</span>",
            description: "WECON Asia Media Group, Inc. is a forward-thinking business media, events, and industry intelligence ecosystem that connects enterprise leaders, innovators, and professionals across Asia."
        },
        section_3_why: {
            tag: "Value Proposition",
            title: "Why Engage with WECON?",
            description: "Four strategic pillars that empower professionals, brands, and organizations to achieve enduring business impact."
        },
        section_4_events: {
            tag: "Industry Gatherings & Benchmarks",
            title: "Upcoming Events & Recognition Platforms",
            description: "Discover high-impact regional summits, industry conferences, and prestigious benchmarks hosted across Asia-Pacific."
        },
        section_5_speakers: {
            tag: "HR Forward Asia",
            title: "Features & Leadership",
            description: "In-depth executive interviews, workforce perspectives, and leadership features examining how organisations navigate change and the future of work across Asia."
        },
        section_6_insights: {
            tag: "Media Intelligence Network",
            title: "Voices, Insights, and Industry Intelligence",
            description: "Stay ahead with verified reporting, executive perspectives, and strategic market intelligence from across the APAC business landscape."
        },
        section_7_newsletter: {
            tag: "Stay Connected",
            title: "Join Asia's Premier Business Information Network",
            description: "Get the latest event invitations, executive insights, award nomination dates, and market reports delivered to your inbox weekly."
        },
        section_9_contact: {
            cta_title: "Be Part of the Next WECON Experience",
            cta_desc: "Discover unprecedented opportunities to connect with industry leaders, participate in premier events, collaborate across borders, and grow within the WECON ecosystem.",
            cta_button_text: "Contact Our Team"
        }
    };

    dashHtml = dashHtml.replace(/\{\{\s*\$sections\['(\w+)'\]\['(\w+)'\]\s*\?\?\s*''\s*\}\}/g, (match, sec, key) => {
        return defaults[sec]?.[key] || '';
    });

    // 6. Clean any remaining blade template tags and empty fallbacks
    dashHtml = dashHtml.replace(/value="\{\{\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*\}\}"/g, 'value="$2"');
    dashHtml = dashHtml.replace(/>\{\{\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*\}\}</g, '>$2<');
    dashHtml = dashHtml.replace(/\{\{\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*\}\}/g, '$2');
    dashHtml = dashHtml.replace(/value="\{\{[^}]+\}\}"/g, 'value=""');
    dashHtml = dashHtml.replace(/\{\{[^}]+\}\}/g, '');

    // 7. Clean loops and any remaining @ directives
    dashHtml = dashHtml.replace(/@php[\s\S]*?@endphp/gi, '');
    dashHtml = dashHtml.replace(/@foreach[\s\S]*?@endforeach/gi, '');
    dashHtml = dashHtml.replace(/@if\s*\([^)]+\)/gi, '');
    dashHtml = dashHtml.replace(/@elseif\s*\([^)]+\)/gi, '');
    dashHtml = dashHtml.replace(/@else/gi, '');
    dashHtml = dashHtml.replace(/@endif/gi, '');

    // 8. Add static preview script for saving sections
    const staticScript = `
    <script>
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let alertBox = document.querySelector('.flash-alert');
                if (!alertBox) {
                    alertBox = document.createElement('div');
                    alertBox.className = 'flash-alert';
                    const main = document.querySelector('.admin-main');
                    if (main) main.prepend(alertBox);
                }
                alertBox.innerHTML = '<span>&#x2714; Section changes saved successfully (Static Preview Mode)</span><button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;font-weight:700;margin-left:1rem;">&times;</button>';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
    </body>`;
    dashHtml = dashHtml.replace('</body>', staticScript);

    fs.writeFileSync(path.join(adminDir, 'dashboard.html'), dashHtml, 'utf8');
    console.log('✓ Successfully generated dist/admin/dashboard.html');
}

