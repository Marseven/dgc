<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style>
        html {
            margin-top: 0.2in !important;
            margin-left: 0.2in !important;
        }

        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.4em;
            font-weight: bold;
        }

        .ticket {
            width: 8in;
            height: 2.7in;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
            margin-bottom: 0.2in;
        }

        .ticket-img {
            max-width: 100%;
            height: auto;
            position: relative;
            /*display: inline-block;*/
        }

        #event-info {
            display: inline-block;
            position: absolute;
            left: 0.1in;
            top: 0.12in;
            width: 4.7in;
        }

        .label {
            color: #768690;
            display: block;
            text-transform: uppercase;
        }

        .value {
            display: block;
            color: #121212;
            text-transform: uppercase;
            overflow: hidden;
            font-size: 16px;
        }

        #title {
            height: 0.4in;
        }

        #location {
            height: 0.8in;
        }

        #stub-info {
            display: block;
            position: absolute;
            top: 0.06in;
            left: 3in;
            width: 1.9in;
            text-align: center;
        }

        #purchased-on {
            display: inline-block;
            color: #fff;
            text-transform: uppercase;
            font-size: 9px;
            text-align: center;
            width: 100%;
            position: relative;
        }

        #qrcode {
            position: relative;
            width: 70%;
            height: auto;
            margin-top: 0.3in;
            margin-left: -1.9in;
        }

        #ticket-num {
            display: block;
            text-transform: uppercase;
            text-align: center;
            width: 100%;
            position: relative;
            top: 0;
            left: 0;
            font-weight: bold;
            font-size: 12px;
        }

        #attendee-info {
            text-align: left;
            font-size: 10px;
            position: relative;
            top: 0.18in;
            line-height: 1.6em;
        }

        #attendee-info .value {
            font-size: 10px;
        }



        #purchased-on {
            display: block;
        }

        #qrcode {
            display: inline;
            margin: -0.1in 0 0 0;
        }
    </style>
</head>

<body>
    <div class="ticket">
        {{-- <img class="ticket-img" style="widht:100px; height:auto" src="{{ asset($registration->event->picture) }}" /> --}}

        <div id="event-info">
            <span class="label">EVENEMENT</span>
            <span id="title" class="value">{{ $registration->event->title }}</span>

            <span class="label">DATE DE DEBUT</span>
            <span class="value">{{ $registration->event->start_time }}</span>
            <br>
            <span class="label">DATE DE FIN</span>
            <span class="value">{{ $registration->event->end_time }}</span>
        </div>

        <div id="stub-info">
            {{-- <img id="logo" style="widht:100px; height:auto" src="{{ asset('front/images/dgc_wb.png') }}" /> --}}
            <span id="ticket-num" class="value">#{{ $registration->id }}</span>

            <div id="attendee-info">
                <span class="label">Ticket : {{ $registration->ticket->name }}</span>

                <span id="name" class="value">{{ $registration->attendee->first_name }}
                    {{ $registration->attendee->last_name }}</span>
                <span id="email" class="value">{{ $registration->attendee->email }}</span>
                <span id="phone" class="value">{{ $registration->attendee->phone }}</span>
            </div>
        </div>
    </div>
</body>

</html>
