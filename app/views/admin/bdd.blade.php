@extends('layouts.admin')

@section('content')
<header>
    <h1>Base de données</h1>
</header>
<article class="article panel" id="pan_admin">
    @if (isset($id)) 
    <?php
    $rows = DB::table($id)->get();
    $table = DB::select('PRAGMA table_info(\'' . $id . '\')');
    ?>
    <h2>Table {{$id}}</h2>
    <table class="striped sortable">
        <thead>
            <tr>
                @foreach ($table as $col) 
                <th>{{ucfirst($col->name)}}<!--em class="ad_em">({{ucfirst($col->type)}})</em--></th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row) 
            <tr>
                @foreach ($table as $col)
                @if ($col->type == "datetime")
                <td><div title="{{($row->{$col->name})}}">{{date("d/m/Y H:i:s", $row->{$col->name})}}</div></td>
                @else
                <td><div title="{{{($row->{$col->name})}}}">{{{($row->{$col->name})}}}</div></td>
                @endif
                @endforeach
                <td><span class="icon-lock"></span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else 
    <?php $tablesName = DB::table("sqlite_master")->select('name')->where('type', 'table')->get(); ?>
    @foreach ($tablesName as $tableName) 
    <p><a href="{{action('bdd@show', $tableName->name)}}">{{$tableName->name}}</a></p>
    @endforeach
    @endif
</article>
<aside></aside>
@stop

@section('footer')
@stop