<?php
/**
 * Jason Lantier - Message Jason (Contact Page)
 */

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Message Jason | Path 2 Potential';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Form Feedback Notification -->
<?php if (isset($_SESSION['form_response'])): ?>
  <div class="container" style="margin-top: 1.5rem;">
    <div class="alert alert-<?php echo $_SESSION['form_response']['status']; ?>">
      <i class="fas fa-<?php echo $_SESSION['form_response']['status'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
      <span><?php echo $_SESSION['form_response']['message']; ?></span>
    </div>
  </div>
  <?php unset($_SESSION['form_response']); ?>
<?php endif; ?>

<!-- Contact Page Hero -->
<section class="hero-section" style="padding: 3rem 0;">
  <div class="container">
    <div style="max-width: 800px; margin: 0 auto; text-align: center;">
      <span class="hero-credentials">Contact &amp; Supervision Inquiries</span>
      <h1 style="font-size: 2.4rem;">Message Jason Lantier</h1>
      <p class="hero-lead">
        Autism life skills programs, naturalistic intervention, and low-cost BCBA supervision in Glendale, NY and nationwide.
      </p>
    </div>
  </div>
</section>

<!-- Contact Form & Details Section -->
<section class="section">
  <div class="container">
    <div class="contact-grid">
      
      <!-- Contact Information Card -->
      <div class="contact-info-card">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.4rem;">Office Information</h3>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="contact-text">
            <h4>Path 2 Potential Clinical Headquarters</h4>
            <p><?php echo SITE_LOCATION; ?></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-phone-alt"></i>
          </div>
          <div class="contact-text">
            <h4>Phone</h4>
            <p><a href="tel:<?php echo SITE_PHONE; ?>">(P) <?php echo SITE_PHONE_DISPLAY; ?> (<?php echo SITE_PHONE; ?>)</a></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="contact-text">
            <h4>Email</h4>
            <p><a href="mailto:<?php echo SITE_EMAIL; ?>">(E) <?php echo SITE_EMAIL; ?></a></p>
          </div>
        </div>

        <div class="contact-info-item">
          <div class="contact-icon">
            <i class="fas fa-clock"></i>
          </div>
          <div class="contact-text" style="width: 100%;">
            <h4>Clinical Hours</h4>
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
                <td>Caregiver Emergency Line</td>
                <td><strong>24/7 Availability</strong></td>
              </tr>
            </table>
          </div>
        </div>

        <div style="margin-top: 2rem; padding: 1.25rem; background: var(--bg-alt); border-radius: 8px;">
          <h4 style="font-size: 1rem; color: var(--primary-navy); margin-bottom: 0.5rem;">
            <i class="fas fa-info-circle" style="color: var(--accent-gold);"></i> Looking for Immediate Supervision?
          </h4>
          <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.75rem;">
            You can also register directly at Path4ABA to begin your remote BCBA supervision or access RBT exam prep courses immediately.
          </p>
          <a href="https://path4aba.org/" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem; width: 100%;">
            Visit Path4ABA.org
          </a>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h3 style="margin-bottom: 0.5rem; font-size: 1.4rem;">Send a Message</h3>
        <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.5rem;">
          Our clinical coordinators and BCBA supervisors review inquiries within 24 business hours.
        </p>

        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST" id="contactForm">
          <input type="hidden" name="action" value="contact_submit">

          <div class="form-group">
            <label for="formName" class="form-label">Name *</label>
            <input type="text" name="name" id="formName" class="form-control" placeholder="Your Name" required>
          </div>

          <div class="form-group">
            <label for="formEmail" class="form-label">Email *</label>
            <input type="email" name="email" id="formEmail" class="form-control" placeholder="yourname@domain.com" required>
          </div>

          <div class="form-group">
            <label for="formPhone" class="form-label">Phone</label>
            <input type="tel" name="phone" id="formPhone" class="form-control" placeholder="(555) 000-0000">
          </div>

          <div class="form-group">
            <label for="formService" class="form-label">Area of Interest</label>
            <select name="service" id="formService" class="form-control">
              <option value="ABA Therapy - New York">In-Home ABA Therapy (New York)</option>
              <option value="ABA Therapy - New Jersey">In-Home ABA Therapy (New Jersey)</option>
              <option value="ABA Therapy - Arizona">In-Home ABA Therapy (Arizona)</option>
              <option value="ABA Therapy - Florida">In-Home ABA Therapy (Florida)</option>
              <option value="Low Cost BCBA Supervision">Low Cost BCBA Supervision (Path4ABA)</option>
              <option value="40-Hour RBT Training">40-Hour RBT Training &amp; Exam Prep</option>
              <option value="Angels 4 Autism Non-Profit">Angels 4 Autism Philanthropy / Support</option>
              <option value="Other Consultation">Other Inquiries</option>
            </select>
          </div>

          <div class="form-group">
            <label for="formMessage" class="form-label">Message *</label>
            <textarea name="message" id="formMessage" class="form-control" placeholder="Write your message here..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary" style="width: 100%;">
            <i class="fas fa-paper-plane"></i> Send
          </button>

          <p style="font-size: 0.8rem; color: #94a3b8; text-align: center; margin-top: 1rem;">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
          </p>
        </form>
      </div>

    </div>

    <!-- Google Map -->
    <div class="map-container">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.946927891391!2d-73.87413692398468!3d40.69719363717208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25e839e943261%3A0xe546b4122b51608!2s71-19%2080th%20St%20%238213%2C%20Glendale%2C%20NY%2011385!5e0!3m2!1sen!2sus!4v1714000000000!5m2!1sen!2sus" 
        width="600" 
        height="450" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="Path 2 Potential Office Location">
      </iframe>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

