<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col"><button class="btn btn-danger btn-sm js-subject-mass-delete" disabled>Delete</button></th>
            <th scope="col">#</th>
            <th scope="col">Subject Name</th>
            <th scope="col">Subject Code</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
        <tr style="vertical-align: baseline;">
            <td class="text-center" style="width: 5px;"><input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}"></td>
            <th scope="row">{{ $subject->id }}</th>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->code }}</td>
            <td>
                <button type="button" class="btn btn-primary btn-subject-edit" data-subject="{{ $subject->id }}" data-bs-toggle="modal" data-bs-target="#subject-edit-{{ $subject->id }}">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" data-subject="{{ $subject->id }}" class="btn btn-danger btn-subject-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                    <i class="bi bi-trash"></i>
                </button>

            </td>
        </tr>
        @endforeach
    </tbody>
    <div class="text-center grading-spinner js-grading-spinner">
        <div class="spinner-border grading-spinner__border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</table>
<div class="subject-edit-modals">
    @foreach ($subjects as $i => $subject)
    <div class="modal fade" id="subject-edit-{{ $subject->id }}" tabindex="-1" aria-labelledby="subject-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="edit-subject-{{ $subject->id }}" method="POST">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        <input name="type" value="edit" type="hidden"/>
                        <input name="id" value="{{ $subject->id }}" type="hidden"/>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Subject" value="{{ $subject->name }}">
                            <label for="floatingInput">Subject</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="code" placeholder="Subject Code" value="{{ $subject->code }}">
                            <label for="floatingPassword">Code</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-update-subject" data-id="{{ $subject->id }}">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $subjects->links() }}