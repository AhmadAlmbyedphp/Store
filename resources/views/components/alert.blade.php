
    @if (session()->has($type))
<div class="alert-dismissible alert alert-{{ $type }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Scsses</h5>
    <h2>{{ session()->get($type)}}</h2>
</div>
@endif