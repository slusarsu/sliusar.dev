<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Віталій Слюсар — Laravel Developer | Portfolio</title>
    <meta name="description" content="Портфоліо Laravel-розробника Віталія Слюсаря: бекенд, API, високонавантажені системи, досвід з 2018 року. Проекти, досвід, навички, контакти." />
    <meta property="og:title" content="Віталій Слюсар — Laravel Developer" />
    <meta property="og:description" content="Портфоліо: Laravel, PHP, MySQL, Redis, Vue.js, Docker, Azure, AWS S3, Git." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://sliusar.dev/" />
    <link rel="icon" href="/favicon-32x32.png" />

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        :root { --accent: #0d6efd; }
        /* дрібна косметика без перевантаження */
        body { scroll-behavior: smooth; }
        header.hero {
            background: radial-gradient(1200px 500px at 80% -10%, rgba(13,110,253,.15), transparent),
            linear-gradient(180deg, #f8f9fa 0%, #ffffff 60%);
        }
        .avatar {
            width: 140px; height: 140px; object-fit: cover; border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }
        .badge-skill { background: #eef4ff; color: #0b5ed7; border: 1px solid #d7e3ff; }
        .timeline { position: relative; }
        .timeline::before { content: ""; position: absolute; left: 12px; top: 0; bottom: 0; width: 2px; background: #e9ecef; }
        .timeline-item { position: relative; padding-left: 3rem; }
        .timeline-item::before {
            content: ""; position: absolute; left: 4px; top: .55rem; width: 16px; height: 16px;
            border-radius: 50%; background: var(--accent); box-shadow: 0 0 0 3px #e9f0ff;
        }
        .project-card:hover { transform: translateY(-2px); box-shadow: 0 .5rem 1.2rem rgba(0,0,0,.08); }
        .link-muted { color: inherit; text-decoration: none; }
        .link-muted:hover { color: var(--accent); }
        .shadow-soft { box-shadow: 0 .25rem .75rem rgba(0,0,0,.05); }
        .section-title { font-weight: 700; letter-spacing: .3px; }
        .nav-link { font-weight: 500; }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#nav" data-bs-offset="80" tabindex="0">
<!-- Навбар -->
<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#top">sliusar.dev</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#about">Про мене</a></li>
                <li class="nav-item"><a class="nav-link" href="#skills">Навички</a></li>
                <li class="nav-item"><a class="nav-link" href="#experience">Досвід</a></li>
                <li class="nav-item"><a class="nav-link" href="#projects">Проєкти</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Контакти</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Блог</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<header id="top" class="hero py-6 py-lg-7 mt-5">
    <div class="container py-5">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-12 col-lg-7 order-2 order-lg-1">
                <h1 class="display-5 fw-bold mb-3">Віталій Слюсар</h1>
                <p class="lead text-secondary mb-4">Senior Laravel / PHP Developer · Архітектура бекенду · API · Високі навантаження</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#projects" class="btn btn-primary btn-lg"><i class="bi bi-rocket-takeoff me-2"></i>Подивитись проєкти</a>
                    <a href="#contact" class="btn btn-outline-primary btn-lg"><i class="bi bi-envelope me-2"></i>Зв'язатись</a>
                </div>
                <div class="mt-4 text-secondary">
                    <i class="bi bi-geo-alt"></i> Україна · Віддалено / Київ
                </div>
            </div>
            <div class="col-12 col-lg-5 text-center order-1 order-lg-2">
                <img src="{{$page->thumb()}}" alt="Фото Віталія Слюсар" class="avatar" onerror="this.src='https://placehold.co/280x280?text=VS';" />
            </div>
        </div>
    </div>
</header>

<!-- Про мене -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <h2 class="section-title h3 mb-3">Про мене</h2>
                <p class="mb-3">Понад 7 років комерційного досвіду з <strong>Laravel</strong> та PHP: проєктую бекенд-архітектуру, будую надійні REST API, інтегрую платіжні системи, оптимізую БД і кеші. Люблю чистий код, очевидні інтерфейси і короткий шлях від ідеї до продакшену.</p>
                <p class="mb-0 text-secondary">Працював з корпоративними LMS, e‑commerce сервісами, соціальними платформами, розробляв браузерні розширення та мікросервіси. Є досвід менторингу та рев'ю коду.</p>
            </div>
            <div class="col-lg-5">
                <div class="p-4 rounded-3 border shadow-soft bg-white">
                    <div class="d-flex align-items-center mb-2"><i class="bi bi-telephone me-2"></i><a class="link-muted" href="tel:+380663758700">+38 066 375 87 00</a></div>
                    <div class="d-flex align-items-center mb-2"><i class="bi bi-envelope me-2"></i><a class="link-muted" href="mailto:slusarvitaliy@gmail.com">slusarvitaliy@gmail.com</a></div>
                    <div class="d-flex align-items-center"><i class="bi bi-globe me-2"></i><a class="link-muted" href="https://sliusar.dev" target="_blank" rel="noopener">sliusar.dev</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Навички -->
<section id="skills" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title h3 mb-4">Навички</h2>
        <div class="d-flex flex-wrap gap-2">
            <span class="badge badge-skill">PHP 7.4–8.x</span>
            <span class="badge badge-skill">Laravel 7–12</span>
            <span class="badge badge-skill">MySQL 8</span>
            <span class="badge badge-skill">Redis</span>
            <span class="badge badge-skill">REST API</span>
            <span class="badge badge-skill">OAuth / Webhooks</span>
            <span class="badge badge-skill">Vue.js 2</span>
            <span class="badge badge-skill">jQuery</span>
            <span class="badge badge-skill">Bootstrap 5</span>
            <span class="badge badge-skill">Tailwind CSS</span>
            <span class="badge badge-skill">Docker</span>
            <span class="badge badge-skill">Git</span>
            <span class="badge badge-skill">Azure</span>
            <span class="badge badge-skill">AWS S3</span>
            <span class="badge badge-skill">Elasticsearch</span>
            <span class="badge badge-skill">CI/CD</span>
        </div>
    </div>
</section>

<!-- Досвід -->
<section id="experience" class="py-5">
    <div class="container">
        <h2 class="section-title h3 mb-4">Досвід</h2>
        <div class="timeline">
            <!-- Tallium -->
            <div class="timeline-item mb-4">
                <div class="card border-0 shadow-soft">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div>
                                <h3 class="h5 mb-1">Senior Software Engineer — Tallium</h3>
                                <div class="text-secondary">06.2021 — теперішній час</div>
                            </div>
                        </div>
                        <ul class="mt-3 mb-0">
                            <li>Проєктування та розробка бекенду для корпоративної платформи навчання.</li>
                            <li>Участь у визначенні обсягів, цілей та етапів проєкту.</li>
                            <li>Регулярні code review, менторинг новачків і участь у наймі.</li>
                        </ul>
                        <div class="mt-3 small text-secondary">Стек: PHP 7.4, JS, Laravel 7, MySQL 8, Bootstrap, Git, Docker, Azure</div>
                    </div>
                </div>
            </div>
            <!-- Stellar Soft -->
            <div class="timeline-item mb-4">
                <div class="card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5 mb-1">Full‑stack Software Developer — Stellar Soft</h3>
                        <div class="text-secondary">02.2021 — 06.2021</div>
                        <ul class="mt-3 mb-0">
                            <li>Розробка веб‑застосунків для digital‑агенції.</li>
                            <li>Підтримка та модернізація легасі‑рішень.</li>
                        </ul>
                        <div class="mt-3 small text-secondary">Стек: PHP 7.4, JS, Laravel 7, MySQL 8, Git, Hosting Panel</div>
                    </div>
                </div>
            </div>
            <!-- Anstrex -->
            <div class="timeline-item mb-4">
                <div class="card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5 mb-1">Full‑stack Developer — Anstrex</h3>
                        <div class="text-secondary">02.2020 — 01.2021</div>
                        <ul class="mt-3 mb-0">
                            <li>Бекенд та фронтенд для e‑commerce сервісу.</li>
                            <li>Розробка Chrome‑розширення для парсингу товарів (AliExpress, Amazon ➝ Shopify).</li>
                            <li>Менторинг розробників та підрядників.</li>
                        </ul>
                        <div class="mt-3 small text-secondary">Стек: PHP 7.4, JS, Laravel 7, MySQL, Vue.js 2, jQuery, Bootstrap, Chrome Extension, Elasticsearch, Git, AWS S3</div>
                    </div>
                </div>
            </div>
            <!-- Viround -->
            <div class="timeline-item">
                <div class="card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5 mb-1">Lead Software Engineer — Viround</h3>
                        <div class="text-secondary">12.2018 — 01.2020</div>
                        <ul class="mt-3 mb-0">
                            <li>Дизайн та впровадження архітектури БД для соціальної мережі.</li>
                            <li>Керування командою (3 деви + 1 QA), інженерія бекенд‑компонентів.</li>
                        </ul>
                        <div class="mt-3 small text-secondary">Стек: PHP, JS, Laravel 5.6, MySQL, AngularJS, jQuery, Bootstrap, Git, AWS S3</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Проєкти -->
<section id="projects" class="py-5 bg-light">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="section-title h3 mb-0">Вибрані проєкти</h2>
            <a class="small link-muted" href="#contact">Хочете демо? Напишіть мені →</a>
        </div>
        <div class="row g-4">
            <!-- FormPost -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5"><a class="link-muted" href="https://formpost.org" target="_blank" rel="noopener">FormPost.org</a></h3>
                        <p class="text-secondary">SaaS‑агрегатор форм: прийом сабмітів, вебхуки, аналітика, інтеграції.</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">Laravel</span>
                            <span class="badge text-bg-light">MySQL</span>
                            <span class="badge text-bg-light">Redis</span>
                            <span class="badge text-bg-light">Azure Blob</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Corporate LMS -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5">Корпоративна LMS</h3>
                        <p class="text-secondary">Платформа навчання: роли, модулі, трекінг прогресу, SSO, звіти.</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">Laravel</span>
                            <span class="badge text-bg-light">Docker</span>
                            <span class="badge text-bg-light">Azure</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chrome Extension -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5">Chrome Extension для e‑commerce</h3>
                        <p class="text-secondary">Парсинг товарів з маркетплейсів і пуш у Shopify. Черги, ретраї, логування.</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">JS</span>
                            <span class="badge text-bg-light">Elasticsearch</span>
                            <span class="badge text-bg-light">AWS S3</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Social Network Backend -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5">Backend соціальної платформи</h3>
                        <p class="text-secondary">Проєктування БД, API для фідів, нотифікацій, медіа‑сховище.</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">Laravel</span>
                            <span class="badge text-bg-light">MySQL</span>
                            <span class="badge text-bg-light">AWS S3</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Payments Integrations -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5">Платіжні інтеграції</h3>
                        <p class="text-secondary">WayForPay, Monobank, LiqPay: інвойси, webhooks, підписки, звіти.</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">REST</span>
                            <span class="badge text-bg-light">Webhooks</span>
                            <span class="badge text-bg-light">Security</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Telegram Bot (Go) -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 project-card border-0 shadow-soft">
                    <div class="card-body">
                        <h3 class="h5">Telegram‑бот (Go)</h3>
                        <p class="text-secondary">FSM, кнопки, підключення до БД/Redis, сценарії для бізнесу. (WIP)</p>
                        <div class="d-flex flex-wrap gap-1">
                            <span class="badge text-bg-light">Go</span>
                            <span class="badge text-bg-light">Redis</span>
                            <span class="badge text-bg-light">Webhook</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Контакти -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-6">
                <div class="h-100 p-4 border rounded-3 shadow-soft bg-white">
                    <h2 class="section-title h3 mb-3">Контакти</h2>
                    <p class="text-secondary">Найшвидше — у месенджер або на пошту. В середньому відповідаю швидше, ніж деплойиться Docker.</p>
                    <div class="d-grid gap-2">
                        <a class="btn btn-primary" href="mailto:slusarvitaliy@gmail.com"><i class="bi bi-envelope me-2"></i>Написати на email</a>
                        <a class="btn btn-outline-primary" href="tel:+380663758700"><i class="bi bi-telephone me-2"></i>Подзвонити</a>
                    </div>
                    <div class="mt-3 small text-secondary">Також доступний у LinkedIn / GitHub (посилання нижче).</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="h-100 p-4 border rounded-3 shadow-soft bg-white">
                    <h3 class="h5 mb-3">Коротко про співпрацю</h3>
                    <ul class="mb-0">
                        <li>Формат: віддалено, фултайм/часткова зайнятість, консалтинг.</li>
                        <li>Таймзона: EET/EEST (UTC+2/+3).</li>
                        <li>Документація, рев'ю коду, прозорі оцінки задач — за замовчуванням.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
{{--            <a class="me-3 link-muted" href="https://github.com/" target="_blank" rel="noopener"><i class="bi bi-github"></i> GitHub</a>--}}
            <a class="me-3 link-muted" href="https://www.linkedin.com/in/vitalii-sliusar-07131822/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i> LinkedIn</a>
{{--            <a class="link-muted" href="https://t.me/" target="_blank" rel="noopener"><i class="bi bi-telegram"></i> Telegram</a>--}}
        </div>
    </div>
</section>

<footer class="py-4 border-top bg-white">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="small text-secondary">© <span id="year"></span> Віталій Слюсар. Усі права захищені.</div>
        <div class="small"><a class="link-muted" href="mailto:slusarvitaliy@gmail.com">slusarvitaliy@gmail.com</a></div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Рік у футері
    document.getElementById('year').textContent = new Date().getFullYear();

    // Підсвітка активного пункту меню (Scrollspy вже ввімкнений через атрибути)
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) nav.classList.add('shadow-sm'); else nav.classList.remove('shadow-sm');
    });
</script>
</body>
</html>
