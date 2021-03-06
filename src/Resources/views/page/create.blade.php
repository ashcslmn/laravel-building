@extends('laravel-building::main')

@section('content')
    @constituent('laravel-building::partial.resource-page-title', [
        'icon' => 'fas fa-file-alt',
        'title' => 'Pages'
    ])
    
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            @include('laravel-building::page.form', [
                'action' => route($routes['store']),
                'edit' => false,
                'data' => $data,
            ])
        </div>
    </div>
@endsection
