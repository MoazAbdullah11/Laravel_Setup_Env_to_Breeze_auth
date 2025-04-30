<!DOCTYPE html>
<html>
<head>
    <title>My Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        h2 {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Messages</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                    <tr>
                        <td>{{ $msg->id }}</td>
                        <td>{{ $msg->subject }}</td>
                        <td>{{ $msg->message }}</td>
                        <td>{{ $msg->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <a href="{{ url('/home') }}">← Back to Home</a>
    </div>
</body>
</html>
