<x-mail::message>
# Reminder

Tanggal jatuh tempo jasa koperasi

<x-mail::button :url="'/koperasihome'">
Kunjungi Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
