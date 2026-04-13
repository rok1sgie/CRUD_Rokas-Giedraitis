<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\City;
use App\Models\Grupe;

class StudentController extends Controller
{
    // Rodyti visus nepašalintus studentus
    public function index()
    {
        $students = Student::with('city', 'grupe')->paginate(20);
        return view('students.index', compact('students'));
    }

    // Formos rodymas naujam studentui sukurti
    public function create()
    {
        $cities = City::all();
        $grupes = Grupe::all();

        return view('students.create', compact('cities', 'grupes'));
    }

    // Naujo studento įrašymas
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
            'grupe_id' => 'required|exists:grupes,id',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Studentas pridėtas!');
    }

    // Redagavimo forma
    public function edit(Student $student)
    {
        $cities = City::all();
        $grupes = Grupe::all();

        return view('students.edit', compact('student', 'cities', 'grupes'));
    }

    // Atnaujinti studento duomenis
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'city_id' => 'required|exists:cities,id',
            'grupe_id' => 'required|exists:grupes,id',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Studentas atnaujintas!');
    }

    // Soft delete
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Studentas buvo pažymėtas kaip ištrintas.');
    }

    // Rodyti tik ištrintus studentus
    public function trashed()
    {
        $students = Student::onlyTrashed()->with('city', 'grupe')->paginate(20);
        return view('students.trashed', compact('students'));
    }

    // Atkurti ištrintą studentą
    public function restore($id)
    {
        Student::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('students.trashed')->with('success', 'Studentas atkurtas!');
    }

    // Visiškai ištrinti
    public function forceDelete($id)
    {
        Student::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('students.trashed')->with('success', 'Studentas visam laikui pašalintas.');
    }
}
