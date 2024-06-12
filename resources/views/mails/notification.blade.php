@component('mail::message')
    <h1>Cher Direction,</h1>

    Vous avez reçu une nouvelle déclaration :

    - Type : {{ $type }}
    - N° : {{ $entity->id }}
    - Entreprise : {{ $entity->entreprise->company_name }}

    @component('mail::button', ['url' => url('admin/dashboard')])
        Voir Plus
    @endcomponent

    Cordialement,
    La Direction Générale du Commerce
@endcomponent
