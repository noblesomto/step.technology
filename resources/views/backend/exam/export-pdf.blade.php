<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #222; }
        h1 { font-size: 18px; color: #001f66; margin-bottom: 2px; }
        p.subtitle { color: #666; margin-top: 0; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #001f66; color: #fff; text-align: left; padding: 6px 8px; font-size: 10px; text-transform: uppercase; }
        td { padding: 6px 8px; border-bottom: 1px solid #e5e5e5; }
        tr:nth-child(even) td { background-color: #f7f7f7; }
        .status-approved { color: #1a7f37; font-weight: bold; }
        .status-pending { color: #b78103; font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ $batch->name ?? 'All Sittings' }} — Exam Results</h1>
    <p class="subtitle">Generated {{ now()->format('j F Y, g:i a') }} &middot; {{ count($results) }} result(s)</p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Score</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->score }}</td>
                    <td class="status-{{ $row->status }}">{{ ucfirst($row->status) }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($row->updated_at)->format('j M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
