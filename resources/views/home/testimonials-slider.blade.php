<!-- ====== اسلایدر نظرات (افقی - دقیقاً مشابه فایل HTML شما) ====== -->
@if($testimonials->count() > 0)
<section class="section" id="testimonials" style="background: #f4f7fc; padding: 60px 0;">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">نظرات مشتریان</p>
                <h2>آن‌هایی که به ما اعتماد کردند</h2>
            </div>
        </div>

        <div class="slider-wrapper fade-up" style="background: #ffffff; border-radius: 28px; box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12); padding: 30px 20px 40px; transition: all 0.2s;">
            <div class="swiper horizontal-swiper" style="padding: 10px 4px 30px; overflow: hidden;">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide" style="height: auto;">
                            <div class="testimonial-card" style="background: #fafcff; border-radius: 24px; padding: 24px 20px 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04); border: 1px solid #eef2f6; height: 100%; display: flex; flex-direction: column; transition: 0.2s;">
                                
                                <!-- هدر کارت: عکس + نام + تاریخ -->
                                <div class="card-header" style="display: flex; align-items: center; gap: 14px; margin-bottom: 14px;">
                                    <div class="avatar" style="width: 56px; height: 56px; border-radius: 50%; overflow: hidden; border: 2px solid #e2e8f0; flex-shrink: 0; background: #e2e8f0;">
                                        @if($testimonial->avatar)
                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 20px; font-weight: 700; color: #64748b;">{{ substr($testimonial->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="user-info" style="flex: 1;">
                                        <div class="user-name" style="font-weight: 600; font-size: 1.05rem; color: #0f172a;">{{ $testimonial->name }}</div>
                                        <div class="user-date" style="font-size: 0.8rem; color: #64748b; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                                            <i class="far fa-calendar-alt" style="font-size: 0.7rem;"></i>
                                            {{ \Hekmatinasser\Verta\Verta::instance($testimonial->created_at)->format('d F Y') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- متن نظر -->
                                <div class="comment-text" style="font-size: 0.95rem; line-height: 1.6; color: #1e293b; margin: 6px 0 14px; flex: 1;">
                                    "{{ $testimonial->comment }}"
                                </div>

                                <!-- بخش پاسخ (اگر وجود داشته باشد) -->
                                @if($testimonial->reply)
                                <div class="reply-box" style="background: #f1f5f9; border-radius: 16px; padding: 14px 16px; margin-top: 6px; border-right: 4px solid #3b82f6;">
                                    <div class="reply-header" style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                                        <div class="reply-avatar" style="width: 32px; height: 32px; border-radius: 50%; background: #cbd5e1; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; color: #0f172a;">
                                            <i class="fas fa-reply" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="reply-name" style="font-weight: 500; font-size: 0.85rem; color: #0f172a;">
                                            <i class="fas fa-reply" style="color: #3b82f6; margin-left: 4px; font-size: 0.75rem;"></i> پاسخ
                                        </span>
                                    </div>
                                    <div class="reply-text" style="font-size: 0.9rem; color: #1e293b; line-height: 1.5; padding-right: 42px;">
                                        {{ $testimonial->reply }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination horizontal-pagination"></div>
                <div class="swiper-button-next horizontal-next" style="color: #3b82f6; background: #ffffff; width: 44px; height: 44px; border-radius: 50%; box-shadow: 0 6px 16px rgba(59, 130, 246, 0.18); border: 1px solid #e2e8f0; transition: 0.2s;"></div>
                <div class="swiper-button-prev horizontal-prev" style="color: #3b82f6; background: #ffffff; width: 44px; height: 44px; border-radius: 50%; box-shadow: 0 6px 16px rgba(59, 130, 246, 0.18); border: 1px solid #e2e8f0; transition: 0.2s;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome (برای آیکون‌ها) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
@endif