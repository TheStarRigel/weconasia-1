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
    loginHtml = loginHtml.replace(/<meta name="csrf-token" content="\{\{[^}]+\}\}">/gi, '<meta name="csrf-token" content="">');
    loginHtml = loginHtml.replace(/href="\{\{\s*url\('\/'\)\s*\}\}"/g, 'href="index.html"');
    loginHtml = loginHtml.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="$1"');
    loginHtml = loginHtml.replace(/\{\{\s*route\('login\.post'\)\s*\}\}/g, '/admin/login');
    loginHtml = loginHtml.replace(/\{\{\s*route\('admin\.dashboard'\)\s*\}\}/g, '/admin/dashboard');
    fs.writeFileSync(path.join(distDir, 'login.html'), loginHtml, 'utf8');
    console.log('✓ Successfully generated dist/login.html');
}

