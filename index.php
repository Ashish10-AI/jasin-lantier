<?php
/**
 * Jason Lantier - Autism & Behavior Specialist
 * Main Landing Page (Who is Jason Lantier?)
 */

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Who is Jason Lantier? | Autism & Behavior Specialist';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Form Feedback Notification -->
<?php if (isset($_SESSION['form_response'])): ?>
  <div class="container" style="margin-top: 1.5rem;">
    <div class="alert alert-<?php echo $_SESSION['form_response']['status']; ?>">
      <i
        class="fas fa-<?php echo $_SESSION['form_response']['status'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
      <span><?php echo $_SESSION['form_response']['message']; ?></span>
    </div>
  </div>
  <?php unset($_SESSION['form_response']); ?>
<?php endif; ?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container hero-grid">
    <div class="hero-content">

      <!-- Top text block: name, subtitle, typing lead -->
      <div class="hero-intro">
        <h1>Jason Lantier</h1>
        <p class="hero-subtitle">Autism &amp; Behavior Specialist</p>
        <p class="hero-lead">
          <span id="typing-text"></span><span class="typing-cursor">|</span>
        </p>
      </div>

      <!-- Bottom block: highlights + buttons -->
      <div class="hero-actions">
        <ul class="hero-highlights">
          <li>
            <i class="fas fa-check-circle"></i>
            <span>Co-Founder &amp; CEO of <strong>Path 2 Potential, LLC</strong></span>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <span>Founder &amp; President of <strong>Angels 4 Autism</strong> 501(c)(3)</span>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <span>Co-Founder of <strong>Path 4 ABA</strong> (Supervision &amp; Exam Prep)</span>
          </li>
          <li>
            <i class="fas fa-check-circle"></i>
            <span>Serving New York, New Jersey, Arizona, Florida &amp; Remote TeleTherapy</span>
          </li>
        </ul>

        <div class="hero-buttons">
          <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
            <i class="fas fa-calendar-check"></i> Schedule Supervision
          </a>
          <a href="#contact" class="btn btn-outline">
            <i class="fas fa-envelope"></i> Message Jason
          </a>
        </div>
      </div>

    </div>

    <!-- Hero Portrait -->
    <div class="hero-portrait-wrap">
      <div class="hero-portrait-stage">
        <div class="hero-portrait-circle" aria-hidden="true"></div>
        <img src="assets/images/jason-hero-2.png" alt="Jason Lantier — BCBA &amp; Entrepreneur"
          class="hero-portrait active" draggable="false">
      </div>
      <div class="hero-card-badge">
        <i class="fas fa-certificate"></i>
        <div class="hero-card-badge-text">
          <h4>Licensed Behavior Analyst Since 2009</h4>
          <p>Over 20 years in Autism, Healthcare &amp; Non-Profit Leadership</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section: Who is Jason Lantier? -->
<section class="section" id="about">
  <div class="container">
    <div class="about-grid">

      <!-- Left Side: Interactive Dynamic Image Collage -->
      <div class="about-visual-column">
        <div class="about-collage-container">
          <div class="about-collage-grid" aria-label="Jason Lantier Clinical & Autism Impact Collage">

            <div class="collage-item collage-item-1" title="Autism Awareness: Understanding">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion1.png"
                alt="Autism awareness artwork focused on understanding">
              <span class="collage-badge"><i class="fas fa-lightbulb"></i> Understanding</span>
            </div>

            <div class="collage-item collage-item-2" title="Autism Awareness: Support">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion3.png"
                alt="Autism awareness artwork focused on support">
              <span class="collage-badge"><i class="fas fa-hands-helping"></i> Support</span>
            </div>

            <div class="collage-item collage-item-3" title="Autism Awareness: Inclusion">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion4.png"
                alt="Autism awareness artwork focused on inclusion">
              <span class="collage-badge"><i class="fas fa-users"></i> Inclusion</span>
            </div>

            <div class="collage-item collage-item-4" title="Autism Awareness: Acceptance">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion5.png"
                alt="Autism awareness artwork promoting acceptance">
              <span class="collage-badge"><i class="fas fa-heart"></i> Acceptance</span>
            </div>

            <div class="collage-item collage-item-5" title="Autism Awareness: Connection">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion6.png"
                alt="Autism awareness artwork celebrating connection">
              <span class="collage-badge"><i class="fas fa-link"></i> Connection</span>
            </div>

            <div class="collage-item collage-item-6" title="Autism Awareness: Understanding and Support">
              <img src="assets/images/Autism Awareness_ Understanding, Support, Inclusion2.png"
                alt="Autism awareness artwork about understanding and support">
              <span class="collage-badge"><i class="fas fa-comments"></i> Awareness</span>
            </div>

          </div>

        </div>
        <div class="resume-cta-card">
          <div class="resume-card-left">
            <div class="resume-icon-circle">
              <i class="fas fa-file-signature"></i>
            </div>
            <div class="resume-info">
              <h4>Curriculum Vitae &amp; Credentials</h4>
              <p>Download Jason’s verified credentials, executive history, and publication record.</p>
            </div>
          </div>
          <div class="resume-card-actions">
            <a href="<?php echo RESUME_PATH; ?>" download class="btn btn-primary btn-resume">
              <i class="fas fa-file-pdf"></i> Download CV (pdf)
            </a>
            <a href="<?php echo SITE_LINKEDIN; ?>" target="_blank" rel="noopener noreferrer"
              class="btn btn-outline-navy btn-resume">
              <i class="fab fa-linkedin"></i> LinkedIn
            </a>
            <div class="experience-tag-inline">
              <div class="experience-number">20+</div>
              <div class="experience-label">Years of Clinical Impact</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Side: Concise Bio & Credentials -->
      <div class="about-text">
        <h2 class="section-title">Autism Specialist &amp; Licensed Behavior Analyst</h2>
        <div class="divider" style="margin: 0 0 1.5rem 0;"></div>

        <p class="about-lead">
          <strong>Jason Lantier, MA, MBA, BCBA, LBA</strong> is a licensed behavior analyst (since 2009), healthcare
          executive, and entrepreneur with over 20 years of clinical experience specializing in Autism Spectrum Disorder
          (ASD) and cognitive diagnoses across schools, residential centers, and in-home programs.
        </p>

        <p>
          As the Co-Founder &amp; CEO of <strong>Path 2 Potential</strong>, founder of <strong>Path 4 ABA</strong>, and
          President of <strong>Angels 4 Autism 501(c)(3)</strong>, Jason bridges rigorous behavioral science with
          compassionate, accessible care—empowering neurodiverse individuals toward independence while providing
          affordable, low-cost BCBA supervision nationwide.
        </p>

        <!-- Credentials Pills -->
        <div class="about-credentials-pill">
          <span class="credential-pill"><i class="fas fa-check"></i> BCBA Certified</span>
          <span class="credential-pill"><i class="fas fa-check"></i> NY State LBA Licensed</span>
          <span class="credential-pill"><i class="fas fa-check"></i> MBA Healthcare Management</span>
          <span class="credential-pill"><i class="fas fa-check"></i> MA Psychology / ABA</span>
          <span class="credential-pill"><i class="fas fa-check"></i> Stony Brook University Alum</span>
        </div>


      </div>
    </div>
  </div>
</section>

<!-- Organizations & Ventures Section -->
<section class="section section-alt" id="experience">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Jason's Experience &amp; Organizations</h2>
      <p class="section-subtitle">
        Pioneering clinical ABA therapy, low-cost clinical supervision, and philanthropic advocacy across the country.
      </p>
      <div class="divider"></div>
    </div>

    <!-- 3D Horizontal Slider Container -->
    <div class="org-slider-wrapper">

      <!-- Navigation Arrows -->
      <button class="slider-arrow slider-arrow-prev" id="orgSliderPrev" aria-label="Previous Organization"
        type="button">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="slider-arrow slider-arrow-next" id="orgSliderNext" aria-label="Next Organization" type="button">
        <i class="fas fa-chevron-right"></i>
      </button>

      <!-- 3D Scroll Viewport -->
      <div class="org-slider-viewport" id="orgSliderViewport">
        <div class="org-slider-track" id="orgSliderTrack">

          <!-- Card 1: Path 2 Potential -->
          <article class="org-slider-card active" data-index="0">
            <div class="org-card-inner">
              <div class="org-card-left">
                <div class="org-img-backdrop has-cover">
                  <img src="assets/images/card-path2potential.jpg" alt="Path 2 Potential In-Home ABA Therapy"
                    class="org-card-img-horizontal cover-photo">
                  <div class="org-img-overlay">
                    <span class="org-img-tag"><i class="fas fa-shield-alt"></i> Established 2017</span>
                  </div>
                </div>
              </div>
              <div class="org-card-right">
                <span class="org-badge">ABA Therapy Provider</span>
                <h3 class="org-title">Path 2 Potential, LLC</h3>
                <div class="org-role"><i class="fas fa-user-tie"></i> Co-Founder &amp; Chief Executive Officer</div>
                <p class="org-desc">
                  Path 2 Potential provides comprehensive in-home autism and ABA Therapy programs in New York, New
                  Jersey, Arizona, and Florida, as well as Remote TeleTherapy. Our customized clinical programs build
                  functional life skills, communicative proficiency, and social independence.
                </p>
                <div class="org-features-pills">
                  <span><i class="fas fa-check"></i> In-Home Programs</span>
                  <span><i class="fas fa-check"></i> 4 States &amp; Telehealth</span>
                  <span><i class="fas fa-check"></i> BCBA Supervision</span>
                </div>
                <div class="org-card-action">
                  <a href="https://www.path2potential.org" target="_blank" rel="noopener noreferrer"
                    class="btn btn-primary org-action-btn">
                    Visit Path2Potential.org <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Card 2: Path 4 ABA -->
          <article class="org-slider-card" data-index="1">
            <div class="org-card-inner">
              <div class="org-card-left">
                <div class="org-img-backdrop has-cover">
                  <img src="assets/images/card-path4aba.jpg" alt="Path 4 ABA Supervision &amp; Mentorship"
                    class="org-card-img-horizontal cover-photo">
                  <div class="org-img-overlay">
                    <span class="org-img-tag"><i class="fas fa-graduation-cap"></i> Global BCBA Mentorship</span>
                  </div>
                </div>
              </div>
              <div class="org-card-right">
                <span class="org-badge" style="background: #fef3c7; color: #92400e;">Education &amp; Supervision</span>
                <h3 class="org-title">Path 4 ABA, PLLC</h3>
                <div class="org-role"><i class="fas fa-chalkboard-teacher"></i> Co-Founder &amp; Clinical Supervisor
                </div>
                <p class="org-desc">
                  Providing premier, low-cost BCBA Supervision, 40-Hour RBT Training, and BACB Task List study
                  resources. Guided by Jason Lantier and Dr. Michael Comiskey to mentor the next generation of behavior
                  analysts with empirical rigor and accessible pricing worldwide.
                </p>
                <div class="org-features-pills">
                  <span><i class="fas fa-check"></i> Affordable BCBA Hours</span>
                  <span><i class="fas fa-check"></i> 40-Hr RBT Training</span>
                  <span><i class="fas fa-check"></i> Task List Prep</span>
                </div>
                <div class="org-card-action">
                  <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer"
                    class="btn btn-primary org-action-btn">
                    Visit Path4ABA.org <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Card 3: Angels 4 Autism -->
          <article class="org-slider-card" data-index="2">
            <div class="org-card-inner">
              <div class="org-card-left">
                <div class="org-img-backdrop has-cover">
                  <img src="assets/images/card-angels4autism.jpg" alt="Angels 4 Autism Non-Profit Advocacy"
                    class="org-card-img-horizontal cover-photo">
                  <div class="org-img-overlay">
                    <span class="org-img-tag"><i class="fas fa-hand-holding-heart"></i> 501(c)(3) Non-Profit</span>
                  </div>
                </div>
              </div>
              <div class="org-card-right">
                <span class="org-badge" style="background: #fee2e2; color: #991b1b;">501(c)(3) Philanthropy</span>
                <h3 class="org-title">Angels 4 Autism, Inc.</h3>
                <div class="org-role"><i class="fas fa-heart"></i> Founder &amp; President</div>
                <p class="org-desc">
                  Navigating the path to success for underprivileged families facing autism, ensuring resources,
                  acceptance, and a voice for every child. We offer scholarships for ABA therapy and supervision. No
                  child left behind!
                </p>
                <div class="org-features-pills">
                  <span><i class="fas fa-check"></i> Therapy Grants</span>
                  <span><i class="fas fa-check"></i> Family Advocacy</span>
                  <span><i class="fas fa-check"></i> Community Outreach</span>
                </div>
                <div class="org-card-action">
                  <a href="https://angels4autism.org/" target="_blank" rel="noopener noreferrer"
                    class="btn btn-primary org-action-btn">
                    Visit Angels4Autism.org <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Card 4: BCBA Bootcamp -->
          <article class="org-slider-card" data-index="3">
            <div class="org-card-inner">
              <div class="org-card-left">
                <div class="org-img-backdrop has-cover">
                  <img src="assets/images/card-luvmichael.jpg" alt="BCBA Bootcamp Exam Preparation"
                    class="org-card-img-horizontal cover-photo">
                  <div class="org-img-overlay">
                    <span class="org-img-tag"><i class="fas fa-graduation-cap"></i> Live Exam Prep</span>
                  </div>
                </div>
              </div>
              <div class="org-card-right">
                <span class="org-badge" style="background: #ede9fe; color: #5b21b6;">Exam Preparation</span>
                <h3 class="org-title">BCBA Bootcamp</h3>
                <div class="org-role"><i class="fas fa-chalkboard-teacher"></i> Primary Instructor &amp; Clinical Lead
                </div>
                <p class="org-desc">
                  An intensive live training and exam preparation program led by Jason Lantier, MA, MBA, BCBA, LBA.
                  Designed to build application fluency, task list mastery, and critical decision-making strategies so
                  aspiring behavior analysts pass the BCBA examination with confidence.
                </p>
                <div class="org-features-pills">
                  <span><i class="fas fa-check"></i> Intensive Live Prep</span>
                  <span><i class="fas fa-check"></i> Task List Fluency</span>
                  <span><i class="fas fa-check"></i> Mock Question Dissection</span>
                </div>
                <div class="org-card-action">
                  <a href="https://bcbabootcamp.com/" target="_blank" rel="noopener noreferrer"
                    class="btn btn-primary org-action-btn">
                    Visit BCBABootcamp.com <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </article>

        </div>
      </div>

      <!-- Slider Indicators -->
      <div class="slider-controls-bottom">
        <div class="slider-dots" id="orgSliderDots">
          <button class="slider-dot active" data-index="0" aria-label="Go to slide 1" type="button"></button>
          <button class="slider-dot" data-index="1" aria-label="Go to slide 2" type="button"></button>
          <button class="slider-dot" data-index="2" aria-label="Go to slide 3" type="button"></button>
          <button class="slider-dot" data-index="3" aria-label="Go to slide 4" type="button"></button>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- Visit Now / Partners Section -->
<section class="section visit-now-section" id="visit-now">
  <div class="container">
    <div class="section-header" style="text-align: center;">
      <span class="visit-now-tag">OUR PARTNERS</span>
      <h2 class="visit-now-title">Visit Now</h2>
      <p class="section-subtitle">
        Explore our affiliated organizations, clinical practices, and non-profit initiatives.
      </p>
      <div class="divider"></div>
    </div>

    <div class="partners-card-grid">
      <a href="https://www.path2potential.org" target="_blank" rel="noopener noreferrer" class="partner-card" title="Path 2 Potential">
        <img src="assets/images/1.png" alt="Path 2 Potential" class="partner-card-img">
      </a>
      <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer" class="partner-card" title="Path 4 ABA">
        <img src="assets/images/2.png" alt="Path 4 ABA" class="partner-card-img">
      </a>
      <a href="https://bcbabootcamp.com/" target="_blank" rel="noopener noreferrer" class="partner-card" title="BCBA Bootcamp">
        <img src="assets/images/3.png" alt="BCBA Bootcamp" class="partner-card-img">
      </a>
      <a href="https://angels4autism.org/" target="_blank" rel="noopener noreferrer" class="partner-card" title="Angels 4 Autism">
        <img src="assets/images/4.png" alt="Angels 4 Autism" class="partner-card-img">
      </a>
    </div>
  </div>
</section>

<!-- Services / Core Pillars Section -->
<section class="section" id="services">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Our Practice Areas &amp; Services</h2>
      <p class="section-subtitle">
        Empirical behavior analysis, compassionate care coordination, and affordable supervision tailored to every
        client.
      </p>
      <div class="divider"></div>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $srv): ?>
        <div
          class="service-card <?php echo htmlspecialchars($srv['layout'], ENT_QUOTES, 'UTF-8'); ?> has-background-image service-card-image-card service-card-blue-image"
          style="background-image: url('<?php echo htmlspecialchars($srv['image'], ENT_QUOTES, 'UTF-8'); ?>');">
          <div class="service-icon">
            <i class="<?php echo $srv['icon']; ?>"></i>
          </div>
          <h3><?php echo $srv['title']; ?></h3>
          <p><?php echo $srv['desc']; ?></p>
          <a href="<?php echo $srv['link']; ?>" class="service-link" <?php echo strpos($srv['link'], 'http') === 0 ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
            <?php echo $srv['link_text']; ?> <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Blog Preview & Educational Tutorials -->
<section class="section section-alt" id="blog-preview">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Autism &amp; Behavior Analysis Blog</h2>
      <p class="section-subtitle">
        Free video summaries, task list breakdowns, and clinical insights from Jason Lantier and Path 4 ABA.
      </p>
      <div class="divider"></div>
    </div>

    <div class="blog-slider-shell blog-slider-shell-large">
      <button class="blog-slider-arrow blog-slider-prev" id="blogSliderPrev" type="button"
        aria-label="Previous blog card">
        <i class="fas fa-chevron-left"></i>
      </button>
      <div class="blog-slider-viewport" id="blogSliderViewport">
        <div class="blog-slider-track" id="blogSliderTrack">
          <?php $postIndex = 0; ?>
          <?php foreach ($blog_posts as $post): ?>
            <?php $thumbnail_url = !empty($post['image']) ? $post['image'] : ('https://img.youtube.com/vi/' . $post['youtube_id'] . '/maxresdefault.jpg'); ?>
            <article
              class="blog-slide-card <?php echo ($postIndex === 0 || $postIndex === 1) ? 'active is-active' : ''; ?>">
              <div class="blog-slide-image-wrap">
                <a href="https://www.youtube.com/watch?v=<?php echo $post['youtube_id']; ?>" target="_blank"
                  rel="noopener noreferrer" class="blog-slide-image-link" aria-label="<?php echo htmlspecialchars($post['title']); ?>">
                  <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>"
                    class="blog-slide-image">
                </a>
                <span class="blog-slide-category"><?php echo $post['category']; ?></span>
              </div>
              <div class="blog-slide-body">
                <h3>
                  <a href="https://www.youtube.com/watch?v=<?php echo $post['youtube_id']; ?>" target="_blank"
                    rel="noopener noreferrer" class="blog-slide-title-link">
                    <?php echo $post['title']; ?>
                  </a>
                </h3>
                <p><?php echo $post['summary']; ?></p>
                <div class="blog-slide-meta">
                  <span><i class="far fa-calendar-alt"></i> <?php echo $post['date']; ?></span>
                  <span><i class="far fa-clock"></i> <?php echo $post['duration']; ?></span>
                </div>
                <a href="https://www.youtube.com/watch?v=<?php echo $post['youtube_id']; ?>" target="_blank"
                  rel="noopener noreferrer" class="btn btn-primary blog-slide-btn">
                  Read Summary <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </article>
            <?php $postIndex++; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <button class="blog-slider-arrow blog-slider-next" id="blogSliderNext" type="button" aria-label="Next blog card">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div style="text-align: center; margin-top: 3rem;">
      <a href="autism_blog.php" class="btn btn-primary">
        <i class="fas fa-video"></i> Explore All Videos &amp; Study Guides
      </a>
    </div>
  </div>
</section>


<!-- Testimonials Section -->
<section class="section section-dark" id="testimonials">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">What Families &amp; Supervisees Say</h2>
      <p class="section-subtitle">
        We strive to provide the best possible care and support, and their feedback is a testament to our commitment.
      </p>
      <div class="divider"></div>
    </div>

    <div class="testimonials-grid">
      <?php foreach ($testimonials as $t): ?>
        <div class="testimonial-card">
          <div class="testimonial-stars">
            <?php for ($i = 0; $i < $t['rating']; $i++): ?>
              <i class="fas fa-star"></i>
            <?php endfor; ?>
          </div>
          <p class="testimonial-quote">"<?php echo $t['quote']; ?>"</p>
          <div class="testimonial-author"><?php echo $t['author']; ?></div>
          <div class="testimonial-role"><?php echo $t['role']; ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Contact Section (Message Jason) -->
<section class="section" id="contact">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Get In Touch</span>
      <h2 class="section-title">Message Jason &amp; Path 2 Potential</h2>
      <p class="section-subtitle">
        Contact us today for low-cost BCBA supervision, in-home ABA therapy programs, or Angels 4 Autism inquiries.
      </p>
      <div class="divider"></div>
    </div>

    <div class="contact-grid">

      <!-- Contact Information Card -->
      <div class="contact-info-card">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.4rem;">Office Location &amp; Hours</h3>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="contact-text">
            <h4>Glendale Clinical Office</h4>
            <p><?php echo SITE_LOCATION; ?></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-phone-alt"></i>
          </div>
          <div class="contact-text">
            <h4>Toll-Free Phone</h4>
            <p><a href="tel:<?php echo SITE_PHONE; ?>"><?php echo SITE_PHONE_DISPLAY; ?> (<?php echo SITE_PHONE; ?>)</a>
            </p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="contact-text">
            <h4>Email Inquiries</h4>
            <p><a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-clock"></i>
          </div>
          <div class="contact-text" style="width: 100%;">
            <h4>Operating Hours</h4>
            <table class="hours-table">
              <tr>
                <td>Monday – Friday</td>
                <td>09:00 am – 05:00 pm</td>
              </tr>
              <tr>
                <td>Saturday</td>
                <td>By Appointment</td>
              </tr>
              <tr>
                <td>Sunday</td>
                <td>Emergency Support</td>
              </tr>
              <tr>
                <td>Caregiver Line</td>
                <td><strong>24/7 Availability</strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h3 style="margin-bottom: 0.5rem; font-size: 1.4rem;">Drop Us a Line</h3>
        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.5rem;">
          Fill out the form below and Jason or our clinical team will get back to you promptly.
        </p>

        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>#contact" method="POST" id="contactForm">
          <input type="hidden" name="action" value="contact_submit">

          <div class="form-group">
            <label for="formName" class="form-label">Your Full Name *</label>
            <input type="text" name="name" id="formName" class="form-control" placeholder="John Doe" required>
          </div>

          <div class="form-group">
            <label for="formEmail" class="form-label">Email Address *</label>
            <input type="email" name="email" id="formEmail" class="form-control" placeholder="john@example.com"
              required>
          </div>

          <div class="form-group">
            <label for="formPhone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" id="formPhone" class="form-control" placeholder="(555) 000-0000">
          </div>

          <div class="form-group">
            <label for="formService" class="form-label">Program of Interest</label>
            <select name="service" id="formService" class="form-control">
              <option value="ABA Therapy Services">Path 2 Potential: In-Home ABA Therapy</option>
              <option value="Low Cost BCBA Supervision">Path 4 ABA: Low-Cost BCBA Supervision</option>
              <option value="40-Hour RBT Training & Exam Prep">40-Hour RBT Training &amp; Exam Prep</option>
              <option value="Angels 4 Autism Scholarship / Donation">Angels 4 Autism Scholarship / Donation</option>
              <option value="General Consultation">General Consultation with Jason Lantier</option>
            </select>
          </div>

          <div class="form-group">
            <label for="formMessage" class="form-label">How Can We Help You? *</label>
            <textarea name="message" id="formMessage" class="form-control"
              placeholder="Please describe your needs, questions, or goals..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 100%;">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>

    </div>

    <!-- Google Map Container -->
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.946927891391!2d-73.87413692398468!3d40.69719363717208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25e839e943261%3A0xe546b4122b51608!2s71-19%2080th%20St%20%238213%2C%20Glendale%2C%20NY%2011385!5e0!3m2!1sen!2sus!4v1714000000000!5m2!1sen!2sus"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade" title="Jason Lantier &amp; Path 2 Potential Glendale Office">
      </iframe>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>