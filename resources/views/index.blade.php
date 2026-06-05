<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MindMate – Your AI Mental Health Companion</title>

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="{{ secure_asset('css/style.css') }}"></head>

<body>

  <!-- HEADER -->
  <section id="header">
    <div class="header ">
      <div class="nav-bar">

        <div class="brand">
          <a href="{{ url('/home') }}" class="logo-container">
            <img src="{{ asset('img/character1.png') }}" alt="MindMate Logo" class="logo-img">
            <h1><span>M</span>ind <span>M</span>ate</h1>
          </a>
        </div>

        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="#hero"     data-after="Home">Home</a></li>
            <li><a href="#team"     data-after="Team">Team</a></li>
            <li><a href="#projects" data-after="Services">Services</a></li>
            <li><a href="#about"    data-after="About">About</a></li>
            <li><a href="#contact"  data-after="Contact">Contact</a></li>
          </ul>
        </div>

      </div>
    </div>
  </section>
  <!--  END HEADER  -->


  <!-- HERO -->
  <section id="hero">
    <div class="hero container hero-wrapper">

      <!-- Left: text -->
      <div class="hero-text">
        <div class="hero-badge">Your AI Mental Wellness Companion</div>

        <h1>ElyBun<span></span></h1>
        <h1>your AI companion<span></span></h1>
        <h1>for mental health<span></span></h1>

        <p class="hero-desc">
          ElyBun is here for you 24/7 — like a friend who truly listens.
          ElyBun helps you connect the dots between thoughts, feelings,
          and behaviours — starting with your very first chat.
        </p>

        <div class="hero-buttons">
          <a id="startChatBtn" class="cta">Chat with ElyBun</a>
          <a href="#projects" class="btn-outline-hero">Learn more</a>
        </div>

        <div class="social-proof">
          <div class="avatar-stack">
            <span class="av1">A</span>
            <span class="av2">S</span>
            <span class="av3">R</span>
          </div>
          <p>2,400+ students feeling better</p>
        </div>
      </div>

      <!-- Right: bunny visual panel -->
      <div class="hero-image">
        <div class="hero-visual-panel">
          <img src="{{ asset('img/character1.png') }}" alt="ElyBun">
          <div class="bunny-bubble">
            <p>Hi! I'm ElyBun. I'm here for you. How are you feeling right now?</p>
          </div>
        </div>
      </div>

    </div>

    <!-- Disclaimer Modal — JS completely untouched -->
    <div id="disclaimerModal" class="disclaimer-modal">
      <div class="disclaimer-card">
        <h2>Before you begin</h2>
        <p>
          This chatbot is for educational and informational purposes only.
          It is <strong>not a substitute for a licensed psychiatrist,
          therapist, or medical professional.</strong>
        </p>
        <p class="sub-text">
          If you are experiencing severe emotional distress,
          please seek professional help immediately.
        </p>
        <div class="modal-buttons">
          <button id="acceptDisclaimer" class="accept-btn">I Understand</button>
          <button id="closeModal"       class="cancel-btn">Cancel</button>
        </div>
      </div>
    </div>

  </section>
  <!--  END HERO  -->


  <!--  STATS STRIP -->
  <div class="stats-strip">
    <div class="stat-item">
      <div class="stat-num">2,400+</div>
      <p>Active users</p>
    </div>
    <div class="stat-item">
      <div class="stat-num amber">98%</div>
      <p>Feel supported</p>
    </div>
    <div class="stat-item">
      <div class="stat-num">24/7</div>
      <p>Always available</p>
    </div>
  </div>
  
  <!--  WHY ELYBUN — FEATURES SECTION -->
  <section id="why-elybun">
    <div class="why-elybun container">
      <div class="why-elybun-header">
        <div class="section-label">Why ElyBun</div>
        <h1 class="section-title">Designed with care, <span>not just code</span></h1>
      </div>
      <div class="why-elybun-cards">

        <div class="why-card">
          <div class="why-card-icon why-card-icon--purple">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M12 21C12 21 3 14 3 8a5 5 0 0 1 10 0 5 5 0 0 1 9 0c0 6-9 13-9 13z" stroke="#534AB7" stroke-width="1.6"/>
            </svg>
          </div>
          <h3>Empathetic listening</h3>
          <p>ElyBun responds with warmth — no scripted replies. Every conversation feels personal and real.</p>
        </div>

        <div class="why-card">
          <div class="why-card-icon why-card-icon--amber">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="9" stroke="#BA7517" stroke-width="1.6"/>
              <path d="M12 7v5l3 3" stroke="#BA7517" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
          </div>
          <h3>Mood tracking</h3>
          <p>Log your emotions daily. See patterns emerge and celebrate how far you've come week over week.</p>
        </div>

        <div class="why-card">
          <div class="why-card-icon why-card-icon--green">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M9 12l2 2 4-4" stroke="#0F6E56" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="12" r="9" stroke="#0F6E56" stroke-width="1.6"/>
            </svg>
          </div>
          <h3>Evidence-based</h3>
          <p>Grounded in CBT and mindfulness — the same techniques therapists use, made accessible for everyone.</p>
        </div>

      </div>
    </div>
  </section>
  <!--  END WHY ELYBUN  -->


  <!-- PRIVACY SECTION -->
  <section class="section">
    <img src="{{ asset('img/phone.png') }}" alt="Privacy">
    <div class="text-box">
      <h2>Your Privacy Is <span>Key</span></h2>
      <p>No registration is required to use MindMate. This means that we have no personal data whatsoever about you. Your data belongs to you and only to you.</p>
      <p>We are not exposing it to third parties. Your data serves to support you and is used to build better tools for everyone who wants to manage anxiety in the future.</p>
    </div>
  </section>


  <!--  TEAM SECTION -->
  <section id="team">
    <div class="team container">
      <div class="team-top">
        <div class="section-label">The people behind ElyBun</div>
        <h1 class="section-title">Our&nbsp;<span>T</span>eam</h1>
        <p>We are a dedicated team of developers passionate about using technology to support mental well-being. Our mission is to build accessible, empathetic, and reliable mental health chatbot solutions.</p>
      </div>
      <div class="team-bottom">

        <div class="team-item">
          <div class="icon">
            <img src="{{ asset('img/femaleicon.png') }}" alt="Laiba Yaqoob">
          </div>
          <h2>Laiba Yaqoob</h2>
          <p>Frontend Developer</p>
        </div>

        <div class="team-item">
          <div class="icon">
            <img src="{{ asset('img/femaleicon.png') }}" alt="Maryam Arif">
          </div>
          <h2>Maryam Arif</h2>
          <p>Backend Developer</p>
        </div>

        <div class="team-item">
          <div class="icon">
            <img src="{{ asset('img/femaleicon.png') }}" alt="Fiza Shahid">
          </div>
          <h2>Fiza Shahid</h2>
          <p>Backend Developer</p>
        </div>

      </div>
    </div>
  </section>
  <!--  END TEAM SECTION  -->


  <!--  SERVICES SECTION -->
  <section id="projects">
    <div class="projects container">
      <div class="projects-header">
        <div class="section-label">What we offer</div>
        <h1 class="section-title">Our <span>Services</span></h1>
      </div>
      <div class="all-projects">

        <div class="project-item">
          <div class="project-info">
            <h1>Mental Health Awareness</h1>
            <h2>Mental Health Support &amp; Guidance</h2>
            <p>We believe in empowering individuals with clear, compassionate, and evidence-based mental health knowledge. Our Mental Health Chatbot goes beyond explaining emotions, symptoms, and psychological conditions — it also provides practical strategies for coping, managing stress, improving well-being, and seeking the right support.</p>
          </div>
          <div class="project-img">
            <img src="{{ asset('img/bgpic.jpg') }}" alt="Mental Health Support">
          </div>
        </div>

        <div class="project-item">
          <div class="project-info">
            <h1>Therapist &amp; Psychologist Details</h1>
            <h2>Connect With Mental Health Professionals</h2>
            <p>We understand how important it is to seek support from trained mental health experts. Our chatbot not only provides reliable guidance and helpful resources, but also helps connect you with qualified psychologists, therapists, and counselors who can offer personalised care and meaningful support on your healing journey.</p>
          </div>
          <div class="project-img">
            <img src="{{ asset('img/doctor.jpg') }}" alt="Connect with Professionals">
          </div>
        </div>

      </div>
    </div>
  </section>
  <!--  END SERVICES SECTION  -->


  <!--   ABOUT SECTION -->
  <section id="about">
    <div class="about container">

      <div class="col-left">
        <div class="about-img">
          <img src="{{ asset('img/about.jpg') }}" alt="About MindMate">
        </div>
      </div>

      <div class="col-right">
        <div class="section-label">Who we are</div>
        <h1 class="section-title" style="text-align:left;">About <span>Us</span></h1>
        <h2>Our Mission</h2>
        <p>Our mission is to deliver accessible, reliable, and evidence-based mental health support to individuals worldwide. We strive to empower people with accurate knowledge about emotional well-being, enabling them to make informed decisions about their mental health.</p>
        <div class="about-point">
          <div class="about-dot"></div>
          <p>Combining the power of technology and psychological expertise</p>
        </div>
        <div class="about-point">
          <div class="about-dot"></div>
          <p>Mental health support at your fingertips, anytime</p>
        </div>
        <div class="about-point">
          <div class="about-dot"></div>
          <p>Personalised, compassionate, and reliable guidance</p>
        </div>
      </div>

    </div>
  </section>
  <!--  END ABOUT SECTION  -->


  <!-- CONTACT SECTION -->
  <section id="contact">
    <div class="contact container">
      <div>
        <div class="section-label">Get in touch</div>
        <h1 class="section-title">Contact <span>Info</span></h1>
      </div>
      <div class="contact-items">

        <div class="contact-item">
          <div class="icon">
            <img src="https://img.icons8.com/bubbles/100/000000/phone.png" alt="Phone">
          </div>
          <div class="contact-info">
            <h1>Phone</h1>
            <h2>+92 3176122301</h2>
            <h2>+92 3076567138</h2>
            <h2>+92 3126001144</h2>

          </div>
        </div>

        <div class="contact-item">
          <div class="icon">
            <img src="https://img.icons8.com/bubbles/100/000000/new-post.png" alt="Email">
          </div>
          <div class="contact-info">
            <h1>Email</h1>
            <h2>maryemarif89@gmail.com</h2>
            <h2>fiza123@gmail.com</h2>
            <h2>laiba123@gmail.com</h2>

          </div>
        </div>

        <div class="contact-item">
          <div class="icon">
            <img src="https://img.icons8.com/bubbles/100/000000/map-marker.png" alt="Address">
          </div>
          <div class="contact-info">
            <h1>Address</h1>
            <h2>MindMate, Mianchannu, Pakistan</h2>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!--  END CONTACT SECTION  -->


  <!--FOOTER -->
  <section id="footer">
    <div class="footer container">
      <div class="brand">
        <h1><span>M</span>ind <span>M</span>ate</h1>
      </div>
      <h2>Your AI mental health companion</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/facebook-new.png" alt="Facebook"></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/instagram-new.png" alt="Instagram"></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/behance.png" alt="Behance"></a>
        </div>
      </div>
      <p>Copyright &copy; 2026 Mind Mate. All rights reserved.</p>
    </div>
  </section>
  <!--  END FOOTER  -->


  <!--  JAVASCRIPT  -->
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const startBtn  = document.getElementById("startChatBtn");
    const modal     = document.getElementById("disclaimerModal");
    const closeBtn  = document.getElementById("closeModal");
    const acceptBtn = document.getElementById("acceptDisclaimer");

    startBtn.addEventListener("click", function () {
      modal.style.display = "flex";
    });
    closeBtn.addEventListener("click", function () {
      modal.style.display = "none";
    });
    acceptBtn.addEventListener("click", function () {
      modal.style.display = "none";
      window.location.href = "{{ url('/chat') }}";
    });
  });
  </script>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>