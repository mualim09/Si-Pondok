@unless ($breadcrumbs->isEmpty())
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 d-flex align-items-center gap-2">
            <a href="{{url()->previous()}}">
                <i class="ri-arrow-go-back-line bg-light rounded-circle p-2"></i>
            </a>
            {{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Fallback Title' }}
        </h4>
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach
            </ol>
        </div>

    </div>
@endunless
