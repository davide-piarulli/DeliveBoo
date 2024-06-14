@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center m-4">Elenco Progetti per Categoria</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Progetti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->categories }}</td>
                    <td>
                        <ul class="list-group">
                            @foreach ($type->projects as $project)
                                <li class="list-group-item">
                                    <a class="text-black" href="{{ route('admin.projects.show', $project->id) }}">
                                        {{ $project->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

