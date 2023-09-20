@extends('layouts.app')

@section('title')
    {{\App\Models\Language::getItem('userHomeTitle')}}
@endsection

@section('sidebar')
    @include('layouts.navbar',['menuActive'=>'adminhome'])
@endsection

@section('extraNavItems')
@endsection

@section('content')
    <style>
        .messages-list {
            max-height: 300px;
            margin-bottom: 10px;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <div class="container mb-3">
        <h2 class="p-4 userhome-title-header">{{\App\Models\Language::getItem('badgesHeader')}}</h2>
    </div>


    <div class="container mb-3">
        <div class="row">
            <div class="container mb-3">
                <h2 class="p-4 usersettings-section-title">{{\App\Models\Language::getItem('userSettingsSpecificSettingsTitle')}}</h2>
                <div class="card usersettings-card">
                    <div class="card-body usersettings-card-body">
                        <div class="row justify-content-center">
                            @foreach(\App\Models\Badge::all() as $badge)
                                <?php 
                                    $userHasBadge = true;
                                    $theBadgeLevel = $badge->getHighestBadgeLevelForUser($user); 
                                    if (empty($theBadgeLevel))
                                    {
                                        $theBadgeLevel = $badge->getLowestBadgeLevel()->first();
                                        $userHasBadge = false;
                                    }
                                    $badgeProgress = $badge->getProgressTowardsNextLevel($user);
                                    $tooltipText = $theBadgeLevel->getRequirementsTooltip();
                                ?>
                                <div class="col-md-4">
                                    <br>
                                    {{\App\Models\Language::getItem($badge->description_key)}}<br>
                                    <img src="{{$theBadgeLevel->image_location}}" alt="" class="img-count-settings usersettings-count-item-selector-image" @if(!$userHasBadge) style="opacity:0.5;" @endif title="{{$tooltipText}}">
                                    <br><progress id="{{$theBadgeLevel->id}}" value="{{$badgeProgress}}" max="100">{{$badgeProgress}}%</progress>
                                    <br>{{\App\Models\Language::getItem($theBadgeLevel->description_key)}}
                                    <br><br>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ol-custom {
            z-index: 1000;
            top: .5em;
            right: .5em;
        }

    </style>


@endsection
