<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'نقاش ساختمان حرفه‌ای')</title>

    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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

				// ====== اسلایدر افقی ======
				if (document.querySelector('.horizontal-swiper')) {
					new Swiper('.horizontal-swiper', {
						slidesPerView: 1,
						spaceBetween: 24,
						loop: true,
						centeredSlides: false,
						pagination: {
							el: '.horizontal-pagination',
							clickable: true,
							dynamicBullets: true,
						},
						navigation: {
							nextEl: '.horizontal-next',
							prevEl: '.horizontal-prev',
						},
						breakpoints: {
							640: {
								slidesPerView: 1.2,
								spaceBetween: 20,
							},
							768: {
								slidesPerView: 2,
								spaceBetween: 24,
							},
							1024: {
								slidesPerView: 3,
								spaceBetween: 28,
							},
						},
						// ====== تنظیمات خودکار ======
						autoplay: {
							delay: 1000,          // 4 ثانیه (4000 میلی‌ثانیه)
							disableOnInteraction: false,  // با کلیک دستی متوقف نشه
							pauseOnMouseEnter: true,      // با هاور کردن متوقف بشه
						},
						speed: 1000,               // سرعت حرکت اسلاید (میلی‌ثانیه)
						grabCursor: true,         // نشانگر دستی برای کشیدن
						simulateTouch: true,      // قابلیت کشیدن با موس یا انگشت
						keyboard: {               // کنترل با کیبورد
							enabled: true,
							onlyInViewport: true,
						},
					});
				}
						});
    </script>

    @stack('scripts')
</body>
</html>