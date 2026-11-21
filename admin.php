<?php
/**
 * Jason Lantier - Admin Blog Management Dashboard
 */

require_once __DIR__ . '/includes/config.php';

$adminConfigFile = __DIR__ . '/data/admin_config.json';
$blogsDataFile = __DIR__ . '/data/blogs.json';

// Ensure data directory exists
if (!is_dir(__DIR__ . '/data')) {
    @mkdir(__DIR__ . '/data', 0777, true);
}

// Helper to get admin config
function get_admin_config($path) {
    if (file_exists($path)) {
        $data = json_decode(@file_get_contents($path), true);
        if (is_array($data) && !empty($data['password_hash'])) {
            return $data;
        }
    }
    // Default password 'admin123' if not yet initialized
    $default = ['password_hash' => password_hash('admin123', PASSWORD_DEFAULT)];
    @file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT));
    return $default;
}

$adminConfig = get_admin_config($adminConfigFile);

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    header('Location: index.php');
    exit;
}

$notice = '';
$noticeType = 'success';

// Handle Login with rate limiting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'admin_login') {
    // Rate limit check
    $failedAttempts = $_SESSION['admin_login_fails'] ?? 0;
    $lockUntil = $_SESSION['admin_lock_until'] ?? 0;
    $currentTime = time();

    if ($lockUntil > $currentTime) {
        $remaining = $lockUntil - $currentTime;
        $notice = "Too many failed attempts. Please wait {$remaining} seconds before trying again.";
        $noticeType = 'error';
    } else {
        $enteredPassword = $_POST['admin_password'] ?? '';
        if (password_verify($enteredPassword, $adminConfig['password_hash'])) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION['admin_logged_in'] = true;
            unset($_SESSION['admin_login_fails'], $_SESSION['admin_lock_until']);
            header('Location: admin.php');
            exit;
        } else {
            $failedAttempts++;
            $_SESSION['admin_login_fails'] = $failedAttempts;
            if ($failedAttempts >= 5) {
                $_SESSION['admin_lock_until'] = $currentTime + 60; // 60s cooldown after 5 fails
                $notice = 'Too many failed login attempts. Temporarily locked for 60 seconds.';
            } else {
                $remaining = 5 - $failedAttempts;
                $notice = "Invalid password. {$remaining} attempts remaining before temporary cooldown.";
            }
            $noticeType = 'error';
        }
    }
}

$isLoggedIn = !empty($_SESSION['admin_logged_in']);

// Helper to load blogs
function load_blogs($path, $fallback) {
    if (file_exists($path)) {
        $blogs = json_decode(@file_get_contents($path), true);
        if (is_array($blogs)) return $blogs;
    }
    return $fallback;
}

// Helper to save blogs
function save_blogs($path, $blogs) {
    return (bool) @file_put_contents($path, json_encode(array_values($blogs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

// Handle Authenticated Actions
if ($isLoggedIn && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postAction = $_POST['action'] ?? '';

    // Change Password
    if ($postAction === 'change_password') {
        $oldPass = $_POST['old_password'] ?? '';
        $newPass = $_POST['new_password'] ?? '';
        $confirmPass = $_POST['confirm_password'] ?? '';

        if (!password_verify($oldPass, $adminConfig['password_hash'])) {
            $notice = 'Current password does not match.';
            $noticeType = 'error';
        } elseif (strlen($newPass) < 4) {
            $notice = 'New password must be at least 4 characters long.';
            $noticeType = 'error';
        } elseif ($newPass !== $confirmPass) {
            $notice = 'New passwords do not match.';
            $noticeType = 'error';
        } else {
            $adminConfig['password_hash'] = password_hash($newPass, PASSWORD_DEFAULT);
            @file_put_contents($adminConfigFile, json_encode($adminConfig, JSON_PRETTY_PRINT));
            $notice = 'Password updated successfully!';
            $noticeType = 'success';
        }
    }

    // Add New Blog
    if ($postAction === 'add_blog') {
        $title = trim($_POST['title'] ?? '');
        $summary = trim($_POST['summary'] ?? '');
        $date = trim($_POST['date'] ?? date('F d, Y'));
        $duration = trim($_POST['duration'] ?? '10:00');
        $category = trim($_POST['category'] ?? 'ABA Therapy');
        $youtubeId = trim($_POST['youtube_id'] ?? 'R3CW5z6ypDQ');
        $image = trim($_POST['image'] ?? '');

        // Extract YouTube ID if full URL pasted
        if (preg_match('/(?:v=|youtu\.be\/|embed\/)([A-Za-z0-9_-]{11})/', $youtubeId, $match)) {
            $youtubeId = $match[1];
        }

        if ($title === '' || $summary === '') {
            $notice = 'Please provide both a heading and a description for the blog.';
            $noticeType = 'error';
        } else {
            $currentBlogs = load_blogs($blogsDataFile, $blog_posts);
            $newId = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $title)) . '-' . time();
            $newPost = [
                'id' => $newId,
                'title' => $title,
                'summary' => $summary,
                'date' => $date,
                'duration' => $duration,
                'category' => $category ?: 'ABA Therapy',
                'youtube_id' => $youtubeId ?: 'R3CW5z6ypDQ',
                'image' => $image
            ];
            array_unshift($currentBlogs, $newPost);
            save_blogs($blogsDataFile, $currentBlogs);
            $notice = 'Blog post added successfully!';
            $noticeType = 'success';
        }
    }

    // Edit Existing Blog
    if ($postAction === 'edit_blog') {
        $id = $_POST['id'] ?? '';
        $title = trim($_POST['title'] ?? '');
        $summary = trim($_POST['summary'] ?? '');
        $date = trim($_POST['date'] ?? '');
        $duration = trim($_POST['duration'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $youtubeId = trim($_POST['youtube_id'] ?? '');
        $image = trim($_POST['image'] ?? '');

        if (preg_match('/(?:v=|youtu\.be\/|embed\/)([A-Za-z0-9_-]{11})/', $youtubeId, $match)) {
            $youtubeId = $match[1];
        }

        $currentBlogs = load_blogs($blogsDataFile, $blog_posts);
        $found = false;
        foreach ($currentBlogs as &$item) {
            if ($item['id'] === $id) {
                $item['title'] = $title;
                $item['summary'] = $summary;
                $item['date'] = $date;
                $item['duration'] = $duration;
                if ($category !== '') $item['category'] = $category;
                if ($youtubeId !== '') $item['youtube_id'] = $youtubeId;
                $item['image'] = $image;
                $found = true;
                break;
            }
        }
        unset($item);

        if ($found) {
            save_blogs($blogsDataFile, $currentBlogs);
            $notice = 'Blog post updated successfully!';
            $noticeType = 'success';
        } else {
            $notice = 'Blog post not found.';
            $noticeType = 'error';
        }
    }

    // Delete Blog
    if ($postAction === 'delete_blog') {
        $id = $_POST['id'] ?? '';
        $currentBlogs = load_blogs($blogsDataFile, $blog_posts);
        $initialCount = count($currentBlogs);
        $currentBlogs = array_filter($currentBlogs, function($item) use ($id) {
            return $item['id'] !== $id;
        });

        if (count($currentBlogs) < $initialCount) {
            save_blogs($blogsDataFile, $currentBlogs);
            $notice = 'Blog post deleted successfully.';
            $noticeType = 'success';
        } else {
            $notice = 'Blog post could not be removed.';
            $noticeType = 'error';
        }
    }
}

// Refresh loaded blogs for rendering
$displayBlogs = load_blogs($blogsDataFile, $blog_posts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | <?php echo SITE_NAME; ?></title>
  <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      background: #061129;
      color: #f8fafc;
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }
    .admin-navbar {
      background: rgba(10, 25, 59, 0.95);
      border-bottom: 1px solid rgba(229, 185, 76, 0.3);
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
      backdrop-filter: blur(8px);
    }
    .admin-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #ffffff;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .admin-title span {
      color: var(--accent-gold);
    }
    .admin-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      border: none;
      transition: all 0.2s ease;
    }
    .admin-btn-primary {
      background: var(--accent-gold);
      color: #03133d;
    }
    .admin-btn-primary:hover {
      background: var(--accent-gold-light);
      transform: translateY(-1px);
    }
    .admin-btn-outline {
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.25);
      color: #ffffff;
    }
    .admin-btn-outline:hover {
      border-color: var(--accent-gold);
      color: var(--accent-gold);
    }
    .admin-btn-danger {
      background: #ef4444;
      color: #ffffff;
    }
    .admin-btn-danger:hover {
      background: #dc2626;
    }
    .admin-container {
      max-width: 1280px;
      margin: 2rem auto;
      padding: 0 1.5rem;
    }
    .notice {
      padding: 1rem 1.25rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 500;
    }
    .notice-success {
      background: rgba(16, 185, 129, 0.15);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #34d399;
    }
    .notice-error {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #f87171;
    }
    /* Login Box */
    .login-wrapper {
      min-height: calc(100vh - 80px);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }
    .login-card {
      background: rgba(16, 40, 90, 0.95);
      border: 1px solid rgba(229, 185, 76, 0.35);
      border-radius: 16px;
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 440px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      text-align: center;
    }
    .login-card h2 {
      margin-bottom: 0.5rem;
      color: #ffffff;
      font-size: 1.6rem;
    }
    .login-card p {
      color: #94a3b8;
      font-size: 0.92rem;
      margin-bottom: 1.5rem;
    }
    .form-group {
      margin-bottom: 1.25rem;
      text-align: left;
    }
    .form-label {
      display: block;
      margin-bottom: 0.4rem;
      font-size: 0.88rem;
      font-weight: 600;
      color: #cbd5e1;
    }
    .form-input, .form-textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      background: rgba(6, 17, 41, 0.8);
      color: #ffffff;
      font-size: 0.95rem;
      box-sizing: border-box;
      outline: none;
      transition: border-color 0.2s ease;
    }
    .form-input:focus, .form-textarea:focus {
      border-color: var(--accent-gold);
    }
    /* Admin Grid */
    .admin-cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 1.75rem;
      margin-top: 1.5rem;
    }
    .admin-blog-card {
      background: linear-gradient(180deg, rgba(16, 40, 90, 0.98), rgba(7, 24, 58, 1));
      border: 1.5px solid rgba(255, 255, 255, 0.14);
      border-radius: 16px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      position: relative;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      transition: transform 0.2s ease, border-color 0.2s ease;
    }
    .admin-blog-card:hover {
      border-color: rgba(229, 185, 76, 0.6);
      transform: translateY(-3px);
    }
    .admin-card-top-bar {
      position: absolute;
      top: 12px;
      right: 12px;
      z-index: 10;
      display: flex;
      gap: 8px;
    }
    .admin-top-action-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    }
    .admin-edit-btn {
      background: var(--accent-gold);
      color: #03133d;
    }
    .admin-edit-btn:hover {
      background: #ffffff;
      transform: scale(1.08);
    }
    .admin-delete-btn {
      background: #ef4444;
      color: #ffffff;
    }
    .admin-delete-btn:hover {
      background: #dc2626;
      transform: scale(1.08);
    }
    .admin-card-img-wrap {
      position: relative;
      aspect-ratio: 16 / 9;
      background: #0f172a;
      overflow: hidden;
    }
    .admin-card-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .admin-card-category {
      position: absolute;
      top: 12px;
      left: 12px;
      background: var(--accent-gold);
      color: #03133d;
      font-size: 0.75rem;
      font-weight: 700;
      padding: 0.25rem 0.65rem;
      border-radius: 50px;
      text-transform: uppercase;
      z-index: 2;
    }
    .admin-card-body {
      padding: 1.25rem 1.25rem 1.5rem;
      display: flex;
      flex-direction: column;
      flex: 1;
    }
    .admin-card-body h3 {
      font-size: 1.1rem;
      line-height: 1.4;
      margin-bottom: 0.6rem;
      color: #ffffff;
    }
    .admin-card-body p {
      color: #94a3b8;
      font-size: 0.88rem;
      line-height: 1.5;
      margin-bottom: 1rem;
      flex: 1;
    }
    .admin-card-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      padding-top: 0.85rem;
      color: #cbd5e1;
      font-size: 0.8rem;
    }
    /* Modal Styles */
    .admin-modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.8);
      z-index: 1000;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      backdrop-filter: blur(4px);
    }
    .admin-modal.is-active {
      display: flex;
    }
    .admin-modal-content {
      background: #0c204c;
      border: 1px solid rgba(229, 185, 76, 0.4);
      border-radius: 16px;
      max-width: 600px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      padding: 2rem;
      box-shadow: 0 25px 60px rgba(0,0,0,0.6);
    }
    .admin-modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding-bottom: 0.75rem;
    }
    .admin-modal-header h3 {
      color: #ffffff;
      font-size: 1.3rem;
      margin: 0;
    }
    .modal-close-btn {
      background: none;
      border: none;
      color: #94a3b8;
      font-size: 1.25rem;
      cursor: pointer;
    }
    .modal-close-btn:hover {
      color: #ffffff;
    }
    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    @media (max-width: 768px) {
      .admin-navbar {
        flex-direction: column;
        align-items: stretch;
        gap: 0.85rem;
        padding: 0.85rem 1rem;
      }
      .admin-navbar > div:last-child {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
      }
      .admin-navbar > div:last-child .admin-btn {
        flex: 1 1 calc(50% - 6px);
        justify-content: center;
        padding: 0.55rem 0.65rem;
        font-size: 0.82rem;
      }
      .admin-container {
        padding: 0 0.85rem;
        margin: 1.25rem auto;
      }
      .admin-cards-grid {
        grid-template-columns: 1fr;
        gap: 1.25rem;
      }
      .admin-modal-content {
        padding: 1.25rem;
        max-height: 94vh;
      }
    }

    @media (max-width: 480px) {
      .grid-2 {
        grid-template-columns: 1fr;
      }
      .admin-title {
        font-size: 1.05rem;
      }
      .admin-btn {
        padding: 0.5rem 0.85rem;
        font-size: 0.82rem;
      }
      .login-card {
        padding: 1.75rem 1.25rem;
      }
    }
  </style>
</head>
<body>

<?php if (!$isLoggedIn): ?>
  <!-- Admin Login Screen -->
  <header class="admin-navbar">
    <div class="admin-title">
      <i class="fas fa-lock"></i> <span>Jason Lantier</span> Admin Access
    </div>
    <a href="index.php" class="admin-btn admin-btn-outline">
      <i class="fas fa-arrow-left"></i> Return to Website
    </a>
  </header>

  <main class="login-wrapper">
    <div class="login-card">
      <div style="font-size: 2.5rem; color: var(--accent-gold); margin-bottom: 1rem;">
        <i class="fas fa-shield-alt"></i>
      </div>
      <h2>Admin Authentication</h2>
      <p>Enter the master password to access blog editing and management controls.</p>

      <?php if (!empty($notice)): ?>
        <div class="notice notice-<?php echo $noticeType; ?>">
          <i class="fas <?php echo $noticeType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
          <span><?php echo htmlspecialchars($notice); ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" action="admin.php">
        <input type="hidden" name="action" value="admin_login">
        <div class="form-group">
          <label class="form-label" for="admin_password">Password</label>
          <input type="password" id="admin_password" name="admin_password" class="form-input" placeholder="Enter password" required autofocus>
        </div>
        <button type="submit" class="admin-btn admin-btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem;">
          <i class="fas fa-sign-in-alt"></i> Login to Dashboard
        </button>
      </form>
    </div>
  </main>

<?php else: ?>
  <!-- Admin Authenticated Dashboard -->
  <header class="admin-navbar">
    <div class="admin-title">
      <i class="fas fa-user-shield"></i> <span>Jason Lantier</span> Blog Manager
    </div>
    <div style="display: flex; gap: 10px; align-items: center;">
      <button type="button" class="admin-btn admin-btn-primary" id="openAddModalBtn">
        <i class="fas fa-plus"></i> Add New Blog
      </button>
      <button type="button" class="admin-btn admin-btn-outline" id="openPasswordModalBtn">
        <i class="fas fa-key"></i> Change Password
      </button>
      <a href="index.php" class="admin-btn admin-btn-outline" target="_blank">
        <i class="fas fa-external-link-alt"></i> View Site
      </a>
      <a href="admin.php?action=logout" class="admin-btn admin-btn-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </header>

  <main class="admin-container">
    <?php if (!empty($notice)): ?>
      <div class="notice notice-<?php echo $noticeType; ?>">
        <i class="fas <?php echo $noticeType === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
        <span><?php echo htmlspecialchars($notice); ?></span>
      </div>
    <?php endif; ?>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
      <div>
        <h1 style="font-size: 1.8rem; margin: 0 0 0.25rem; color: #ffffff;">Manage Blog Section</h1>
        <p style="color: #94a3b8; margin: 0; font-size: 0.95rem;">
          Add, edit, or delete articles and video lectures. All modifications appear live on both the homepage and blog page.
        </p>
      </div>
      <button type="button" class="admin-btn admin-btn-primary" id="openAddModalBtn2">
        <i class="fas fa-plus-circle"></i> Add Blog Post
      </button>
    </div>

    <!-- Blog Posts Cards Grid with Top Edit/Delete buttons -->
    <div class="admin-cards-grid">
      <?php foreach ($displayBlogs as $post): ?>
        <?php 
          $thumbnail_url = !empty($post['image']) ? $post['image'] : ('https://img.youtube.com/vi/' . ($post['youtube_id'] ?? '') . '/maxresdefault.jpg'); 
        ?>
        <article class="admin-blog-card" id="post-card-<?php echo htmlspecialchars($post['id']); ?>">
          <!-- Action Buttons on Top of Card Layout -->
          <div class="admin-card-top-bar">
            <button type="button" 
                    class="admin-top-action-btn admin-edit-btn edit-post-btn" 
                    title="Edit blog post"
                    data-id="<?php echo htmlspecialchars($post['id']); ?>"
                    data-title="<?php echo htmlspecialchars($post['title'] ?? '', ENT_QUOTES); ?>"
                    data-summary="<?php echo htmlspecialchars($post['summary'] ?? '', ENT_QUOTES); ?>"
                    data-date="<?php echo htmlspecialchars($post['date'] ?? '', ENT_QUOTES); ?>"
                    data-duration="<?php echo htmlspecialchars($post['duration'] ?? '', ENT_QUOTES); ?>"
                    data-category="<?php echo htmlspecialchars($post['category'] ?? '', ENT_QUOTES); ?>"
                    data-youtube="<?php echo htmlspecialchars($post['youtube_id'] ?? '', ENT_QUOTES); ?>"
                    data-image="<?php echo htmlspecialchars($post['image'] ?? '', ENT_QUOTES); ?>">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <form method="POST" action="admin.php" style="margin: 0;" onsubmit="return confirm('Are you sure you want to permanently delete this blog post?');">
              <input type="hidden" name="action" value="delete_blog">
              <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
              <button type="submit" class="admin-top-action-btn admin-delete-btn" title="Delete blog post">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </div>

          <div class="admin-card-img-wrap">
            <span class="admin-card-category"><?php echo htmlspecialchars($post['category'] ?? 'ABA'); ?></span>
            <img src="<?php echo htmlspecialchars($thumbnail_url); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="admin-card-img" onerror="this.src='assets/images/hero-banner.png';">
          </div>

          <div class="admin-card-body">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><?php echo htmlspecialchars($post['summary']); ?></p>
            <div class="admin-card-meta">
              <span><i class="far fa-calendar-alt" style="color: var(--accent-gold);"></i> <?php echo htmlspecialchars($post['date'] ?? 'Recent'); ?></span>
              <span><i class="far fa-clock" style="color: var(--accent-gold);"></i> <?php echo htmlspecialchars($post['duration'] ?? '10:00'); ?></span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Add Blog Modal -->
  <div class="admin-modal" id="addBlogModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3><i class="fas fa-plus-circle" style="color: var(--accent-gold);"></i> Add New Blog Post</h3>
        <button type="button" class="modal-close-btn" data-close="addBlogModal">&times;</button>
      </div>
      <form method="POST" action="admin.php">
        <input type="hidden" name="action" value="add_blog">
        <div class="form-group">
          <label class="form-label" for="add_title">Heading / Title *</label>
          <input type="text" id="add_title" name="title" class="form-input" placeholder="e.g. 3 Goals of Behavior Analysis" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="add_summary">Description / Summary *</label>
          <textarea id="add_summary" name="summary" class="form-textarea" rows="4" placeholder="Brief summary of the article or video tutorial..." required></textarea>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label" for="add_date">Date</label>
            <input type="text" id="add_date" name="date" class="form-input" value="<?php echo date('F d, Y'); ?>" placeholder="e.g. October 14, 2024">
          </div>
          <div class="form-group">
            <label class="form-label" for="add_duration">Duration</label>
            <input type="text" id="add_duration" name="duration" class="form-input" placeholder="e.g. 8:30" value="8:30">
          </div>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label" for="add_category">Category</label>
            <input type="text" id="add_category" name="category" class="form-input" placeholder="e.g. BACB Fundamentals" value="Clinical Guidance">
          </div>
          <div class="form-group">
            <label class="form-label" for="add_youtube_id">YouTube Video ID or URL</label>
            <input type="text" id="add_youtube_id" name="youtube_id" class="form-input" placeholder="e.g. R3CW5z6ypDQ or full URL">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="add_image">Custom Image Path / URL (Optional)</label>
          <input type="text" id="add_image" name="image" class="form-input" placeholder="assets/images/... (leaves blank to use YouTube thumbnail)">
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
          <button type="button" class="admin-btn admin-btn-outline" data-close="addBlogModal">Cancel</button>
          <button type="submit" class="admin-btn admin-btn-primary">
            <i class="fas fa-check"></i> Publish Blog Post
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Blog Modal -->
  <div class="admin-modal" id="editBlogModal">
    <div class="admin-modal-content">
      <div class="admin-modal-header">
        <h3><i class="fas fa-pencil-alt" style="color: var(--accent-gold);"></i> Edit Blog Post</h3>
        <button type="button" class="modal-close-btn" data-close="editBlogModal">&times;</button>
      </div>
      <form method="POST" action="admin.php">
        <input type="hidden" name="action" value="edit_blog">
        <input type="hidden" id="edit_id" name="id">

        <div class="form-group">
          <label class="form-label" for="edit_title">Heading / Title *</label>
          <input type="text" id="edit_title" name="title" class="form-input" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="edit_summary">Description / Summary *</label>
          <textarea id="edit_summary" name="summary" class="form-textarea" rows="4" required></textarea>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label" for="edit_date">Date</label>
            <input type="text" id="edit_date" name="date" class="form-input">
          </div>
          <div class="form-group">
            <label class="form-label" for="edit_duration">Duration</label>
            <input type="text" id="edit_duration" name="duration" class="form-input">
          </div>
        </div>
        <div class="grid-2">
          <div class="form-group">
            <label class="form-label" for="edit_category">Category</label>
            <input type="text" id="edit_category" name="category" class="form-input">
          </div>
          <div class="form-group">
            <label class="form-label" for="edit_youtube_id">YouTube Video ID or URL</label>
            <input type="text" id="edit_youtube_id" name="youtube_id" class="form-input">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label" for="edit_image">Custom Image Path / URL (Optional)</label>
          <input type="text" id="edit_image" name="image" class="form-input">
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
          <button type="button" class="admin-btn admin-btn-outline" data-close="editBlogModal">Cancel</button>
          <button type="submit" class="admin-btn admin-btn-primary">
            <i class="fas fa-save"></i> Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div class="admin-modal" id="passwordModal">
    <div class="admin-modal-content" style="max-width: 480px;">
      <div class="admin-modal-header">
        <h3><i class="fas fa-key" style="color: var(--accent-gold);"></i> Change Admin Password</h3>
        <button type="button" class="modal-close-btn" data-close="passwordModal">&times;</button>
      </div>
      <form method="POST" action="admin.php">
        <input type="hidden" name="action" value="change_password">
        <div class="form-group">
          <label class="form-label" for="old_password">Current Password *</label>
          <input type="password" id="old_password" name="old_password" class="form-input" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="new_password">New Password *</label>
          <input type="password" id="new_password" name="new_password" class="form-input" required minlength="4">
        </div>
        <div class="form-group">
          <label class="form-label" for="confirm_password">Confirm New Password *</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-input" required minlength="4">
        </div>
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem;">
          <button type="button" class="admin-btn admin-btn-outline" data-close="passwordModal">Cancel</button>
          <button type="submit" class="admin-btn admin-btn-primary">
            <i class="fas fa-lock"></i> Update Password
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Admin Modal JS -->
  <script>
    // Modal Helpers
    function openModal(id) {
      var modal = document.getElementById(id);
      if (modal) modal.classList.add('is-active');
    }
    function closeModal(id) {
      var modal = document.getElementById(id);
      if (modal) modal.classList.remove('is-active');
    }

    document.querySelectorAll('[data-close]').forEach(function(btn) {
      btn.addEventListener('click', function() {
        closeModal(this.getAttribute('data-close'));
      });
    });

    // Close on click outside modal content
    document.querySelectorAll('.admin-modal').forEach(function(modal) {
      modal.addEventListener('click', function(e) {
        if (e.target === this) {
          this.classList.remove('is-active');
        }
      });
    });

    // Add buttons
    var addBtn1 = document.getElementById('openAddModalBtn');
    var addBtn2 = document.getElementById('openAddModalBtn2');
    if (addBtn1) addBtn1.addEventListener('click', function() { openModal('addBlogModal'); });
    if (addBtn2) addBtn2.addEventListener('click', function() { openModal('addBlogModal'); });

    // Password modal
    var passBtn = document.getElementById('openPasswordModalBtn');
    if (passBtn) passBtn.addEventListener('click', function() { openModal('passwordModal'); });

    // Populate Edit Modal
    document.querySelectorAll('.edit-post-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.getElementById('edit_id').value = this.getAttribute('data-id') || '';
        document.getElementById('edit_title').value = this.getAttribute('data-title') || '';
        document.getElementById('edit_summary').value = this.getAttribute('data-summary') || '';
        document.getElementById('edit_date').value = this.getAttribute('data-date') || '';
        document.getElementById('edit_duration').value = this.getAttribute('data-duration') || '';
        document.getElementById('edit_category').value = this.getAttribute('data-category') || '';
        document.getElementById('edit_youtube_id').value = this.getAttribute('data-youtube') || '';
        document.getElementById('edit_image').value = this.getAttribute('data-image') || '';
        openModal('editBlogModal');
      });
    });
  </script>
<?php endif; ?>

</body>
</html>
