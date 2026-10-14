<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WECON Asia | Executive CMS Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy-dark: #071326;
            --navy: #0B2B55;
            --blue: #1261B5;
            --blue-light: #1d7ae4;
            --cyan: #0284c7;
            --bg-page: #F1F5F9;
            --surface: #FFFFFF;
            --surface-subtle: #F8FAFC;
            --text-heading: #0F172A;
            --text-body: #334155;
            --text-muted: #64748B;
            --border: #E2E8F0;
            --danger: #EF4444;
            --success: #10B981;
            --gold: #C8962A;
            --orange: #EA580C;
            --shadow: 0 4px 20px -2px rgba(11, 43, 85, 0.08);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: var(--bg-page);
            color: var(--text-heading);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .admin-header {
            background: var(--navy-dark);
            color: #FFFFFF;
            padding: 0.85rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .header-brand img {
            height: 32px;
            filter: brightness(0) invert(1);
        }

        .header-badge {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: rgba(2, 132, 199, 0.2);
            color: #38bdf8;
            padding: 0.25rem 0.65rem;
            border-radius: 9999px;
            border: 1px solid rgba(56, 189, 248, 0.3);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .user-greeting {
            font-size: 0.85rem;
            color: #94A3B8;
        }

        .user-greeting strong {
            color: #F8FAFC;
        }

        .btn-view-site {
            font-size: 0.82rem;
            font-weight: 600;
            color: #38bdf8;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            background: rgba(56, 189, 248, 0.1);
            transition: all 0.2s;
        }

        .btn-view-site:hover {
            background: rgba(56, 189, 248, 0.2);
        }

        .btn-logout {
            font-size: 0.82rem;
            font-weight: 600;
            color: #F87171;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            padding: 0.4rem 0.85rem;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Layout */
        .admin-layout {
            display: flex;
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem;
            gap: 2rem;
        }

        /* Sidebar Tabs */
        .admin-sidebar {
            width: 300px;
            flex-shrink: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 5rem;
            max-height: calc(100vh - 7rem);
            overflow-y: auto;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            padding: 0 0.5rem;
        }

        .tab-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-body);
            text-align: left;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 0.35rem;
        }

        .tab-btn:hover {
            background: var(--surface-subtle);
            color: var(--navy);
        }

        .tab-btn.active {
            background: rgba(18, 97, 181, 0.1);
            color: var(--blue);
            font-weight: 700;
        }

        .tab-btn .badge-pill {
            margin-left: auto;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 9999px;
            background: var(--border);
            color: var(--text-muted);
        }

        .tab-btn.active .badge-pill {
            background: var(--blue);
            color: #FFFFFF;
        }

        /* Content Area */
        .admin-main {
            flex: 1;
            min-width: 0;
        }

        .flash-alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #065F46;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-panel {
            display: none;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            animation: fadeIn 0.3s ease;
        }

        .section-panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .panel-header {
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
        }

        .panel-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 0.35rem;
        }

        .panel-desc {
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-full {
            grid-column: 1 / -1;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 0.5rem;
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-heading);
            background: #FFFFFF;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(18, 97, 181, 0.15);
        }

        textarea.form-control {
            min-height: 100px;
            line-height: 1.5;
            resize: vertical;
        }

        /* Sub-cards in forms */
        .sub-card {
            background: var(--surface-subtle);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .sub-card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Buttons */
        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--blue);
            color: #FFFFFF;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 700;
            padding: 0.85rem 1.75rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(18, 97, 181, 0.2);
        }

        .btn-save:hover {
            background: var(--navy);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(11, 43, 85, 0.25);
        }

        /* Tables for Submissions */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            margin-top: 1rem;
        }

        .data-table th {
            background: var(--surface-subtle);
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 700;
            color: var(--navy);
            border-bottom: 1px solid var(--border);
        }

        .data-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-body);
            vertical-align: top;
        }

        .data-table tr:hover td {
            background: rgba(18, 97, 181, 0.02);
        }

        .badge-tag {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            background: rgba(18, 97, 181, 0.1);
            color: var(--blue);
        }

        .btn-action-del {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .btn-action-del:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- TOP HEADER -->
    <header class="admin-header">
        <div class="header-brand">
            <img src="{{ asset('images/logo1.png') }}" alt="WECON ASIA" onerror="this.style.display='none'">
            <span class="header-badge">Content Management Suite</span>
        </div>
        <div class="header-actions">
            <span class="user-greeting">Logged in as <strong>{{ Auth::user()->name ?? 'Administrator' }}</strong></span>
            <a href="{{ route('home') }}" target="_blank" class="btn-view-site">&#x1F310; View Live Portal</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">&#x23FB; Sign Out</button>
            </form>
        </div>
    </header>

    <!-- MAIN LAYOUT -->
    <div class="admin-layout">
        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="sidebar-title">Landing Page Sections</div>
            <button class="tab-btn active" data-target="tab-sec1">
                <span>&#x1F30C;</span> Section 1: Hero
            </button>
            <button class="tab-btn" data-target="tab-sec2">
                <span>&#x1F3E2;</span> Section 2: About & Brands
            </button>
            <button class="tab-btn" data-target="tab-sec3">
                <span>&#x1F4A1;</span> Section 3: Why WECON
            </button>
            <button class="tab-btn" data-target="tab-sec4">
                <span>&#x1F3C6;</span> Section 4: Events & Awards
            </button>
            <button class="tab-btn" data-target="tab-sec5">
                <span>&#x1F3A4;</span> Section 5: Speakers / Features
            </button>
            <button class="tab-btn" data-target="tab-sec6">
                <span>&#x1F4F0;</span> Section 6: Insights & Media
            </button>
            <button class="tab-btn" data-target="tab-sec7">
                <span>&#x2709;</span> Section 7: Stay Connected
            </button>
            <button class="tab-btn" data-target="tab-pathways">
                <span>&#x1F9ED;</span> Guided Pathways
            </button>
            <button class="tab-btn" data-target="tab-careers">
                <span>&#x1F4BC;</span> Careers & Job Openings
            </button>
            <button class="tab-btn" data-target="tab-sec9">
                <span>&#x1F4DE;</span> Section 8: Contact Modal
            </button>

            <div class="sidebar-title" style="margin-top: 1.5rem;">Live Submissions</div>
            <button class="tab-btn" data-target="tab-inquiries">
                <span>&#x1F4E8;</span> Contact Inquiries
                <span class="badge-pill">{{ count($inquiries) }}</span>
            </button>
            <button class="tab-btn" data-target="tab-subscribers">
                <span>&#x1F4EC;</span> Subscribers
                <span class="badge-pill">{{ count($subscribers) }}</span>
            </button>
        </aside>

        <!-- MAIN VIEW -->
        <main class="admin-main">
            @if(session('success'))
                <div class="flash-alert">
                    <span>&#x2714; {{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;font-weight:700;">&times;</button>
                </div>
            @endif

            <!-- ============================================== -->
            <!-- SECTION 1: HERO -->
            <!-- ============================================== -->
            <div class="section-panel active" id="tab-sec1">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 1: Hero Visual & Headline</h2>
                        <p class="panel-desc">Update the primary banner text, headline, description, call-to-actions, and main visual image.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_1_hero') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Top Trust Tag / Pill</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_1_hero']['tag'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hero Visual Image File (Upload)</label>
                            <input type="file" name="hero_image_file" class="form-control" accept="image/*">
                            <span class="form-hint">Current: {{ $sections['section_1_hero']['hero_image'] ?? 'images/hero-visual.png' }}</span>
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">Hero Title (HTML supported for accent spans)</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_1_hero']['title'] ?? '' }}">
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">Hero Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_1_hero']['description'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Primary CTA Button Text</label>
                            <input type="text" name="content[primary_cta_text]" class="form-control" value="{{ $sections['section_1_hero']['primary_cta_text'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Primary CTA Destination Link</label>
                            <input type="text" name="content[primary_cta_link]" class="form-control" value="{{ $sections['section_1_hero']['primary_cta_link'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Secondary CTA Button Text</label>
                            <input type="text" name="content[secondary_cta_text]" class="form-control" value="{{ $sections['section_1_hero']['secondary_cta_text'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Secondary CTA Destination Link</label>
                            <input type="text" name="content[secondary_cta_link]" class="form-control" value="{{ $sections['section_1_hero']['secondary_cta_link'] ?? '' }}">
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 1 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 2: ABOUT & BRANDS -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec2">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 2: About & Media Brands</h2>
                        <p class="panel-desc">Manage the narrative description and the three flagship brand cards (MARKETECH APAC, UpTech Media, and HR Forward Asia).</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_2_about') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Tag</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_2_about']['tag'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_2_about']['title'] ?? '' }}">
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">About Narrative</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_2_about']['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <h3 style="font-size: 1.1rem; color: var(--navy); margin: 1.5rem 0 1rem;">Flagship Media Branches</h3>

                    @foreach(($sections['section_2_about']['branches'] ?? []) as $i => $branch)
                        <div class="sub-card">
                            <div class="sub-card-title">&#x1F4CB; Brand {{ $i + 1 }}: {{ $branch['name'] }}</div>
                            <input type="hidden" name="content[branches][{{ $i }}][id]" value="{{ $branch['id'] }}">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Brand Name</label>
                                    <input type="text" name="content[branches][{{ $i }}][name]" class="form-control" value="{{ $branch['name'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website / About URL</label>
                                    <input type="text" name="content[branches][{{ $i }}][link]" class="form-control" value="{{ $branch['link'] }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Excerpt / Description</label>
                                    <textarea name="content[branches][{{ $i }}][excerpt]" class="form-control">{{ $branch['excerpt'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 2 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 3: WHY WECON -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec3">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 3: Why WECON (Value Proposition)</h2>
                        <p class="panel-desc">Update the 4 core strategic pillars: Connect, Discover, Participate, and Grow.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_3_why') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Tag</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_3_why']['tag'] ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Section Title</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_3_why']['title'] ?? '' }}">
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">Section Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_3_why']['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <h3 style="font-size: 1.1rem; color: var(--navy); margin: 1.5rem 0 1rem;">Four Strategic Pillars</h3>

                    @foreach(($sections['section_3_why']['pillars'] ?? []) as $i => $pillar)
                        <div class="sub-card">
                            <div class="sub-card-title">Pillar {{ $pillar['step'] }}: {{ $pillar['title'] }}</div>
                            <input type="hidden" name="content[pillars][{{ $i }}][step]" value="{{ $pillar['step'] }}">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="content[pillars][{{ $i }}][title]" class="form-control" value="{{ $pillar['title'] }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tag / Outcome</label>
                                    <input type="text" name="content[pillars][{{ $i }}][tag]" class="form-control" value="{{ $pillar['tag'] }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description</label>
                                    <textarea name="content[pillars][{{ $i }}][desc]" class="form-control">{{ $pillar['desc'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 3 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 4: EVENTS & AWARDS -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec4">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 4: Events & Awards Showcase</h2>
                        <p class="panel-desc">Manage the upcoming events and awards headers, descriptions, and registration links.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_4_events') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Badge 1</label>
                            <input type="text" name="content[badge_1]" class="form-control" value="{{ $sections['section_4_events']['badge_1'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Badge 2</label>
                            <input type="text" name="content[badge_2]" class="form-control" value="{{ $sections['section_4_events']['badge_2'] ?? '' }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_4_events']['title'] ?? '' }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_4_events']['description'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Primary Link Destination</label>
                            <input type="text" name="content[primary_link]" class="form-control" value="{{ $sections['section_4_events']['primary_link'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Primary Link Label</label>
                            <input type="text" name="content[primary_link_text]" class="form-control" value="{{ $sections['section_4_events']['primary_link_text'] ?? '' }}">
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 4 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 5: SPEAKERS / FEATURES -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec5">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 5: Speakers & Leadership Features</h2>
                        <p class="panel-desc">Update the executive leadership and speaker feature narrative text.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_5_speakers') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Tag</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_5_speakers']['tag'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_5_speakers']['title'] ?? '' }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_5_speakers']['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 5 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 6: INSIGHTS & MEDIA -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec6">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 6: Industry Insights & Media</h2>
                        <p class="panel-desc">Update the editorial and business intelligence section headers and narrative.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_6_insights') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Tag</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_6_insights']['tag'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_6_insights']['title'] ?? '' }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_6_insights']['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 6 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 7: STAY CONNECTED / AUTO EMAIL -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec7">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 7: Stay Connected & Automated Email Alerts</h2>
                        <p class="panel-desc">Configure the newsletter signup text and the automated email recipient for subscriber alerts.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_7_newsletter') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Section Tag</label>
                            <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_7_newsletter']['tag'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Main Heading</label>
                            <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_7_newsletter']['title'] ?? '' }}">
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Description</label>
                            <textarea name="content[description]" class="form-control">{{ $sections['section_7_newsletter']['description'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group form-full">
                            <div class="sub-card">
                                <div class="sub-card-title">&#x1F4E7; Automated Staff Email Notifications</div>
                                <p style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                                    When a viewer submits their information on this section, an automated notification is instantly dispatched to this staff email:
                                </p>
                                <label class="form-label">Staff Notification Email Address</label>
                                <input type="email" name="content[recipient_email]" class="form-control" value="{{ $sections['section_7_newsletter']['recipient_email'] ?? 'management@marketech-apac.com' }}" required>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 7 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- GUIDED PATHWAYS ("WHAT BRINGS YOU TO WECON?") -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-pathways">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Guided Pathways ("What Brings You to WECON?")</h2>
                        <p class="panel-desc">Customize the section title, description, and each of the 6 pathway cards (Summits, Awards, Speaker, Partner, Insights, Careers).</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_pathways') }}" method="POST">
                    @csrf
                    
                    <!-- Section Header -->
                    <div class="sub-card">
                        <div class="sub-card-title">&#x1F9ED; Section Header</div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Section Tag / Pill</label>
                                <input type="text" name="content[tag]" class="form-control" value="{{ $sections['section_pathways']['tag'] ?? 'Guided Pathways' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Section Title</label>
                                <input type="text" name="content[title]" class="form-control" value="{{ $sections['section_pathways']['title'] ?? 'What Brings You to WECON?' }}">
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">Section Description</label>
                                <textarea name="content[description]" class="form-control">{{ $sections['section_pathways']['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 6 Pathway Cards Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); gap: 1.25rem;">
                        <!-- Card 1 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F3AB; Card 1: Attend an Event</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_1_badge]" class="form-control" value="{{ $sections['section_pathways']['card_1_badge'] ?? 'Summits & Forums' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Target Link URL</label>
                                    <input type="text" name="content[card_1_link_url]" class="form-control" value="{{ $sections['section_pathways']['card_1_link_url'] ?? '#events' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_1_question]" class="form-control" value="{{ $sections['section_pathways']['card_1_question'] ?? '\"I want to attend an event\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_1_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_1_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_1_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_1_link_text'] ?? 'View Events Showcase' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F3C6; Card 2: Enter an Award</div>
                            <div class="form-grid">
                                <div class="form-group form-full">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_2_badge]" class="form-control" value="{{ $sections['section_pathways']['card_2_badge'] ?? 'Awards & Honors' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_2_question]" class="form-control" value="{{ $sections['section_pathways']['card_2_question'] ?? '\"I want to enter an award\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_2_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_2_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_2_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_2_link_text'] ?? 'Open Nomination Form' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F3A4; Card 3: Become a Speaker</div>
                            <div class="form-grid">
                                <div class="form-group form-full">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_3_badge]" class="form-control" value="{{ $sections['section_pathways']['card_3_badge'] ?? 'Thought Leadership' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_3_question]" class="form-control" value="{{ $sections['section_pathways']['card_3_question'] ?? '\"I want to become a speaker\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_3_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_3_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_3_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_3_link_text'] ?? 'Submit Speaker Proposal' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F91D; Card 4: Partner / Sponsor</div>
                            <div class="form-grid">
                                <div class="form-group form-full">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_4_badge]" class="form-control" value="{{ $sections['section_pathways']['card_4_badge'] ?? 'Commercial Alliances' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_4_question]" class="form-control" value="{{ $sections['section_pathways']['card_4_question'] ?? '\"I want to partner with WECON\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_4_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_4_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_4_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_4_link_text'] ?? 'Request Partner Pack' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F4D6; Card 5: Explore Insights</div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_5_badge]" class="form-control" value="{{ $sections['section_pathways']['card_5_badge'] ?? 'Intelligence' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Target Link URL</label>
                                    <input type="text" name="content[card_5_link_url]" class="form-control" value="{{ $sections['section_pathways']['card_5_link_url'] ?? '#insights' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_5_question]" class="form-control" value="{{ $sections['section_pathways']['card_5_question'] ?? '\"I want to explore insights\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_5_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_5_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_5_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_5_link_text'] ?? 'Go to Insights Hub' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Card 6 -->
                        <div class="sub-card" style="margin-bottom: 0;">
                            <div class="sub-card-title">&#x1F4BC; Card 6: Careers & Talent</div>
                            <div class="form-grid">
                                <div class="form-group form-full">
                                    <label class="form-label">Badge Label</label>
                                    <input type="text" name="content[card_6_badge]" class="form-control" value="{{ $sections['section_pathways']['card_6_badge'] ?? 'Talent & Culture' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Heading / Question</label>
                                    <input type="text" name="content[card_6_question]" class="form-control" value="{{ $sections['section_pathways']['card_6_question'] ?? '\"I want to join the WECON team\"' }}">
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Description / Answer</label>
                                    <textarea name="content[card_6_answer]" class="form-control" style="min-height: 70px;">{{ $sections['section_pathways']['card_6_answer'] ?? '' }}</textarea>
                                </div>
                                <div class="form-group form-full">
                                    <label class="form-label">Link Text</label>
                                    <input type="text" name="content[card_6_link_text]" class="form-control" value="{{ $sections['section_pathways']['card_6_link_text'] ?? 'View Career Openings' }}">
                                </div>
                                <div class="form-group form-full" style="margin-top: 0.25rem;">
                                    <div style="font-size: 0.8rem; background: rgba(2, 132, 199, 0.08); padding: 0.5rem 0.75rem; border-radius: 8px; color: #0284c7;">
                                        💼 <strong>Want to manage live job positions?</strong> Go to the <a href="#tab-careers" onclick="switchTab('tab-careers'); return false;" style="color: var(--blue); font-weight: 700; text-decoration: underline;">Careers & Job Openings Tab</a> to add new positions, departments, and descriptions.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Guided Pathways Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- CAREERS & JOB POSITIONS MANAGEMENT -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-careers">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">💼 Careers & Job Openings Management</h2>
                        <p class="panel-desc">Manage the "Careers at WECON" modal, recruit new talent, and add, edit, or remove open job positions and descriptions.</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_careers') }}" method="POST">
                    @csrf
                    
                    <!-- Modal Header & Contact Info -->
                    <div class="sub-card">
                        <div class="sub-card-title">📌 Careers Modal Header & Settings</div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Modal Title</label>
                                <input type="text" name="content[modal_title]" class="form-control" value="{{ $sections['section_careers']['modal_title'] ?? 'Careers at WECON' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Talent Acquisition Email</label>
                                <input type="email" name="content[careers_email]" class="form-control" value="{{ $sections['section_careers']['careers_email'] ?? 'careers@wecon.asia' }}" required>
                                <span class="form-hint">Job applicants will be directed to send their resume and applications to this address.</span>
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">Modal Subtitle / Tagline</label>
                                <input type="text" name="content[modal_subtitle]" class="form-control" value="{{ $sections['section_careers']['modal_subtitle'] ?? 'Join our cross-border team of media, event, and business innovators.' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Open Positions Dynamic List -->
                    <div class="sub-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
                            <div>
                                <div class="sub-card-title" style="margin-bottom: 0.25rem;">📋 Active Job Positions</div>
                                <p style="font-size: 0.82rem; color: var(--text-muted); margin: 0;">Add new job openings with role titles, department locations, and detailed descriptions.</p>
                            </div>
                            <button type="button" onclick="addJobPosition()" class="btn-save" style="padding: 0.55rem 1.15rem; font-size: 0.85rem; background: #0284c7;">
                                ➕ Add New Job Position
                            </button>
                        </div>

                        <div id="jobs-list-container">
                            @php
                                $jobs = $sections['section_careers']['jobs'] ?? [
                                    [
                                        'title' => 'Senior Tech & Business Journalist',
                                        'location' => 'Singapore / Remote • Editorial Team',
                                        'type' => 'Full-time',
                                        'description' => 'Produce in-depth coverage, executive interviews, and investigative features across Asia-Pacific enterprise technology and digital markets.',
                                    ],
                                    [
                                        'title' => 'Conference Program Producer',
                                        'location' => 'Manila / Hybrid • Events Division',
                                        'type' => 'Full-time',
                                        'description' => 'Curate thought leadership agendas, recruit high-profile keynote speakers, and collaborate with marketing teams to deliver world-class business summits.',
                                    ],
                                    [
                                        'title' => 'Enterprise Sponsorship Director',
                                        'location' => 'Regional • Commercial Partnerships',
                                        'type' => 'Full-time',
                                        'description' => 'Develop and secure strategic multi-market sponsorship and media alliances with top technology brands and enterprise vendors across APAC.',
                                    ],
                                ];
                            @endphp

                            @foreach($jobs as $idx => $job)
                                <div class="sub-card job-entry-card" style="background: #FFFFFF; border: 1px solid var(--border); border-left: 4px solid var(--blue); margin-bottom: 1.25rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px dashed var(--border); padding-bottom: 0.6rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <span style="font-size: 1.1rem;">💼</span>
                                            <span style="font-weight: 700; color: var(--navy); font-size: 0.95rem;" class="job-card-title-label">Position #{{ $loop->iteration }}: {{ $job['title'] ?? 'New Role' }}</span>
                                        </div>
                                        <button type="button" onclick="removeJobCard(this)" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.25); color: #EF4444; font-size: 0.82rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                                            🗑 Remove Position
                                        </button>
                                    </div>

                                    <div class="form-grid">
                                        <div class="form-group form-full">
                                            <label class="form-label">Job Position Title *</label>
                                            <input type="text" name="content[jobs][{{ $idx }}][title]" class="form-control" value="{{ $job['title'] ?? '' }}" placeholder="e.g. Senior Tech & Business Journalist" oninput="updateJobTitlePreview(this)" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Location & Division / Department</label>
                                            <input type="text" name="content[jobs][{{ $idx }}][location]" class="form-control" value="{{ $job['location'] ?? '' }}" placeholder="e.g. Singapore / Remote • Editorial Team">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Employment Type</label>
                                            <select name="content[jobs][{{ $idx }}][type]" class="form-control">
                                                <option value="Full-time" {{ ($job['type'] ?? '') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                                <option value="Hybrid" {{ ($job['type'] ?? '') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                <option value="Remote" {{ ($job['type'] ?? '') === 'Remote' ? 'selected' : '' }}>Remote</option>
                                                <option value="Part-time" {{ ($job['type'] ?? '') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                                <option value="Contract" {{ ($job['type'] ?? '') === 'Contract' ? 'selected' : '' }}>Contract</option>
                                            </select>
                                        </div>
                                        <div class="form-group form-full">
                                            <label class="form-label">Job Description & Responsibilities</label>
                                            <textarea name="content[jobs][{{ $idx }}][description]" class="form-control" placeholder="Outline the role overview, core responsibilities, and key requirements..." style="min-height: 80px;">{{ $job['description'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div style="text-align: center; margin-top: 1rem;">
                            <button type="button" onclick="addJobPosition()" style="background: rgba(2, 132, 199, 0.08); border: 2px dashed #0284c7; color: #0284c7; font-weight: 700; font-size: 0.9rem; padding: 0.85rem 2rem; border-radius: 10px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s;">
                                ➕ Add Another Job Position
                            </button>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Careers & Job Positions Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- SECTION 8: CONTACT OUR TEAM & MODAL -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-sec9">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Section 9: Contact Modal & Corporate Information</h2>
                        <p class="panel-desc">Customize the "Contact Our Team" modal info (Office, Call/Message, Email Us, Consent Quote, and Terms Links).</p>
                    </div>
                </div>

                <form action="{{ route('admin.section.update', 'section_9_contact') }}" method="POST">
                    @csrf
                    
                    <!-- Landing Page CTA Text -->
                    <div class="sub-card">
                        <div class="sub-card-title">&#x1F50C; Landing Page Final Call to Action</div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">CTA Heading</label>
                                <input type="text" name="content[cta_title]" class="form-control" value="{{ $sections['section_9_contact']['cta_title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">CTA Button Label</label>
                                <input type="text" name="content[cta_button_text]" class="form-control" value="{{ $sections['section_9_contact']['cta_button_text'] ?? 'Contact Our Team' }}">
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">CTA Description</label>
                                <textarea name="content[cta_desc]" class="form-control">{{ $sections['section_9_contact']['cta_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Notification Target -->
                    <div class="sub-card">
                        <div class="sub-card-title">&#x1F4E8; Automated Lead Notification</div>
                        <div class="form-group">
                            <label class="form-label">Company Staff Email for Inquiries</label>
                            <input type="email" name="content[staff_notification_email]" class="form-control" value="{{ $sections['section_9_contact']['staff_notification_email'] ?? 'management@marketech-apac.com' }}" required>
                            <span class="form-hint">When a visitor submits the modal form, their information is immediately sent to this email address.</span>
                        </div>
                    </div>

                    <!-- Modal Left Column: Office, Call, Email -->
                    <div class="sub-card">
                        <div class="sub-card-title">&#x1F3E2; Modal Left Sidebar: Contact Details</div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Header Title</label>
                                <input type="text" name="content[modal_left_title]" class="form-control" value="{{ $sections['section_9_contact']['modal_left_title'] ?? 'Get In Touch with Us' }}">
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">Header Intro Description</label>
                                <textarea name="content[modal_left_desc]" class="form-control">{{ $sections['section_9_contact']['modal_left_desc'] ?? '' }}</textarea>
                            </div>

                            <!-- Office Details -->
                            <div class="form-group form-full" style="border-top: 1px dashed var(--border); padding-top: 1rem;">
                                <label class="form-label">&#x1F3E2; Office Address</label>
                                <textarea name="content[office_address]" class="form-control">{{ $sections['section_9_contact']['office_address'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">Google Maps Link URL</label>
                                <input type="text" name="content[google_map_url]" class="form-control" value="{{ $sections['section_9_contact']['google_map_url'] ?? '' }}">
                            </div>

                            <!-- Call / Message -->
                            <div class="form-group" style="border-top: 1px dashed var(--border); padding-top: 1rem;">
                                <label class="form-label">&#x1F4DE; Call/Message Phone Number</label>
                                <input type="text" name="content[call_phone]" class="form-control" value="{{ $sections['section_9_contact']['call_phone'] ?? '+63 917 319 5762' }}">
                            </div>
                            <div class="form-group" style="border-top: 1px dashed var(--border); padding-top: 1rem;">
                                <label class="form-label">WhatsApp Direct Link</label>
                                <input type="text" name="content[call_whatsapp_url]" class="form-control" value="{{ $sections['section_9_contact']['call_whatsapp_url'] ?? '' }}">
                            </div>

                            <!-- Email Us Department Addresses -->
                            <div class="form-group form-full" style="border-top: 1px dashed var(--border); padding-top: 1rem;">
                                <label class="form-label">&#x2709; Email Us Department Addresses</label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Editorial Email</label>
                                <input type="email" name="content[email_editorial]" class="form-control" value="{{ $sections['section_9_contact']['email_editorial'] ?? 'editorial@marketech-apac.com' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sales Email</label>
                                <input type="email" name="content[email_sales]" class="form-control" value="{{ $sections['section_9_contact']['email_sales'] ?? 'sales@marketech-apac.com' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Subscription Email</label>
                                <input type="email" name="content[email_subscription]" class="form-control" value="{{ $sections['section_9_contact']['email_subscription'] ?? 'subscription@marketech-apac.com' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Others / Management Email</label>
                                <input type="email" name="content[email_others]" class="form-control" value="{{ $sections['section_9_contact']['email_others'] ?? 'management@marketech-apac.com' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Right Column: Legal Disclaimer Quote & Policies -->
                    <div class="sub-card">
                        <div class="sub-card-title">&#x1F4DD; Modal Right Column: Terms, Privacy & Consent Quote</div>
                        <div class="form-grid">
                            <div class="form-group form-full">
                                <label class="form-label">Modal Right Title</label>
                                <input type="text" name="content[modal_right_title]" class="form-control" value="{{ $sections['section_9_contact']['modal_right_title'] ?? 'Connect with MARKETECH APAC TEAM' }}">
                            </div>
                            <div class="form-group form-full">
                                <label class="form-label">Consent Disclaimer Quote Text</label>
                                <textarea name="content[consent_quote]" class="form-control" style="min-height: 120px;">{{ $sections['section_9_contact']['consent_quote'] ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Terms & Conditions URL</label>
                                <input type="text" name="content[terms_url]" class="form-control" value="{{ $sections['section_9_contact']['terms_url'] ?? 'https://marketech-apac.com/terms-and-conditions/' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Privacy Policy and Cookie Policy URL</label>
                                <input type="text" name="content[privacy_url]" class="form-control" value="{{ $sections['section_9_contact']['privacy_url'] ?? 'https://marketech-apac.com/privacy-and-cookie-policy/' }}">
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn-save">&#x1F4BE; Save Section 9 Changes</button>
                    </div>
                </form>
            </div>

            <!-- ============================================== -->
            <!-- INQUIRIES INBOX -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-inquiries">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Contact Inquiries Inbox</h2>
                        <p class="panel-desc">All leads submitted via the Section 9 "Contact Our Team" modal.</p>
                    </div>
                </div>

                @if($inquiries->isEmpty())
                    <p style="color: var(--text-muted); font-size: 0.9rem; padding: 2rem 0; text-align: center;">No contact inquiries submitted yet.</p>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email & Phone</th>
                                <th>Company & Role</th>
                                <th>Purpose & Details</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inquiries as $inq)
                                <tr>
                                    <td>
                                        <strong>{{ $inq->first_name }} {{ $inq->last_name }}</strong>
                                    </td>
                                    <td>
                                        <div><a href="mailto:{{ $inq->business_email }}" style="color: var(--blue);">{{ $inq->business_email }}</a></div>
                                        <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $inq->contact_number ?: 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div><strong>{{ $inq->company_name ?: 'N/A' }}</strong></div>
                                        <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $inq->job_title ?: 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge-tag">{{ $inq->purpose }}</span>
                                        <p style="font-size: 0.8rem; margin-top: 0.35rem; color: var(--text-body);">{{ Str::limit($inq->details, 140) }}</p>
                                    </td>
                                    <td style="font-size: 0.78rem; white-space: nowrap; color: var(--text-muted);">
                                        {{ $inq->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.inquiry.delete', $inq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-del">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- ============================================== -->
            <!-- SUBSCRIBERS INBOX -->
            <!-- ============================================== -->
            <div class="section-panel" id="tab-subscribers">
                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Newsletter Subscribers</h2>
                        <p class="panel-desc">All subscribers registered through Section 7 "Stay Connected".</p>
                    </div>
                </div>

                @if($subscribers->isEmpty())
                    <p style="color: var(--text-muted); font-size: 0.9rem; padding: 2rem 0; text-align: center;">No newsletter subscribers recorded yet.</p>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Interests</th>
                                <th>Subscribed At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $sub)
                                <tr>
                                    <td><strong>{{ $sub->full_name ?: 'Subscriber' }}</strong></td>
                                    <td><a href="mailto:{{ $sub->email }}" style="color: var(--blue);">{{ $sub->email }}</a></td>
                                    <td>
                                        @if(is_array($sub->interests))
                                            @foreach($sub->interests as $it)
                                                <span class="badge-tag">{{ $it }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge-tag">General</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 0.78rem; white-space: nowrap; color: var(--text-muted);">
                                        {{ $sub->created_at->format('M d, Y H:i') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.subscriber.delete', $sub->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-del">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </main>
    </div>

    <!-- TAB SWITCHING SCRIPT -->
    <script>
        const tabButtons = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.section-panel');

        function switchTab(targetId) {
            tabButtons.forEach(btn => {
                if (btn.getAttribute('data-target') === targetId) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            panels.forEach(panel => {
                if (panel.id === targetId) {
                    panel.classList.add('active');
                } else {
                    panel.classList.remove('active');
                }
            });

            // Store in URL hash
            history.replaceState(null, null, '#' + targetId);
        }

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const target = btn.getAttribute('data-target');
                switchTab(target);
            });
        });

        // Check if tab query param or hash exists on load
        @if(request('tab'))
            const requestedSection = "{{ request('tab') }}";
            const tabMap = {
                'section_1_hero': 'tab-sec1',
                'section_2_about': 'tab-sec2',
                'section_3_why': 'tab-sec3',
                'section_4_events': 'tab-sec4',
                'section_5_speakers': 'tab-sec5',
                'section_6_insights': 'tab-sec6',
                'section_7_newsletter': 'tab-sec7',
                'section_pathways': 'tab-pathways',
                'section_careers': 'tab-careers',
                'section_9_contact': 'tab-sec9'
            };
            if (tabMap[requestedSection]) {
                switchTab(tabMap[requestedSection]);
            }
        @elseif(request('hash'))
            if (document.getElementById("{{ request('hash') }}")) {
                switchTab("{{ request('hash') }}");
            }
        @else
            if (window.location.hash) {
                const hash = window.location.hash.substring(1);
                if (document.getElementById(hash)) {
                    switchTab(hash);
                }
            }
        @endif

        // Dynamic Job Position Management
        let jobCounter = Date.now();

        function addJobPosition() {
            const container = document.getElementById('jobs-list-container');
            const newIdx = jobCounter++;
            const positionNumber = container.querySelectorAll('.job-entry-card').length + 1;

            const cardHtml = `
                <div class="sub-card job-entry-card" style="background: #FFFFFF; border: 1px solid var(--border); border-left: 4px solid #0284c7; margin-bottom: 1.25rem; animation: fadeIn 0.3s ease;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px dashed var(--border); padding-bottom: 0.6rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 1.1rem;">💼</span>
                            <span style="font-weight: 700; color: var(--navy); font-size: 0.95rem;" class="job-card-title-label">Position #${positionNumber}: New Job Role</span>
                        </div>
                        <button type="button" onclick="removeJobCard(this)" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.25); color: #EF4444; font-size: 0.82rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem;">
                            🗑 Remove Position
                        </button>
                    </div>

                    <div class="form-grid">
                        <div class="form-group form-full">
                            <label class="form-label">Job Position Title *</label>
                            <input type="text" name="content[jobs][${newIdx}][title]" class="form-control" placeholder="e.g. Head of Strategic Partnerships" oninput="updateJobTitlePreview(this)" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Location & Division / Department</label>
                            <input type="text" name="content[jobs][${newIdx}][location]" class="form-control" placeholder="e.g. Singapore / Remote • Commercial Partnerships">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Employment Type</label>
                            <select name="content[jobs][${newIdx}][type]" class="form-control">
                                <option value="Full-time">Full-time</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Remote">Remote</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Contract">Contract</option>
                            </select>
                        </div>
                        <div class="form-group form-full">
                            <label class="form-label">Job Description & Responsibilities</label>
                            <textarea name="content[jobs][${newIdx}][description]" class="form-control" placeholder="Outline the role overview, core responsibilities, and key requirements..." style="min-height: 80px;"></textarea>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', cardHtml);
            const newlyAdded = container.lastElementChild;
            const titleInput = newlyAdded.querySelector('input[type="text"]');
            if (titleInput) {
                titleInput.focus();
            }
        }

        function removeJobCard(button) {
            const card = button.closest('.job-entry-card');
            if (card) {
                card.remove();
                renumberJobCards();
            }
        }

        function updateJobTitlePreview(input) {
            const card = input.closest('.job-entry-card');
            if (!card) return;
            const label = card.querySelector('.job-card-title-label');
            if (label) {
                const currentCards = Array.from(document.querySelectorAll('.job-entry-card'));
                const index = currentCards.indexOf(card) + 1;
                label.textContent = `Position #${index}: ${input.value.trim() || 'New Job Role'}`;
            }
        }

        function renumberJobCards() {
            const cards = document.querySelectorAll('.job-entry-card');
            cards.forEach((card, index) => {
                const label = card.querySelector('.job-card-title-label');
                const titleInput = card.querySelector('input[name*="[title]"]');
                const titleVal = titleInput ? titleInput.value.trim() : '';
                if (label) {
                    label.textContent = `Position #${index + 1}: ${titleVal || 'Job Role'}`;
                }
            });
        }
    </script>
</body>
</html>
