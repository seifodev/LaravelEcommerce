@if(session()->has('reset'))
    <div class="alert alert-success">{{ session('reset') }}</div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> @lang('admin.alert')!</h4>
        {{ session('success') }}
    </div>
@endif

@if(count($errors->all()))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> @lang('admin.alert')!</h4>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif