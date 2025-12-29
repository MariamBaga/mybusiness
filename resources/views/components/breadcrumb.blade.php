<!-- ht breadcrumb area start -->
<section class="ht-breadcrumb-area">
    <div class="container">
        <div class="ht-breadcrumb-heading">
            <h2 class="ht-breadcrumb-title">{{ $title }}</h2>
            <ul class="ht-breadcrumb-list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa-solid fa-chevron-right"></i></li>
                <li class="active">{{ $active }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- ht breadcrumb area end -->
