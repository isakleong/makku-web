<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $languages = Language::all();

        // dd($languages);

        return view('administrator.languages', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.languages-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'languageCode' => 'required', 'name' => 'required'
        ]);

        $input = $request->all();

        Language::create($input);

        //prevent auto-close of sweetalert
        // Alert::success('Data Added Successfully!')->persistent('Dismiss');

        // return redirect('/admin/languages')->with('message', 'Data added successfully');
        return redirect('/admin/languages')->withSuccess('Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        dd($language->id);
        // return view('administrator.languages-edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'languageCode' => 'required', 'name' => 'required'
        ]);

        $input = $request->all();

        $language->update($input);

        return redirect('/admin/languages')->withSuccess('Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return redirect('/admin/languages')->withSuccess('Data Deleted Successfully!');
    }
}
