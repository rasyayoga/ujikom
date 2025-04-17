<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 12px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #007BFF;
            color: white;
            font-weight: 600;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f8ff;
        }

        tr:hover {
            background-color: #e6f0ff;
        }

        td[colspan] {
            background-color: #f5f5f5;
            text-align: center;
            font-style: italic;
        }

        @media print {
            body {
                background: white;
                margin: 0;
            }

            table {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <h2>Data User</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datauser as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->role }}</td>
            </tr>
            @endforeach
            
        </tbody>
        
        
    </table>

</body>
</html>
