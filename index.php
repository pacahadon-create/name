<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yavatar - Платформа для ИИ-аватаров</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6a11cb;
            --secondary: #2575fc;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 5rem 0;
            border-radius: 0 0 2rem 2rem;
            margin-bottom: 3rem;
        }
        
        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 1rem;
            overflow: hidden;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .avatar-card {
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .avatar-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .dashboard-card {
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, var(--secondary), var(--primary));
            transform: translateY(-2px);
        }
        
        .stat-card {
            border-left: 4px solid var(--primary);
            background: white;
            border-radius: 0.75rem;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25);
        }
        
        .sidebar {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: calc(100vh - 4rem);
            position: sticky;
            top: 2rem;
        }
        
        .nav-link {
            color: var(--dark);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            margin: 0.25rem 0;
        }
        
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
        }
        
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(45deg, #e0e0e0, #f5f5f5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 1.5rem;
        }
        
        .pricing-card {
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .pricing-card.popular {
            border: 2px solid var(--primary);
            position: relative;
        }
        
        .popular-badge {
            position: absolute;
            top: -12px;
            right: 20px;
            background: var(--accent);
            color: white;
            padding: 0.25rem 1rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        footer {
            background: linear-gradient(135deg, var(--dark) 0%, #333 100%);
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }
        
        .testimonial-card {
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .page {
            display: none;
        }
        
        .page.active {
            display: block;
        }
        
        .admin-sidebar {
            background: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 20px;
        }
        
        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .admin-nav-link {
            color: #bdc3c7;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        
        .admin-nav-link:hover, .admin-nav-link.active {
            background: #34495e;
            color: white;
        }
        
        .api-endpoint {
            background: #f8f9fa;
            border-left: 4px solid var(--primary);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 5px 5px 0;
        }
        
        .database-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        .integration-card {
            transition: all 0.3s;
            border: 1px solid #dee2e6;
        }
        
        .integration-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .deepseek-integration {
            border: 2px dashed var(--primary);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            background: rgba(106, 17, 203, 0.05);
        }
        
        .knowledge-file {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .knowledge-file:hover {
            background: #f8f9fa;
        }
        
        .progress {
            height: 10px;
            border-radius: 5px;
        }
        
        .chart-container {
            height: 300px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Навигация -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#" onclick="showPage('landing')">
                <i class="bi bi-robot me-2"></i>Yavatar
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features" onclick="showPage('landing')">Возможности</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing" onclick="showPage('landing')">Тарифы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials" onclick="showPage('landing')">Отзывы</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-outline-primary me-2" onclick="showPage('login')">Вход</button>
                    <button class="btn btn-primary" onclick="showPage('register')">Регистрация</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Лендинг -->
    <div id="landing-page" class="page active">
        <!-- Герой секция -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">ИИ-ассистент для коучей и психологов</h1>
                        <p class="lead mb-4">Создайте своего уникального ИИ-аватара с вашей базой знаний для автоматизации консультаций и повышения эффективности работы</p>
                        <div class="d-flex gap-3">
                            <button class="btn btn-light btn-lg" onclick="showPage('register')">Попробовать бесплатно</button>
                            <button class="btn btn-outline-light btn-lg" onclick="showPage('demo')">Демонстрация</button>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="avatar-preview">
                            <i class="bi bi-robot"></i>
                        </div>
                        <h3 class="text-white">Ваш персональный ИИ-ассистент</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Возможности -->
        <section id="features" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Возможности платформы</h2>
                    <p class="text-muted">Все необходимые инструменты для профессиональной работы</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-robot fs-1"></i>
                                </div>
                                <h5 class="card-title">ИИ-аватары</h5>
                                <p class="card-text">Создавайте уникальных ИИ-ассистентов с вашей базой знаний и профессиональным опытом</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-database fs-1"></i>
                                </div>
                                <h5 class="card-title">База знаний</h5>
                                <p class="card-text">Загружайте документы, книги, статьи для обучения вашего ИИ-ассистента</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-chat-dots fs-1"></i>
                                </div>
                                <h5 class="card-title">Консультации</h5>
                                <p class="card-text">Автоматизируйте первичные консультации и предварительную диагностику</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-graph-up fs-1"></i>
                                </div>
                                <h5 class="card-title">Аналитика</h5>
                                <p class="card-text">Отслеживайте эффективность работы и статистику взаимодействий</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-shield-lock fs-1"></i>
                                </div>
                                <h5 class="card-title">Безопасность</h5>
                                <p class="card-text">Гарантируем конфиденциальность данных клиентов и соответствие требованиям</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card feature-card h-100">
                            <div class="card-body p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-headset fs-1"></i>
                                </div>
                                <h5 class="card-title">Поддержка</h5>
                                <p class="card-text">Круглосуточная техническая поддержка и консультации по внедрению</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Интеграции -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Интеграции с популярными платформами</h2>
                    <p class="text-muted">Подключите вашего ИИ-аватара к любимым мессенджерам</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card integration-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-telegram fs-1"></i>
                                </div>
                                <h5 class="card-title">Telegram</h5>
                                <p class="card-text">Интеграция с Telegram-ботом</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card integration-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-whatsapp fs-1"></i>
                                </div>
                                <h5 class="card-title">WhatsApp</h5>
                                <p class="card-text">Подключение через WhatsApp Business API</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card integration-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-vk fs-1"></i>
                                </div>
                                <h5 class="card-title">ВКонтакте</h5>
                                <p class="card-text">Интеграция с сообществами ВКонтакте</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card integration-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="text-primary mb-3">
                                    <i class="bi bi-globe fs-1"></i>
                                </div>
                                <h5 class="card-title">Веб-чат</h5>
                                <p class="card-text">Виджет для вашего сайта</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Тарифы -->
        <section id="pricing" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Тарифные планы</h2>
                    <p class="text-muted">Выберите подходящий план для вашего бизнеса</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card pricing-card h-100">
                            <div class="card-body p-4">
                                <h5 class="card-title">Стартовый</h5>
                                <div class="mb-4">
                                    <span class="display-6 fw-bold">0₽</span>
                                    <span class="text-muted">/месяц</span>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>1 ИИ-аватар</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>100 МБ базы знаний</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>100 консультаций/месяц</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Базовая аналитика</li>
                                    <li class="mb-2 text-muted"><i class="bi bi-x-circle-fill me-2"></i>Премиум поддержка</li>
                                </ul>
                                <button class="btn btn-outline-primary w-100" onclick="showPage('register')">Начать бесплатно</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card pricing-card popular h-100">
                            <div class="popular-badge">Популярный</div>
                            <div class="card-body p-4">
                                <h5 class="card-title">Профессиональный</h5>
                                <div class="mb-4">
                                    <span class="display-6 fw-bold">2 990₽</span>
                                    <span class="text-muted">/месяц</span>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>5 ИИ-аватаров</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>1 ГБ базы знаний</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>1000 консультаций/месяц</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Расширенная аналитика</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Премиум поддержка</li>
                                </ul>
                                <button class="btn btn-primary w-100" onclick="showPage('register')">Выбрать план</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card pricing-card h-100">
                            <div class="card-body p-4">
                                <h5 class="card-title">Корпоративный</h5>
                                <div class="mb-4">
                                    <span class="display-6 fw-bold">9 990₽</span>
                                    <span class="text-muted">/месяц</span>
                                </div>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Неограниченные ИИ-аватары</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>10 ГБ базы знаний</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Неограниченные консультации</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Полная аналитика</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Персональный менеджер</li>
                                </ul>
                                <button class="btn btn-outline-primary w-100" onclick="showPage('contact')">Связаться с нами</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Отзывы -->
        <section id="testimonials" class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold">Отзывы специалистов</h2>
                    <p class="text-muted">Что говорят наши пользователи</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card testimonial-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-preview me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Анна Петрова</h6>
                                        <small class="text-muted">Психолог</small>
                                    </div>
                                </div>
                                <p class="card-text">"Yavatar помог мне автоматизировать первичные консультации. ИИ-аватар экономит мне 5 часов в неделю!"</p>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card testimonial-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-preview me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Михаил Сидоров</h6>
                                        <small class="text-muted">Бизнес-коуч</small>
                                    </div>
                                </div>
                                <p class="card-text">"Создал ИИ-ассистента с моей методикой. Клиенты получают качественные рекомендации 24/7!"</p>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card testimonial-card">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-preview me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Елена Козлова</h6>
                                        <small class="text-muted">Клинический психолог</small>
                                    </div>
                                </div>
                                <p class="card-text">"Платформа интуитивно понятна. ИИ-аватар помогает в предварительной диагностике и сборе анамнеза."</p>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Футер -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h4 class="mb-4">Yavatar</h4>
                        <p>Платформа для создания ИИ-ассистентов для коучей и психологов</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-white"><i class="bi bi-telegram fs-4"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-vk fs-4"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-youtube fs-4"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-4 mb-lg-0">
                        <h5 class="mb-4">Платформа</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none" onclick="showPage('landing')">Возможности</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none" onclick="showPage('landing')">Тарифы</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Интеграции</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none" onclick="showPage('api')">API</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 mb-4 mb-lg-0">
                        <h5 class="mb-4">Ресурсы</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Блог</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Документация</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none" onclick="showPage('support')">Поддержка</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="mb-4">Контакты</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> info@yavatar.ru</li>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i> +7 (495) 123-45-67</li>
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> Москва, ул. Тверская, 1</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4 bg-light">
                <div class="text-center">
                    <p class="mb-0">&copy; 2023 Yavatar. Все права защищены.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Страница входа -->
    <div id="login-page" class="page">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2>Вход в систему</h2>
                                <p class="text-muted">Введите свои учетные данные</p>
                            </div>
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Пароль</label>
                                    <input type="password" class="form-control" id="loginPassword" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Запомнить меня</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Войти</button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="#" class="text-decoration-none" onclick="showPage('register')">Нет аккаунта? Зарегистрируйтесь</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Страница регистрации -->
    <div id="register-page" class="page">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="text-center mb-4">
                                <h2>Регистрация</h2>
                                <p class="text-muted">Создайте аккаунт для начала работы</p>
                            </div>
                            <form id="registerForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="registerName" class="form-label">ФИО</label>
                                        <input type="text" class="form-control" id="registerName" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="registerEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="registerEmail" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="registerPassword" class="form-label">Пароль</label>
                                        <input type="password" class="form-control" id="registerPassword" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="registerConfirmPassword" class="form-label">Подтвердите пароль</label>
                                        <input type="password" class="form-control" id="registerConfirmPassword" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="specialization" class="form-label">Специализация</label>
                                    <select class="form-select" id="specialization">
                                        <option selected>Выберите специализацию</option>
                                        <option>Психолог</option>
                                        <option>Бизнес-коуч</option>
                                        <option>Лайф-коуч</option>
                                        <option>Психотерапевт</option>
                                        <option>Другое</option>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                    <label class="form-check-label" for="terms">Согласен с <a href="#" class="text-decoration-none">условиями использования</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="#" class="text-decoration-none" onclick="showPage('login')">Уже есть аккаунт? Войдите</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Дашборд -->
    <div id="dashboard-page" class="page">
        <div class="container-fluid">
            <div class="row">
                <!-- Боковое меню -->
                <div class="col-lg-2 p-3">
                    <div class="sidebar p-3">
                        <div class="text-center mb-4">
                            <div class="avatar-preview mb-2" style="width: 80px; height: 80px; font-size: 2rem;">
                                <i class="bi bi-person"></i>
                            </div>
                            <h6>Анна Петрова</h6>
                            <small class="text-muted">Психолог</small>
                        </div>
                        <nav class="nav flex-column">
                            <a class="nav-link active" href="#" onclick="showDashboardSection('overview')"><i class="bi bi-house me-2"></i>Дашборд</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('avatars')"><i class="bi bi-robot me-2"></i>Мои аватары</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('knowledge')"><i class="bi bi-database me-2"></i>База знаний</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('consultations')"><i class="bi bi-chat-dots me-2"></i>Консультации</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('analytics')"><i class="bi bi-graph-up me-2"></i>Аналитика</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('integrations')"><i class="bi bi-plug me-2"></i>Интеграции</a>
                            <a class="nav-link" href="#" onclick="showDashboardSection('settings')"><i class="bi bi-gear me-2"></i>Настройки</a>
                            <a class="nav-link" href="#" onclick="showPage('landing')"><i class="bi bi-box-arrow-right me-2"></i>Выход</a>
                        </nav>
                    </div>
                </div>
                
                <!-- Основной контент -->
                <div class="col-lg-10 p-3">
                    <!-- Обзор -->
                    <div id="dashboard-overview" class="dashboard-section active">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Дашборд</h2>
                            <button class="btn btn-primary" onclick="showDashboardSection('create-avatar')"><i class="bi bi-plus-circle me-2"></i>Создать аватара</button>
                        </div>
                        
                        <!-- Статистика -->
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>3</h5>
                                            <small class="text-muted">Аватаров</small>
                                        </div>
                                        <div class="text-primary">
                                            <i class="bi bi-robot fs-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>124</h5>
                                            <small class="text-muted">Консультаций</small>
                                        </div>
                                        <div class="text-primary">
                                            <i class="bi bi-chat-dots fs-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>2.4K</h5>
                                            <small class="text-muted">Вопросов</small>
                                        </div>
                                        <div class="text-primary">
                                            <i class="bi bi-question-circle fs-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="stat-card p-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5>98%</h5>
                                            <small class="text-muted">Удовлетворенность</small>
                                        </div>
                                        <div class="text-primary">
                                            <i class="bi bi-emoji-smile fs-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Мои аватары -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Мои ИИ-аватары</h4>
                                <a href="#" class="text-decoration-none" onclick="showDashboardSection('avatars')">Посмотреть все</a>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card avatar-card">
                                        <div class="card-body text-center">
                                            <div class="avatar-preview mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                                                <i class="bi bi-robot"></i>
                                            </div>
                                            <h5>Психолог-консультант</h5>
                                            <p class="text-muted">Общая психология</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-outline-primary" onclick="showDashboardSection('avatar-settings')">Настроить</button>
                                                <button class="btn btn-sm btn-primary">Запустить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card avatar-card">
                                        <div class="card-body text-center">
                                            <div class="avatar-preview mb-3" style="width: 100px; height: 100px; font-size: 2.5rem; background: linear-gradient(45deg, #ff9a9e, #fad0c4);">
                                                <i class="bi bi-robot"></i>
                                            </div>
                                            <h5>Бизнес-коуч</h5>
                                            <p class="text-muted">Развитие бизнеса</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-outline-primary" onclick="showDashboardSection('avatar-settings')">Настроить</button>
                                                <button class="btn btn-sm btn-primary">Запустить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card avatar-card h-100 d-flex align-items-center justify-content-center">
                                        <div class="card-body text-center">
                                            <i class="bi bi-plus-circle text-primary fs-1 mb-3"></i>
                                            <h5>Создать нового аватара</h5>
                                            <button class="btn btn-primary mt-2" onclick="showDashboardSection('create-avatar')">Начать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Последние консультации -->
                        <div>
                            <h4 class="mb-3">Последние консультации</h4>
                            <div class="card dashboard-card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Клиент</th>
                                                    <th>Аватар</th>
                                                    <th>Дата</th>
                                                    <th>Статус</th>
                                                    <th>Действия</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Иван Иванов</td>
                                                    <td>Психолог-консультант</td>
                                                    <td>15.03.2023 14:30</td>
                                                    <td><span class="badge bg-success">Завершена</span></td>
                                                    <td><button class="btn btn-sm btn-outline-primary">Просмотр</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Мария Смирнова</td>
                                                    <td>Бизнес-коуч</td>
                                                    <td>15.03.2023 12:15</td>
                                                    <td><span class="badge bg-warning">В процессе</span></td>
                                                    <td><button class="btn btn-sm btn-outline-primary">Просмотр</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Алексей Петров</td>
                                                    <td>Психолог-консультант</td>
                                                    <td>14.03.2023 16:45</td>
                                                    <td><span class="badge bg-success">Завершена</span></td>
                                                    <td><button class="btn btn-sm btn-outline-primary">Просмотр</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Создание аватара -->
                    <div id="dashboard-create-avatar" class="dashboard-section" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Создание ИИ-аватара</h2>
                            <button class="btn btn-outline-secondary" onclick="showDashboardSection('overview')">Назад</button>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Настройки аватара</h5>
                                        <form>
                                            <div class="mb-3">
                                                <label for="avatarName" class="form-label">Название аватара</label>
                                                <input type="text" class="form-control" id="avatarName" placeholder="Например: Психолог-консультант">
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatarDescription" class="form-label">Описание</label>
                                                <textarea class="form-control" id="avatarDescription" rows="3" placeholder="Опишите специализацию аватара"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatarSpecialization" class="form-label">Специализация</label>
                                                <select class="form-select" id="avatarSpecialization">
                                                    <option selected>Выберите специализацию</option>
                                                    <option>Общая психология</option>
                                                    <option>Клиническая психология</option>
                                                    <option>Бизнес-коучинг</option>
                                                    <option>Лайф-коучинг</option>
                                                    <option>Детская психология</option>
                                                    <option>Семейная терапия</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Тон общения</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tone" id="toneProfessional" checked>
                                                    <label class="form-check-label" for="toneProfessional">
                                                        Профессиональный
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tone" id="toneFriendly">
                                                    <label class="form-check-label" for="toneFriendly">
                                                        Дружелюбный
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tone" id="toneEmpathetic">
                                                    <label class="form-check-label" for="toneEmpathetic">
                                                        Эмпатичный
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Создать аватара</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Добавить базу знаний</h5>
                                        <p class="text-muted">Загрузите документы для обучения аватара</p>
                                        <div class="mb-3">
                                            <label for="knowledgeFiles" class="form-label">Файлы (PDF, DOC, TXT)</label>
                                            <input class="form-control" type="file" id="knowledgeFiles" multiple>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary">Загрузить файлы</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card dashboard-card mt-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Интеграция с DeepSeek</h5>
                                        <div class="deepseek-integration">
                                            <i class="bi bi-lightning-charge fs-1 mb-2"></i>
                                            <p class="mb-2">Подключите API DeepSeek для повышения качества ответов</p>
                                            <div class="mb-3">
                                                <label for="apiKey" class="form-label">API ключ</label>
                                                <input type="password" class="form-control" id="apiKey" placeholder="Введите ваш API ключ">
                                            </div>
                                            <button class="btn btn-primary">Подключить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Мои аватары -->
                    <div id="dashboard-avatars" class="dashboard-section" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Мои ИИ-аватары</h2>
                            <button class="btn btn-primary" onclick="showDashboardSection('create-avatar')"><i class="bi bi-plus-circle me-2"></i>Создать аватара</button>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card avatar-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="avatar-preview mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                                                    <i class="bi bi-robot"></i>
                                                </div>
                                                <h5>Психолог-консультант</h5>
                                                <p class="text-muted">Общая психология</p>
                                            </div>
                                            <span class="badge bg-success">Активен</span>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-sm">Запустить</button>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="showDashboardSection('avatar-settings')">Настроить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="card avatar-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="avatar-preview mb-3" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(45deg, #ff9a9e, #fad0c4);">
                                                    <i class="bi bi-robot"></i>
                                                </div>
                                                <h5>Бизнес-коуч</h5>
                                                <p class="text-muted">Развитие бизнеса</p>
                                            </div>
                                            <span class="badge bg-warning">Обучение</span>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-outline-primary btn-sm">Запустить</button>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="showDashboardSection('avatar-settings')">Настроить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="card avatar-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="avatar-preview mb-3" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(45deg, #a1c4fd, #c2e9fb);">
                                                    <i class="bi bi-robot"></i>
                                                </div>
                                                <h5>Детский психолог</h5>
                                                <p class="text-muted">Детская психология</p>
                                            </div>
                                            <span class="badge bg-secondary">Неактивен</span>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-outline-primary btn-sm">Запустить</button>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="showDashboardSection('avatar-settings')">Настроить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Настройки аватара -->
                    <div id="dashboard-avatar-settings" class="dashboard-section" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Настройки аватара: Психолог-консультант</h2>
                            <button class="btn btn-outline-secondary" onclick="showDashboardSection('avatars')">Назад</button>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card dashboard-card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Основные настройки</h5>
                                        <form>
                                            <div class="mb-3">
                                                <label for="editAvatarName" class="form-label">Название аватара</label>
                                                <input type="text" class="form-control" id="editAvatarName" value="Психолог-консультант">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editAvatarDescription" class="form-label">Описание</label>
                                                <textarea class="form-control" id="editAvatarDescription" rows="3">ИИ-ассистент для первичной психологической консультации</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editAvatarSpecialization" class="form-label">Специализация</label>
                                                <select class="form-select" id="editAvatarSpecialization">
                                                    <option>Общая психология</option>
                                                    <option selected>Клиническая психология</option>
                                                    <option>Бизнес-коучинг</option>
                                                    <option>Лайф-коучинг</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">База знаний</h5>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Название файла</th>
                                                        <th>Дата загрузки</th>
                                                        <th>Статус</th>
                                                        <th>Действия</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Психология общения.pdf</td>
                                                        <td>12.03.2023</td>
                                                        <td><span class="badge bg-success">Обработан</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Техники терапии.docx</td>
                                                        <td>10.03.2023</td>
                                                        <td><span class="badge bg-success">Обработан</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Методики диагностики.txt</td>
                                                        <td>08.03.2023</td>
                                                        <td><span class="badge bg-warning">Обработка</span></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-danger">Удалить</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3">
                                            <label for="newKnowledgeFile" class="form-label">Добавить новый файл</label>
                                            <input class="form-control" type="file" id="newKnowledgeFile">
                                            <button class="btn btn-outline-primary mt-2">Загрузить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card dashboard-card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Статистика</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Всего консультаций
                                                <span class="badge bg-primary rounded-pill">124</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Уникальные клиенты
                                                <span class="badge bg-primary rounded-pill">87</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Средняя оценка
                                                <span class="badge bg-success rounded-pill">4.8</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Время ответа
                                                <span class="badge bg-info rounded-pill">2.3с</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Управление</h5>
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success">Запустить аватара</button>
                                            <button class="btn btn-warning">Переобучить</button>
                                            <button class="btn btn-danger">Удалить аватара</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Интеграции -->
                    <div id="dashboard-integrations" class="dashboard-section" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Интеграции</h2>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Telegram</h5>
                                        <p class="text-muted">Подключение через Telegram-бот</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input" type="checkbox" id="telegramSwitch">
                                                <label class="form-check-label" for="telegramSwitch">Активировать</label>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm">Настроить</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Токен бота</label>
                                            <input type="text" class="form-control" placeholder="Введите токен Telegram-бота">
                                        </div>
                                        <button class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">WhatsApp</h5>
                                        <p class="text-muted">Подключение через WhatsApp Business API</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input" type="checkbox" id="whatsappSwitch">
                                                <label class="form-check-label" for="whatsappSwitch">Активировать</label>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm">Настроить</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Номер телефона</label>
                                            <input type="text" class="form-control" placeholder="Введите номер WhatsApp">
                                        </div>
                                        <button class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">ВКонтакте</h5>
                                        <p class="text-muted">Интеграция с сообществами ВКонтакте</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input" type="checkbox" id="vkSwitch">
                                                <label class="form-check-label" for="vkSwitch">Активировать</label>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm">Настроить</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ID сообщества</label>
                                            <input type="text" class="form-control" placeholder="Введите ID сообщества ВКонтакте">
                                        </div>
                                        <button class="btn btn-primary">Сохранить</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Веб-чат</h5>
                                        <p class="text-muted">Виджет для вашего сайта</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="form-check form-switch me-3">
                                                <input class="form-check-input" type="checkbox" id="webchatSwitch" checked>
                                                <label class="form-check-label" for="webchatSwitch">Активировать</label>
                                            </div>
                                            <button class="btn btn-outline-primary btn-sm">Настроить</button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Код виджета</label>
                                            <textarea class="form-control" rows="3" readonly><script src="https://yavatar.ru/widget.js" data-avatar="psychologist-assistant"></script></textarea>
                                        </div>
                                        <button class="btn btn-primary">Скопировать код</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Админка -->
    <div id="admin-page" class="page">
        <div class="admin-sidebar">
            <div class="text-center mb-4">
                <h4 class="text-white">Админ-панель</h4>
            </div>
            <nav>
                <a href="#" class="admin-nav-link active" onclick="showAdminSection('overview')">Обзор</a>
                <a href="#" class="admin-nav-link" onclick="showAdminSection('users')">Пользователи</a>
                <a href="#" class="admin-nav-link" onclick="showAdminSection('avatars')">Аватары</a>
                <a href="#" class="admin-nav-link" onclick="showAdminSection('database')">База данных</a>
                <a href="#" class="admin-nav-link" onclick="showAdminSection('api')">API</a>
                <a href="#" class="admin-nav-link" onclick="showAdminSection('settings')">Настройки</a>
                <a href="#" class="admin-nav-link" onclick="showPage('landing')">Выйти</a>
            </nav>
        </div>
        
        <div class="admin-content">
            <!-- Обзор -->
            <div id="admin-overview" class="admin-section active">
                <h2>Административная панель</h2>
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Пользователи</h5>
                                <h3>1,248</h3>
                                <p class="text-success">+12% за месяц</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Аватары</h5>
                                <h3>3,421</h3>
                                <p class="text-success">+8% за месяц</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Консультации</h5>
                                <h3>24,567</h3>
                                <p class="text-success">+15% за месяц</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Доход</h5>
                                <h3>1,245,000₽</h3>
                                <p class="text-success">+22% за месяц</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5>Активность пользователей</h5>
                                <canvas id="activityChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Тарифы</h5>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Стартовый
                                        <span class="badge bg-primary rounded-pill">842</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Профессиональный
                                        <span class="badge bg-primary rounded-pill">356</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Корпоративный
                                        <span class="badge bg-primary rounded-pill">50</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Пользователи -->
            <div id="admin-users" class="admin-section" style="display: none;">
                <h2>Управление пользователями</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Список пользователей</h5>
                            <button class="btn btn-primary">Добавить пользователя</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Специализация</th>
                                        <th>Дата регистрации</th>
                                        <th>Статус</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1001</td>
                                        <td>Анна Петрова</td>
                                        <td>anna@example.com</td>
                                        <td>Психолог</td>
                                        <td>12.01.2023</td>
                                        <td><span class="badge bg-success">Активен</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Редактировать</button>
                                            <button class="btn btn-sm btn-outline-danger">Блокировать</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1002</td>
                                        <td>Михаил Сидоров</td>
                                        <td>mikhail@example.com</td>
                                        <td>Бизнес-коуч</td>
                                        <td>15.01.2023</td>
                                        <td><span class="badge bg-success">Активен</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Редактировать</button>
                                            <button class="btn btn-sm btn-outline-danger">Блокировать</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1003</td>
                                        <td>Елена Козлова</td>
                                        <td>elena@example.com</td>
                                        <td>Клинический психолог</td>
                                        <td>20.01.2023</td>
                                        <td><span class="badge bg-warning">Ожидает подтверждения</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Редактировать</button>
                                            <button class="btn btn-sm btn-outline-success">Подтвердить</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- База данных -->
            <div id="admin-database" class="admin-section" style="display: none;">
                <h2>Управление базой данных</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card database-table mb-4">
                            <div class="card-header">
                                <h5>Таблица пользователей</h5>
                            </div>
                            <div class="card-body">
                                <pre class="bg-light p-3 rounded">
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    specialization VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card database-table mb-4">
                            <div class="card-header">
                                <h5>Таблица аватаров</h5>
                            </div>
                            <div class="card-body">
                                <pre class="bg-light p-3 rounded">
CREATE TABLE avatars (
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES users(id),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    specialization VARCHAR(100),
    api_key VARCHAR(255),
    status VARCHAR(50) DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card database-table">
                            <div class="card-header">
                                <h5>Таблица консультаций</h5>
                            </div>
                            <div class="card-body">
                                <pre class="bg-light p-3 rounded">
CREATE TABLE consultations (
    id SERIAL PRIMARY KEY,
    avatar_id INTEGER REFERENCES avatars(id),
    client_name VARCHAR(255),
    client_email VARCHAR(255),
    start_time TIMESTAMP,
    end_time TIMESTAMP,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card database-table">
                            <div class="card-header">
                                <h5>Таблица знаний</h5>
                            </div>
                            <div class="card-body">
                                <pre class="bg-light p-3 rounded">
CREATE TABLE knowledge_base (
    id SERIAL PRIMARY KEY,
    avatar_id INTEGER REFERENCES avatars(id),
    file_name VARCHAR(255),
    file_path VARCHAR(500),
    status VARCHAR(50) DEFAULT 'processing',
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- API -->
            <div id="admin-api" class="admin-section" style="display: none;">
                <h2>API Документация</h2>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>Аутентификация</h5>
                        <p>Все API вызовы требуют аутентификации через API ключ в заголовке запроса.</p>
                        <pre class="bg-light p-3 rounded">
Authorization: Bearer YOUR_API_KEY</pre>
                    </div>
                </div>
                
                <div class="api-endpoint">
                    <h5>POST /api/v1/avatars</h5>
                    <p>Создание нового ИИ-аватара</p>
                    <pre class="bg-light p-3 rounded">
{
  "name": "string",
  "description": "string",
  "specialization": "string",
  "tone": "professional|friendly|empathetic"
}</pre>
                    <p><strong>Ответ:</strong> 201 Created</p>
                </div>
                
                <div class="api-endpoint">
                    <h5>POST /api/v1/avatars/{id}/knowledge</h5>
                    <p>Добавление знаний в базу аватара</p>
                    <pre class="bg-light p-3 rounded">
{
  "content": "string",
  "source": "string"
}</pre>
                    <p><strong>Ответ:</strong> 200 OK</p>
                </div>
                
                <div class="api-endpoint">
                    <h5>POST /api/v1/avatars/{id}/chat</h5>
                    <p>Отправка сообщения аватару</p>
                    <pre class="bg-light p-3 rounded">
{
  "message": "string",
  "client_id": "string"
}</pre>
                    <p><strong>Ответ:</strong> 200 OK</p>
                </div>
                
                <div class="api-endpoint">
                    <h5>GET /api/v1/avatars/{id}/stats</h5>
                    <p>Получение статистики аватара</p>
                    <p><strong>Ответ:</strong> 200 OK</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Переключение страниц
        function showPage(pageId) {
            // Скрыть все страницы
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Показать нужную страницу
            document.getElementById(`${pageId}-page`).classList.add('active');
            
            // Для дашборда показать обзор по умолчанию
            if(pageId === 'dashboard') {
                showDashboardSection('overview');
            }
            
            // Для админки показать обзор по умолчанию
            if(pageId === 'admin') {
                showAdminSection('overview');
            }
        }
        
        // Переключение секций дашборда
        function showDashboardSection(sectionId) {
            // Скрыть все секции
            document.querySelectorAll('.dashboard-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Показать нужную секцию
            document.getElementById(`dashboard-${sectionId}`).style.display = 'block';
        }
        
        // Переключение секций админки
        function showAdminSection(sectionId) {
            // Скрыть все секции
            document.querySelectorAll('.admin-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Показать нужную секцию
            document.getElementById(`admin-${sectionId}`).style.display = 'block';
        }
        
        // Обработка форм
        document.addEventListener('DOMContentLoaded', function() {
            // Форма регистрации
            const registerForm = document.getElementById('registerForm');
            if(registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Регистрация успешна! В реальном приложении вы бы перешли на дашборд.');
                    showPage('dashboard');
                });
            }
            
            // Форма входа
            const loginForm = document.getElementById('loginForm');
            if(loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Вход выполнен! В реальном приложении вы бы перешли на дашборд.');
                    showPage('dashboard');
                });
            }
            
            // Инициализация графика активности
            const ctx = document.getElementById('activityChart');
            if(ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн'],
                        datasets: [{
                            label: 'Активные пользователи',
                            data: [1200, 1900, 1500, 2200, 1800, 2400],
                            borderColor: '#6a11cb',
                            backgroundColor: 'rgba(106, 17, 203, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
