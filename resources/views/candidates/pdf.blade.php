<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Ứng viên</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }

        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>Danh sách Ứng viên</h2>

    <table>
        <thead>
            <tr>
                <th>Họ tên</th>
                <th>Năm sinh</th>
                <th>Ngày nộp CV</th>
                <th>Đạt yêu cầu</th>
                <th>PV 1</th>
                <th>PV 2</th>
                <th>Offer</th>
                <th>Nhận việc</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $c)
                <tr>
                    <td>{{ $c->full_name }}</td>
                    <td>{{ $c->birth_year }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $c->qualify_date ? \Carbon\Carbon::parse($c->qualify_date)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $c->interview1_date ? \Carbon\Carbon::parse($c->interview1_date)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $c->interview2_date ? \Carbon\Carbon::parse($c->interview2_date)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $c->offer_date ? \Carbon\Carbon::parse($c->offer_date)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $c->hand_date ? \Carbon\Carbon::parse($c->hand_date)->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        In vào ngày: {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
