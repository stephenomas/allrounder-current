@if (App\Helpers\Utilities::admin())
<form action="{{$link}}" method="get">
    <div class="form-group row">
        <div class="col-sm-10 col-lg-4">
            <select name="branch" required class="select2 form-control modelsel" id="product" searchable="Search here..">
                @php
                   $current =  request('branch') && request('branch') != 0 ? App\Models\Branch::find(request('branch')) : null;
                @endphp
                <option value="{{$current->id ?? 0}}">{{$current->name ?? "All"}}</option>
                @if ($current)
                    <option value="0">All</option>
                @endif
                @foreach ($branches as  $branch)
                @if (!$current)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                @else
                    @if($current->id != $branch->id)
                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endif
                @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-light waves-effect waves-light m-l-10">Apply </button>
    </div>
</form>
@endif
