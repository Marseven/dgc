@component('mail::message')
    <h1>Cher {{ $entity->entreprise->company_name }},</h1>

    Votre déclaration {{ $type == 'importation' ? "d'importation/exportation" : 'de stock' }} N°{{ $entity->id }} a changé
    de statut, le nouveau statut est désormais :
    <strong>{{ App\Http\Controllers\Controller::status($entity->status)['message'] }}</strong>.

    @if ($reason != '')
        Raison du rejet : {{ $reason }}
    @endif

    Si vous avez des questions n'hésitez pas à nous contacter.

    Cordialement,
    La Direction Générale du Commerce
@endcomponent
