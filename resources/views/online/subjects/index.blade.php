@extends('online.default', ['body_class' => 'subject', 'title' => 'Temas' ])

@section('page-content')
<div class="container">
    <div class="page-title mb-4">
        <h1 class="mb-0">Mis temas</h1>
    </div>
    <div class="row">
         <div class="col-md-12">
            <ul class="list-unstyled list-subjects card-group justify-content-center">
    	     @foreach($subjects as $item)
                <li class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('subjectDetail', [$item->slug]) }}" class="card-link">{{ $item->title }}</a></h5>
                        <p class="card-text">{!! substr(strip_tags($item->description), 0, 100) !!}</p>
                        <span class="badge badge-purple py-1 px-2">{{$item->course_title}}</span>
                    </div>
                </li>
             @endforeach
         </ul>
         </div>
     </div>
</div>
@endsection