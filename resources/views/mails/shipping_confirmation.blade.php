@component('mail::message')
    <h1>Twoje zamówienie zostało wysłane!</h1>
    <h2>Numer zamówienia: #{{ $order->id }}</h2>
    <h3>Dane kupującego:</h3>
    <br>
    <p>Imię i nazwisko: {{ $order->main_name }}</p>
    <p>Adres E-mail: {{ $order->main_email }}</p>
    <p>Numer telefonu: {{ $order->main_phone }}</p>
    <p>Adres:
        {{ "$order->main_street $order->main_house_number/$order->main_flat_number, $order->main_zip_code $order->main_city" }}
    </p>
    @if (!$order->second_message)
        <p>Wiadomość: {{ $order->main_message }}</p>
    @else
        <br><br>
        <h3>Dostawa na inny adres: </h3>
        <br>
        <p>Imię i nazwisko: {{ $order->second_name }}</p>
        <p>Numer telefonu: {{ $order->second_phone }}</p>
        <p>Adres:
            {{ "$order->second_street $order->second_house_number/$order->second_flat_number, $order->second_zip_code $order->second_city" }}
        </p>
        <p>Wiadomość: {{ $order->second_message }}</p>
    @endif
    <br /><br />
    <h3>Dostawa i płatność</h3>
    <br>
    <p>Dostawa: {{ $delivery->title }}</p>
    <p>Płatność: {{ $payment }}</p>
    <br><br>
    <h3>Produkty</h3>
    @foreach ($products as $product)
        <?php $data = $product->product_id ? $product->shopProduct : $product->shopItem; ?>
        <div style="display: flex; flex-wrap: wrap;">
            <div style="width: 25%; display: flex; align-items: center;">
                <img width="100%" height="auto" src="storage/media/{{ $data->photo }}" alt="">
            </div>
            <div style="width: 75%; padding-left: 3rem">
                <h4>Tytuł: {{ $data->title }}</h4>
                <p>Podtytuł: {{ $data->subtitle }}</p>
                <p>Cena: {{ $data->price }} zł</p>
                <p>Ilość: {{ $product->amount }} szt.</p>
            </div>
        </div>
    @endforeach
    <br><br>
    @component('mail::button', ['url' => url('/sklep')])
        Odwiedź nasz sklep ponownie!
    @endcomponent
    <div style="display: flex; justify-content: center;">{{ config('app.name') }}</div>
@endcomponent
