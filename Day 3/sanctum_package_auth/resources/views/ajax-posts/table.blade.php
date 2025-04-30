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
    
<table id="postTable">
    <thead>
        <tr><th>ID</th><th>Title</th><th>Body</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
            <tr id="row_{{ $post->id }}">
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <span class="btn-edit" onclick="editPost({{ $post->id }})">✏️</span>
                    <span class="btn-delete" onclick="deletePost({{ $post->id }})">🗑️</span>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No posts found.</td></tr>
        @endforelse
    </tbody>
</table>
