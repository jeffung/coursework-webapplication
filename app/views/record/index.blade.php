

@extends('layouts.master')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
          <p>Do you want to delete the selected entry?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="delete">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exportModalLabel">Import</h4>
      </div>
      <div class="modal-body">
        
          <h4>Import Record (.CSV):</h4>
          {{ Form::open(['route' => 'importRec', 'enctype' => 'multipart/form-data']) }}
          <input id="importRec" type="file" name="file">
          {{ $errors->first('file') }}
          {{ Form::close() }}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labell
edby="exportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exportModalLabel">Confirm Export</h4>
      </div>
      <div class="modal-body">
       <p>Do you want to Export all Records?</p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
       <button type="button" class="btn btn-primary" data-dismiss="modal" id="exportRec">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!--Button-->
<div id="toolbar" class="btn-group btn-default">
  <button class="btn btn-default" id="create">
    <i class="glyphicon glyphicon-file"></i> <span>New</span>
  </button>
  <button class="btn btn-default" id="show">
    <i class="glyphicon glyphicon-new-window"></i> <span>Show</span>
  </button>
  <button class="btn btn-default" id="edit">
    <i class="glyphicon glyphicon-edit"></i> <span>Edit</span>
  </button>
  @if (Auth::user() != null && Auth::user()->isAdmin())
  <button class="btn btn-default" data-toggle="modal" data-target="#deleteModal">
    <i class="glyphicon glyphicon-trash"></i> <span>Delete</span>
  </button>
  <button class="btn btn-default" data-toggle="modal" data-target="#importModal">
    <i class="glyphicon glyphicon-upload"></i> <span>Import</span>
  </button>
  <button class="btn btn-default" data-toggle="modal" data-target="#exportModal">
     <i class="glyphicon glyphicon-download"></i> <span>Export</span>
  </button>
  @endif

</div>



<!--Table-->
<div id="list">
  <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-click-to-select="true">
    <thead>
      <tr>
        <th data-field="state" data-checkbox="true"></th>
        <th data-field="patient.phn" data-sortable="true">Personal Health Number</th>
        <th data-field="patient.name" data-sortable="true">Full Name</th>
        <th data-field="patient.preferred_name" data-sortable="true">Preferred Name</th>
        <th data-field="user.name" data-sortable="true">Doctor</th>
        <th data-field="facility.name" data-sortable="true">Facility</th>
        <th data-field="reg_datetime" data-sortable="true">Registration</th>
        <th data-field="admit_datetime" data-sortable="true">Admittance</th>
      </tr>
    </thead>
  </table>
</div>

<input id="token" type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

@stop
