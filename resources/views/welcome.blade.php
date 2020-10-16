@extends('layouts.app')

@section('content')
    <form action="" method="POST">
        <div class="row mt-4">
            <div class="col-12">
                <div class="form-group">
                    <label for="song_name">Search song:</label>
                    <input type="text" class="form-control" id="song_name" name="song_name">
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
    </form>

    <div id="songs"></div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#song_name").keyup(function() {
                let value = $("#song_name").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: './get_songs',
                    data: {
                        song_name: value,
                    }, success: function (response){
                        console.log(response);
                        $( "#songs" ).html(response);
                    }
                });
            })
        })
    </script>
@endsection
