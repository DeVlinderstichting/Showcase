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
    <h1 class="p-4">User settings</h1>
</div>

<div class="container mb-3">
    <h1 class="p-4">General settings</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>User</td>
                        <th>Sir Testington</th>
                    </tr>
                    <tr>
                        <td>Registered at</td>
                        <th>2022/02/02</th>
                    </tr>
                    <tr>
                        <td>Use scientific names</td>
                        <td>
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Show previously seen</td>
                        <td>
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Show common species</td>
                        <td>
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </td>
                    </tr>                                        
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container mb-3">
    <h1 class="p-4">Specific settings</h1>
    <div class="card">
        <div class="card-body">
            <div class="col mb-3">
                <h3><span>What do you want to count?</span></h3>
                <div>
                    <div class="row" style="margin-top: 8px;">   
                        <p><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i> <span style="color: #B6F0BC; margin-bottom: 8px;">No counts</span></p>
                    </div>
                    <div class="row">
                        <p><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i> <span style="color: #B6F0BC;">Count only speciesgroups</span></p>
                    </div>
                    <div class="row">
                        <p><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i> <span style="color: #B6F0BC;">Count all species</span></p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <img src="img/butterflies.png" alt="" class="img-count-settings">
                            <div class="flex-radio-buttons">   
                                <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i>
                                    <input type="radio" id="settings_selectButtonButterflies3" checked="checked" name="butterflies-check">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i>
                                    <input type="radio" id="settings_selectButtonButterflies2" name="butterflies-check">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i>
                                    <input type="radio" id="settings_selectButtonButterflies1" name="butterflies-check">
                                    <span class="checkmark"></span>
                                </label>
                            </div> 
                    </div>
                    <div class="col-md-4">
                        <img src="img/birds.png" alt="" class="img-count-settings">
                        <div class="flex-radio-buttons">   
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBirds3" checked="checked" name="birds-check">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBirds2" name="birds-check">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBirds1" name="birds-check">
                                <span class="checkmark"></span>
                            </label>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <img src="img/bees.png" alt="" class="img-count-settings">
                        <div class="flex-radio-buttons">   
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #f5e590; opacity: 0.5; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBees3" checked="checked" name="bees-check">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #ffe421; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBees2" name="bees-check">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container-radio-buttons"><i class="fas fa-bug" style="color: #fda230; font-size: 18px;"></i>
                                <input type="radio" id="settings_selectButtonBees1" name="bees-check">
                                <span class="checkmark"></span>
                            </label>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
