<?php

namespace Database\Factories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormField>
 */
class FormFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['text', 'email', 'number', 'textarea', 'select', 'radio', 'checkbox', 'date'];
        $type = $this->faker->randomElement($types);

        return [
            'form_id' => Form::factory(),
            'type' => $type,
            'label' => $this->faker->words(2, true),
            'name' => $this->faker->slug(2),
            'placeholder' => $this->faker->sentence(3),
            'help_text' => $this->faker->sentence(),
            'required' => $this->faker->boolean(30),
            'order' => $this->faker->numberBetween(1, 10),
            'validation_rules' => null,
            'options' => $type === 'select' || $type === 'radio' || $type === 'checkbox'
                ? ['Option 1', 'Option 2', 'Option 3']
                : null,
            'settings' => null,
        ];
    }
}
