
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Directory</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            padding: 35px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
        }

        .add-button {
            display: inline-block;
            background: #0f766e;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
            border: 1px solid #0f766e;
            transition: background 0.2s;
        }

        .add-button:hover {
            background: #115e59;
        }

        .message {
            padding: 14px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .patient-number {
            font-weight: bold;
            color: #0f766e;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            h1 {
                font-size: 24px;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Patient Directory</h1>
            <p class="subtitle">Manage and view registered patients.</p>
        </div>

        <a href="{{ url('/patients/create') }}" class="add-button">
    + Add Patient
        </a>
    </div>

    @if (session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Patient No.</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Sex</th>
                    <th>Phone</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td class="patient-number">
                            {{ $patient->patient_number }}
                        </td>
                        <td>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </td>
                        <td>
                            {{ $patient->date_of_birth }}
                        </td>
                        <td>
                            {{ $patient->sex }}
                        </td>
                        <td>
                            {{ $patient->phone ?: 'N/A' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            No patients registered yet.
                            Click "+ Add Patient" to add your first patient.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
