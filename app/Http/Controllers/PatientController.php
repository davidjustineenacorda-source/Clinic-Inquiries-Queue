<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Display all patients
    public function index()
    {
        $patients = Patient::latest()->get();

        return view('patients.index', compact('patients'));
    }

    // Show the Add Patient form
    public function create()
    {
        return view('patients.create');
    }

    // Save a new patient
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_number' => 'required|string|max:50|unique:patients,patient_number',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'sex' => 'nullable|in:Male,Female,Other',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
        ]);

        Patient::create($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient added successfully!');
    }
}
