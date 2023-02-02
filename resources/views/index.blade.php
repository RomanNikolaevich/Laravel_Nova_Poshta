<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="index, follow"/>
    <title>Вартість доставки - «Нова Пошта»| Доставка майбутнього</title>
    <meta name="description"
          content="Вартість доставки | Нова Пошта – Швидка та надійна доставка★ Найбільша мережа відділень по всій Україні✔ Доставка протягом 1-го дня✔ Кур’єрська доставка✔ Клієнтська підтримка 24/7 ☎0-800-500-609"/>
</head>

<body>
<span style="color:red">LINKS - ONLY FOR DEBUG TEST</span>
<ul>
    <li><a href="{{route('city.get-list')}}">Get cities from API Nova Poshta</a></li>
    <li><a href="{{route('city.store-data-in-database')}}">Store data of cities in database</a></li>
    <br>
    <li><a href="{{route('warehouses.get')}}">Get warehouses from API Nova Poshta</a></li>
    <li><a href="{{route('warehouses.store-data-in-database')}}">Store data of warehouses in database</a></li>
</ul>



<div id="container">
    <div id="wrapper" class="clearfix">
        <form method="post" enctype="multipart/form-data" action="">
            @csrf
            <h1 class="page_title">Вартість доставки</h1>
            <div class="text desc">
                <p style="font-size: 12px; font-family: verdana, geneva,serif;">Оберіть місце для доставки вантажу</p>
            </div>

            {{--            <select>--}}
            {{--                @foreach($cities as $city)--}}
            {{--                    @foreach($warehouses as $warehouse)--}}
            {{--                        <option value="{{ $city->ref }}">{{ $city->description ?? '' }}</option>--}}
            {{--                        @if( $city->ref === $warehouse->city_ref)--}}
            {{--                            <option value="{{ $warehouse->city_ref }}">{{ $warehouse->description }}</option>--}}
            {{--                        @endif--}}

            {{--                    @endforeach--}}
            {{--                @endforeach--}}
            {{--            </select>--}}
            <select>
                {{--                @foreach($cities as $city)--}}
                {{--                    <option value="{{ $city->ref }}">{{ $city->description }}</option>--}}
                {{--                @endforeach--}}
            </select>
            <select>
                {{--                @foreach($warehouses as $warehouse)--}}
                {{--                    <option value="{{ $warehouse->city_ref }}">{{ $warehouse->description }}</option>--}}
                {{--                @endforeach--}}
            </select>
        </form>

    </div>
    <div id="clear"></div>
</div>

</body>
</html>
