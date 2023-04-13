@extends('layouts.app')

@section('content')
<div class="container text-center p-5">
    <x-title title="Edit players" subtitle=""></x-title>

<div class="page-holder">
    <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

    <form method="POST" action="" class="searchbar row g-2 mb-5">
        @csrf
        <div class="col-auto">
            <input type="text" name="name" placeholder="Search..." class="form-control">
        </div>
        <div class="col-auto">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>{{__('Name')}}</th>
                <th>{{__('Account')}}</th>
                <th>{{__('IP')}}</th>
                <th>{{__('Level')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Actions')}}</th>
            </tr>
            @foreach($players as $player)
                <tr>
                    <td>{{$player->name}}</td>
                    <td>{{$player->account->login}}</td>
                    <td>{{$player->ip}}</td>
                    <td>{{$player->level}}</td>
                    <td>{{$player->account->status}}</td>
                    <td>
                        @if($player->banned())
                            <form method="POST" action="/player/unban/{{$player->account->id}}">
                                @csrf
                                <input type="submit" class="btn btn-success" value="Unban">
                            </form>
                        @else
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-account="{{$player->account->id}}">Ban</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        {{$players->links()}}
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ban player</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/player/ban">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Account id:</label>
                        <input type="number" class="form-control" id="account-id" name="account">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Reason:</label>
                        <input type="text" class="form-control" id="reason" name="reason">
                    </div>
                    <button type="submit" class="btn btn-primary">Send message</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var account = button.getAttribute('data-bs-account')
        var modalBodyInput = document.getElementById('account-id')
        console.log(modalBodyInput)
        modalBodyInput.value = account
    })

</script>
@endsection

