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
            padding: 30px 20px;
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
        }

        .panel {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        input[type="search"] {
            flex: 1;
            min-width: 220px;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="search"]:focus {
            outline: 2px solid #99f6e4;
            border-color: #0f766e;
        }

        .add-button {
            display: inline-block;
            background: #0f766e;
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .add-button:hover {
            background: #115e59;
        }

        .count {
            color: #64748b;
            margin: 15px 0;
            font-size: 14px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th,
        td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .patient-number {
            color: #0f766e;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 30px;
        }

        .message {
            padding: 14px;
            margin-bottom: 18px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px 10px;
            }

            .panel {
                padding: 15px;
            }

            .add-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <main>
        @if (session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        <section class="panel">
            <h2>Patient Directory</h2>

            <div class="toolbar">
                <input
                    type="search"
                    id="searchInput"
                    placeholder="Search patient name or patient number..."
                    aria-label="Search patients"
                >

                <a
                    href="https://organic-chainsaw-4jxx9vj9vw6q2jxr5-8000.app.github.dev/patients/create"
                    class="add-button"
                >
                    + Add Patient
                </a>
            </div>

            <p class="count">
                Total patients: {{ $patients->count() }}
            </p>

            <div class="table-wrap">
                <table id="patientsTable">
                    <thead>
                        <tr>
                            <th>Patient Number</th>
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
                                    {{ $patient->first_name }}
                                    {{ $patient->last_name }}
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
                                    No patients found. Click "+ Add Patient"
                                    to register a patient.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#patientsTable tbody tr');

        searchInput.addEventListener('input', function () {
            const search = this.value.toLowerCase().trim();

            rows.forEach(function (row) {
                row.style.display =
                    row.textContent.toLowerCase().includes(search)
                        ? ''
                        : 'none';
            });
        });
    </script>
</body>
</html>
