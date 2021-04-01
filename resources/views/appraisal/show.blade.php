<div class="card bg-none card-box">
    <div class="row py-4">
        <div class="col-md-12">
            <div class="info text-sm">
                <strong>{{__('Branch')}} : </strong>
                <span>{{ !empty($appraisal->branches)?$appraisal->branches->name:'' }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Employee')}} : </strong>
                <span>{{!empty($appraisal->employees)?$appraisal->employees->name:'' }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Appraisal Date')}} : </strong>
                <span>{{$appraisal->appraisal_date }}</span>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h6>{{__('Technical Competencies')}}</h6>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Customer Experience')}} : </strong>
                <span>{{ __(\App\Appraisal::$technical[$appraisal->customer_experience]) }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Marketing')}} : </strong>
                <span>{{ __(\App\Indicator::$technical[$appraisal->marketing]) }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Administration')}} : </strong>
                <span>{{ __(\App\Indicator::$technical[$appraisal->administration]) }}</span>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h6>{{__('Organizational Competencies')}}</h6>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Professionalism')}} : </strong>
                <span>{{ __(\App\Indicator::$technical[$appraisal->professionalism]) }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Integrity')}} : </strong>
                <span>{{ __(\App\Indicator::$technical[$appraisal->integrity]) }}</span>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="info text-sm font-style">
                <strong>{{__('Attendance')}} : </strong>
                <span>{{ __(\App\Indicator::$technical[$appraisal->attendance]) }}</span>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <h6>{{__('Remark')}}</h6>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-sm">{{$appraisal->remark }}</p>
        </div>
    </div>
</div>
