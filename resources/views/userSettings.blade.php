@extends('layouts.app')

@section('title')
User settings
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <div class="container mb-3">
        <h1 class="p-4 usersettings-title-header">User settings</h1>
        <h2 class="px-4 news-title-sub usersettings-title-sub">Subtitle</h2>
    </div>

    <div class="container mb-3">
        <h2 class="p-4 usersettings-section-title">General settings</h2>
        <div class="card usersettings-card">
            <div class="card-body usersettings-card-body">
                <table class="table table-borderless usersettings-table">
                    <tbody>
                        <tr>
                            <td>User</td>
                            <th>{{$user->name}}</th>
                        </tr>
                        <tr>
                            <td>Registered at</td>
                            <th>{{$user->created_at}}</th>
                        </tr>
                        <tr>
                            <td>Use scientific names</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingSciName" class="form-check-input" onchange="changeUserSetting('sciName');" @if($user->sci_names) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Show previously seen</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingPrevSeen" class="form-check-input" onchange="changeUserSetting('prevSeen');" @if($user->show_previous_observed_species) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Show common species</td>
                            <td>
                                <div class="form-check form-switch usersettings-switch">
                                <input id= "userSettingShowCommon" class="form-check-input" onchange="changeUserSetting('showCommon');" @if($user->show_only_common_species) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </td>
                        </tr>                                        
                    </tbody>
                </table>
                <div class="container-fluid text-center">
                    <a href="/logOff" class="btn btn-outline-primary usersettings-section-button">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script> 
        function changeUserSetting(settingName)
        {
            settingValue = "";
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
                        "settingsvalue": settingValue
                    },
                    success:function(data) 
                    {                        
                    }
                });
            }
        }
    </script>

    <div class="container mb-3">
        <h2 class="p-4 usersettings-section-title">Specific settings</h2>
        <div class="card usersettings-card">
            <div class="card-body usersettings-card-body">
                <div class="col mb-3">
                    <h3 class="usersettings-title-sub"></h3>
                    <div>
                        <div class="row usersettings-count-item" style="margin-top: 8px;">   
                            <p><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i> <span style="color: #B6F0BC; margin-bottom: 8px;">No counts</span></p>
                        </div>
                        <div class="row usersettings-count-item">
                            <p><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i> <span style="color: #B6F0BC;">Count only speciesgroups</span></p>
                        </div>
                        <div class="row usersettings-count-item">
                            <p><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i> <span style="color: #B6F0BC;">Count all species</span></p>
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
                                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i>
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
