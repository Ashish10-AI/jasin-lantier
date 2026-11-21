# Jason Lantier Portfolio & Practice Platform (PHP)

A complete, responsive, dynamic PHP recreation of **[https://jasonlantier.com](https://jasonlantier.com)** — the official website of **Jason Lantier, MA, MBA, BCBA, LBA** (Autism Specialist, Licensed Behavior Analyst, and CEO of Path 2 Potential).

---

## 🌟 Key Features

* **Complete Content Replication**:
  * **Who is Jason Lantier?** (Hero banner, 20+ years credentials, bio, and downloadable Resume `.doc`).
  * **Leadership & Ventures**: Path 2 Potential (P2P), Path 4 ABA (Low-Cost Supervision), Angels 4 Autism 501(c)(3) Non-Profit, and Luv Michael.
  * **Care Services & Pillars**: Personalized care plans, 24/7 client availability, 40-hour RBT training, and home-based ABA programs across NY, NJ, AZ, and FL.
  * **Autism Blog**: Embedded YouTube video lectures, BACB task list breakdowns, and autism prevalence research.
  * **Media Gallery**: Videos covering careers, supplements, celebrity awareness, and supervision tips.
  * **Interactive Contact Page**: Working PHP contact form with input validation, session notifications, and submission persistence to `data/messages.json`.
  * **Newsletter Subscription**: PHP newsletter subscription form saving to `data/subscribers.json`.
  * **Office Details & Map**: Toll-free hotline `1-833-AUTISM-2`, Glendale NY clinical headquarters, and responsive Google Maps embed.

* **Design & Styling**:
  * Luxury executive health theme matching the original site: Deep Navy Blue (`#052069`), Gold accents (`#c59b27`), `Cinzel` serif headings, and `Source Sans` body font.
  * Fully responsive design across mobile phones, tablets, and desktop displays.
  * Local high-resolution assets and imagery stored in `assets/images/`.

---

## 📁 File Structure

```text
jason/
├── index.php                 # Main website entry point (Who is Jason Lantier?)
├── jason_portfolio.php       # Portfolio entry point
├── who-is-jason-lantier.php  # Dedicated route alias
├── message_jason.php         # Dedicated Contact & Inquiries page
├── message-jason.php         # Route alias for /message-jason
├── autism_blog.php           # Autism Blog & video lectures
├── autism-blog.php           # Route alias for /autism-blog
├── media.php                 # Media & video gallery
├── .htaccess                 # Apache clean-URL rewrites
├── includes/
│   ├── config.php            # Core site settings, data models, and form processor
│   ├── header.php            # Global header, announcement bar & navigation
│   └── footer.php            # Global footer & newsletter signup
├── assets/
│   ├── css/
│   │   └── style.css         # Custom responsive stylesheet
│   ├── js/
│   │   └── main.js           # Navigation drawer, alerts & form scripts
│   ├── images/               # Logos, hero banners & clinical photography
│   └── docs/
│       └── Jason_Lantier_Resume_2023.doc # Verified downloadable resume
└── data/
    ├── messages.json         # Contact form submissions log
    └── subscribers.json      # Newsletter subscribers log
```

---

## 🚀 How to Run the Website

### Option 1: PHP Built-in Web Server (Recommended for Quick Testing)
Open PowerShell or your command prompt in this directory (`c:\Users\student\OneDrive\Desktop\ML projects\jason`) and run:

```bash
php -S localhost:8000
```

Then open your browser and navigate to:
```
http://localhost:8000
```
Or directly:
```
http://localhost:8000/jason_portfolio.php
```

### Option 2: XAMPP / WampServer / Laragon
1. Copy the `jason` folder into your `htdocs` directory (e.g. `C:\xampp\htdocs\jason`).
2. Start the Apache service in XAMPP.
3. Open your browser and go to:
   ```
   http://localhost/jason/
   ```

---

## 🛠️ Configuration & Customization

All primary content, phone numbers, contact emails, and partner links are managed centrally in `includes/config.php`:
* `SITE_PHONE`: `1-833-288-4762` (`1-833-AUTISM-2`)
* `SITE_EMAIL`: `jlantier@path2potential.org`
* `SITE_LOCATION`: `71-19 80th Street, Suite 8213, Queens (Glendale), NY 11385`
* `$organizations`: Details and links for P2P, Path 4 ABA, Angels 4 Autism, and Luv Michael.
* `$blog_posts`: YouTube IDs and summaries for BACB educational lectures.

