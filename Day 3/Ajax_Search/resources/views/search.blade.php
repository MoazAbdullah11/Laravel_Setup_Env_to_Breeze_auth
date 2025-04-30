<!DOCTYPE html>
<html>
<head>
    <title>AJAX Search</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        #search {
            width: 100%;
            max-width: 400px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        #result {
            list-style-type: none;
            padding: 0;
            max-width: 500px;
        }

        #result li {
            padding: 12px 15px;
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: background-color 0.2s ease;
        }

        #result li:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>AJAX User Search</h1>
    <input type="text" id="search" placeholder="Search users by name or email" autocomplete="off">
    <ul id="result"></ul>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function debounce(func, delay) {
            let timer;
            return function (...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        const performSearch = () => {
            let query = $('#search').val();

            $.ajax({
                url: "{{ route('search.ajax') }}",
                type: "GET",
                data: { query: query },
                success: function (data) {
                    let html = '';
                    if (data.length > 0) {
                        data.forEach(user => {
                            html += `<li>${user.name} <br><small>${user.email}</small></li>`;
                        });
                    } else {
                        html = '<li>No results found.</li>';
                    }
                    $('#result').html(html);
                }
            });
        };

        $('#search').on('keyup', debounce(performSearch, 300));
    </script>
</body>
</html>
