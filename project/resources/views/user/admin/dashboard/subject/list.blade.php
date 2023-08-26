@extends('user.admin.index')
@section('content')

<div class="row mt-3 subject-page">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/admin/subject/save" id="new-subject" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                <span class="input-group-text" id="basic-addon1">Add</span>
                                <input type="text" class="form-control" placeholder="Subject" aria-label="Subject" name="name" aria-describedby="button-addon1">
                                <input type="text" class="form-control" placeholder="Code" aria-label="Code" name="code" aria-describedby="button-addon1">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="GET" id="search-form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search_subject" id="search_subject" value="" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <div class="grading-subject js-subjects-table"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/subjects.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.subject-page').subjects({
            token: "{{ csrf_token() }}"
        });
    });
</script>
@endsection