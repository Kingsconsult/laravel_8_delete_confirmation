@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Laravel 8 CRUD </h2>
        </div>
    </div>
</div>

<div class="pull-left ">
    <a class="btn btn-success" href="{{ route('projects.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
    </a>
</div>
<div class="d-flex">
    <div class="mx-auto">

        <form action="{{ route('projects.index') }}" method="GET" role="search">

            <div class="d-flex">

                <button class="btn btn-info t" type="submit" title="Search projects">
                    <span class="fas fa-search"></span>
                </button>
                <input type="text" class="form-control mr-2" name="term" placeholder="Search projects" id="term">
                <a href="{{ route('projects.index') }}" class="">
                    <button class="btn btn-danger" type="button" title="Refresh page">
                        <span class="fas fa-sync-alt"></span>
                    </button>

                </a>
            </div>
        </form>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered table-responsive table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Introduction</th>
            <th scope="col">Location</th>
            <th scope="col">Cost</th>
            <th scope="col">Date Created</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td scope="row">{{ ++$i }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->introduction }}</td>
            <td>{{ $project->location }}</td>
            <td>{{ $project->cost }}</td>
            <td>{{ date_format($project->created_at, 'jS M Y') }}</td>
            <td>

                <a href="{{ route('projects.show', $project->id) }}" title="show">
                    <i class="fas fa-eye text-success  fa-lg"></i>
                </a>

                <a href="{{ route('projects.edit', $project->id) }}">
                    <i class="fas fa-edit  fa-lg"></i>

                </a>
                <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('delete', $project->id) }}" title="Delete Project">
                    <i class="fas fa-trash text-danger  fa-lg"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

{!! $projects->links() !!}

<!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // display a modal (small modal)
    $(document).on('click', '#smallButton', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href
            , beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                $('#smallModal').modal("show");
                $('#smallBody').html(result).show();
            }
            , complete: function() {
                $('#loader').hide();
            }
            , error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            }
            , timeout: 8000
        })
    });

</script>


@endsection
