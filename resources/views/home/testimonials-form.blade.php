<!-- ====== فرم ثبت نظر ====== -->
<section class="section" id="testimonial-form">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">نظرات شما</p>
                <h2>تجربه‌تون رو با ما به اشتراک بذارید</h2>
            </div>
            <p class="sec-desc">نظر شما برای ما ارزشمند است و به بهبود کارمون کمک میکنه.</p>
        </div>

        <div class="testimonial-form-wrapper fade-up">
            @if(session('testimonial_success'))
                <div class="alert alert-success">
                    ✅ {{ session('testimonial_success') }}
                </div>
            @endif

            <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="testimonial-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">نام و نام خانوادگی *</label>
                        <input type="text" id="name" name="name" class="form-control" required placeholder="مثلاً علی محمدی">
                    </div>
                    <div class="form-group">
                        <label for="avatar">عکس پروفایل (اختیاری)</label>
                        <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <label>امتیاز شما *</label>
                    <div class="rating-input">
						@for($i = 5; $i >= 1; $i--)
							<input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
							<label for="star{{ $i }}" title="{{ $i }} ستاره">☆</label>
						@endfor
					</div>
                </div>

                <div class="form-group">
                    <label for="comment">متن نظر *</label>
                    <textarea id="comment" name="comment" class="form-control" rows="4" required placeholder="نظر خود را بنویسید..."></textarea>
                </div>

                <button type="submit" class="btn-gold">📨 ارسال نظر</button>
            </form>
        </div>
    </div>
</section>