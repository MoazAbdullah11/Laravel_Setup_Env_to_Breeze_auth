<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Form</title>

    <!-- External Style (Bootstrap for quick styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Internal Custom Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 4px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            padding: 10px 20px;
            border: none;
        }
        .btn-submit:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-edit, .btn-delete {
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Laravel Form Submission</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ isset($editData) ? route('update.form', $editData->id) : route('submit.form') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($editData))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ isset($editData) ? $editData->name : '' }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ isset($editData) ? $editData->email : '' }}" required>
            </div>

            <!-- File Upload -->
            <div class="form-group">
                <label for="file">Upload File:</label>
                <input type="file" id="file" name="file" class="form-control" @if(!isset($editData)) required @endif>
                @if(isset($editData) && $editData->file)
                    <p><strong>Current File:</strong> <a href="{{ asset('storage/' . $editData->file) }}" target="_blank">Download</a></p>
                @endif
            </div>

            <div class="form-group text-center">
                <input type="submit" class="btn-submit" value="{{ isset($editData) ? 'Update' : 'Submit' }}">
            </div>
        </form>

        <h3>Submitted Data:</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>File</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formData as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            @if($data->file)
                                <a href="{{ asset('storage/' . $data->file) }}" target="_blank">Download</a>
                            @else
                                No file uploaded
                            @endif
                        </td>
                        <td>{{ $data->created_at }}</td>
                        <td>
                            <a href="{{ route('edit.form', $data->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('delete.form', $data->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
