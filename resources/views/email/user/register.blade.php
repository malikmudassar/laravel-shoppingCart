@component('mail::message')


# Conferma di registrazione

Gentile cliente,
per terminare la registrazione 

@component('mail::button', ['url' => $url, 'color' => 'green'])
clicca qui
@endcomponent

Grazie per averci scelto.<br>
**Il team CateriSana**

@endcomponent
