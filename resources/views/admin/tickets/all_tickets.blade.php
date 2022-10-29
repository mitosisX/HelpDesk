@extends('admin.layout.app')

@section('title')
    <title>Dashboard - Admin</title>
@endsection

@section('content')
    <!-- START ISSUES LIST-->
    <div class="column">
        <!-- START ISSUES CARD LIST-->
        <div class="columns is-desktop">
            <div class="column" style="margin-left: 200px;">
                <div class="columns  is-desktop has-text-centered">
                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">New</p>
                                        <p class="title">02</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-active"></div>
                        </div>
                    </div>

                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">Open</p>
                                        <p class="title">56</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-open"></div>
                        </div>
                    </div>

                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle">Closed</p>
                                        <p class="title">145</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-closed"></div>
                        </div>
                    </div>


                    <div class="column is-2">
                        <div class="card">
                            <div class="card-content">
                                <div class="content">
                                    <div>
                                        <p class="subtitle has-text-danger">Overdue</p>
                                        <p class="title has-text-danger">32</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-overdue"></div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- END ISSUES CARD LIST-->

        <div class="column box is-multiline">
            <table class="table is-fullheight is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Ticket name</th>
                        <th>Department</th>
                        <th>Asignee</th>
                        <th>Priority</th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12</td>
                        <td>Daugherty-Daniel</td>
                        <td>South Cory</td>
                        <td> sdsd</td>
                        <td>22323</td>
                        <td>
                            <div>
                                <button class="button is-rounded is-small is-primary" type="button">
                                    <span class="icon">
                                        <i class="mdi mdi-eye"></i>
                                    </span>
                                </button>
                                <button class="button is-rounded is-small is-danger jb-modal" data-target="sample-modal"
                                    type="button">
                                    <span class="icon">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END ISSUES LIST -->
@endsection
