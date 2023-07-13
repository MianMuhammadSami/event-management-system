@extends('layouts.app')

@section('content')
    <div class="container" id="eventsListingPage">

        <div class="row">
            <h4><b>Upcoming Events</b></h4>
            <p>
                The Events homepage is a central hub for discovering and exploring a wide range of upcoming events,
                including concerts, charity events, and prayer gatherings. Stay informed about the latest events in your
                area and never miss out on your favorite activities.
            </p>
        </div>

        <div class="row">

            <a class="col-sm-2 btn btn-dark mb-3" href="/create">
                <i class="fa fa-plus" aria-hidden="true"></i> Create Evenet
            </a>

            <hr/>
            
        </div>

        <div class="row">
            <div class="col-12">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            @if($events->count() > 0)

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Name</th>
                                        <th scope="col"></th>
                                        <th scope="col">Details</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($events as $event)
                                        <tr class="inner-box">
                                            <th scope="row">
                                                <div class="event-date">
                                                    <span>{{ $event['name'] }}</span>
                                                    <p>{{ $event['id'] }}</p>
                                                </div>
                                            </th>
                                            <td>
                                                <div class="event-img">
                                                    @if(!empty($event['image']))
                                                        <img width="150"
                                                            src="{{ asset('images/'.$event['image']) }}"
                                                            alt=""/>
                                                    @else
                                                        <p> Image Not Available</p>
                                                    @endif

                                                </div>
                                            </td>
                                            <td>
                                                <div class="event-wrap">
                                                    <h4>{{ $event['event_type'] }}</h4>
                                                    <p>{{ $event['description'] }}</p>

                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a class="text-secondary mr-3 fs-5" href="/edit/{{ $event['hash_id'] }}">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                </a>

                                                <a class="text-danger ml-2 fs-5 p-2"
                                                   href="/destroy/{{ $event['hash_id'] }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center p-3">
                                    <button class="btn btn-danger text-white">No Event Found.</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
