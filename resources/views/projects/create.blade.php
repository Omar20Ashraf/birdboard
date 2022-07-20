@extends ('layouts.app')

@section('content')

    <form action="/projects" method="POST">
        @csrf
        <h1> Create Project</h1>

        <div class="">
            <label for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="title">
            </div>
        </div>

        <div class="">
            <label for="description">Description</label>

            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="">

            <div class="control">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/projects" class="btn btn-danger">Cancel</a>
            </div>
        </div>

    </form>
@endsection
