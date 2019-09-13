<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>wamojiya メンテナンスメニュー画面</title>
    </head>
    <body>
        <div class="container">
            @if($message)
            <p>{{$message}}</p>
            @endif
            <table>
                <tr>
                    <td colspan="2">
                        <form id="selectMaintenance" class="maintenance_form"  action="." method="post">
                            {{ csrf_field() }}
                            <p class="tc">
                                <input class="btn btn-customer" type="submit" value="顧客情報">
                                <input type="hidden" name="mode" value="customer" />
                                <input type="hidden" name="url" value="{{$url}}" />
                            </p>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form id="selectMaintenance" class="maintenance_form"  action="." method="post">
                            {{ csrf_field() }}
                            <p class="tc">
                                <input class="btn btn-contract" type="submit" value="契約情報">
                                <input type="hidden" name="mode" value="contract" />
                                <input type="hidden" name="url" value="{{$url}}" />
                            </p>
                        </form>
                    </td>
                    <td>
                        <form id="selectMaintenance" class="maintenance_form"  action="." method="post">
                            {{ csrf_field() }}
                            <p class="tc">
                                <input class="btn btn-payment" type="submit" value="入金管理">
                                <input type="hidden" name="mode" value="payment" />
                                <input type="hidden" name="url" value="{{$url}}" />
                            </p>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form id="selectMaintenance" class="maintenance_form"  action="/maintenance/facilityManagement" method="post">
                            {{ csrf_field() }}
                            <p class="tc">
                                <input class="btn btn-facility" type="submit" value="施設情報">
                                <input type="hidden" name="mode" value="facility" />
                                <input type="hidden" name="url" value="{{$url}}" />
                            </p>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form id="selectMaintenance" class="maintenance_form"  action="." method="post">
                            {{ csrf_field() }}
                            <p class="tc">
                                <input class="btn btn-history" type="submit" value="使用履歴">
                                <input type="hidden" name="mode" value="history" />
                                <input type="hidden" name="url" value="{{$url}}" />
                            </p>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
