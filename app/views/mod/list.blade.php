@extends('layouts/master')
@section('content')
<div class="page-header">
<h1>Mod Library</h1>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
	<div class="pull-right">
		<a href="{{ URL::to('mod/create') }}" class="btn btn-xs btn-success">Add Mod</a>
	</div>
	Mod List
	</div>
	<div class="panel-body">
		@if (Session::has('success'))
		<div class="alert alert-success">
			{{ Session::get('success') }}
		</div>
		@endif
		@if ($errors->all())
		<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
			{{ $error }}<br />
		@endforeach
		</div>
		@endif
		<table class="table table-striped table-bordered table-hover" id="dataTables">
			<thead>
				<tr>
					<th>#</th>
					<th>Mod Name</th>
					<th>Author</th>
					<th>Website</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($mods as $mod)
				<tr>
					<td>{{ HTML::link('mod/view/'.$mod->id, $mod->id) }}</td>
					@if (!empty($mod->pretty_name))
						<td>{{ HTML::link('mod/view/'.$mod->id, $mod->pretty_name) }} ({{ $mod->name }})</td>
					@else
						<td>{{ HTML::link('mod/view/'.$mod->id, $mod->name) }}</td>
					@endif
					<td>{{ !empty($mod->author) ? $mod->author : "N/A" }}</td>
					<td>{{ !empty($mod->link) ? HTML::link($mod->link, $mod->link, array("target" => "_blank")) : "N/A" }}</td>
					<td>{{ HTML::link('mod/view/'.$mod->id,'Manage', array("class" => "btn btn-xs btn-primary")) }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection
@section('bottom')
<script type="text/javascript">
$(document).ready(function() {
	$('#dataTables').dataTable({
        "order": [[ 1, "asc" ]],
        aLengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        iDisplayLength: -1
	});

});
</script>
@endsection