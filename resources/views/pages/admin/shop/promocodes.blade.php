@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage ItemShop Promocodes" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <form class="row g-3" method="POST" action="/shop/promocode">
                @csrf
                <div class="col-auto">
                    <label class="text-muted">Code</label>
                    <input type="text" name="code" placeholder="Promocode" class="form-control">
                </div>
                <!-- Select options MD and JD -->
                <div class="col-auto">
                    <label class="text-muted">Type</label>
                    <select class="form-select" name="type">
                        <option selected>Choose...</option>
                        <option value="1">MD</option>
                        <option value="2">JD</option>
                        <option value="3">ITEM</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="text-muted">Value</label>
                    <input type="number" name="value" placeholder="100" class="form-control">
                </div>
                <div class="col-auto">
                    <label class="text-muted">Count (only for items)</label>
                    <input type="number" name="count" value="1" class="form-control">
                </div>
                <div class="col-auto">
                    <label class="text-muted">Max. Uses</label>
                    <input type="number" name="max_uses" placeholder="100" class="form-control">
                </div>
                <div class="col-auto">
                    <label class="text-muted">Max. Uses Account</label>
                    <input type="number" name="max_uses_account" value="1" class="form-control">
                </div>
                <!-- expire_date input -->
                <div class="col-auto">
                    <label class="text-muted">Expire Date</label>
                    <input type="datetime-local" name="expires_at" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                </div>
            </form>

            <hr>
            <h1>Current codes</h1>
            <div class="text-center table-responsive">
                <!-- print data as table and create edit modal and delete button -->
                <table class="table table-striped">
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Count (only for items)</th>
                        <th>Max Uses</th>
                        <th>Max Uses / Acc</th>
                        <th>Total Uses</th>
                        <th>Expire Date</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($codes as $code)
                        <tr>
                            <td>{{$code->code}}</td>
                            <td>{{$code->type == 1 ? 'MD' : ($code->type == 2 ? 'JD' : 'ITEM')}}</td>
                            <td>{{$code->value}}</td>
                            <td>{{$code->count}}</td>
                            <td>{{$code->max_uses}}</td>
                            <td>{{$code->max_uses_account}}</td>
                            <!-- print how many times it has been used -->
                            <td>{{$code->getTotalUsesAttribute()}}</td>
                            <td>{{$code->expires_at}}</td>
                            <td>
                                <button type="button" class="btn btn-dark"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        data-id="{{$code->id}}"
                                        data-code="{{$code->code}}"
                                        data-type="{{$code->type}}"
                                        data-count="{{$code->count}}"
                                        data-value="{{$code->value}}"
                                        data-max_uses="{{$code->max_uses}}"
                                        data-max_uses_account="{{$code->max_uses_account}}"
                                        data-expires_at="{{$code->expires_at}}"
                                >
                                    Edit
                                </button>
                                <form action="/shop/promocode/{{$code->id}}" method="POST" id="deleteForm" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <!--pagination-->
                <div class="d-flex justify-content-center">
                    {{$codes->links()}}
                </div>

                <div class="modal " tabindex="-1" id="editModal">
                    <div class="modal-dialog">
                        <div class="modal-content page-holder">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit promocode</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">
                                    <form class="row g-3" method="POST" action="/shop/promocode/{{$code->id}}">
                                        <!-- add csrf token -->
                                        @method('PATCH')
                                        @method('PATCH')
                                        @csrf
                                        @csrf

                                        <div class="col-auto">
                                            <label>Code</label>
                                            <input type="text" name="code" value="" class="form-control">
                                        </div>
                                        <!-- Select options MD and JD -->
                                        <div class="col-auto">
                                            <label>Type</label>
                                            <select class="form-select" name="type">
                                                <option>Choose...</option>
                                                <option value="1">MD</option>
                                                <option value="2">JD</option>
                                                <option value="3">ITEM</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label>Value</label>
                                            <input type="number" name="value" class="form-control">
                                        </div>
                                        <div class="col-auto">
                                            <label>Count (only for items)</label>
                                            <input type="number" name="count" class="form-control">
                                        </div>
                                        <div class="col-auto">
                                            <label>Max. Uses</label>
                                            <input type="number" name="max_uses" class="form-control">
                                        </div>
                                        <div class="col-auto">
                                            <label>Max. Uses Account</label>
                                            <input type="number" name="max_uses_account" class="form-control">
                                        </div>
                                        <!-- expire_date input -->
                                        <div class="col-auto">
                                            <label>Expire Date</label>
                                            <input type="datetime-local" name="expires_at" class="form-control">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mb-3">Send</button>
                                            <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
    <script>
        // when opening a modal, fill the input fields with the data of the promocode
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            console.log(button.data)
            var code = button.data('code') // Extract info from data-* attributes
            var type = button.data('type')
            var value = button.data('value')
            var count = button.data('count')
            var max_uses = button.data('max_uses')
            var max_uses_account = button.data('max_uses_account')
            var expires_at = button.data('expires_at')
            // truncate expires_at without seconds
            expires_at = expires_at.substring(0, expires_at.length - 3)
            var url = '/shop/promocode/' + button.data('id')

            var modal = $(this)
            modal.find('form').attr('action', url)
            modal.find('.modal-body input[name="code"]').val(code)
            modal.find('.modal-body input[name="count"]').val(count)
            modal.find('.modal-body select[name="type"]').val(type)
            modal.find('.modal-body input[name="value"]').val(value)
            modal.find('.modal-body input[name="max_uses"]').val(max_uses)
            modal.find('.modal-body input[name="max_uses_account"]').val(max_uses_account)

            modal.find('.modal-body input[name="expires_at"]').val(expires_at)
        })
    </script>
@endsection
