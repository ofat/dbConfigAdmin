@extends($layout)

@section('title')
    Settings - {{ $page['name'] }}
@stop

@section('main')
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="settingsTabs">
        @foreach($page['tabs'] as $slug=>$tab)
        <li role="presentation"><a href="#tab-{{ $slug }}" role="tab" data-toggle="tab"><?=$tab['name']?></a></li>
        @endforeach
    </ul>
<p>&nbsp;</p>
    <!-- Tab panes -->
    <div class="tab-content">
        @foreach($page['tabs'] as $slug=>$tab)
        <div role="tabpanel" class="tab-pane" id="tab-{{ $slug }}">
            {{ Form::open(['route' => 'dbConfigAdmin.store']) }}
            <input type="hidden" name="tab" value="tab-{{ $slug }}">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            <br>
            <div class="row">
            @foreach($tab['items'] as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label>{{ $item['label'] }}</label>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="#" class="btn btn-sm btn-info btn-add top">Add item</a>
                        </div>
                    </div>
                    <br>
                    <div class="fieldBlock" id="fieldBlock-{{ $item['type'] }}">
                        @include('dbConfigAdmin::fields.'.$item['type'])
                    </div>
                    <a href="#" class="btn btn-sm btn-info btn-add bottom">Add item</a>
                </div>
            </div>
            @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
        @endforeach
    </div>

<script>
(function($){
    $("#settingsTabs a:first").tab('show');
    $('#settingsTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    $(".btn-add").click(function(e){
        e.preventDefault();
        var fieldBlock = $(this).closest('.form-group').find('.fieldBlock');
        var layout = fieldBlock.find('.form-group').first().clone();
        layout.find('input').val('').attr('value', '');
        if($(this).hasClass('bottom'))
            fieldBlock.append(layout);
        else
            fieldBlock.prepend(layout);
    });
    $(document).on('click', '.btn-remove', function(e){
        e.preventDefault();
        $(this).closest('.form-group').remove();
    });

    var hash = location.hash;
    if($('a[href="'+hash+'"]').length) {
        $('a[href="'+hash+'"]:first').tab('show');
    }
})(jQuery);
</script>
@stop