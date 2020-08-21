@extends('online.default', ['body_class' => 'course', 'title' => 'Cursos' ])

@section('page-content')
<div class="container">
    <div class="page-title mb-4">
        <h1 class="mb-0">Mis cursos</h1>
    </div>
    <div class="row">
         <div class="col-md-12">
            <ul class="list-unstyled list-courses card-group">
    	     @foreach($courses as $item)
                <li class="card">
                    <div class="card-body text-center p-0">
                        <a class="card-link p-3 py-md-4 px-md-2 btn btn-block" href="{{ route('courseDetail', [$item->slug]) }}">{{ $item->title }}</a>
                    </div>
                </li>
             @endforeach
         </ul>
         </div>
     </div>
</div>
@endsection