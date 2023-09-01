@extends('user.admin.index')
@section('content')
<div class="row mt-3 instructor-add-page">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <form id="add-instructor" method="POST" action="/admin/instructor/save">
                    <h3>New Instructor</h3>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control shadow-sm border-1" id="email" name="email" placeholder="name@example.com">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow-sm border-1" id="firstname" name="firstname" placeholder="John">
                        <label for="firstname">Firstname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow-sm border-1" id="lastname" name="lastname" placeholder="Doe">
                        <label for="lastname">Lastname</label>
                    </div>
                    <div class="form-floating mb-3">
                        <div class="subjects-container">
                            <p><strong>Subjects:</strong>
                                <span class="badge text-bg-info">Computer Programming <i class="bi bi-x-circle js-remove-subject"></i></span>
                                <span class="badge text-bg-info">Data Structures <i class="bi bi-x-circle js-remove-subject"></i></span>
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark w-25 mb-3 d-sm-block d-none">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h3>Subjects</h3>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Subject" aria-label="Subject" aria-describedby="basic-addon1">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Code</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@vite(['resources/js/instructor.js'])

@endsection