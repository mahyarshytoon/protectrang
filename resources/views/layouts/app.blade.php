<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'نقاش ساختمان حرفه‌ای')</title>

    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        // ====== منوی همبرگر ======
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const body = document.body;

            if (hamburgerBtn) {
                hamburgerBtn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (mobileMenu) mobileMenu.classList.toggle('active');
                    body.classList.toggle('menu-open');
                });
            }

            // بستن منو با کلیک روی لینک‌ها
            document.querySelectorAll('.mobile-menu a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if (hamburgerBtn) hamburgerBtn.classList.remove('active');
                    if (mobileMenu) mobileMenu.classList.remove('active');
                    body.classList.remove('menu-open');
                });
            });

            // ====== اسکرول انیمیشن (Fade-up) ======
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry, index) {
                    if (entry.isIntersecting) {
                        setTimeout(function() {
                            entry.target.classList.add('visible');
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.fade-up').forEach(function(el) {
                observer.observe(el);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>