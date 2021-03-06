@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <strong>Eggs</strong>
                    <div class="pull-right">
                        <a href="{{ route('projects.create') }}" class="btn btn-success btn-xs">Add</a>
                    </div>
                </div>

                <div class="panel-body">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Revision</th>
                                <th>Size of egg</th>
                                <th>Size of content</th>
                                <th>Category</th>
                                <th>Last release</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
				    <td>
					@can('update', $project)
						<a href="{{ route('projects.edit', ['project' => $project->slug]) }}">{{ $project->name }}</a></td>
					@else
						<a href="{{ route('projects.show', ['project' => $project->slug]) }}">{{ $project->name }}</a></td>
					@endcan
                                    <td>{{ $project->versions()->published()->count() > 0 ? $project->versions()->published()->get()->last()->revision : 'unpublished' }}</td>
                                    <td>{{ $project->size_of_zip }}</td>
                                    <td>{{ $project->size_of_content }}</td>
                                    <td>{{ $project->category }}</td>
                                    <td>{{ $project->versions()->published()->count() > 0 ? $project->versions()->published()->get()->last()->updated_at : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Eggs published yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pull-right">
                        <a href="{{ route('projects.create') }}" class="btn btn-default">Add</a>
                    </div>

                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
