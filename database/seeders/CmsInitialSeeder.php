<?php

namespace Database\Seeders;

use App\Models\CmsContent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CmsInitialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure Admin User exists
        User::updateOrCreate(
            ['email' => 'admin@wecon.asia'],
            [
                'name' => 'WECON Administrator',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Section 1: Hero
        CmsContent::setSection('section_1_hero', [
            'tag' => 'Asia-Pacific Media & Business Ecosystem',
            'title' => 'Connecting Ideas, <span class="highlight">People</span>, and Opportunities',
            'description' => 'WECON brings together industry leaders, organizations, professionals, and communities through events, awards, media, and meaningful business experiences.',
            'primary_cta_text' => 'See Articles',
            'primary_cta_link' => '#insights',
            'secondary_cta_text' => 'View Upcoming Events',
            'secondary_cta_link' => '#events',
            'hero_image' => 'images/hero-visual.png',
        ]);

        // 3. Section 2: About & Brands
        CmsContent::setSection('section_2_about', [
            'tag' => 'Who We Are',
            'title' => 'More Than Media.<br><span class="accent-red">A Connected Business Ecosystem.</span>',
            'description' => 'WECON Asia Media Group, Inc. is a forward-thinking business media, events, and industry intelligence ecosystem that connects enterprise leaders, innovators, and professionals across Asia. Through premier conferences, prestigious awards, insightful editorial coverage, and curated networking, we shape industries and catalyze growth.',
            'branches' => [
                [
                    'id' => 'marketech',
                    'name' => 'MARKETECH APAC',
                    'logo' => 'images/marketech-logo.png',
                    'excerpt' => "Asia's premier marketing technology intelligence publication reporting on digital advertising, MarTech innovation, and brand strategy across APAC.",
                    'link' => 'https://marketech-apac.com/about-marketech-apac/',
                ],
                [
                    'id' => 'uptech',
                    'name' => 'UpTech Media',
                    'logo' => 'images/uptech-logo.png',
                    'excerpt' => 'Always moving upwards — verified technology media covering enterprise AI, data infrastructure, cybersecurity, fintech, and digital transformation.',
                    'link' => 'https://uptech-media.com/about-us/',
                ],
                [
                    'id' => 'hrforward',
                    'name' => 'HR Forward Asia',
                    'logo' => 'images/hrforward-logo.png',
                    'excerpt' => 'Pan-Asian human capital publication dedicated to executive leadership, talent development, employee experience, and HR technology.',
                    'link' => 'https://hrforwardasia.com/about-us/',
                ],
            ],
        ]);

        // 4. Section 3: Why WECON
        CmsContent::setSection('section_3_why', [
            'tag' => 'Value Proposition',
            'title' => 'Why Engage with WECON?',
            'description' => 'Four strategic pillars that empower professionals, brands, and organizations to achieve enduring business impact.',
            'pillars' => [
                [
                    'step' => '01',
                    'title' => 'Connect',
                    'desc' => 'Meet influential decision-makers, fellow directors, senior executives, and visionary founders in high-trust peer environments.',
                    'tag' => 'High-Level Peer Network',
                ],
                [
                    'step' => '02',
                    'title' => 'Discover',
                    'desc' => 'Access forward-looking business intelligence, actionable case studies, emerging tech trends, and fresh industry perspectives.',
                    'tag' => 'Strategic Foresight',
                ],
                [
                    'step' => '03',
                    'title' => 'Participate',
                    'desc' => 'Take the main stage as a speaker, enter competitive benchmark awards, or join specialized immersion masterclasses.',
                    'tag' => 'Active Contribution',
                ],
                [
                    'step' => '04',
                    'title' => 'Grow',
                    'desc' => 'Amplify commercial brand visibility, forge strategic cross-border partnerships, and capture transformative market opportunities.',
                    'tag' => 'Exponential ROI',
                ],
            ],
        ]);

        // 5. Section 4: Events & Awards
        CmsContent::setSection('section_4_events', [
            'badge_1' => 'Premier APAC Gatherings',
            'badge_2' => 'Flagship Conferences',
            'badge_3' => 'Benchmark Awards',
            'title' => 'Upcoming Summits & Industry Awards',
            'description' => 'WECON curates and hosts high-caliber business conferences, executive symposiums, and benchmark industry awards across the Asia-Pacific region. Explore our flagship brand experiences below.',
            'primary_link' => 'https://marketech-apac.com/featured-events/',
            'primary_link_text' => 'Explore Full Calendar & Tickets',
            'secondary_link_text' => 'Download Events Prospectus',
        ]);

        // 6. Section 5: Speakers / Leadership
        CmsContent::setSection('section_5_speakers', [
            'tag' => 'HR Forward Asia',
            'title' => 'Features & Leadership',
            'description' => 'In-depth executive interviews, workforce perspectives, and leadership features examining how organisations navigate change and the future of work across Asia.',
        ]);

        // 7. Section 6: Insights & Media
        CmsContent::setSection('section_6_insights', [
            'tag' => 'Editorial & Intelligence',
            'title' => 'Industry Insights & Media',
            'description' => 'Verified reporting, strategic analysis, executive interviews, and research across our 3 media publications: MARKETECH APAC, UpTech Media, and HR Forward Asia.',
        ]);

        // 8. Section 7: Stay Connected / Newsletter
        CmsContent::setSection('section_7_newsletter', [
            'tag' => 'Stay Connected',
            'title' => "Join Asia's Premier Business Information Network",
            'description' => 'Get the latest event invitations, executive insights, award nomination dates, and market reports delivered to your inbox weekly.',
            'recipient_email' => 'management@marketech-apac.com',
            'notify_staff' => true,
        ]);

        // 9. Guided Pathways ("What Brings You to WECON?")
        CmsContent::setSection('section_pathways', [
            'tag' => 'Guided Pathways',
            'title' => 'What Brings You to WECON?',
            'description' => 'Select your intended journey below to immediately access relevant programs, nomination portals, and executive resources.',
            'card_1_badge' => 'Summits & Forums',
            'card_1_question' => '"I want to attend an event"',
            'card_1_answer' => 'Browse our upcoming technology, marketing, and HR summits to secure passes and view speaker agendas.',
            'card_1_link_text' => 'View Events Showcase',
            'card_1_link_url' => '#events',
            'card_2_badge' => 'Awards & Honors',
            'card_2_question' => '"I want to enter an award"',
            'card_2_answer' => 'Submit nominations for your organization or team to receive Asia-Pacific industry recognition.',
            'card_2_link_text' => 'Open Nomination Form',
            'card_3_badge' => 'Thought Leadership',
            'card_3_question' => '"I want to become a speaker"',
            'card_3_answer' => 'Share your expertise on stage at upcoming WECON summits before senior enterprise audiences.',
            'card_3_link_text' => 'Submit Speaker Proposal',
            'card_4_badge' => 'Commercial Alliances',
            'card_4_question' => '"I want to partner with WECON"',
            'card_4_answer' => 'Explore bespoke sponsorship, branded thought leadership, event staging, and media integration packages.',
            'card_4_link_text' => 'Request Partner Pack',
            'card_5_badge' => 'Intelligence',
            'card_5_question' => '"I want to explore insights"',
            'card_5_answer' => 'Read deep-dive articles, watch keynote recordings, and download proprietary sector benchmarking reports.',
            'card_5_link_text' => 'Go to Insights Hub',
            'card_5_link_url' => '#insights',
            'card_6_badge' => 'Talent & Culture',
            'card_6_question' => '"I want to join the WECON team"',
            'card_6_answer' => 'Discover open career opportunities across journalism, event production, partnership sales, and technology.',
            'card_6_link_text' => 'View Career Openings',
        ]);

        // 10. Section 9: Contact Our Team & Modal (Matching Reference Image)
        CmsContent::setSection('section_9_contact', [
            // CTA on landing page
            'cta_title' => 'Be Part of the Next WECON Experience',
            'cta_desc' => 'Discover unprecedented opportunities to connect with industry leaders, participate in premier events, collaborate across borders, and grow within the WECON ecosystem.',
            'cta_button_text' => 'Contact Our Team',

            // Modal Left Column
            'modal_left_title' => 'Get In Touch with Us',
            'modal_left_desc' => 'Connect with us to stay up-to-date on the latest marketing news and events, network with other marketing professionals, and gain access to exclusive insights and resources.',
            'office_title' => 'Office',
            'office_address' => '14i Seville Tower, Circulo Verde Phase 1, #70 Calle Industria, Brgy. Bagumbayan, Quezon City, 1100 Philippines',
            'google_map_url' => 'https://maps.google.com/?q=Circulo+Verde+Phase+1+Calle+Industria+Bagumbayan+Quezon+City',
            'call_title' => 'Call/Message Us',
            'call_phone' => '+63 917 319 5762',
            'call_viber_url' => 'viber://chat?number=+639173195762',
            'call_whatsapp_url' => 'https://wa.me/639173195762',
            'email_title' => 'Email Us',
            'email_editorial' => 'editorial@marketech-apac.com',
            'email_sales' => 'sales@marketech-apac.com',
            'email_subscription' => 'subscription@marketech-apac.com',
            'email_others' => 'management@marketech-apac.com',
            'staff_notification_email' => 'management@marketech-apac.com',

            // Modal Right Column
            'modal_right_title' => 'Connect with MARKETECH APAC TEAM',
            'consent_quote' => 'By submitting the form I understand, I understand MARKETECT APAC’s Terms & Conditions and Cookies & Privacy Policy. Opt to receive marketing tips, insight, invitations, product updates and more via email from MARKETECH APAC. Please note that your consent and voluntary and you are under obligation to opt-in. even if you choose to consent now, you are welcome to come back and opt-out at any time.',
            'terms_url' => 'https://marketech-apac.com/terms-and-conditions/',
            'privacy_url' => 'https://marketech-apac.com/privacy-and-cookie-policy/',
        ]);

        // 11. Careers Modal & Job Openings
        CmsContent::setSection('section_careers', [
            'modal_title' => 'Careers at WECON',
            'modal_subtitle' => 'Join our cross-border team of media, event, and business innovators.',
            'careers_email' => 'careers@wecon.asia',
            'jobs' => [
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
            ],
        ]);
    }
}
