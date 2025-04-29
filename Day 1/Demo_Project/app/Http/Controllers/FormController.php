<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    // Show the form and the submitted data
    public function showForm()
    {
        $formData = FormData::all();
        return view('form', compact('formData'));
    }

    // Handle form submission (create)
    public function handleForm(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // optional file validation
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');
    }

    FormData::create([
        'name' => $request->name,
        'email' => $request->email,
        'file' => $filePath,
    ]);

    return redirect()->route('form')->with('success', 'Form submitted successfully!');
}


    // Show the form for editing
    public function editForm($id)
    {
        $editData = FormData::find($id);
        $formData = FormData::all();
        return view('form', compact('formData', 'editData'));
    }

    // Handle form update
    public function updateForm(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Optional file validation
        ]);

        // Find the record to update
        $data = FormData::find($id);

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            // Delete the old file if exists
            if ($data->file && Storage::exists('public/' . $data->file)) {
                Storage::delete('public/' . $data->file);
            }
            $data->file = $request->file('file')->store('uploads', 'public');
        }

        // Update form data
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('form')->with('success', 'Data updated successfully!');
    }

    // Handle form deletion
    public function deleteForm($id)
    {
        // Find the data to delete
        $data = FormData::find($id);

        // Delete the associated file if exists
        if ($data->file && Storage::exists('public/' . $data->file)) {
            Storage::delete('public/' . $data->file);
        }

        // Delete the form data
        $data->delete();

        return redirect()->route('form')->with('success', 'Data deleted successfully!');
    }
}
