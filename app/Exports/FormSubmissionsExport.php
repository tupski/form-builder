<?php

namespace App\Exports;

use App\Models\Form;
use App\Models\FormSubmission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormSubmissionsExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->form->submissions()->with('form')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $headings = ['ID', 'Submitted At', 'IP Address'];

        // Add form field names as headings
        foreach ($this->form->fields()->orderBy('order')->get() as $field) {
            $headings[] = $field->label;
        }

        return $headings;
    }

    /**
     * @param FormSubmission $submission
     * @return array
     */
    public function map($submission): array
    {
        $row = [
            $submission->id,
            $submission->created_at->format('Y-m-d H:i:s'),
            $submission->ip_address ?? 'Unknown'
        ];

        // Add form field values
        foreach ($this->form->fields()->orderBy('order')->get() as $field) {
            $value = $submission->data[$field->name] ?? '';

            // Handle array values (checkboxes)
            if (is_array($value)) {
                $value = implode(', ', $value);
            }

            $row[] = $value;
        }

        return $row;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Form Submissions - ' . $this->form->title;
    }
}
