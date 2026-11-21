<?php
/**
 * Global Header Component
 */
if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/config.php';
}

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$queryPage = isset($_GET['page']) ? $_GET['page'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME . ' | ' . SITE_TAGLINE; ?></title>
  <meta name="description" content="Get low-cost BCBA supervision and effective ABA therapy services for individuals with autism and other developmental disorders. Contact Jason Lantier today!">
  <meta name="author" content="Jason Lantier / Path 2 Potential">
  
  <!-- Open Graph / Social Meta -->
  <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle : SITE_NAME; ?>">
  <meta property="og:description" content="Our skilled professionals deliver personalized care with a human touch. Low-cost BCBA supervision and comprehensive ABA therapy.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/images/hero-banner.png">
  <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">

  <!-- Google Fonts: Poppins + Manrope -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/_float-contact.css">
</head>
<body>

  <!-- Top Announcement Bar -->
  <aside class="top-bar" aria-label="Announcement & Contact Bar">
    <div class="container top-bar-inner">
      <div class="top-announcement">
        <i class="fas fa-bullhorn" aria-hidden="true"></i>
        <span>1-833-AUTISM-2 &bull; Autism Specialists &bull; Glendale NY</span>
      </div>
      <div class="top-contacts">
        <a href="tel:<?php echo SITE_PHONE; ?>">
          <i class="fas fa-phone-alt" aria-hidden="true"></i>
          <span><?php echo SITE_PHONE_DISPLAY; ?></span>
        </a>
        <a href="mailto:<?php echo SITE_EMAIL; ?>">
          <i class="fas fa-envelope" aria-hidden="true"></i>
          <span><?php echo SITE_EMAIL; ?></span>
        </a>
        <a href="<?php echo SITE_LINKEDIN; ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Profile">
          <i class="fab fa-linkedin" aria-hidden="true"></i>
        </a>
        <a href="<?php echo SITE_YOUTUBE; ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube Channel">
          <i class="fab fa-youtube" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </aside>

  <!-- Sticky Main Navigation -->
  <header class="site-header">
    <div class="container">
      <nav class="navbar" aria-label="Main Navigation">
        <a href="index.php" class="brand-link">
          <span class="brand-title">Jason Lantier</span>
          <span class="brand-subtitle">Autism &amp; Behavior Specialist</span>
        </a>

        <div class="nav-right-actions">
          <a href="https://calendly.com/jason-lantier" target="_blank" rel="noopener noreferrer" class="nav-cta header-mobile-cta">
            Schedule Supervision
          </a>

          <button class="mobile-toggle" id="mobileToggle" type="button" aria-label="Open navigation menu" aria-expanded="false" aria-controls="navLinks">
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <ul class="nav-links" id="navLinks">
          <li>
            <a href="index.php" class="nav-link <?php echo ($currentPage === 'index' || $currentPage === 'who-is-jason-lantier' || $queryPage === 'home') ? 'active' : ''; ?>">
              Who is Jason Lantier?
            </a>
          </li>
          <li>
            <a href="index.php#experience" class="nav-link">Experience</a>
          </li>
          <li>
            <a href="index.php#services" class="nav-link">Services</a>
          </li>
          <li>
            <a href="autism_blog.php" class="nav-link <?php echo ($currentPage === 'autism_blog' || $queryPage === 'blog') ? 'active' : ''; ?>">
              Autism Blog
            </a>
          </li>
          <li>
            <a href="media.php" class="nav-link <?php echo ($currentPage === 'media' || $queryPage === 'media') ? 'active' : ''; ?>">
              Media
            </a>
          </li>
          <li>
            <a href="message_jason.php" class="nav-link <?php echo ($currentPage === 'message_jason' || $queryPage === 'contact') ? 'active' : ''; ?>">
              Message Jason
            </a>
          </li>
          <li>
            <a href="https://calendly.com/jason-lantier" target="_blank" rel="noopener noreferrer" class="nav-cta">
              Schedule Supervision
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

