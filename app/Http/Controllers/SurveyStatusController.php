<?php

namespace App\Http\Controllers;

use App\Models\SurveyStatus;
use App\Models\Warga;
use Illuminate\Http\Request;

class SurveyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $survey_status = SurveyStatus::with('warga')->latest()->get();
        $warga = Warga::all();

        return view('admin.survey_status.index', compact('survey_status', 'warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.survey_status.create', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'warga_id' => 'required|exists:wargas,id',
        'pendapatan' => 'required|numeric',
        'pekerjaan' => 'required|string',
        'jumlah_anggota' => 'required|integer',
        'kwh_listrik' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'kondisi_rumah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('survey/foto', 'public');
    }

    if ($request->hasFile('kondisi_rumah')) {
        $validated['kondisi_rumah'] = $request->file('kondisi_rumah')->store('survey/kondisi', 'public');
    }

    SurveyStatus::create($validated);

    return redirect()->route('admin.survey_status.index')->with('success', 'Survey berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyStatus $survey_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyStatus $survey_status)
    {
        return view('admin.survey_status.edit', compact('survey_status', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SurveyStatus $survey_status)
    {
        $request->validate([
            'warga_id'       => 'required|exists:wargas,id',
            'pendapatan'     => 'required|integer',
            'pekerjaan'      => 'required|string|max:255',
            'kondisi_rumah'  => 'required|string|max:255',
            'jumlah_anggota' => 'required|integer',
            'kwh_listrik'    => 'required|string|max:255',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('survey_foto', 'public');
        }

        $survey_status->update($data);

        return redirect()->route('admin.survey_status.index')->with('success', 'Data Survey Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyStatus $survey_status)
    {
        $survey_status->delete();

        return redirect()->route('admin.survey_status.index')->with('success', 'Data Survey Berhasil Dihapus.');
    }
}
