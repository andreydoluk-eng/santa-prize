<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\Models\Project;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\FlexibleRender;
use MoonShine\UI\Fields\Hidden;
use MoonShine\TinyMce\Fields\TinyMce;
use Povly\MoonshineInterventionImage\Fields\InterventionImage;


/**
 * @extends FormPage<ProjectResource, Project>
 */
final class ProjectFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Grid::make([
                Column::make(
                    [
                        Box::make([
                            ID::make(),
                            Hidden::make('Сортування', 'sorting')->default(0),
                            Text::make('Назва', 'title')->reactive()->required(),
                            Slug::make('Slug', 'slug')->from('title')->live()->readonly(),
                            Text::make('Ціна', 'price'),

                            TinyMce::make('Опис', 'description'),

                        ]),
                    ],
                    colSpan: 6,
                    adaptiveColSpan: 6
                ),
                Column::make(
                    [
                        Box::make([

                            Text::make('SEO title', 'seo_title')
                                ->hint('Натисніть кнопку нижче для генерації за допомогою ШІ'),
                            Text::make('SEO keywords', 'seo_keywords')
                                ->hint('Натисніть кнопку нижче для генерації за допомогою ШІ'),
                            Textarea::make('SEO description', 'seo_description')
                                ->hint('Натисніть кнопку нижче для генерації за допомогою ШІ'),

                            FlexibleRender::make(<<<'HTML'
<div x-data="seoGenerator()" class="mt-2 mb-4">
    <button
        type="button"
        @click="generate()"
        :disabled="loading"
        class="btn btn-secondary"
        style="display:flex;align-items:center;gap:8px;padding:8px 16px;border-radius:6px;border:1px solid #6c757d;background:#000000;color:white;cursor:pointer;font-size:14px;"
    >
        <span x-show="!loading">🤖 Згенерувати SEO через Gemini</span>
        <span x-show="loading">⏳ Генерується...</span>
    </button>
    <div x-show="error" x-text="error" style="color:red;margin-top:8px;font-size:13px;"></div>
</div>

<script>
if (typeof seoGenerator !== 'function') {
function seoGenerator() {
    return {
        loading: false,
        error: '',

        getFieldValue(name) {
            const el = document.querySelector(`[name="${name}"]`) 
                    || document.querySelector(`#${name}`);
            return el ? el.value : '';
        },

        setFieldValue(name, value) {
            const el = document.querySelector(`[name="${name}"]`) 
                    || document.querySelector(`#${name}`);
            if (el) {
                el.value = value;
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('change', { bubbles: true }));
            }
        },

        async generate() {
            this.error = '';
            
            const title = this.getFieldValue('title');
            if (!title) {
                this.error = 'Спочатку заповніть поле "Назва"';
                return;
            }

            // Отримуємо опис з TinyMCE або textarea
            let description = '';
if (window.tinymce && tinymce.editors && tinymce.editors.length > 0) {
    const editor = tinymce.get('description') || tinymce.editors[0];
    if (editor) description = editor.getContent({ format: 'text' });
}
            if (!description) {
                description = this.getFieldValue('description');
            }

            this.loading = true;

            try {
                const response = await fetch('/admin/seo/generate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({ title, description }),
                });

                const data = await response.json();

                if (!response.ok) {
                    this.error = data.error || 'Помилка генерації';
                    return;
                }

                this.setFieldValue('seo_title', data.seo_title || '');
                this.setFieldValue('seo_keywords', data.seo_keywords || '');
                this.setFieldValue('seo_description', data.seo_description || '');

            } catch (e) {
                this.error = 'Помилка запиту: ' + e.message;
            } finally {
                this.loading = false;
            }
        }
    }
}
}
</script>
HTML),

                            InterventionImage::make('Головне зображення', 'main_image')
                                ->dir('equipments')
                                ->generateWebp()
                                ->generateAvif()
                                ->preset('banner')
                                ->maxDimensions(800, 600)
                                ->removable(),
                            InterventionImage::make('Галерея', 'gallery_images')
                                ->dir('equipments/gallery')
                                ->multiple()
                                ->generateWebp()
                                ->generateAvif()
                                ->preset('gallery')
                                ->removable(),
                        ]),
                    ],
                    colSpan: 6,
                    adaptiveColSpan: 6
                ),
            ]),

        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        $id = $item->getOriginal()->getKey();

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:equipments,slug,' . $id],
            'price' => ['nullable', 'string', 'max:255'],
        ];
    }

}
