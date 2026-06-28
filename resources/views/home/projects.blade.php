<!-- ====== PROJECTS ====== -->
<section class="section" id="projects">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">نمونه‌کارها</p>
                <h2>پروژه‌های انجام شده</h2>
            </div>
            <a href="#" style="font-size:0.85rem; color:var(--blue); text-decoration:none; border-bottom:1px solid var(--ice);">مشاهده همه ←</a>
        </div>

        <div class="gallery-flex fade-up">
            @forelse($projects as $index => $project)
                @php
                    // چرخه‌ای برای انتخاب کلاس‌های مختلف
                    $classes = ['g1', 'g2', 'g3', 'g4', 'g5', 'g6'];
                    $class = $classes[$index % 6];
                @endphp
                <div class="gi">
                    <div class="gi-inner {{ $class }}" 
                         style="background: {{ $project->image ? 'url('.asset('storage/'.$project->image).') center/cover no-repeat' : 'linear-gradient(145deg, #1a3350, #2a4a6a)' }};">
                        <span class="gi-lbl">{{ $project->category }}</span>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align:center; padding:60px 0; color:#6a7f9a;">
                    <p style="font-size:18px;">📍 هنوز پروژه‌ای ثبت نشده است</p>
                    <p style="font-size:14px; margin-top:8px;">از پنل ادمین پروژه جدید اضافه کنید</p>
                </div>
            @endforelse
        </div>
    </div>
</section>