<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="index, follow"/>
    <title>Вартість доставки - «Нова Пошта»| Доставка майбутнього</title>
    <meta name="description"
          content="Вартість доставки | Нова Пошта – Швидка та надійна доставка"/>
    <script
        src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous">
    </script>
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


<div>
    <form method="post" enctype="multipart/form-data" action="/calculate-delivery-cost">
        @csrf
        <h1 class="page_title">Вартість доставки</h1>
        <div class="text desc">
            <p style="font-size: 12px; font-family: verdana, geneva,serif;">Оберіть місце для доставлення
                вантажу</p>
        </div>

        <label>
            <select>
                @foreach($cities as $city)
                    <option value="{{ $city->ref }}">{{ $city->description }}</option>
                @endforeach
            </select>
        </label>
        @isset($warehouses)
            <label>
                <select>
                    @foreach($warehouses as $warehouse)
                        @if($city->ref === $warehouse->city_ref )
                            <option value="{{ $warehouse->city_ref }}">{{ $warehouse->description }}</option>
                        @else
                            <option value=""> -----</option>
                        @endif
                    @endforeach
                </select>
            </label>
        @endisset
        <br>
        <p style="font-size: 12px; font-family: verdana, geneva,serif;">Введіть вартість вантажу</p>
        <label>
            <input type="text" name="packageCost" id="package-cost-input" class="form-control">
        </label>
        <button type="button" name="submit">Розрахувати доставку</button>
    </form>
    <p style="font-size: 12px; font-family: verdana, geneva,serif;">Розрахункова вартість доставлення складає:</p>
    <p id="delivery-cost-service"></p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $.ajax({
            type: 'POST',
            url: '/calculate-delivery-cost',
            data: {
                packageCost: $('#package-cost-input').val(),
            },
            success: function (data) {
                $('#delivery-cost-service').html(data);
            }
        });
    });
</script>

</body>
</html>
