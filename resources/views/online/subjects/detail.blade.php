@extends('online.default', ['body_class' => 'subject_detail', 'title' => 'Tema | '.$subject->title ])

@section('page-content')
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/temas">Temas</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $subject->title }}</li>
      </ol>
    </nav>
    <div class="page-title mb-4">
        <h1 class="mb-0"> {{ $subject->title }}</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="description">{!! $subject->description !!}</div>
        <div class="subject-media">
            @php
            $file_url = $subject->getMedia('file');
            @endphp
            @if($file_url->count())
            <div class="file mb-3">
                @php
                $media = $file_url[0]->getUrl();
                @endphp
                @if(pathinfo($media)['extension'] == 'pdf')
                <a class="btn btn-light mb-3" download="{{ str_replace(' ', '_',$subject->title) }}" href="{{$media}}"><i class="fa fa-file-pdf mr-3 text-danger"></i>Descargar contenido</a>
                @endif
            </div>
            @endif
        </div>
        </div>
     </div>
</div>
@endsection