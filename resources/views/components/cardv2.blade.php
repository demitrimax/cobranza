<div class="panel panel-{!! isset($color) ? $color : 'default' !!}">
    <div class="panel-heading">

        <h3 class="panel-title">{!! isset($title) ? $title : 'Panel Default' !!}</h3>

    </div>
    <div class="panel-body">
        {{ $slot }}
    </div>
</div>
