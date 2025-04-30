<table id="postTable" border="1" cellspacing="0" cellpadding="10" style="width: 100%; margin-top: 20px;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Actions</th>
        </tr>
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
            <tr>
                <td colspan="4">No posts found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
