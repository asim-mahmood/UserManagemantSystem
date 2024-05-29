@extends('layoutsv2.app')
@section('content')
<?php $pagename = "packages";
$objLang = app('App\Http\Controllers\CtrlLang');
//mh check
//$company_id =  session()->has('companyId') ? session()->get('companyId') : 0;
?>



<div class="ss-mmr ss-settiong-container ss-bg-gray clearfix">
    @include('ss-setting.sidebar')
    <section class="ss-page__setting page-id--settings_advanced-email-builder ss-js-auto-hide-b-padding ss--auto-data-table">
        <article class="ss-page__setting__content" style="background-color:unset;">
            <div class="ss-page__setting__inner ss-pt--32">
                <div class="ss-f ss-f--sb rl-main--title rl-advanced-email-builder">

                    <div class="ss-f ss-f--start ss-f--no-wrap ss-pb--27">
                        <button class="ss-setting-nav ss--setting ss-mr--12">
                            <div class="ss-setting-bar ss-setting-arrow-top-r"></div>
                            <div class="ss-setting-bar ss-setting-arrow-middle-r"></div>
                            <div class="ss-setting-bar ss-setting-arrow-bottom-r"></div>
                        </button>
                        <div>
                            <h1 class="ss-htext ss-htext--24 ss-pt--0"> Manage Packages</h1>
                            <h4 class="ss-htext ss-htext--16 ss-fw--400 ss-py--0"> manage packages for Sign up. </h4>
                        </div>
                    </div>
                    <div class="ss-f--end" style="margin-bottom:auto;">
                        <ul class="ss-buttons apiclas ss-mr-15X">
                            <li>
                                <!--mh check-->
                                <a href="{{ URL::to('/template/builder2') }}" class="ss-highlight--bg ss-px--25 ss-py--11 ss-fw--700"> Add new Package</a>
                                {{-- <a href="{{ URL::to('/templatebuilder') }}" class="ss-highlight--bg ss-px--25 ss-py--11 ss-fw--700" > {{ $objLang->getLangword('create_template', 'common_part2') }} </a> --}}
                            </li>

                        </ul>
                    </div>
                    <div class="ss-f ss-f--center ss-center-line ss-width--80 ss-pb--10 hide">
                        <ul class="ss-shape-buttons apiclas ">
                            <li>
                                <a href="{{ URL::to('/templatebuilder') }}" class="ss-green--bg ss-px--25  ss-button--18 ss-fw--700 ss-button--shadow ss-radius--30 ss-primary-font">
                                    {{ $objLang->getLangword('create_template', 'common_part2') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="ss-right-section-content ss-mt-0">
                    <div class="ss-card">
                        <div class="ss-card__full ss-card--no-shadow rl-grid--template">
                            <div class="ss-lead-details__header ss-f ss-f--sb ss-px--24 ss-py--18">
                                <div class="ss-f ss-f--start">
                                    <h3 class="ss-lead-details__title ss-font__size--19 ss-mr--10 title-black"> Packages List </h3>
                                    <ul class="ss-lead-details__button-container ss-py--5">

                                    </ul>
                                </div>
                            </div>
                            <div class="ss-card__body ss-pa--0 ">
                                <div class="rl-card__left ss-card--hover  ss-card--no-shadow rl-integ--card">
                                    <div class="ss-card__body ss-f ss-f--sb ">
                                        <ul class="ss-buttons ss-mr--10">
                                            <li>
                                                <button class="ss-light--text ss-integration" style=" background-image: url('style/images/integration/dnc-logo.png');"></button>
                                            </li>
                                        </ul>
                                        <h2 class="ss-htext ss-htext--18 ss-fw--500"> Pacakage 1 </h2>
                                        <div class="ss-f ss-f--end ss-ml--auto">
                                            <ul class="ss-buttons">
                                                <li>
                                                    <!--switch button-->
                                                    <div class="switcher pull-left ss-ml--15" title="" style="cursor:pointer;line-height:5;">
                                                        <i data-isenabled="0" class="ss-color-green ss-p-relative  toggleDncApi fal fa-toggle-on fa-2x active"></i>
                                                        <!--<i data-isenabled="1"  class="ss-color-red ss-p-relative  toggleDncApi fal fa-toggle-on fa-2x fa-rotate-180 inactive"></i>-->
                                                    </div>
                                                    <!--switch button-->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ss-card__footer dnc-show ss-footer-opacity }}">
                                        <div class="ss-fx">
                                            <p class="ss-text--min ss-mr--10">
                                                <input type="checkbox" class="dncCheckbox" name="">
                                                <label for="isScrubDetail">DNC Scrub Details</label>
                                            </p>
                                            <p class="ss-text--min">
                                                <input type="checkbox" class="dncCheckbox" name="">
                                                <label for="isAddtoDnc">Add To IDNC</label>
                                            </p>
                                            <p class="ss-text--min">
                                                <input type="checkbox" class="dncCheckbox" name="isDncLitigator">
                                                <label for="isDncLitigator">High Performance Litigator Identification details</label>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="rl-card__left ss-card--hover  ss-card--no-shadow rl-integ--card">
                                    <div class="ss-card__body ss-f ss-f--sb ">
                                        <ul class="ss-buttons ss-mr--10">
                                            <li>
                                                <button class="ss-light--text ss-integration" style=" background-image: url('style/images/integration/dnc-logo.png');"></button>
                                            </li>
                                        </ul>
                                        <h2 class="ss-htext ss-htext--18 ss-fw--500"> Pacakage 1 </h2>
                                        <div class="ss-f ss-f--end ss-ml--auto">
                                            <ul class="ss-buttons">
                                                <li>
                                                    <!--switch button-->
                                                    <div class="switcher pull-left ss-ml--15" title="" style="cursor:pointer;line-height:5;">
                                                        <i data-isenabled="0" class="ss-color-green ss-p-relative  toggleDncApi fal fa-toggle-on fa-2x active"></i>
                                                        <!--<i data-isenabled="1"  class="ss-color-red ss-p-relative  toggleDncApi fal fa-toggle-on fa-2x fa-rotate-180 inactive"></i>-->
                                                    </div>
                                                    <!--switch button-->
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ss-card__footer dnc-show ss-footer-opacity }}">
                                        <div class="ss-fx">
                                            <p class="ss-text--min ss-mr--10">
                                                <input type="checkbox" class="dncCheckbox" name="">
                                                <label for="isScrubDetail">DNC Scrub Details</label>
                                            </p>
                                            <p class="ss-text--min">
                                                <input type="checkbox" class="dncCheckbox" name="">
                                                <label for="isAddtoDnc">Add To IDNC</label>
                                            </p>
                                            <p class="ss-text--min">
                                                <input type="checkbox" class="dncCheckbox" name="isDncLitigator">
                                                <label for="isDncLitigator">High Performance Litigator Identification details</label>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include("manage.setting-helpInfopage")
                </div><!--</ss-right-section-content>-->
            </div>
        </article>
    </section>
</div>


@endsection