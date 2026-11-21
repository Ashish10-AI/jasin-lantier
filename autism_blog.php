<?php
/**
 * Jason Lantier - Autism Blog & Study Video Guides
 */

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Autism Blog & Video Tutorials | Path 2 Potential';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Blog Page Hero -->
<section class="hero-section subpage-hero" style="padding: 3.5rem 0;">
  <div class="container">
    <div style="max-width: 850px; margin: 0 auto; text-align: center;">
      <span class="hero-credentials">Clinical Research &amp; Exam Prep</span>
      <h1 class="subpage-hero-title">Autism &amp; ABA Educational Blog</h1>
      <p class="hero-lead subpage-hero-lead">
        Path 2 Potential in Glendale NY are autism specialists in autism programs, low-cost BCBA supervision, and BACB Task List mastery.
      </p>
      <div class="subpage-hero-buttons">
        <a href="https://www.youtube.com/@Path4ABA/videos" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
          <i class="fab fa-youtube"></i> Subscribe on YouTube
        </a>
        <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer" class="btn btn-outline">
          <i class="fas fa-book"></i> Path 4 ABA Study Guides
        </a>
      </div>
    </div>
  </div>
</section>

<!-- All Video Tutorials & Blog Posts -->
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="section-tag">Video Library &amp; Lectures</span>
      <h2 class="section-title">Featured ABA Training Lectures</h2>
      <p class="section-subtitle">
        Follow us on YouTube as we have summaries to meditate and study to in each section of the BACB Task List.
      </p>
      <div class="divider"></div>
    </div>

    <div class="blog-slider-shell blog-slider-shell-large">
      <button class="blog-slider-arrow blog-slider-prev" id="blogSliderPrev" type="button" aria-label="Previous blog card">
        <i class="fas fa-chevron-left"></i>
      </button>
      <div class="blog-slider-viewport" id="blogSliderViewport">
        <div class="blog-slider-track" id="blogSliderTrack">
          <?php foreach ($blog_posts as $post): ?>
            <?php $thumbnail_url = !empty($post['image']) ? $post['image'] : ('https://img.youtube.com/vi/' . $post['youtube_id'] . '/maxresdefault.jpg'); ?>
            <article class="blog-slide-card">
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
          <?php endforeach; ?>
        </div>
      </div>
      <button class="blog-slider-arrow blog-slider-next" id="blogSliderNext" type="button" aria-label="Next blog card">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>
</section>

<!-- Blog Introduction Callout -->
<section class="section section-alt" style="padding-bottom: 4rem;">
  <div class="container">
    <div class="advancements-card">
      <h2 class="advancements-title">
        Advancements in Autism Programs &amp; Evidence-Based ABA Interventions
      </h2>
      <p class="advancements-text">
        The prevalence of autism spectrum disorder (ASD) has been the subject of growing interest and concern over the past 20 years. Researchers and autism specialists have dedicated extensive efforts to understanding and quantifying the prevalence of ASD, leading to significant advancements in autism programs, as well as our knowledge of this complex condition.
      </p>
      <p class="advancements-text">
        This also leads to research-based autism interventions. Our clinical team at Path 2 Potential in Glendale, NY, delivers evidence-based Applied Behavior Analysis that respects neurodiversity while building essential life skills, communication, and independence.
      </p>
      <div class="advancements-pills">
        <span class="credential-pill"><i class="fas fa-check"></i> #1 BCBA Study Guide</span>
        <span class="credential-pill"><i class="fas fa-check"></i> 40-Hour RBT Training</span>
        <span class="credential-pill"><i class="fas fa-check"></i> Pass The RBT Guaranteed</span>
        <span class="credential-pill"><i class="fas fa-check"></i> BACB Task List Section Reviews</span>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

