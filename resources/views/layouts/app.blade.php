@props(['title'=> '', 'bodyClass'=> null, 'footerLinks'=> ''])

<x-base-layout :title="$title" :bodyClass="$bodyClass">
    <x-layouts.header/>
    {{ $slot}}

</x-base-layout>
