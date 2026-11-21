<?php
/**
 * Jason Lantier Portfolio & Autism Specialist Website
 * Configuration, Data Models, and Core Helper Functions
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site Information
define('SITE_NAME', 'Jason Lantier, Autism & Behavior Specialist');
define('SITE_TAGLINE', 'Affordable BCBA Supervision | ABA Therapy Services');
define('SITE_PHONE', '1-833-288-4762');
define('SITE_PHONE_DISPLAY', '1-833-AUTISM-2');
define('SITE_EMAIL', 'jlantier@path2potential.org');
define('SITE_LOCATION', '71-19 80th Street, Suite 8213, Queens (Glendale), NY 11385, United States');
define('SITE_HOURS', 'Mon - Fri: 09:00 am - 05:00 pm (24/7 Availability for Clients)');
define('SITE_LINKEDIN', 'https://www.linkedin.com/in/jasonlantier-path2potential/');
define('SITE_CALENDLY', 'https://calendly.com/jason-lantier');
define('SITE_YOUTUBE', 'https://www.youtube.com/@Path4ABA/videos');
define('RESUME_PATH', 'assets/docs/Jason_Lantier_Executive_Resume_Updated_Study_Manuals.pdf');

// Affiliations & Partner Organizations
$organizations = [
    'p2p' => [
        'name' => 'Path 2 Potential, LLC (P2P)',
        'role' => 'Co-Founder & Chief Executive Officer',
        'desc' => 'Leading ABA therapy company providing personalized in-home, center, and remote teletherapy across New York, New Jersey, Arizona, and Florida.',
        'url' => 'https://www.path2potential.org',
        'badge' => 'ABA Therapy Leader',
        'logo' => 'assets/images/p2p-logo.png'
    ],
    'path4aba' => [
        'name' => 'Path 4 ABA, PLLC',
        'role' => 'Co-Founder & Education Director',
        'desc' => 'Premier global education and mentorship platform providing affordable remote BCBA supervision, 40-hour RBT training courses, and comprehensive BACB task list exam prep.',
        'url' => 'https://path4aba.org/',
        'badge' => 'Low-Cost BCBA Supervision',
        'logo' => 'assets/images/behavior-plan.jpg'
    ],
    'angels' => [
        'name' => 'Angels 4 Autism, Inc.',
        'role' => 'Founder & President',
        'desc' => '501(c)(3) non-profit organization dedicated to improving the lives of underprivileged children on the spectrum by providing ABA scholarships, diagnostic support, and low-cost supervision.',
        'url' => 'https://angels4autism.org/',
        'badge' => '501(c)(3) Non-Profit Philanthropy',
        'logo' => 'assets/images/angels-logo.png'
    ],
    'bcbabootcamp' => [
        'name' => 'BCBA Bootcamp',
        'role' => 'Primary Instructor & Clinical Lead',
        'desc' => 'Intensive live exam preparation and task list fluency training led by Jason Lantier, MA, MBA, BCBA, LBA, empowering aspiring behavior analysts to pass the BCBA examination.',
        'url' => 'https://bcbabootcamp.com/',
        'badge' => 'Intensive Exam Preparation',
        'logo' => 'assets/images/card-luvmichael.jpg'
    ]
];

// Core Pillars & Services
$services = [
    [
        'title' => 'Personalized Care Plans',
        'desc' => 'At Path 2 Potential, we understand that each client has unique needs and preferences. That is why we create personalized care plans that are tailored to meet the specific developmental milestones and daily routines of each individual.',
        'icon' => 'fas fa-clipboard-check',
        'image' => 'assets/images/personalized-care-plans.png',
        'image_tone' => 'white',
        'layout' => 'bento-feature',
        'link' => 'https://www.path2potential.org',
        'link_text' => 'Explore ABA Therapy'
    ],
    [
        'title' => 'Low-Cost BCBA Supervision',
        'desc' => 'Comprehensive remote and in-person supervision for aspiring Board Certified Behavior Analysts. Guided mentorship through BACB 5th & 6th Edition Task Lists with practical, real-world case analysis.',
        'icon' => 'fas fa-user-graduate',
        'image' => 'assets/images/Low-Cost BCBA Supervision.png',
        'layout' => 'bento-side',
        'link' => 'https://path4aba.org/',
        'link_text' => 'Schedule Supervision'
    ],
    [
        'title' => '40-Hour RBT Training & Exam Prep',
        'desc' => 'State-of-the-art Registered Behavior Technician coursework, mock assessments, study manuals, and test-taking strategies guaranteed to help supervisees pass the exam with confidence.',
        'icon' => 'fas fa-book-open',
        'image' => 'assets/images/40-Hour-RBT-Training.png',
        'image_tone' => 'white',
        'layout' => 'bento-wide',
        'link' => 'https://path4aba.org/',
        'link_text' => 'Get Study Manuals'
    ],
    [
        'title' => '24/7 Support & Care Coordination',
        'desc' => 'We are available 24/7 to provide continuous guidance and care coordination. Whether it is crisis intervention, school IEP collaboration, or a quick consultation, our team is always within reach.',
        'icon' => 'fas fa-clock',
        'image' => 'assets/images/Care-Coordination.png',
        'layout' => 'bento-tile',
        'link' => '#contact',
        'link_text' => 'Connect With Our Team'
    ],
    [
        'title' => 'Professional & Licensed Team',
        'desc' => 'Our clinical team consists of licensed behavior analysts (LBA), BCBAs, and certified therapists who undergo continuous training, empirical audit, and rigorous background verification.',
        'icon' => 'fas fa-award',
        'image' => 'assets/images/Professional & Licensed Team.png',
        'layout' => 'bento-tile',
        'link' => 'https://www.path2potential.org',
        'link_text' => 'Meet Our Specialists'
    ],
    [
        'title' => 'Angels 4 Autism Philanthropy',
        'desc' => 'Navigating the path to success for underprivileged families facing autism, ensuring resources, acceptance, and a voice for every child. No child left behind!',
        'icon' => 'fas fa-heart',
        'image' => 'assets/images/card-angels4autism.jpg',
        'layout' => 'bento-tile',
        'link' => 'https://angels4autism.org/',
        'link_text' => 'Support Our Mission'
    ]
];

// Blog Posts & Educational Video Tutorials
// Load dynamically from data/blogs.json if present
$blogs_data_file = __DIR__ . '/../data/blogs.json';
if (file_exists($blogs_data_file)) {
    $decoded_posts = json_decode(@file_get_contents($blogs_data_file), true);
    if (is_array($decoded_posts)) {
        $blog_posts = $decoded_posts;
    }
}
if (!isset($blog_posts) || !is_array($blog_posts)) {
    $blog_posts = [
    [
        'id' => 'goals-of-behavior-analysis',
        'title' => '3 Goals of Behavior Analysis',
        'youtube_id' => 'R3CW5z6ypDQ',
        'category' => 'BACB Fundamentals',
        'summary' => 'Understanding Description, Prediction, and Control—the scientific foundations of Applied Behavior Analysis and how they drive clinical interventions.',
        'date' => 'October 14, 2024',
        'duration' => '7:18'
    ],
    [
        'id' => 'changing-criterion-design',
        'title' => 'What is a Changing Criterion Design in ABA?',
        'youtube_id' => 'aFztUhqathY',
        'category' => 'Experimental Design',
        'summary' => 'Deep dive into single-subject research methodology, step-by-step criterion adjustments, and demonstrating experimental control for behavior modification.',
        'date' => 'September 28, 2024',
        'duration' => '9:42'
    ],
    [
        'id' => 'component-vs-parametric-analysis',
        'title' => 'Component or Parametric Analysis',
        'youtube_id' => 'txbcO0wfed8',
        'category' => 'Advanced ABA',
        'summary' => 'A clear breakdown of the difference between evaluating treatment packages (component analysis) versus varying dosage or intensity levels (parametric analysis).',
        'date' => 'August 19, 2024',
        'duration' => '8:56'
    ],
    [
        'id' => 'section-a1-tasklist',
        'title' => 'Section A1 BACB Tasklist Explained',
        'youtube_id' => '0ubUQq3P9No',
        'category' => 'Exam Prep',
        'summary' => 'Master Section A1 of the BACB Task List with Jason Lantier. Essential definitions, philosophical assumptions, and practical clinical test questions.',
        'date' => 'July 11, 2024',
        'duration' => '11:24'
    ],
    [
        'id' => 'pass-rbt-guaranteed',
        'title' => 'Pass The RBT Exam Guaranteed!',
        'youtube_id' => '4F5lSfDui_Y',
        'image' => 'assets/images/rbt.png',
        'category' => 'RBT Training',
        'summary' => 'Key study tips, high-yield flashcard concepts, and measurement techniques to ace the 40-hour Registered Behavior Technician examination on your first try.',
        'date' => 'June 05, 2024',
        'duration' => '10:17'
    ],
    [
        'id' => 'meditation-study-guide',
        'title' => 'Study While You Relax: ABA Task List Audio Summaries',
        'youtube_id' => 'xFi_iOuZ1U8',
        'category' => 'Study Mindset',
        'summary' => 'Audio summaries accompanied by calming visual meditation to help candidate BCBAs absorb complex behavioral principles with clarity and reduced test anxiety.',
        'date' => 'May 22, 2024',
        'duration' => '12:05'
    ],
    [
        'id' => 'autism-prevalence-advancements',
        'title' => '20 Years of Autism Research & Emerging Interventions',
        'youtube_id' => 'NClt_X_zJA8',
        'category' => 'Clinical Research',
        'summary' => 'How advancements in early diagnostic screening, naturalistic developmental behavioral interventions (NDBI), and community support are transforming outcomes.',
        'date' => 'April 30, 2024',
        'duration' => '8:40'
    ]
];
}

// Media Video Library
$media_videos = [
    [
        'title' => 'What Supplements Help Individuals With Autism? Jason Lantier, ABA Therapy',
        'youtube_id' => 'ow0cT-MG6W0',
        'desc' => 'Jason Lantier discusses nutritional support, biomedical research, and sensory-friendly diets for neurodiverse individuals.',
        'tag' => 'Clinical Guidance'
    ],
    [
        'title' => 'Careers for Autism: Vocational Pathways & Independence',
        'youtube_id' => '2GUfQO2aSIQ',
        'desc' => 'How Applied Behavior Analysis can develop functional vocational skills and open doors to meaningful employment.',
        'tag' => 'Life Skills'
    ],
    [
        'title' => 'Celebrities with Autism: Breaking Stereotypes',
        'youtube_id' => '_k9nMMwJv58',
        'desc' => 'Exploring high-profile artists, creators, and leaders on the spectrum demonstrating that neurodiversity fuels extraordinary creativity.',
        'tag' => 'Advocacy'
    ],
    [
        'title' => 'Pass the BCBA Exam with Our Help: Section A1 BCBA Tasklist',
        'youtube_id' => 'z-NJjo2gk_k',
        'desc' => 'In-depth supervision session breaking down radical behaviorism, determinism, empiricism, and parsimony.',
        'tag' => 'BCBA Supervision'
    ],
    [
        'title' => 'Section A4 Tasklist Review: Behaviorism in Practice',
        'youtube_id' => 'Noe91UBBf08',
        'desc' => 'Behavior-analytic interpretation of private events, rule-governed behavior, and verbal operants.',
        'tag' => 'Study Review'
    ],
    [
        'title' => 'Autism Specialists & Designing Interventions in Glendale NY',
        'youtube_id' => '_QkSIUsR8M0',
        'desc' => 'Path 2 Potential clinical leadership on tailoring home-based ABA plans to real family dynamics.',
        'tag' => 'Interventions'
    ],
    [
        'title' => 'Creative Arts & ABA Therapy for Children',
        'youtube_id' => 'dvI0gni_9Jk',
        'desc' => 'Incorporating music, drama, and visual arts into behavior reduction and communication goals.',
        'tag' => 'Therapy Innovation'
    ],
    [
        'title' => 'Building Path 2 Potential: From Vision to Regional Leader',
        'youtube_id' => 'wgReMxUu2Kk',
        'desc' => 'Jason Lantier shares the entrepreneurial journey behind creating a compassionate, BCBA-led organization.',
        'tag' => 'Leadership'
    ]
];

// Testimonials
$testimonials = [
    [
        'quote' => 'Jason Lantier and Path 2 Potential changed our family’s life. The personalized care plan and in-home therapist helped our son find his voice and gain independence we never thought possible.',
        'author' => 'Sarah M.',
        'role' => 'Parent, Queens NY',
        'rating' => 5
    ],
    [
        'quote' => 'Finding affordable, high-quality BCBA supervision seemed impossible until I found Path4ABA. Jason is an exceptional supervisor who teaches you how to think like a true behavior analyst.',
        'author' => 'David K., BCBA Candidate',
        'role' => 'Supervisee, New York',
        'rating' => 5
    ],
    [
        'quote' => 'Angels 4 Autism provided our family with therapy scholarships when our insurance wouldn’t cover enough hours. Jason’s dedication to underprivileged families is genuine and unmatched.',
        'author' => 'Maria R.',
        'role' => 'Angels 4 Autism Family',
        'rating' => 5
    ]
];

/**
 * Helper function to sanitize user input
 */
function sanitize($data)
{
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Handle form submissions safely (Contact and Newsletter)
 */
function process_form_submissions()
{
    $response = ['status' => null, 'message' => ''];

    // Handle Contact Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact_submit') {
        $name = isset($_POST['name']) ? sanitize($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
        $service = isset($_POST['service']) ? sanitize($_POST['service']) : 'General Inquiry';
        $message = isset($_POST['message']) ? sanitize($_POST['message']) : '';

        // Validation
        if (empty($name) || empty($email) || empty($message)) {
            $response = [
                'status' => 'error',
                'message' => 'Please fill in all required fields (Name, Email, and Message).'
            ];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'status' => 'error',
                'message' => 'Please provide a valid email address.'
            ];
        } else {
            // Save lead to local JSON storage for persistence
            $lead = [
                'timestamp' => date('Y-m-d H:i:s'),
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'service' => $service,
                'message' => $message,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
            ];

            $dataFile = __DIR__ . '/../data/messages.json';
            $dir = dirname($dataFile);
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }

            $currentData = [];
            if (file_exists($dataFile)) {
                $raw = @file_get_contents($dataFile);
                $currentData = json_decode($raw, true) ?: [];
            }
            $currentData[] = $lead;
            @file_put_contents($dataFile, json_encode($currentData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            $response = [
                'status' => 'success',
                'message' => 'Thank you, ' . $name . '! Your message has been received. Jason or a senior clinical coordinator will contact you promptly.'
            ];
        }
        $_SESSION['form_response'] = $response;
    }

    // Handle Newsletter Signup
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'newsletter_submit') {
        $newsletter_email = isset($_POST['newsletter_email']) ? sanitize($_POST['newsletter_email']) : '';

        if (!filter_var($newsletter_email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'status' => 'error',
                'message' => 'Please enter a valid email address to subscribe.'
            ];
        } else {
            $subFile = __DIR__ . '/../data/subscribers.json';
            $dir = dirname($subFile);
            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            $subs = [];
            if (file_exists($subFile)) {
                $subs = json_decode(@file_get_contents($subFile), true) ?: [];
            }
            $subs[] = [
                'email' => $newsletter_email,
                'subscribed_at' => date('Y-m-d H:i:s')
            ];
            @file_put_contents($subFile, json_encode($subs, JSON_PRETTY_PRINT));

            $response = [
                'status' => 'success',
                'message' => 'Thank you for subscribing! You will receive our latest updates on autism programs, supervision tips, and community resources.'
            ];
        }
        $_SESSION['form_response'] = $response;
    }
}

process_form_submissions();

