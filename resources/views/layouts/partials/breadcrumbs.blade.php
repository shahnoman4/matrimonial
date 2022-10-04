@if (count($breadcrumbs))
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
              @if($breadcrumb->title=="Dashboard")  
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}"><span class="fa fa-dashboard"></span> Dashboard</a></li>
              @else 
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
              @endif
            @else                
                @if($breadcrumb->title=="Dashboard")  
                  <li class="breadcrumb-item active"><span class="fa fa-dashboard"></span> Dashboard</li>
                @else 
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif
            @endif

        @endforeach
    </ol>
@endif