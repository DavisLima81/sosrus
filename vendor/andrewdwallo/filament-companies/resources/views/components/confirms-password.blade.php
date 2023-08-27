@props([
    'title' => __('filament-companies::default.modal_titles.confirm_password'),
    'content' => __('filament-companies::default.modal_descriptions.confirm_password'),
    'button' => __('filament-companies::default.buttons.confirm'),
])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span {{ $attributes->wire('then') }}
      x-data x-ref="span"
      x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
      x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
    <x-filament-companies::dialog-modal wire:model.live="confirmingPassword">
        <x-slot name="title">
            {{ $title }}
        </x-slot>

        <x-slot name="content">
            {{ $content }}

            <x-filament-forms::field-wrapper id="confirmable_password" statePath="confirmable_password" x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
                <x-filament::input.wrapper class="mt-6">
                    <x-filament::input type="password" placeholder="{{ __('filament-companies::default.fields.password') }}"
                            autocomplete="current-password"
                            x-ref="confirmable_password"
                            wire:model="confirmablePassword"
                            wire:keydown.enter="confirmPassword"
                    />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>
        </x-slot>

        <x-slot name="footer">
            <x-filament::button
                    color="gray"
                    wire:click="stopConfirmingPassword"
                    wire:loading.attr="disabled"
            >
                {{ __('filament-companies::default.buttons.cancel') }}
            </x-filament::button>

            <x-filament::button
                    dusk="confirm-password-button"
                    wire:click="confirmPassword"
                    wire:loading.attr="disabled"
            >
                {{ $button }}
            </x-filament::button>
        </x-slot>
    </x-filament-companies::dialog-modal>
@endonce
