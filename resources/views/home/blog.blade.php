<!-- ====== بخش وبلاگ ====== -->
@if($posts->count() > 0)
<section class="section" id="blog">
    <div class="container">
        <div class="sec-top fade-up">
            <div>
                <p class="sec-eyebrow">وبلاگ</p>
                <h2>آخرین نوشته‌ها و رویدادهای هنری</h2>
            </div>
            <a href="#" style="font-size:0.85rem; color:var(--blue); text-decoration:none; border-bottom:1px solid var(--ice);">مشاهده همه ←</a>
        </div>

        {{-- دسته‌بندی --}}
        <div class="blog-categories fade-up">
            <button class="cat-btn active" data-category="all">همه</button>
            @foreach($services as $service)
                <button class="cat-btn" data-category="{{ $service->id }}">{{ $service->title }}</button>
            @endforeach
        </div>

        {{-- باکس اسکرول‌دار --}}
        <div class="blog-feed-wrapper fade-up">
            <div class="blog-feed" id="blogFeed">
                @foreach($posts as $post)
                    <article class="post-card" data-category="{{ $post->service_id }}">
                        <div class="thumb">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" loading="lazy" />
                            @else
                                <div style="width:100%; height:100%; background: linear-gradient(135deg, #e8edf4, #d6e8f7); display:flex; align-items:center; justify-content:center; color:#8a9bb5; font-size:2rem;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            @if($post->is_featured)
                                <span class="badge"><i class="fas fa-star"></i> ویژه</span>
                            @endif
                        </div>
                        <div class="body">
                            <div class="meta">
                                <span class="date"><i class="far fa-calendar-alt"></i> {{ \Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/m/d') }}</span>
                                <span class="category"><i class="fas fa-tag"></i> {{ $post->service->title ?? 'دسته‌بندی نشده' }}</span>
                            </div>
                            <h3>{{ $post->title }}</h3>
                            <p>{{ Str::limit($post->excerpt ?? strip_tags($post->content), 80) }}</p>
                            <div class="footer-meta">
                                <span class="read-time"><i class="far fa-clock"></i> {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} دقیقه</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    /* ====== وبلاگ ====== */
    #blog {
        background: #f0f5fb;
        padding: 60px 0;
    }

    #blog .sec-eyebrow {
        color: var(--blue, #1B4E8A);
    }

    #blog h2 {
        color: var(--navy, #0D1F3C);
    }

    /* ====== دسته‌بندی ====== */
    .blog-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        justify-content: center;
    }

    .blog-categories .cat-btn {
        background: transparent;
        border: 1px solid #c8d6e8;
        color: #4a6a85;
        padding: 0.3rem 1rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: 0.3s ease;
    }

    .blog-categories .cat-btn:hover {
        border-color: #c9a84c;
        color: #0b1a2e;
    }

    .blog-categories .cat-btn.active {
        background: #c9a84c;
        border-color: #c9a84c;
        color: #fff;
    }

    /* ====== باکس اسکرول‌دار ====== */
    .blog-feed-wrapper {
        position: relative;
        max-height: 520px;
        overflow-y: auto;
        padding: 0 4px 4px;
        direction: rtl;
        border-radius: 12px;
        /* برای زیبایی */
        scroll-behavior: smooth;
    }

    /* اسکرول بار سفارشی */
    .blog-feed-wrapper::-webkit-scrollbar {
        width: 5px;
    }

    .blog-feed-wrapper::-webkit-scrollbar-track {
        background: #e8edf4;
        border-radius: 10px;
    }

    .blog-feed-wrapper::-webkit-scrollbar-thumb {
        background: #c9a84c;
        border-radius: 10px;
    }

    .blog-feed {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    /* ====== کارت پست: عکس چپ، متن راست ====== */
    .post-card {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e8edf4;
        overflow: hidden;
        transition: 0.3s ease;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        min-height: 100px;
        flex-shrink: 0;
    }

    .post-card:hover {
        transform: translateY(-2px);
        border-color: #c9a84c;
        box-shadow: 0 4px 16px rgba(11, 26, 46, 0.06);
    }

    /* عکس سمت چپ */
    .post-card .thumb {
        width: 100px;
        min-width: 100px;
        height: auto;
        min-height: 100px;
        background: #e8edf4;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
        order: 1;
    }

    .post-card .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .post-card .thumb .badge {
        position: absolute;
        bottom: 4px;
        left: 4px;
        background: rgba(11, 26, 46, 0.8);
        backdrop-filter: blur(4px);
        padding: 0.05rem 0.5rem;
        border-radius: 30px;
        font-size: 0.45rem;
        font-weight: 700;
        color: #e8d08a;
        border: 1px solid rgba(201,168,76,0.2);
    }

    .post-card .thumb .badge i {
        margin-left: 0.2rem;
    }

    /* متن سمت راست */
    .post-card .body {
        padding: 0.5rem 0.8rem 0.5rem 0.8rem;
        display: flex;
        flex-direction: column;
        flex: 1;
        order: 2;
        min-width: 0;
    }

    .post-card .body .meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.2rem 0.5rem;
        margin-bottom: 0.2rem;
        font-size: 0.55rem;
        color: #6a7f9a;
    }

    .post-card .body .meta .category {
        background: #f0f5fb;
        padding: 0.05rem 0.5rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.45rem;
        color: #1a5a8a;
        border: 1px solid #e0e8f0;
    }

    .post-card .body .meta .category i {
        margin-left: 0.2rem;
        color: #c9a84c;
        font-size: 0.45rem;
    }

    .post-card .body h3 {
        font-size: 0.8rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.2rem;
        color: #0b1a2e;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-card .body p {
        color: #4a6a85;
        font-size: 0.65rem;
        line-height: 1.4;
        margin-bottom: 0.2rem;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-card .body .footer-meta {
        display: flex;
        align-items: center;
        padding-top: 0.2rem;
        border-top: 1px solid #e8edf4;
        gap: 0.5rem;
        font-size: 0.55rem;
        color: #6a7f9a;
    }

    .post-card .body .footer-meta .read-time i {
        color: #c9a84c;
        margin-left: 0.3rem;
    }

    /* ====== دسکتاپ ====== */
    @media (min-width: 768px) {
        .blog-feed-wrapper {
            max-height: 580px;
        }

        .post-card {
            min-height: 140px;
            border-radius: 14px;
        }

        .post-card .thumb {
            width: 180px;
            min-width: 180px;
            min-height: 140px;
        }

        .post-card .body {
            padding: 0.8rem 1.2rem 0.8rem 1rem;
        }

        .post-card .body h3 {
            font-size: 1rem;
        }

        .post-card .body p {
            font-size: 0.8rem;
        }

        .post-card .body .meta {
            font-size: 0.7rem;
        }

        .post-card .body .footer-meta {
            font-size: 0.7rem;
        }

        .post-card .thumb .badge {
            font-size: 0.55rem;
            padding: 0.1rem 0.7rem;
        }

        .blog-categories .cat-btn {
            font-size: 0.8rem;
            padding: 0.4rem 1.2rem;
        }
    }

    /* ====== موبایل ====== */
    @media (max-width: 400px) {
        .blog-feed-wrapper {
            max-height: 400px;
        }

        .post-card .thumb {
            width: 80px;
            min-width: 80px;
            min-height: 80px;
        }

        .post-card .body h3 {
            font-size: 0.7rem;
        }

        .post-card .body p {
            font-size: 0.55rem;
        }

        .post-card .body .meta {
            font-size: 0.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.cat-btn');
        const posts = document.querySelectorAll('.post-card');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const category = this.dataset.category;

                posts.forEach(post => {
                    const postCategory = post.dataset.category;
                    if (category === 'all' || postCategory == category) {
                        post.style.display = 'flex';
                    } else {
                        post.style.display = 'none';
                    }
                });

                // ریست اسکرول به بالا بعد از فیلتر
                const wrapper = document.querySelector('.blog-feed-wrapper');
                if (wrapper) {
                    wrapper.scrollTop = 0;
                }
            });
        });
    });
</script>
@endif