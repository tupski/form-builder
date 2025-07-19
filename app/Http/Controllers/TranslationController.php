<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $languages = Language::with('translations')->get();
        $translationKeys = Translation::distinct('key')->pluck('key')->sort();

        return view('admin.translations.index', compact('languages', 'translationKeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'translations' => 'required|array',
            'translations.*' => 'required|string',
        ]);

        foreach ($request->translations as $languageId => $value) {
            Translation::updateOrCreate(
                ['language_id' => $languageId, 'key' => $request->key],
                ['value' => $value]
            );
        }

        return response()->json(['success' => true, 'message' => 'Translation saved successfully!']);
    }

    public function update(Request $request, Translation $translation)
    {
        $request->validate([
            'value' => 'required|string',
        ]);

        $translation->update(['value' => $request->value]);

        return response()->json(['success' => true, 'message' => 'Translation updated successfully!']);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        Translation::where('key', $request->key)->delete();

        return response()->json(['success' => true, 'message' => 'Translation deleted successfully!']);
    }

    public function createLanguage(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:5|unique:languages,code',
            'name' => 'required|string|max:255',
            'native_name' => 'required|string|max:255',
        ]);

        $language = Language::create([
            'code' => $request->code,
            'name' => $request->name,
            'native_name' => $request->native_name,
            'is_active' => true,
            'is_default' => false,
        ]);

        return response()->json(['success' => true, 'message' => 'Language created successfully!', 'language' => $language]);
    }

    public function toggleLanguage(Language $language)
    {
        $language->update(['is_active' => !$language->is_active]);

        return response()->json(['success' => true, 'message' => 'Language status updated!']);
    }

    public function setDefault(Language $language)
    {
        // Remove default from all languages
        Language::where('is_default', true)->update(['is_default' => false]);

        // Set new default
        $language->update(['is_default' => true, 'is_active' => true]);

        return response()->json(['success' => true, 'message' => 'Default language updated!']);
    }

    public function switchLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|string|exists:languages,code',
        ]);

        session(['locale' => $request->language]);
        app()->setLocale($request->language);

        return response()->json(['success' => true, 'message' => 'Language switched successfully!']);
    }
}
