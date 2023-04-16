<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * view files path
     */
    protected string $v_path = "pages.language.";

    public function __construct()
    {
        $this->middleware('permission:language-index')->only(['index', 'show']);
        $this->middleware('permission:language-create')->only(['create', 'store']);
        $this->middleware('permission:language-update')->only(['edit', 'update']);
        $this->middleware('permission:language-destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view($this->v_path . "index", compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $translatable = app_path() . "/../resources/lang/translatable.json";
        $transable = null;
        if (file_exists($translatable)) {
            $data = json_decode(file_get_contents($translatable));
            $transable = $data->columns;
        }
        return view($this->v_path . "create", compact('transable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
        ]);

        $data = $request->all();
        Language::create($data);
        alert()->success("Success", 'Language create successfull!');
        return redirect()->back();
    }

    /**
     * get translate language
     * @return \Illuminate\Http\Response
     */
    public function translate($language)
    {
        $language = Language::find($language);
        $translatable = app_path() . "/../resources/lang/translatable.json";
        $transable = null;
        if (file_exists($translatable)) {
            $data = json_decode(file_get_contents($translatable));
            $transable = $data->columns;
        }
        /**
         * translage language
         */
        $lang_file = app_path() . "/../resources/lang/". $language->slug . ".json";
        if(!file_exists($lang_file)) {
            touch($lang_file);
            file_put_contents($lang_file, json_encode([]));
        }
        $translate = [];
        if (file_exists($lang_file)) {
            $translate = (array)json_decode(file_get_contents($lang_file));
        }
        return view($this->v_path . "translate", compact('transable', "language", "translate"));
    }

    /**
     * store all translate language
     * @return void
     */
    public function translateStore(Request $request, $language)
    {
        $language = Language::find($language);
        $lang_file = app_path() . "/../resources/lang/" . $language->slug . ".json";
        if(!file_exists($lang_file)) {
            touch($lang_file);
            file_put_contents($lang_file, json_encode([]));
        }
        $data = [];
        foreach($request->transable as $key => $value) {
            if($value) {
                $data[$key] = $value;
            }
        }
        file_put_contents($lang_file, json_encode($data));
        alert()->success("Success", 'Language translate saved!');
        return redirectToRoute("language.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view($this->v_path . "edit", compact("language"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $language->update($request->all());
        alert()->success("Updated", 'Language updated successfully!');
        return redirectToRoute("language.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language)
    {
        $lang = Language::findOrFail($language);
        $lang_file = app_path() . "/../resources/lang/" . $lang->slug . ".json";
        if(file_exists($lang_file)) {
            unlink($lang_file);
        }
        $lang->delete();
        alert()->success("Deleted", 'Language deleted successfully!');
        return redirectToRoute("language.index");
    }
}
