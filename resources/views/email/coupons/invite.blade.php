@component('mail::message')
# Condice sconto:

Inserisci il codice (**{{$coupon->name}}**) al checkout nell'area Sconti e Coupon e clicca Inserisci per ricevere questo sconto sul tuo acauisto:

<br><br><br>

ll codice e valido per un periodo limitato. Approfittane subito!
<br><br>
Grazie per averci scelto.<br>
**Il team CateriSana**
<br>

{{ config('app.name') }}
@endcomponent
