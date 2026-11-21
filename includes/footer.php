<?php
/**
 * Global Footer Component
 */
if (!defined('SITE_NAME')) {
  require_once __DIR__ . '/config.php';
}
?>
<!-- Footer -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <!-- Column 1: Bio & Vision -->
      <div class="footer-col footer-about">
        <h3>Jason Lantier</h3>
        <p>
          Licensed Behavior Analyst (BCBA, LBA) and CEO of Path 2 Potential. Dedicated to empowering individuals on the
          autism spectrum through evidence-based ABA therapy, low-cost BCBA supervision, and compassionate care.
        </p>
        <div class="top-contacts" style="margin-top: 1rem;">
          <a href="<?php echo SITE_LINKEDIN; ?>" target="_blank" rel="noopener noreferrer" style="font-size: 1.25rem;"
            aria-label="LinkedIn">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="<?php echo SITE_YOUTUBE; ?>" target="_blank" rel="noopener noreferrer" style="font-size: 1.25rem;"
            aria-label="YouTube">
            <i class="fab fa-youtube"></i>
          </a>
          <a href="tel:<?php echo SITE_PHONE; ?>" style="font-size: 1.25rem;" aria-label="Call Now">
            <i class="fas fa-phone-alt"></i>
          </a>
          <a href="mailto:<?php echo SITE_EMAIL; ?>" style="font-size: 1.25rem;" aria-label="Email Us">
            <i class="fas fa-envelope"></i>
          </a>
        </div>
      </div>

      <!-- Column 2: Affiliations & Ventures -->
      <div class="footer-col footer-ventures">
        <h3>Ventures</h3>
        <ul class="footer-links">
          <li>
            <a href="https://www.path2potential.org" target="_blank" rel="noopener noreferrer">
              <i class="fas fa-angle-right"></i> Path 2 Potential (P2P)
            </a>
          </li>
          <li>
            <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer">
              <i class="fas fa-angle-right"></i> Path 4 ABA Supervision
            </a>
          </li>
          <li>
            <a href="https://angels4autism.org/" target="_blank" rel="noopener noreferrer">
              <i class="fas fa-angle-right"></i> Angels 4 Autism 501(c)(3)
            </a>
          </li>
          <li>
            <a href="https://bcbabootcamp.com/" target="_blank" rel="noopener noreferrer">
              <i class="fas fa-angle-right"></i> BCBA Bootcamp
            </a>
          </li>
          <li>
            <a href="<?php echo RESUME_PATH; ?>" download>
              <i class="fas fa-file-pdf"></i> Download Resume (pdf)
            </a>
          </li>
        </ul>
      </div>

      <!-- Column 3: Quick Navigation -->
      <div class="footer-col footer-nav">
        <h3>Navigation</h3>
        <ul class="footer-links">
          <li>
            <a href="index.php"><i class="fas fa-angle-right"></i> Who is Jason Lantier?</a>
          </li>
          <li>
            <a href="index.php#experience"><i class="fas fa-angle-right"></i> Experience</a>
          </li>
          <li>
            <a href="autism_blog.php"><i class="fas fa-angle-right"></i> Autism Blog</a>
          </li>
          <li>
            <a href="media.php"><i class="fas fa-angle-right"></i> Media &amp; Videos</a>
          </li>
          <li>
            <a href="message_jason.php"><i class="fas fa-angle-right"></i> Message Jason</a>
          </li>
        </ul>
      </div>

      <!-- Column 4: Newsletter & Contact -->
      <div class="footer-col footer-connect">
        <h3>Stay Connected</h3>
        <p style="font-size: 0.9rem; color: #cbd5e1; margin-bottom: 0.75rem;">
          Sign up to hear about autism life skills programs, naturalistic intervention, and supervision workshops.
        </p>

        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST" class="newsletter-form">
          <input type="hidden" name="action" value="newsletter_submit">
          <input type="email" name="newsletter_email" class="newsletter-input" placeholder="Enter your email" required>
          <button type="submit" class="newsletter-btn" aria-label="Subscribe">
            <i class="fas fa-paper-plane"></i>
          </button>
        </form>

        <div style="margin-top: 1.5rem; font-size: 0.88rem; color: #94a3b8;">
          <p><i class="fas fa-map-marker-alt" style="color: var(--accent-gold); margin-right: 6px;"></i> Glendale,
            Queens, NY 11385</p>
          <p><i class="fas fa-phone" style="color: var(--accent-gold); margin-right: 6px;"></i>
            <?php echo SITE_PHONE_DISPLAY; ?></p>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <div>
        Copyright &copy; <?php echo date('Y'); ?> <strong>Path 2 Potential / <span id="adminSecretTrigger" style="cursor: pointer; user-select: none; display: inline-block; padding: 4px 6px; -webkit-tap-highlight-color: transparent;" title="Jason Lantier">Jason Lantier</span></strong> &bull; All Rights
        Reserved. &nbsp;|&nbsp; designed by <a href="mailto:hypenbloom@gmail.com" style="color:#ffffff;font-weight:700;text-decoration:none;">Hypenbloom</a>
      </div>
      <div>
        This site is protected by Google reCAPTCHA and terms apply.
      </div>
    </div>
  </div>
</footer>

<!-- Secret 3-Tap/Click Admin Access Handler (Desktop & Mobile Touch Supported) -->
<script>
(function() {
  var trigger = document.getElementById('adminSecretTrigger');
  if (!trigger) return;
  var tapCount = 0;
  var timer = null;

  function registerTap(e) {
    tapCount++;
    if (timer) clearTimeout(timer);
    if (tapCount >= 3) {
      tapCount = 0;
      if (navigator.vibrate) {
        try { navigator.vibrate(50); } catch(err) {}
      }
      window.location.href = 'admin.php';
    } else {
      timer = setTimeout(function() {
        tapCount = 0;
      }, 1600); // 1.6 second window for 3 mobile taps
    }
  }

  // Handle both touch and pointer/mouse clicks without double-firing
  var touched = false;
  trigger.addEventListener('touchend', function(e) {
    touched = true;
    e.preventDefault();
    registerTap(e);
    setTimeout(function() { touched = false; }, 300);
  }, { passive: false });

  trigger.addEventListener('click', function(e) {
    if (touched) return;
    registerTap(e);
  });
})();
</script>

<!-- Floating Contact Button -->
<div class="float-contact" id="floatContact">
  <!-- Toggle button -->
  <button class="float-contact__toggle" id="floatToggle" aria-label="Contact us" aria-expanded="false">
    <i class="fas fa-comment-dots float-contact__icon-open"></i>
    <i class="fas fa-times float-contact__icon-close"></i>
  </button>

  <!-- Action items (revealed on toggle) -->
  <div class="float-contact__menu" id="floatMenu">
    <a href="tel:18332884762" class="float-contact__item" aria-label="Call 1-833-AUTISM-2">
      <span class="float-contact__label">1-833-AUTISM-2</span>
      <span class="float-contact__btn"><i class="fas fa-phone"></i></span>
    </a>
    <a href="mailto:jlantier@path2potential.org" class="float-contact__item" aria-label="Email Jason">
      <span class="float-contact__label">jlantier@path2potential.org</span>
      <span class="float-contact__btn"><i class="fas fa-envelope"></i></span>
    </a>
  </div>
</div>

<!-- Typing Animation -->
<script>
(function () {
  var el = document.getElementById('typing-text');
  if (!el) return;
  var text = 'Our skilled professionals deliver personalized care with a human touch. Empowering individuals and families with empirical ABA therapy and premier low-cost BCBA supervision.';
  var i = 0;
  var speed = 28; // ms per character

  function type() {
    if (i < text.length) {
      el.textContent += text.charAt(i);
      i++;
      setTimeout(type, speed);
    } else {
      // Hide cursor after typing completes (optional: keep it blinking)
      var cursor = document.querySelector('.typing-cursor');
      if (cursor) {
        setTimeout(function () {
          cursor.style.opacity = '0';
          cursor.style.transition = 'opacity 0.5s';
        }, 1500);
      }
    }
  }

  // Start after a short delay so the page feels snappy
  setTimeout(type, 400);
})();
</script>

<!-- Scripts -->
<script src="assets/js/main.js"></script>
<script>
// Floating contact toggle
(function () {
  var widget = document.getElementById('floatContact');
  var btn    = document.getElementById('floatToggle');
  if (!widget || !btn) return;
  btn.addEventListener('click', function () {
    var open = widget.classList.toggle('is-open');
    btn.setAttribute('aria-expanded', open);
  });
  // Close when clicking outside
  document.addEventListener('click', function (e) {
    if (!widget.contains(e.target)) {
      widget.classList.remove('is-open');
      btn.setAttribute('aria-expanded', 'false');
    }
  });
})();
</script>
</body>

</html>