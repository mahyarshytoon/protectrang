<!-- ====== SERVICES ====== -->
<section class="section" id="services">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">تخصص ما</p>
                <h2>خدمات جامع<br>پوشش سطح ساختمان</h2>
            </div>
            <p class="sec-desc">از اجرای میکروسمنت برای فضاهای مدرن تا پتینه‌کاری هنری برای دکوراسیون کلاسیک — هر سلیقه‌ای راه‌حل دارد.</p>
        </div>

        <div class="services-list fade-up">
            @forelse($services as $index => $service)
                <div class="srv {{ $loop->first ? 'highlight' : '' }}">
                    <div class="srv-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="srv-info">
                        <h3>{{ $service->icon }} {{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                    @if($service->badge)
                        <span class="srv-badge">{{ $service->badge }}</span>
                    @endif
                </div>
            @empty
                <div style="text-align:center; padding:40px 0; color:#6a7f9a;">
                    <p>📍 هنوز تخصصی ثبت نشده است</p>
                </div>
            @endforelse
        </div>
    </div>
</section>