@component('mail::message')
# Introduction

your new post {{ $articale->title}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
