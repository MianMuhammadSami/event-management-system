@extends('layouts.app')

@section('content')
    <div class="container" id="createEventPage">

        <div class="row">
            <h4><b>Create Event Page</b></h4>
            <p>
                Add New Upcoming Event to the system
            </p>
        </div>

        <div class="row">
            <hr/>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-6">

                <form method="post" action="/store" enctype="multipart/form-data">

                    <div class="form-group pt-2">
                        <label for="name">Event Name</label>
                        <input name="name" type="text" class="form-control" id="eventName"
                               placeholder="Type Event Name">
                    </div>

                    <div class="form-group pt-2">
                        <label for="description">Event Description</label>
                        <textarea name="description" type="text" class="form-control" id="eventDescription"
                                  placeholder="Enter Event Description"></textarea>
                    </div>

                    <div class="form-group pt-2">
                        <label for="type_id">Select Event Type</label>
                        <select class="custom-select form-control" id="type_id" name="type_id">
                            @if($types->count() > 0)
                                @foreach ($types as $type)
                                    <option value="{{$type['id']}}" default>{{$type['name']}}
                                    </option>
                                @endforeach
                            @else
                                <option disabled></option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group pt-2">
                        <label for="eventFile">Upload Event Banner (Image) </label>
                        <div class="custom-file">
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group pt-4">
                        @csrf
                        <button type="submit" class="btn btn-dark">Save Event</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
