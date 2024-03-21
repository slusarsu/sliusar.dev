<x-filament-panels::page>

    <div>
        <form wire:submit="submit">
            {{ $this->form }}

            <div class="py-6">
                <x-filament::button type="submit">
                    Submit
                </x-filament::button>
            </div>

        </form>

        <x-filament-actions::modals />
    </div>

</x-filament-panels::page>
