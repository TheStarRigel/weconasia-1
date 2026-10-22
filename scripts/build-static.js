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

// Route mapping for static URLs
const routeMap = {
    'home': '/',
    'brands.index': '/brands',
    'brands.marketech': '/marketech-apac',
    'brands.uptech': '/uptech-media',
    'brands.hrforward': '/hr-forward-asia',
    'contact.submit': '/api/contact',
    'newsletter.subscribe': '/api/newsletter'
};

function cleanBladeSyntax(html) {
    // 1. Replace html lang tag
    html = html.replace(/<html\s+lang="\{\{[^}]+\}\}">/i, '<html lang="en">');

    // 2. Replace @vite directive with actual links
    let assetTags = '';
    if (cssFilename) {
        assetTags += `<link rel="stylesheet" href="/assets/${cssFilename}">\n    `;
    }
    if (jsFilename) {
        assetTags += `<script type="module" src="/assets/${jsFilename}"></script>`;
    }
    html = html.replace(/@vite\(\[[^\]]+\]\)/g, assetTags.trim());

    // 3. Replace background url asset helper
    html = html.replace(/url\(['"]\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}['"]\)/g, "url('/$1')");

    // 4. Replace img src asset helper with query versions: {{ asset('...') }}?v={{ ... }}
    html = html.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}\?v=\{\{[^}]+\}\}"/g, 'src="/$1"');
    html = html.replace(/src="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="/$1"');
    html = html.replace(/href="\{\{\s*asset\(['"]([^'"]+)['"]\)\s*\}\}"/g, 'href="/$1"');

    // 5. Replace auth/route blocks with static explore button
    const authRegex = /@if\s*\(Route::has\('login'\)\)[\s\S]*?@endif/g;
    html = html.replace(authRegex, () => {
        return '<a href="#insights" class="nav-cta-btn" id="nav-explore-btn">Explore WECON <span class="cta-arrow">&rarr;</span></a>';
    });

    // 6. Replace route and URL helpers
    html = html.replace(/href="\{\{\s*url\('\/insights'\)\s*\}\}"/g, 'href="/#insights"');
    html = html.replace(/href="\{\{\s*url\('\/events'\)\s*\}\}"/g, 'href="https://marketech-apac.com/featured-events/" target="_blank" rel="noopener noreferrer"');
    html = html.replace(/href="\{\{\s*url\('\/'\)\s*\}\}"/g, 'href="/"');
    html = html.replace(/\{\{\s*route\(['"]([^'"]+)['"]\)\s*\}\}/g, (match, name) => routeMap[name] || ('/' + name));

    // 7. Strip CSRF tokens and meta tags
    html = html.replace(/<meta name="csrf-token" content="\{\{[^}]+\}\}">/gi, '<meta name="csrf-token" content="">');
    html = html.replace(/@csrf/gi, '');

    // 8. Remove Blade session flash messages
    html = html.replace(/@if\s*\(\s*session\([^)]+\)\s*\)[\s\S]*?@endif/gi, '');

    // 9. Clean up complex image assets with PHP functions: {{ asset($sections[...] ?? '...') }}?v={{ ... }}
    html = html.replace(/src="\{\{\s*asset\([^?]+?\?\?\s*['"]([^'"]+)['"]\)\s*\}\}\?v=\{\{[^}]+\}\}"/g, 'src="/$1"');
    html = html.replace(/src="\{\{\s*asset\([^)]+\?\?\s*['"]([^'"]+)['"]\)\s*\}\}"/g, 'src="/$1"');

    // 10. Replace {!! $sections[...] ?? 'fallback' !!} or {!! $sections[...] ?? "fallback" !!}
    html = html.replace(/\{!!\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*!!\}/g, '$2');

    // 11. Replace {{ $sections[...] ?? 'fallback' }} or {{ $sections[...] ?? "fallback" }}
    html = html.replace(/\{\{\s*\$sections\[['"][^'"]+['"]\]\[['"][^'"]+['"]\]\s*\?\?\s*(['"])([\s\S]*?)\1\s*\}\}/g, '$2');

    return html;
}

// ----------------------------------------------------------------
// 1. Build Homepage (dist/index.html)
// ----------------------------------------------------------------
const bladePath = path.join(viewsDir, 'welcome.blade.php');
let homeHtml = fs.readFileSync(bladePath, 'utf8');

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
homeHtml = homeHtml.replace(/@php[\s\S]*?\$careersList[\s\S]*?@endphp\s*@foreach\(\$careersList\s+as\s+\$job\)[\s\S]*?@endforeach/, careersStaticBlock.trim());
homeHtml = cleanBladeSyntax(homeHtml);

fs.writeFileSync(path.join(distDir, 'index.html'), homeHtml, 'utf8');
console.log('✓ Successfully generated dist/index.html');

// ----------------------------------------------------------------
// 2. Build Brand Subpages (Marketech, Uptech, HR Forward, Brands Directory)
// ----------------------------------------------------------------
function renderBrandPage(brandBladePath, activeTab, brandLandingUrl) {
    const brandContent = fs.readFileSync(brandBladePath, 'utf8');
    const layout = fs.readFileSync(path.join(viewsDir, 'layouts', 'brand.blade.php'), 'utf8');

    // Extract title
    const titleMatch = brandContent.match(/@section\('title',\s*['"](.*?)['"]\)/);
    const title = titleMatch ? titleMatch[1].replace(/\\'/g, "'") : 'WECON Asia';

    // Extract meta-description
    const metaMatch = brandContent.match(/@section\('meta-description',\s*['"](.*?)['"]\)/);
    const metaDesc = metaMatch ? metaMatch[1].replace(/\\'/g, "'") : 'WECON Asia Media Ecosystem';

    // Extract brand-tokens
    const tokensMatch = brandContent.match(/@section\('brand-tokens'\)([\s\S]*?)@endsection/);
    const brandTokens = tokensMatch ? tokensMatch[1] : '';

    // Extract content
    const contentMatch = brandContent.match(/@section\('content'\)([\s\S]*?)@endsection/);
    const mainContent = contentMatch ? contentMatch[1] : '';

    // Inject into layout
    let result = layout;
    result = result.replace(/@yield\('title'[^)]*\)/g, title);
    result = result.replace(/@yield\('meta-description'[^)]*\)/g, metaDesc);
    result = result.replace(/@yield\('brand-tokens'\)/g, brandTokens);
    result = result.replace(/@yield\('content'\)/g, mainContent);
    result = result.replace(/@yield\('active-marketech'\)/g, activeTab === 'marketech' ? 'active' : '');
    result = result.replace(/@yield\('active-uptech'\)/g, activeTab === 'uptech' ? 'active' : '');
    result = result.replace(/@yield\('active-hrforward'\)/g, activeTab === 'hrforward' ? 'active' : '');
    result = result.replace(/@yield\('active-brands'\)/g, activeTab === 'brands' ? 'active' : '');
    result = result.replace(/@yield\('brand-landing-url'[^)]*\)/g, brandLandingUrl);
    result = result.replace(/@yield\('extra-scripts'\)/g, '');

    result = cleanBladeSyntax(result);
    return result;
}

function writePageWithAliases(slug, htmlContent, legacyAliases = []) {
    // 1. Write slug.html (e.g. dist/marketech-apac.html)
    fs.writeFileSync(path.join(distDir, `${slug}.html`), htmlContent, 'utf8');

    // 2. Write slug/index.html (e.g. dist/marketech-apac/index.html)
    const slugDir = path.join(distDir, slug);
    if (!fs.existsSync(slugDir)) {
        fs.mkdirSync(slugDir, { recursive: true });
    }
    fs.writeFileSync(path.join(slugDir, 'index.html'), htmlContent, 'utf8');

    // 3. Write legacy alias folders (e.g. dist/brands.marketech/index.html)
    for (const alias of legacyAliases) {
        const aliasDir = path.join(distDir, alias);
        if (!fs.existsSync(aliasDir)) {
            fs.mkdirSync(aliasDir, { recursive: true });
        }
        fs.writeFileSync(path.join(aliasDir, 'index.html'), htmlContent, 'utf8');
    }
}

// Build Marketech APAC
const marketechHtml = renderBrandPage(
    path.join(viewsDir, 'brands', 'marketech.blade.php'),
    'marketech',
    'https://marketech-apac.com'
);
writePageWithAliases('marketech-apac', marketechHtml, ['brands.marketech', 'brands/marketech-apac']);
console.log('✓ Successfully generated dist/marketech-apac.html and aliases');

// Build Uptech Media
const uptechHtml = renderBrandPage(
    path.join(viewsDir, 'brands', 'uptech.blade.php'),
    'uptech',
    'https://uptech-media.com'
);
writePageWithAliases('uptech-media', uptechHtml, ['brands.uptech', 'brands/uptech-media']);
console.log('✓ Successfully generated dist/uptech-media.html and aliases');

// Build HR Forward Asia
const hrforwardHtml = renderBrandPage(
    path.join(viewsDir, 'brands', 'hrforward.blade.php'),
    'hrforward',
    'https://hrforwardasia.com'
);
writePageWithAliases('hr-forward-asia', hrforwardHtml, ['brands.hrforward', 'brands/hr-forward-asia']);
console.log('✓ Successfully generated dist/hr-forward-asia.html and aliases');

// Build Brands Directory
const brandsHtml = renderBrandPage(
    path.join(viewsDir, 'brands', 'index.blade.php'),
    'brands',
    '/'
);
writePageWithAliases('brands', brandsHtml, ['brands.index']);
console.log('✓ Successfully generated dist/brands.html and aliases');
