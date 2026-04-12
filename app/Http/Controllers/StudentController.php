<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\City;
use App\Models\Grupe;

class StudentController extends Controller
{
    // Rodyti visus studentus su miestais (index)
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
        $request->validate([
    'name' => 'required|string|max:255',
    'surname' => 'required|string|max:255',
    'birthday' => 'required|date',
    'address' => 'required|string',
    'phone' => 'required|string|max:20',
    'city_id' => 'required|exists:cities,id',
    'grupe_id' => 'required|exists:grupes,id',
]);

        Student::create($request->all());
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
    $request->validate([
    'name' => 'required|string|max:255',
    'surname' => 'required|string|max:255',
    'birthday' => 'required|date',
    'address' => 'required|string',
    'phone' => 'required|string|max:20',
    'city_id' => 'required|exists:cities,id',
    'grupe_id' => 'required|exists:grupes,id',
]);

    // Atnaujiname studento duomenis
    $student->update($request->only(['name', 'surname', 'address', 'phone', 'city_id']));

    // Peradresavimas į studentų sąrašą
    return redirect()->route('students.index')->with('success', 'Studentas atnaujintas!');
}

    // Ištrinti studentą
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Studentas ištrintas!');
    }
}
