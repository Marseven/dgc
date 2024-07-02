<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style>
        html {
            margin-top: 0.4in !important;
            margin-left: 0.6in !important;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .value {
            font-weight: bold;
        }

        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('{{ asset($registration->event->picture) }}') no-repeat center;
            background-size: contain;
            opacity: 0.1;
            /* Adjust the opacity as needed */
        }
    </style>
</head>

<body>
    <div class="watermark"></div>

    <div class="header" style="margin-bottom:40px;">
        <div class="logo-left" style="display: inline-block; width:40%">
            <img style="width: 27%; height:auto;" class="ticket-img" src="{{ asset('front/images/dgc_wb.png') }}" />
        </div>
        <div class="logo-right" style="display: inline-block; width:50%; text-align:right;">
            <img style="width: 30%; height:auto;" class="ticket-img" src="{{ asset('front/images/blason.jpg') }}" />
        </div>
    </div>

    <div class="ticket" style="width:100%">
        <div id="event-info"
            style="display: inline-block; border: 2px solid #ccc; width:60%; padding:10px; font-size:10px;">
            <span class="label">EVENEMENT : </span>
            <span id="title" class="value">{{ $registration->event->title }}</span>
            <br>
            <span class="label">DATE DE DEBUT : </span>
            <span class="value">{{ date_format(date_create($registration->event->start_time), 'd-m-Y H:i') }}</span>
            <br>
            <span class="label">DATE DE FIN : </span>
            <span class="value">{{ date_format(date_create($registration->event->end_time), 'd-m-Y H:i') }}</span>
            <br>
            <span class="label">LIEU : </span>
            <span class="value">{{ $registration->event->place }}</span>
            <br><br>
            <div id="attendee-info">
                <span class="label">TICKET : <span class="value">{{ $registration->ticket->name }} -
                        {{ round($registration->ticket->price) }} FCFA</span>
                </span>
                <br><br>

                <span class="label">COMMANDER PAR : </span><br>
                <span id="name" class="value">{{ $registration->attendee->first_name }}
                    {{ $registration->attendee->last_name }}</span><br>
                <span id="email" class="value">{{ $registration->attendee->email }}</span><br>
                <span id="phone" class="value">{{ $registration->attendee->phone }}</span><br>
            </div>
        </div>

        <div id="stub-info"
            style="display: inline-block; border: 2px solid #ccc; width:25%; text-align:center; padding:13px; margin-left:-5px;">
            <img class="qrcode" style="width: 90%; height:auto;" src="{{ asset('front/images/qr_code.png') }}" />
        </div>
    </div>

    <div class="footer">
        <p id="disclaimer" style="text-align: justify; font-size: 10px; margin-top:-15px;">
            Ce billet est non-remboursable et non-transférable. L'accès à l'événement est soumis à la présentation de ce
            billet valide. Les organisateurs ne sont pas responsables des pertes, dommages ou blessures survenus lors de
            l'événement. En participant, vous acceptez l'utilisation de votre image à des fins promotionnelles. Veuillez
            respecter le règlement intérieur de l'événement. Merci de votre compréhension.
        </p>
    </div>
</body>

</html>
