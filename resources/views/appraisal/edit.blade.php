<div class="card bg-none card-box">
    {{Form::model($appraisal,array('route' => array('appraisal.update', $appraisal->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class'=>'form-control-label'])}}
                {{Form::select('branch',$brances,null,array('class'=>'form-control select2','required'=>'required','id'=>'branch'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('employee',__('Employee'),['class'=>'form-control-label'])}}
                <select class="select2 form-control select2-multiple" id="employee" name="employee" data-toggle="select2" data-placeholder="{{ __('Select Employee') }}" required>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('appraisal_date',__('Select Month'),['class'=>'form-control-label'])}}
                {{ Form::text('appraisal_date',null, array('class' => 'form-control custom-datepicker')) }}
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <h6>{{__('Technical Competencies')}}</h6>
            <hr class="mt-0">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('customer_experience',__('Customer Experience'),['class'=>'form-control-label'])}}
                {{Form::select('customer_experience',$technical,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('marketing',__('Marketing'),['class'=>'form-control-label'])}}
                {{Form::select('marketing',$technical,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('administration',__('Administration'),['class'=>'form-control-label'])}}
                {{Form::select('administration',$technical,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6>{{__('Organizational Competencies')}}</h6>
            <hr class="mt-0">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('professionalism',__('Professionalism'),['class'=>'form-control-label'])}}
                {{Form::select('professionalism',$organizational,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('integrity',__('Integrity'),['class'=>'form-control-label'])}}
                {{Form::select('integrity',$organizational,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('attendance',__('Attendance'),['class'=>'form-control-label'])}}
                {{Form::select('attendance',$organizational,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('remark',__('Remarks'),['class'=>'form-control-label'])}}
                {{Form::textarea('remark',null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

<script type="text/javascript">
    function getEmployee(did) {
        $.ajax({
            url: '{{route('branch.employee.json')}}',
            type: 'POST',
            data: {
                "branch": did, "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                $('#employee').empty();
                $('#employee').append('<option value="">{{__('Select Branch')}}</option>');
                $.each(data, function (key, value) {
                    var select = '';
                    if (key == '{{ $appraisal->employee }}') {
                        select = 'selected';
                    }

                    $('#employee').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                });
            }
        });
    }

    $(document).ready(function () {
        var d_id = $('#branch').val();
        getEmployee(d_id);
    });

</script>



