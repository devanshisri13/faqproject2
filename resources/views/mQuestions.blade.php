@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">This Month Questions
            <div class="card-body">
                <div class="card-deck">
                    @foreach($monthlyQuestions as $questions)
                        <div class="col-sm-4 d-flex align-items-stretch">
                            <div class="card mb-3 ">
                                <div class="card-header">
                                    <small class="text-muted">
                                        Created: {{ $questions->created_at}}

                                    </small>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$questions->body}}</p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text">

                                        <a class="btn btn-primary float-right"

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><a href="{{ route('questions.show', ['id' => $questions->id]) }}">{{$questions->body}}</a></li>
                                    </ul>

                                    </a>
                                    </p>
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>

            </div>


        </div>

        <div class="card-footer">
            <div class="float-left">
                {{ $monthlyQuestions->links() }}
            </div>
        </div>

    </div>


@endsection