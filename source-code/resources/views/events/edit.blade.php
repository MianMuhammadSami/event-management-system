@extends('layouts.app')

@section('content')
    <div class="container" id="createEventPage">

        <div class="row">
            <h4><b>Edit / Update Event</b></h4>
            <p>
                Update the Name, Description, Type, OR Image of the event
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

        @if(!empty($event))
            <div class="row">
                <div class="col-6">


                    <form method="post" action="/update/{{$event['hash_id']}}" enctype="multipart/form-data">

                        <div class="form-group pt-2">
                            <label for="name">Event Name</label>
                            <input name="name" type="text" class="form-control" id="eventName"
                                   value="{{$event['name']}}"
                                   placeholder="Type Event Name">
                        </div>

                        <div class="form-group pt-2">
                            <label for="description">Event Description</label>
                            <textarea name="description" type="text" class="form-control" id="eventDescription"
                                      value="{{$event['description']}}"
                                      placeholder="Enter Event Description"></textarea>
                        </div>

                        <div class="form-group pt-2">
                            <label for="type_id">Select Event Type</label>
                            <select class="custom-select form-control" id="type_id" name="type_id">
                                @if($types->count() > 0)
                                    @foreach ($types as $type)
                                        <option value="{{$type['id']}}"

                                            {{ $type['id'] == $event['type_id'] ? 'selected' : '' }}


                                        >{{$type['name']}}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled></option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group pt-2">


                            @if(!empty($event['image']))
                                <div class="mb-3"
                                >
                                    <img width="200" height="200"
                                         src="{{ asset('images/'.$event['image']) }}"
                                         alt=""/>
                                </div>
                            @else
                                <p> Previous Image Not Available</p>
                            @endif

                            <label for="eventFile">Change Event Banner (Image) </label>
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

        @else
            <p> No Record Found.</p>
        @endif
    </div>
@endsection
