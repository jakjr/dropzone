<div class="row">
    <div class="col-md-12 well cab_interno">
        <h3 class="page-title">
            <i class="{{ isset($pageIcon) ? "{$pageIcon}" : '' }} x-bigger"></i>
            {{ $pageTitle or '' }}
            {!! isset($pageDesc) ? "<br><small>{$pageDesc}</small>" : '' !!}
        </h3>
    </div>
</div>