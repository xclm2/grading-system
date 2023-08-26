<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">School Grading</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav float-right">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @unless (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/">Login</a>
                    </li>
                @endunless
                <li class="nav-item">
                    <a class="nav-link" href="/admin/config">Config</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/subject">Subject</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/subject/grade">Grades</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</nav>