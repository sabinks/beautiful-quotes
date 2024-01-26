<x-mail::message>
    # New Query From Contact Form
    From : {{ $name }}
    Email: {{ $email }}
    Phone: {{ $phone }}

    {{ $message }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>