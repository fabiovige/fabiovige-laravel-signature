<x-app-layout>
    <x-slot name="header">
        <h3>header</h3>
    </x-slot>
    <ol>
        <li>Nome: {{ auth()->user()->name }}</li>
        <li>Documento: {{ auth()->user()->client->document }}</li>
        <li>Status da assinatura: {{ auth()->user()->client->signatures->first()->status->name }}</li>
    </ol>
</x-app-layout>