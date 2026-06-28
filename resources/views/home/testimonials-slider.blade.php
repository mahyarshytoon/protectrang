<!-- ====== اسلایدر نظرات ====== -->
@if($testimonials->count() > 0)
<section class="section" id="testimonials" style="background: #f8fafc;">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">نظرات مشتریان</p>
                <h2>آن‌هایی که به ما اعتماد کردند</h2>
            </div>
        </div>

        <div class="testimonial-slider fade-up">
            <div class="slider-track">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            @if($testimonial->avatar)
                                <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                            @else
                                <span>{{ substr($testimonial->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="testimonial-stars">
                            {!! str_repeat('⭐', $testimonial->rating) !!}
                        </div>
                        <p class="testimonial-text">"{{ $testimonial->comment }}"</p>
                        <div class="testimonial-author">
                            <strong>{{ $testimonial->name }}</strong>
                            <span class="testimonial-date">
								{{ \Hekmatinasser\Verta\Verta::instance($testimonial->created_at)->format('Y/m/d') }}                            </span>
                            @if($testimonial->reply)
                                <div class="testimonial-reply">
                                    <strong>پاسخ:</strong> {{ $testimonial->reply }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif