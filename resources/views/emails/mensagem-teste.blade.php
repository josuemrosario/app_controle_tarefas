@component('mail::message')
# Introdução

Corpo da mensagem.

- Opção 1
- Opção 2
- Opção 3

@component('mail::button', ['url' => ''])
Texto do botão
@endcomponent

@component('mail::button', ['url' => ''])
Texto do botão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
