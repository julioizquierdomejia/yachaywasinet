@extends('online.default', ['body_class' => 'course_detail', 'title' => 'Curso | '.$course->title ])

@section('page-content')
<div class="container">
    <nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="/cursos">Cursos</a></li>
	    <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
	  </ol>
	</nav>
    <div class="page-title mb-4">
        <h1 class="mb-0">{{ $course->title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
        	<div class="competence">{!! $course->competence !!}</div>
        	@if($subjects->count())
        	<div class="subjects row">
        		<div class="col col-md-6">
        			<h4>Temas</h4>
		        	<div class="subjects-list list-group">
		        		@foreach($subjects as $item)
		        		<a class="list-group-item list-group-item-action" href="{{route('subjectDetail', ['slug'=>$item->slug])}}">{{$item->title}}</a>
		        		@endforeach
		        	</div>
        		</div>
        	</div>
        	@endif
        </div>
     </div>
</div>
@endsection