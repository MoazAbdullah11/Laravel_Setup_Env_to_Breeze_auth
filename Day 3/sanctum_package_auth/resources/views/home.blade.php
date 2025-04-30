<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        input, textarea, button {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .logout-form {
            margin-top: 20px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div class="container">
        <h2>Welcome, {{ auth()->user()->name }}!</h2>

        <form method="POST" action="/contact">
            @csrf
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" rows="4" placeholder="Write your message here..." required></textarea>
            <button type="submit">Send Message</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <!-- Place this below the logout form -->

<button id="loadAjaxPosts" style="margin-top: 20px; background-color: #007bff;">Load AJAX Posts</button>

<!-- Container to inject ajax-posts content -->
<div id="ajaxPostsContainer" style="margin-top: 30px;"></div>



    <a href="{{ route('messages') }}">
    <button style="margin-top: 10px; background-color: #007bff;">Show Records</button>
</a>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    $('#loadAjaxPosts').click(function() {
        $.ajax({
            url: '/ajax-posts',
            type: 'GET',
            success: function(response) {
                $('#ajaxPostsContainer').html(response);
            },
            error: function() {
                alert('Could not load AJAX Posts.');
            }
        });
    });
</script>









<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     }
    // });

    // Save token once on page load
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    localStorage.setItem('csrf_token', csrfToken);

    // Set token from localStorage into every AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': localStorage.getItem('csrf_token')
        }
    });
    console.log('CSRF Token:', localStorage.getItem('csrf_token'));


    $('#loadAjaxPosts').click(function () {
        $.ajax({
            url: '/ajax-posts',
            type: 'GET',
            success: function (response) {
                // console.log('AJAX Response:', response);
                $('#ajaxPostsContainer').html(response);

                // Attach event handlers *after* the content loads
                attachAjaxCrudHandlers();
            },
            error: function () {
                alert('Could not load AJAX Posts.');
            }
        });
    });

    function attachAjaxCrudHandlers() {
        // Save Post
        $(document).on('click', 'button:contains("Save")', function () {
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
                success: function (post) {
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
        });
    }

    // Global functions still needed
    function editPost(id) {
        $.get(`/ajax-posts/${id}`, function (post) {
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
            success: function () {
                $(`#row_${id}`).remove();
            }
        });
    }


    $(document).on('keyup', '#searchInput', function () {
        const query = $(this).val();
        $.ajax({
            url: '/ajax-posts/search',
            type: 'GET',
            data: { query: query },
            success: function (response) {
                $('#ajaxPostsContainer').html(response);
                attachAjaxCrudHandlers(); // Re-attach handlers if needed
            },
            error: function () {
                alert('Search failed.');
            }
        });
    });


    
</script>
