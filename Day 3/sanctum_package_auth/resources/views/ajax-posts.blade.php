<!DOCTYPE html>
<html>
<head>
    <title>Laravel AJAX CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        .form-group { margin-bottom: 15px; }
        button { padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .btn-edit, .btn-delete { cursor: pointer; margin: 0 5px; color: #007bff; }
        .btn-delete { color: red; }
        .header { display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>

@if(auth()->check())
    <div class="header">
        <h2>Laravel AJAX CRUD (Posts)</h2>
        <div>
            Welcome, {{ auth()->user()->name }}
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" style="background:#dc3545">Logout</button>
            </form>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <input type="hidden" id="post_id">
        <div class="form-group">
            <input type="text" id="title" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea id="body" placeholder="Body"></textarea>
        </div>
        <button onclick="savePost()">Save</button>
    </div>

    <table id="postTable">
        <thead>
            <tr><th>ID</th><th>Title</th><th>Body</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr id="row_{{ $post->id }}">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>
                        <span class="btn-edit" onclick="editPost({{ $post->id }})">✏️</span>
                        <span class="btn-delete" onclick="deletePost({{ $post->id }})">🗑️</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> to manage posts.</p>
@endif


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        function savePost() {
            const id = $('#post_id').val();
            const title = $('#title').val();
            const body = $('#body').val();

            const data = { title, body };
            const url = id ? `/ajax-posts/${id}` : '/ajax-posts';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(post) {
                    const row = `
                        <tr id="row_${post.id}">
                            <td>${post.id}</td>
                            <td>${post.title}</td>
                            <td>${post.body}</td>
                            <td>
                                <span class="btn-edit" onclick="editPost(${post.id})">✏️</span>
                                <span class="btn-delete" onclick="deletePost(${post.id})">🗑️</span>
                            </td>
                        </tr>`;

                    if (id) {
                        $(`#row_${post.id}`).replaceWith(row);
                    } else {
                        $('#postTable tbody').prepend(row);
                    }

                    $('#post_id').val('');
                    $('#title').val('');
                    $('#body').val('');
                }
            });
        }

        function editPost(id) {
            $.get(`/ajax-posts/${id}`, function(post) {
                $('#post_id').val(post.id);
                $('#title').val(post.title);
                $('#body').val(post.body);
            });
        }

        function deletePost(id) {
            if (!confirm('Are you sure you want to delete this post?')) return;

            $.ajax({
                url: `/ajax-posts/${id}`,
                type: 'DELETE',
                success: function() {
                    $(`#row_${id}`).remove();
                }
            });
        }
    </script> -->

</body>
</html>
