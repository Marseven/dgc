@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('front/images/dgc.png') }}" class="logo" alt="Logo DGC">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
