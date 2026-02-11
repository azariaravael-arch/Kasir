<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * Show settings page
     */
    public function index()
    {
        $settings = $this->getAllSettings();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update settings by category
     */
    public function update(Request $request, $category)
    {
        match($category) {
            'store' => $this->updateStoreSettings($request),
            'appearance' => $this->updateAppearanceSettings($request),
            default => abort(404),
        };

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }

    /**
     * Update store settings
     */
    private function updateStoreSettings(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:100',
            'store_address' => 'nullable|string|max:255',
            'store_phone' => 'nullable|string|max:20',
            'store_email' => 'nullable|email|max:100',
            'store_website' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Session::put("settings.$key", $value);
        }

        cache()->put('app_settings_store', $validated, null);
        
        // Save to persistent JSON file
        $this->saveToPersistentStorage('store', $validated);
    }

    /**
     * Update appearance settings
     */
    private function updateAppearanceSettings(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,gif,webp|max:2048',
            'primary_color' => 'required|regex:/#[0-9A-F]{6}/i',
            'secondary_color' => 'required|regex:/#[0-9A-F]{6}/i',
        ]);

        // Handle logo upload FIRST
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo_path'] = $logoPath;
        }

        // Remove file object from validated data before saving to session
        unset($validated['logo']);

        // Save to session and cache (only non-file data)
        foreach ($validated as $key => $value) {
            Session::put("settings.$key", $value);
        }

        cache()->put('app_settings_appearance', $validated, null);
        
        // Save to persistent JSON file
        $this->saveToPersistentStorage('appearance', $validated);
    }

    /**
     * Save settings to persistent JSON storage
     */
    private function saveToPersistentStorage($category, $data)
    {
        $storagePath = storage_path('app/settings.json');
        $settings = [];
        
        if (file_exists($storagePath)) {
            $settings = json_decode(file_get_contents($storagePath), true) ?? [];
        }
        
        $settings[$category] = $data;
        file_put_contents($storagePath, json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Load settings from persistent JSON storage
     */
    private function loadFromPersistentStorage($category)
    {
        $storagePath = storage_path('app/settings.json');
        
        if (file_exists($storagePath)) {
            $settings = json_decode(file_get_contents($storagePath), true) ?? [];
            return $settings[$category] ?? [];
        }
        
        return [];
    }

    /**
     * Get all settings
     */
    private function getAllSettings(): array
    {
        $defaults = [
            // Store
            'store_name' => 'Toko Saya',
            'store_address' => '',
            'store_phone' => '',
            'store_email' => '',
            'store_website' => '',

            // Appearance
            'logo_path' => null,
            'primary_color' => '#20a770',
            'secondary_color' => '#0D8ABC',
        ];

        // Merge with cached/session values and persistent storage
        $settings = [];
        foreach ($defaults as $key => $default) {
            // First check session, then cache, then persistent storage, then default
            $settings[$key] = Session::get("settings.$key", 
                cache()->get("app_settings", [])[$key] ?? 
                $this->loadFromPersistentStorage('appearance')[$key] ?? 
                $default
            );
        }

        return $settings;
    }
}
