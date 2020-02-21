<div class="lecture">
    <h4>Upload Lectures Video Below</h4>
    <div class="form-group">
        <input type="text" required autofocus class="form-control {{ $errors->has('lecture') ? ' is-invalid' : '' }}" value="{{ old('lecture') }}" id="lecture" name="lecture[]" placeholder="Lecture Title">
        @if ($errors->has('lecture'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('lecture') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label>Select Video for lecture (Optional)</label>
        <input type="file" name="lectureVid[]">
        @if ($errors->has('lectureVid'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('lectureVid') }}</strong>
            </span>
        @endif
    </div>



    <div class="form-group">
        <label for="notes">Add Notes (Optional)</label>
        <textarea name="notes[]" id="notes" rows="5" class="form-control notes"></textarea>
        @if ($errors->has('notes'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('notes') }}</strong>
            </span>
        @endif
    </div>
    <hr>
</div>

<script>
    var notes = CKEDITOR.replace('notes');
</script>
