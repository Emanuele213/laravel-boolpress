@extends('layouts.app')

@section('content')
    @if (session('success_delete'))
    <div class="alert alert-success">
        {{-- {{ session('success_delete') }} --}}
        Il post con id "{{ session('success_delete') }}" e' stato eliminato correttamente
    </div>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
            <th class="text-center" scope="col">ID</th>
            <th class="text-center" scope="col">Slug</th>
            <th class="text-center" scope="col">Title</th>
            <th class="text-center" scope="col">Category</th>
            <th class="text-center" scope="col">Tags</th>
            <th class="text-center" scope="col">View</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Delete</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($posts as $post)
            <tr>
                <th class="text-center" scope="row">{{ $post->id}}</th>
                <td class="text-center">{{ $post->slug }}</td>
                <td class="text-center">{{ $post->title }}</td>
                <td class="text-center">
                    @if ($post->category)
                        <a href="{{ route('admin.categories.show', ['category' => $post->category]) }}">{{ $post->category->name ?? '' }}</a>
                    @endif
                </td>
                <td class="text-center">
                    @foreach ($post->tags as $tag)
                    {{-- {{ route('admin.tags.show', ['tag' => $post->tag] )}} --}}
                        <a href="">{{ $tag->name }}{{ $loop->last ? '' : ', ' }}</a>
                    @endforeach
                </td>
                <td class="text-center"><a href="{{ route('admin.posts.show', ['post' => $post]) }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                  </svg></a></td>
                <td class="text-center"><a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                  </svg></a></td>
                <td class="text-center">
                    <button class="btn btn-danger btn-delete-me" data-id="{{ $post->slug }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links()}}
    </div>

    @include('admin.partials.delete_confirmation', ['delete_name' => 'post'])
@endsection
