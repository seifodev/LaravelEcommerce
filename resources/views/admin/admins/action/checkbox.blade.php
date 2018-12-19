
@if(admin()->user()->id !== $id)
    <input type="checkbox" class="check" name="check[]" value="{{ $id }}">
@endif
