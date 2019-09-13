<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>施設管理 - 施設情報</title>
    </head>
    <body>
        <div class="container">
            <main class="main" role="main">
                <form id="saveDetail" class="detail_form" action="/maintenance/facilityManagement/saveDetail" method="post">
                    {{ csrf_field() }}
                    <div>
                        @if($mode == "new")
                        <p>顧客ID：<input type="text" name="customerId" maxlength="12" size="12" value="" /><input type="button" name="searchCustomer" value="顧客検索" /></p>
                        <p>プロジェクト：<select name="projectId"><option value="WP">WP:wamojiPrint</option></select></p>
                        <p>業務形態：<select name="businessType"><option value="W">W:web</option><option value="G">G:ゲストハウス</option></select></p>
                        <p>仕様版数：<input type="text" name="specificationVersionNumber" maxlength="1" size="1" value="1" /></p>
                        @else
                        <p>顧客ID：<input type="hidden" name="customerId" value=""></p>
                        <p>施設ID：<input type="hidden" name="facilityId" value="{{$facility->facility_id}}">{{$facility->facility_id}}</p>
                        @endif
                    </div>
                    <br />
                    <div>
                        <p>施設名：<input type="text" name="facilityName" maxlength="20" size="20" value="{{$facility->facility_name}}" /></p>
                        <p>パスワード：<input type="password" name="password" size="30" value="{{$facility->password}}" /></p>
                        <p>使用許可フラグ：<input type="checkbox" name="licenseFlg" value="" /></p>
                        <p>背景コード１：<input type="text" name="backgroundCd1" maxlength="3" size="3" value="{{$facility->background_cd_1}}" /></p>
                        <p>背景コード２：<input type="text" name="backgroundCd2" maxlength="3" size="3" value="{{$facility->background_cd_2}}"></p>
                        <p>背景コード３：<input type="text" name="backgroundCd3" maxlength="3" size="3" value="{{$facility->background_cd_3}}"></p>
                        <p>背景コード４：<input type="text" name="backgroundCd4" maxlength="3" size="3" value="{{$facility->background_cd_4}}"></p>
                        <p>PRコード：<input type="text" name="prCd" maxlength="1" size="1" value="{{$facility->pr_cd}}"></p>
                    </div>
                    <br />
                    <div>
                    </div>
                    <br />
                    <div>
                        <span><input class="btn-back" type="button" name="back" value="戻る" /></span>@if($mode=="new")<span><input type="submit" name="add" value="登録" /></span>@else<span><input type="submit" name="update" value="更新" /></span>@endif
                    </div>
                    <input type="hidden" name="mode" value="{{$mode}}" />
                    <input type="hidden" name="url" value="{{$url}}" />
                </form>
            </main>
            <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
            <script src="{{ asset('/assets/js/facilityDetail.js') }}"></script>
        </div>
    </body>
</html>
