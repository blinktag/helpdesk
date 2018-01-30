@extends('layouts.app')

@section('page_title', "Ticket {$ticket->id} - {$ticket->subject}")

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach($ticket->responses as $response)
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td width="20%">
                            <div class="text-center">
                                <p>
                                    <img src="{{ $response->user->getGravatarUrl() }}" class="rounded-circle" />
                                </p>
                                <p>
                                {{ $response->user->name }}
                                </p>
                            </div>
                        </td>
                        <td valign="top">
                            {{ $response->content }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            {{ $response->created_at->diffForHumans()}}

                            <span class="float-right">
                                {{ $response->from }}
                            </span>
                        </td>
                    </tr>
                </tfoot>
                @endforeach
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Reply
                </div>
                <div class="card-body">
                    <form action="{{ route('responses.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                            <div class="form-group">
                                <textarea rows="10" name="body" id="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body') }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <b>{{ $errors->first('body') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 float-right">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Attach A File</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                Add Reply
                            </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
