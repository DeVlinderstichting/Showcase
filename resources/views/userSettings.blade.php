@extends('layouts.app')

@section('title')
{{\App\Models\Language::getItem('userSettingsTitle')}} 
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <div class="container mb-3">
        <h1 class="p-4 usersettings-title-header">{{\App\Models\Language::getItem('userSettingsHeader')}}</h1>
        <h2 class="px-4 news-title-sub usersettings-title-sub">{{\App\Models\Language::getItem('userSettingsSubHeader')}}</h2>
    </div>

    <div class="container mb-3">
        <h2 class="p-4 usersettings-section-title">{{\App\Models\Language::getItem('userSettingsGeneralSettings')}}</h2>
        <div class="card usersettings-card">
            <div class="card-body usersettings-card-body">
                <table class="table table-borderless usersettings-table">
                    <tbody>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsUser')}}</td>
                            <th>{{$user->name}}</th>
                        </tr>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsRegisteredAt')}}</td>
                            <th>{{$user->created_at}}</th>
                        </tr>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsSciNames')}}</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingSciName" class="form-check-input" onchange="changeUserSetting('sciName');" @if($user->sci_names) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>
               <?php /*         <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsPrevSeen')}}</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingPrevSeen" class="form-check-input" onchange="changeUserSetting('prevSeen');" @if($user->show_previous_observed_species) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsShowCommonSp')}}</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingShowCommon" class="form-check-input" onchange="changeUserSetting('showCommon');" @if($user->show_only_common_species) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr> 

                        */  ?>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsPreferedLanguage')}}</td>
                            <td>
                                <select id="prefered_language" onchange="changeUserSetting('preferedLanguage');">

                                <?php $theLanguages = ['al','au','ba','bg','ch','cz','de','dk','ee','en','es','fi','fr','gr','hr','hu','it','lt','lv','me','nl','no','pl','pt','ro','rs','se','si','sk']; ?>

                                @foreach ($theLanguages as $lan)
                                    <option @if($user->prefered_language == $lan) selected @endif value="{{$lan}}">{{$lan}}</option>
                                @endforeach

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{{\App\Models\Language::getItem('userSettingsShareData')}}</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id="userSettingShareData" class="form-check-input" onchange="changeUserSetting('shareData');" @if($user->share_data) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>                         
                    </tbody>
                </table>

                <?php //dd($user); ?>


                <div class="container-fluid text-center">
                    <a href="/logOff" class="btn btn-outline-primary usersettings-section-button">{{\App\Models\Language::getItem('userSettingsLogout')}}</a>
                    <a href="/changePassword" class="btn btn-outline-primary usersettings-section-button">{{\App\Models\Language::getItem('userSettingsChangePassword')}}</a>
                </div>
            </div>
        </div>
    </div>

    <script> 
        function changeUserSetting(settingName)
        {
            settingValue = "";
            language = "en";
            var doPost = false;
            if (settingName == 'sciName')
            {
                var elem = document.getElementById('userSettingSciName');
                settingValue = elem.checked;
                doPost = true;
            }
            if (settingName == 'prevSeen')
            {
                var elem = document.getElementById('userSettingPrevSeen');
                settingValue = elem.checked;
                doPost = true;
            }
            if (settingName == 'showCommon')
            {
                var elem = document.getElementById('userSettingShowCommon');
                settingValue = elem.checked;
                doPost = true;
            }
            if (settingName == 'preferedLanguage')
            {
                var elem = document.getElementById('prefered_language');
                language = elem.value;
                doPost = true;
            }
            if (settingName == 'shareData')
            {
                var elem = document.getElementById('userSettingShareData');
                settingValue = elem.checked;
                doPost = true;
            }
            if (settingValue)
            {
                settingValue = 1;
            }
            else 
            {
                settingValue = 0;
            }
            if (doPost)
            {
                $.ajax(
                {
                    type:'POST',
                    url: '/user/setUserSettingsAjax',
                    data: 
                    {
                        "settingsname": settingName, 
                        "settingsvalue": settingValue,
                        "language": language
                    },
                    success:function(data) 
                    {                        
                    }
                });
            }
        }
    </script>

    <div class="container mb-3">
        <h2 class="p-4 usersettings-section-title">{{\App\Models\Language::getItem('userSettingsSpecificSettingsTitle')}}</h2>
        <div class="card usersettings-card">
            <div class="card-body usersettings-card-body">
                <div class="col mb-3">
                    <h3 class="usersettings-title-sub"></h3>
                    <div>
                        <div class="row usersettings-count-item" style="margin-top: 8px;">   
                            <p><i class="fas fa-bug" style="color: #f5e590; font-size: 18px;"></i> <span style="color: #B6F0BC; margin-bottom: 8px;">{{\App\Models\Language::getItem('userSettingsNoCounts')}}</span></p>
                        </div>
                        <div class="row usersettings-count-item">
                            <p><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i> <span style="color: #B6F0BC;">{{\App\Models\Language::getItem('userSettingsCountOnlyGroups')}}</span></p>
                        </div>
                        <div class="row usersettings-count-item">
                            <p><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i> <span style="color: #B6F0BC;">{{\App\Models\Language::getItem('userSettingsCountAll')}}</span></p>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        @foreach(\App\Models\Speciesgroup::where('visibible_for_users', true)->get() as $sg)
                            <div class="col-md-4">
                                <img src="{{$sg->imageLocation}}" alt="" class="img-count-settings usersettings-count-item-selector-image">
                                <br>{{$sg->name}}
                                <div class="flex-radio-buttons usersettings-count-item-selector">
                                    @foreach(\App\Models\RecordingLevel::all() as $rl)
                                        @if ((($rl->name=='species') && ($sg->name == 'butterflies')) || ($rl->name!='species'))
                                            @php
                                            if ($rl->name=='species') {
                                               $color = "#fda230";
                                            }elseif ($rl->name=='group') {
                                               $color = "#ffe421";
                                            }else{
                                               $color = "#f5e590";
                                            }
                                            @endphp
                                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: {{$color}}; font-size: 18px;"></i>
                                                <input class="usersettings-count-item-selector-input" type="radio" onchange="setRecordingLevel({{$rl->id}}, {{$sg->id}});" id="settings_select_{{$sg->id}}_{{$rl->id}}" 
                                                <?php 
                                                    $checked = "";
                                                    $userSet = $user->speciesgroupsRecordingLevels()->where('speciesgroup_id', $sg->id)->first();
                                                    if ($userSet != null)
                                                    {
                                                        if ($userSet->recordinglevel_id == $rl->id)
                                                        {
                                                            if ($userSet->recordinglevel_id == $rl->id)
                                                            {
                                                                $checked = 'checked="checked"';
                                                            }
                                                        }
                                                    } 
                                                ?> 
                                                {{$checked}} name="check_{{$sg->id}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        @endif
                                    @endforeach
                                </div> 
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setRecordingLevel(recordinglevelId, speciesgroupId)
        {
            $.ajax(
            {
                type:'POST',
                url: '/user/setUserRecordingLevelAjax',
                data: 
                {
                    "recordinglevel_id": recordinglevelId, 
                    "speciesgroup_id": speciesgroupId
                },
                success:function(data) 
                {                        
                }
            });
        }
    </script>

@endsection
