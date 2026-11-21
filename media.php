<?php
/**
 * Jason Lantier - Media & Video Gallery
 */

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Media & Video Gallery | Path 2 Potential';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Media Page Hero -->
<section class="hero-section subpage-hero" style="padding: 3.5rem 0;">
  <div class="container">
    <div style="max-width: 850px; margin: 0 auto; text-align: center;">
      <span class="hero-credentials">Interviews, Podcasts &amp; Clinical Presentations</span>
      <h1 class="subpage-hero-title">Jason Lantier Media Library</h1>
      <p class="hero-lead subpage-hero-lead">
        Explore discussions on autism interventions, careers for neurodiverse adults, nutritional supplements, and exam preparation.
      </p>
      <div class="subpage-hero-buttons">
        <a href="https://www.youtube.com/@Path4ABA/videos" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
          <i class="fab fa-youtube"></i> Visit Path 4 ABA YouTube
        </a>
        <a href="https://www.path2potential.org" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
          <i class="fas fa-globe"></i> Path 2 Potential
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Media Gallery Section -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Featured Broadcasts</span>
      <h2 class="section-title">Videos &amp; Clinical Presentations</h2>
      <p class="section-subtitle">
        Video insights demonstrating how autism specialists improve programs with individualized behavioral strategies.
      </p>
      <div class="divider"></div>
    </div>

    <div class="video-grid">
      <?php foreach ($media_videos as $vid): ?>
        <div class="video-card">
          <div class="video-wrapper">
            <iframe 
              src="https://www.youtube.com/embed/<?php echo $vid['youtube_id']; ?>?rel=0&amp;modestbranding=1" 
              title="<?php echo htmlspecialchars($vid['title']); ?>" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
            </iframe>
          </div>
          <div class="video-body">
            <span class="video-category"><?php echo $vid['tag']; ?></span>
            <h3 class="video-title"><?php echo $vid['title']; ?></h3>
            <p class="video-desc"><?php echo $vid['desc']; ?></p>
            <div class="video-footer">
              <span style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--accent-gold-dark); font-weight: 600;">
                <i class="fas fa-play-circle"></i> Watch Video
              </span>
              <a href="https://www.youtube.com/watch?v=<?php echo $vid['youtube_id']; ?>" target="_blank" rel="noopener noreferrer" style="font-weight: 700; color: var(--primary-navy);">
                YouTube <i class="fas fa-external-link-alt"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Partner Callout Strip -->
<section class="section section-dark" style="padding: 3rem 0;">
  <div class="container" style="text-align: center;">
    <h3 style="font-size: 1.6rem; margin-bottom: 1rem;">Explore Our Ecosystem of Autism Organizations</h3>
    <p style="color: #cbd5e1; max-width: 700px; margin: 0 auto 1.5rem auto;">
      From clinical in-home ABA therapy to low-cost supervision and non-profit scholarships, we are dedicated to supporting every family.
    </p>
    <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
      <a href="https://www.path2potential.org" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
        Path2Potential.org
      </a>
      <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
        Path4ABA.org
      </a>
      <a href="https://angels4autism.org/" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
        Angels4Autism.org
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

