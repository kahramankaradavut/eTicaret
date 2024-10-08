@extends('backend.layout.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Pageseo</h4>

                @if ($errors)
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                    @endforeach
                @endif
                @if (session()->get('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
                @endif


                @if (!empty($pageseo->id))
                @php
                        $routelink = route('panel.pageseo.update',$pageseo->id);

                @endphp
                @else
                    @php
                        $routelink = route('panel.pageseo.store');
                    @endphp
                @endif
                <form action="{{$routelink}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($pageseo->id))
                        @method('PUT')
                    @endif

                <div class="form-group">
                    <label for="name">Dil</label>
                    <input type="text" class="form-control" id="dil" name="dil" value="{{$pageseo->dil ?? 'tr'}}" placeholder="Dil">
                </div>
                  <div class="form-group">
                    <label for="name">SayfaUrl</label>
                    <input type="text" class="form-control" id="page" name="page" value="{{$pageseo->page ?? ''}}" placeholder="Page Başlık">
                  </div>

                  <div class="form-group">
                    <label for="link">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$pageseo->title ?? ''}}" placeholder="Title">
                  </div>

                  <div class="form-group">
                    <label for="link">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$pageseo->description ?? ''}}" placeholder="Title">
                  </div>

                  <div class="form-group">
                    <label for="link">Keywords</label>
                    <input type="text" class="form-control" id="keywords" name="keywords" value="{{$pageseo->keywords ?? ''}}" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="slogan">İçerik kısa yazı</label>
                    <textarea class="form-control" id="contents" name="contents" placeholder="Content" rows="3">{!! $pageseo->contents ?? '' !!}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection
