<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>施設管理 - 施設一覧</title>
    </head>
    <body>
        <div class="container">
            <main class="main" role="main">
                <div>
                    <div>
                        <span>顧客ID：<input type="text" name="customerId" value=""><input type="button" value="顧客検索" /></span>
                        <span>施設ID：<input type="text" name="facilityId" value=""><input type="button" value="施設検索" /></span>
                    </div>
                    <br>
                    <div>
                        <form id="new_facility" class="facility_form"  action="/maintenance/facilityManagement/detail" method="post">
                            {{ csrf_field() }}
                            <span><input type="button" value="検索" /></span>
                            <input type="hidden" name="mode" value="new" />
                            <span><input type="submit" value="施設登録" /></span>
                        </form>
                    </div>
                </div>
                <div>
                    <table border="1">
                        <tr>
                            <th>顧客ID</th>
                            <th>施設ID</th>
                            <th>施設名</th>
                            <th></th>
                        </tr>
                        @if ($facilityList)
                        @foreach ($facilityList as $facility)
                        <tr>
                            <td></td>
                            <td>{{$facility->facility_id}}</td>
                            <td>{{$facility->facility_name}}</td>
                            <td>
                                <form id="edit_facility" class="facility_form" action="/maintenance/facilityManagement/detail" method="post">
                                    {{ csrf_field() }}
                                    <input type="submit" value="編集" />
                                    <input type="hidden" name="facilityId" value="{{$facility->facility_id}}" />
                                    <input type="hidden" name="mode" value="edit" />
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
                <div>
                    <span><input class="btn-back" type="button" name="back" value="戻る" /></span>
                </div>
            </main>
            <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
            <script src="{{ asset('/assets/js/facilityList.js') }}"></script>
        </div>
    </body>
</html>
