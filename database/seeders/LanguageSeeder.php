<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create English language (default)
        $english = Language::updateOrCreate(
            ['code' => 'en'],
            [
                'name' => 'English',
                'native_name' => 'English',
                'is_active' => true,
                'is_default' => true,
            ]
        );

        // Create Indonesian language
        $indonesian = Language::updateOrCreate(
            ['code' => 'id'],
            [
                'name' => 'Indonesian',
                'native_name' => 'Bahasa Indonesia',
                'is_active' => true,
                'is_default' => false,
            ]
        );

        // English translations
        $englishTranslations = [
            'app.name' => 'Form Builder',
            'nav.dashboard' => 'Dashboard',
            'nav.my_forms' => 'My Forms',
            'nav.admin' => 'Admin',
            'forms.create' => 'Create New Form',
            'forms.title' => 'Form Title',
            'forms.description' => 'Description',
            'forms.success_message' => 'Success Message',
            'forms.save' => 'Save Form',
            'forms.edit' => 'Edit',
            'forms.delete' => 'Delete',
            'forms.preview' => 'Preview',
            'forms.builder' => 'Builder',
            'forms.submissions' => 'Submissions',
            'forms.export_excel' => 'Export Excel',
            'forms.back_to_forms' => 'Back to Forms',
            'forms.no_forms' => 'No forms',
            'forms.no_submissions' => 'No submissions yet',
            'buttons.cancel' => 'Cancel',
            'buttons.save' => 'Save',
            'buttons.create' => 'Create',
            'buttons.update' => 'Update',
            'buttons.delete' => 'Delete',
            'messages.form_created' => 'Form created successfully!',
            'messages.form_updated' => 'Form updated successfully!',
            'messages.form_deleted' => 'Form deleted successfully!',
            'messages.thank_you' => 'Thank you for your submission!',
        ];

        foreach ($englishTranslations as $key => $value) {
            Translation::updateOrCreate(
                ['language_id' => $english->id, 'key' => $key],
                ['value' => $value]
            );
        }

        // Indonesian translations
        $indonesianTranslations = [
            'app.name' => 'Pembuat Form',
            'nav.dashboard' => 'Dasbor',
            'nav.my_forms' => 'Form Saya',
            'nav.admin' => 'Admin',
            'forms.create' => 'Buat Form Baru',
            'forms.title' => 'Judul Form',
            'forms.description' => 'Deskripsi',
            'forms.success_message' => 'Pesan Sukses',
            'forms.save' => 'Simpan Form',
            'forms.edit' => 'Edit',
            'forms.delete' => 'Hapus',
            'forms.preview' => 'Pratinjau',
            'forms.builder' => 'Pembuat',
            'forms.submissions' => 'Kiriman',
            'forms.export_excel' => 'Ekspor Excel',
            'forms.back_to_forms' => 'Kembali ke Form',
            'forms.no_forms' => 'Tidak ada form',
            'forms.no_submissions' => 'Belum ada kiriman',
            'buttons.cancel' => 'Batal',
            'buttons.save' => 'Simpan',
            'buttons.create' => 'Buat',
            'buttons.update' => 'Perbarui',
            'buttons.delete' => 'Hapus',
            'messages.form_created' => 'Form berhasil dibuat!',
            'messages.form_updated' => 'Form berhasil diperbarui!',
            'messages.form_deleted' => 'Form berhasil dihapus!',
            'messages.thank_you' => 'Terima kasih atas kiriman Anda!',
        ];

        foreach ($indonesianTranslations as $key => $value) {
            Translation::updateOrCreate(
                ['language_id' => $indonesian->id, 'key' => $key],
                ['value' => $value]
            );
        }
    }
}
