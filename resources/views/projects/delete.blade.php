<?php  
    $splitPageUri = explode("/", $_SERVER['REQUEST_URI']);

    $id = end($splitPageUri);  
  ?>
{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('projects.destroy', $id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Are you sure you want to delete this Project?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Yes, Delete Project</button>
    </div>
</form>